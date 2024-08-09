<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home()
    {
        // Hiển sản phẩm trang chủ
        $products = Product::query()->latest('id')->limit(8)->get();
        $product_color = ProductColor::query()->latest()->get();
        $product_size = ProductSize::query()->latest()->get();
        $product_galleries= ProductGallery::query()->latest()->get();
        $totalCarts = CartItem::query()->count('cart_id');


        return view('clients.pages.home', compact('products',
            'product_color',
                        'product_size',
                        'totalCarts'));
    }
    public function about()
    {
        return view('clients.pages.about');
    }

    public function contact()
    {
        return view('clients.pages.contact');
    }

    public function posts()
    {
        return view('clients.pages.blog');
    }

    public function products()
    {
        return view('clients.pages.product-list');
    }
    public function detail($slug)
    {

        $listProduct = Product::query()->latest('id')->limit(4)->get();
//        dd($listProduct->toArray());
        $product = Product::query()->where('slug', $slug)->with(['variants', 'category', 'galleries'])->first();
        if (!$product) {
            // Xử lý khi không tìm thấy sản phẩm
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        $productVariant = $product->variants;
        $colorIds = [];
        $sizeIds = []; // Sửa $sizeID thành $sizeIds để đồng nhất tên biến

        foreach ($productVariant as $item) {
            $colorIds[] = $item->product_color_id;
            $sizeIds[] = $item->product_size_id; // Sửa $sizeIDs thành $sizeIds để đồng nhất tên biến
        }

        $sizes = ProductSize::query()->whereIn('id', $sizeIds)
            ->pluck('name', 'id')->all();
        $colors = ProductColor::query()->whereIn('id', $colorIds)
            ->pluck('name', 'id')->all();
        // Bỏ dòng không cần thiết: $productVariant = ProductVariant::query()->latest()
        $totalCarts = CartItem::query()->count('cart_id');

        return view('clients.pages.product-detail', compact('product', 'colors', 'sizes', 'productVariant', 'listProduct', 'totalCarts'));
    }

    public function Login()
    {
        // Xử lý logic hiển thị chi tiết sản phẩm
        return view('clients.pages.login');
    }
    public function Register()
    {
        // Xử lý logic hiển thị chi tiết sản phẩm
        return view('clients.pages.register');
    }
    public function myCart()
    {
        // Xử lý logic hiển thị chi tiết sản phẩm
        return view('clients.pages.orders.index');
    }
    public function Checkout()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
        }
//        dd($user);
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
        $userId = $cart->id;
        return view('clients.pages.checkout', compact('totalAmount', 'subTotal', 'shipping', 'productVariants', 'userId', 'user'));
    }
    public function bill()
    {

        return view('clients.pages.bill');
    }
}
