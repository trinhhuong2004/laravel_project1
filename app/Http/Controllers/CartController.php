<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function list()
    {
        // Lấy thông tin user đã đăng nhập
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
        }

        // Lấy ra thông tin cart
        $cart = Cart::query()->where('user_id', $user->id)->first();
        if (!$cart) {
            return view('clients.pages.cart', ['totalAmount' => 0, 'subTotal' => 0, 'shipping' => 30000, 'productVariants' => []]);
        }

        $totalAmount = 0;
        $subTotal = 0;
        $productVariants = $cart->cartItems()
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('product_sizes', 'product_sizes.id', '=', 'product_variants.product_size_id')
            ->join('product_colors', 'product_colors.id', '=', 'product_variants.product_color_id')
            ->get([
                'product_variants.id as product_variant_id',
                'products.name as product_name',
                'products.sku as product_sku',
                'products.img_thumb as product_img_thumb',
                'product_variants.price_variant as product_price_variant',
                'product_variants.price_sale_variant as product_price_sale_variant',
                'product_sizes.name as variant_size_name',
                'product_colors.name as variant_color_name',
                'cart_items.quantity'
            ]);

        // Tính tổng phụ và tổng số tiền
        foreach ($productVariants as $variant) {
            $price = $variant->product_price_sale_variant ?: $variant->product_price_variant;
            $quantity = $variant->quantity;
            $subTotal += $quantity * $price;
        }

        $shipping = 30000;
        $totalAmount = $subTotal + $shipping;

        return view('clients.pages.cart', compact('totalAmount', 'subTotal', 'shipping', 'productVariants'));
    }


    public function add(Request $request)
    {
        // Lấy sản phẩm theo ID
        $product = Product::query()->where('id', $request->product_id)->first();

        // Lấy biến thể sản phẩm theo các thuộc tính
        $productVariant = ProductVariant::query()->where([
            'product_id' => $request->product_id,
            'product_size_id' => $request->product_size_id,
            'product_color_id' => $request->product_color_id
        ])->first();

        // Kiểm tra nếu chưa đăng nhập thì trả về để đăng nhập
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'], 401);
        }

        // Lấy giỏ hàng của người dùng hoặc tạo mới nếu chưa có
        $cart = Cart::query()->firstOrCreate(['user_id' => $user->id]);

        // Chuẩn bị dữ liệu để lưu vào cart item
        $data = [
            'product_variant_id' => $productVariant->id,
            'cart_id' => $cart->id,
            'quantity' => $request->quantity
        ];

        // Kiểm tra nếu đã có product_variant_id thì cộng số lượng
        $cartItem = CartItem::query()->where([
            'product_variant_id' => $productVariant->id,
            'cart_id' => $cart->id
        ])->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $request->quantity]);
        } else {
            CartItem::query()->create($data);
        }

        return response()->json(['success' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
    }

    public function update(Request $request)
    {
        // Validate input data
        $request->validate([
            'cartItems' => 'required|array',
            'cartItems.*.product_id' => 'required|integer',
            'cartItems.*.quantity' => 'required|integer|min:1',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Loop through each cart item from the request
        foreach ($request->cartItems as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];

            // Find the cart item and update its quantity
            CartItem::where('product_variant_id', $productId)
                ->where('cart_id', function ($query) use ($user) {
                    $query->select('id')
                        ->from('carts')
                        ->where('user_id', $user->id);
                })
                ->update(['quantity' => $quantity]);
        }

        // Calculate subtotal and totalAmount
        $cartItems = CartItem::whereHas('cart', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $cart = Cart::query()->where('user_id', $user->id)->first();
        if (!$cart) {
            return view('clients.pages.cart', ['totalAmount' => 0, 'subTotal' => 0, 'shipping' => 30000, 'productVariants' => []]);
        }

        $totalAmount = 0;
        $subTotal = 0;
        $productVariants = $cart->cartItems()
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('product_sizes', 'product_sizes.id', '=', 'product_variants.product_size_id')
            ->join('product_colors', 'product_colors.id', '=', 'product_variants.product_color_id')
            ->get([
                'product_variants.id as product_variant_id',
                'products.name as product_name',
                'products.sku as product_sku',
                'products.img_thumb as product_img_thumb',
                'product_variants.price_variant as product_price_variant',
                'product_variants.price_sale_variant as product_price_sale_variant',
                'product_sizes.name as variant_size_name',
                'product_colors.name as variant_color_name',
                'cart_items.quantity'
            ]);

        // Tính tổng phụ và tổng số tiền
        foreach ($productVariants as $variant) {
            $price = $variant->product_price_sale_variant ?: $variant->product_price_variant;
            $quantity = $variant->quantity;
            $subTotal += $quantity * $price;
        }

        $shipping = 30000;
        $totalAmount = $subTotal + $shipping;

        // Return JSON response
        return response()->json([
            'subtotal' => number_format($subTotal, 0, '', '.'),
            'totalAmount' => number_format($totalAmount, 0, '', '.'),
            'productVariants' => $productVariants,
        ]);
    }
    public function remove(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Xóa sản phẩm khỏi giỏ hàng
        CartItem::where('product_variant_id', $request->product_id)
            ->where('cart_id', function ($query) use ($user) {
                $query->select('id')
                    ->from('carts')
                    ->where('user_id', $user->id);
            })
            ->delete();

        // Lấy giỏ hàng của người dùng
        $cart = Cart::query()->where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json([
                'subtotal' => number_format(0, 0, '', '.'),
                'totalAmount' => number_format(30000, 0, '', '.'),
                'cartHtml' => '', // Không có sản phẩm
            ]);
        }

        // Tính toán tổng phụ và tổng số tiền
        $totalAmount = 0;
        $subTotal = 0;
        $productVariants = $cart->cartItems()
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('product_sizes', 'product_sizes.id', '=', 'product_variants.product_size_id')
            ->join('product_colors', 'product_colors.id', '=', 'product_variants.product_color_id')
            ->get([
                'product_variants.id as product_variant_id',
                'products.name as product_name',
                'products.sku as product_sku',
                'products.img_thumb as product_img_thumb',
                'product_variants.price_variant as product_price_variant',
                'product_variants.price_sale_variant as product_price_sale_variant',
                'product_sizes.name as variant_size_name',
                'product_colors.name as variant_color_name',
                'cart_items.quantity'
            ]);

        foreach ($productVariants as $variant) {
            $price = $variant->product_price_sale_variant ?: $variant->product_price_variant;
            $quantity = $variant->quantity;
            $subTotal += $quantity * $price;
        }

        $shipping = 30000;
        $totalAmount = $subTotal + $shipping;

        // Trả về JSON với thông tin cập nhật
        return response()->json([
            'subtotal' => number_format($subTotal, 0, '', '.'),
            'totalAmount' => number_format($totalAmount, 0, '', '.'),
        ]);
    }






}
