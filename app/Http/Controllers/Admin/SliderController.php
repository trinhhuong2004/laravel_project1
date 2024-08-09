<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $title = 'Danh sách slide';
        $sliders = Slider::all(); // Sửa lại ở đây
//        dd($sliders);
        return view('admins.sliders.index', compact('title', 'sliders'));
    }

    public function create()
    {
        $title = 'Thêm mới slide';
        return view('admins.sliders.create', compact('title'));
    }
    public function store(SlideRequest $request)
    {
//        dd($request->all());
        // Xử lý việc upload file nếu có
        if($request->isMethod('POST')){

            $filepath = $request->hasFile('thumb') ? $request->file('thumb')->store('upload/sliders', 'public') : null;

            // Tạo mảng tham số để lưu trữ danh mục
            $param = $request->except('_token');
            $param['thumb'] = $filepath;

            // Tạo mới danh mục
            Slider::create($param);
            return redirect()->route('admins.sliders.index')->with('success', 'Thêm mới slide thành công');
        }else {
            return redirect()->route('admins.sliders.create')->with('error', 'Thêm mới slide không thành công');
        }

    }
    public function edit( string $id)
    {
        $title = 'Cập nhật slide';
        $slide = Slider::query()->findOrFail($id);
        return view('admins.sliders.edit', compact('title', 'slide'));
    }
    public function update(Request $request, string $id)
    {
//        dd(3324);
        if($request->isMethod('PUT')){
            $param = $request->except('_token', '_method');
            $slide = Slider::query()->findOrFail($id);

            if($request->hasFile('thumb')){
                if ($slide->thumb && Storage::disk('public')->exists($slide->thumb)){
                    Storage::disk('public')->delete($slide->thumb);
                }
                $filepath = $request->file('thumb')->store('upload/sliders', 'public');
            }else{
                $filepath = $slide->thumb;
            }
            $param['thumb'] = $filepath;
            $slide->update($param);
            return redirect()->route('admins.sliders.index')->with('success', 'Cập nhật slide thành công');
        }
    }
    public function destroy(string $id)
    {
//        dd(233);
        $slide = Slider::query()->findOrFail($id);
        $slide->delete();
        if ($slide->thumb && Storage::disk('public')->exists($slide->thumb)){
            Storage::disk('public')->delete($slide->thumb);
        }
        return redirect()->back()->with('success', 'Xóa slide thành công');
    }



}
