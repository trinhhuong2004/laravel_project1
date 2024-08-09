<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Quản lý tài khoản';
        $user = User::query()->get();
        return view('admins.accounts.index', compact('title', 'user'));
    }

    public function edit(Request $request, string $id)
    {
        $title = 'Cập nhật trạng thái';
        $user = User::query()->findOrFail($id);

        return view('admins.accounts.edit', compact('title', 'user'));
    }
    public function update(Request $request, string $id)
    {
        // Tìm tài khoản theo ID
        $account = User::findOrFail($id);

        // Lấy giá trị trạng thái từ request
        $status = $request->input('is_active');

        // Cập nhật trạng thái của tài khoản
        $account->is_active = $status;
        $account->save();

        // Quay lại trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }


}
