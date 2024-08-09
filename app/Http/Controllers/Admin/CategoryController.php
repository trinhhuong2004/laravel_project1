<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = "Danh mục sản phẩm";
        $listCategory = Category::orderByDesc('is_active')->get();
        return view('admins.categories.index', compact('title', 'listCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = "Thêm danh mục sản phẩm";
        return view('admins.categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(DanhMucRequest $request)
//    {
////        dd($request);
//        if($request->isMethod('POST')){
//            $param = $request->except('_token');
//            if($request->hasFile('cover')){
//                $filepath = $request->file('cover')->store('upload/categories', 'public');
//            }else{
//                $filepath = null;
//            }
//            $param['cover'] = $filepath;
//            Category::create($param);
//            return redirect()->route('admins.categories.index')->with('success', 'Them danh muc thành công');
//        }else{
//            return redirect()->route('admins.categories.create')->with('errors', 'Thêm mới khong thành công');
//        }
//    }
    public function store(DanhMucRequest $request)
    {
        if ($request->isMethod('POST')) {
            // Xử lý việc upload file nếu có
            $filepath = $request->hasFile('cover') ? $request->file('cover')->store('upload/categories', 'public') : null;

            // Tạo mảng tham số để lưu trữ danh mục
            $param = $request->except('_token');
            $param['cover'] = $filepath;

            // Tạo mới danh mục
            $category = Category::create($param);

            // Trả về phản hồi JSON
            return response()->json(['success' => 'Danh mục đã được thêm thành công!', 'category' => $category]);
        } else {
            return response()->json(['errors' => 'Phương thức không được hỗ trợ'], 405);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $title = "Chỉnh sửa danh mục sản phẩm";
        $category = Category::findOrFail($id);
        return view('admins.categories.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $param = $request->except('_token','_method');

            $category = Category::findOrFail($id);

            if($request->hasFile('cover')){
                if ($category->cover && Storage::disk('public')->exists($category->cover)){
                    Storage::disk('public')->delete($category->cover);
                }
                $filepath = $request->file('cover')->store('upload/categories', 'public');
            }else{
                $filepath = $category->cover;
            }
            $param['cover'] = $filepath;
            $category->update($param);
            return redirect()->route('admins.categories.index')->with('success', 'Cập nhật danh mục thành công');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id)
//    {
//        $category = Category::findOrFail($id);
//
//        $category->delete();
//
//        if ($category->cover && Storage::disk('public')->exists($category->cover)){
//            Storage::disk('public')->delete($category->cover);
//        }
//        return redirect()->route('admins.categories.index')->with('success', 'Xóa danh mục thành công');
//
//    }
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra trạng thái đơn hàng thông qua các mối quan hệ
        $hasNonCanceledOrder = $category->products()->whereHas('variants.orderItems.order', function ($query) {
            $query->where('order_status', '!=', 'cancel');
        })->exists();

        if ($hasNonCanceledOrder) {
            return redirect()->route('admins.categories.index')->with('error', 'Không thể xóa danh mục vì có đơn hàng không phải trạng thái hủy.');
        }
        // Xóa danh mục
        $category->delete();

        // Xóa ảnh bìa nếu tồn tại
        if ($category->cover && Storage::disk('public')->exists($category->cover)) {
            Storage::disk('public')->delete($category->cover);
        }

        return redirect()->route('admins.categories.index')->with('success', 'Xóa danh mục thành công');
    }









}
