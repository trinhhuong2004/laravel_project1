
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $title }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>{{ $title }}</a>
                </li>
                <li class="active">
                    <strong>Danh sách tài khoản</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="filter-wrapper">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <div class="perpage">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <select name="perpage" class="form-control input-sm perpage filter mr10">
                                            @for($i = 0; $i < 10; $i++)
                                                <option value="{{ $i }}">{{$i}} Ban ghi</option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>
                                <div class="action">
                                    <div class="uk-flex uk-flex-middle">
                                        <select name="user_catalogue" class="form-control input-s mr10">
                                            <option value="{{ $i }}">{{$i}} Ban ghi</option>

                                        </select>
                                        <div class="uk-search uk-flex uk-flex-middle mr10">
                                            <div class="input-group">
                                                <input type="text" name="keyword" placeholder="Nhập tu khóa để tìm kiếm" class="form-control mr10">
                                                <span class="input-group-btn">
                                                        <button type="submit" name="search" class="btn btn-primary mb0 btn-sm">Tìm kiếm</button>
                                                </span>
                                            </div>

                                        </div>
                                        <a href="#" class="btn btn-danger" disabled=""> <i class="fa fa-plus"></i>Thêm mới danh mục</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table-bordered text-center footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>

                                <th  class="text-center" data-toggle="true">STT</th>
                                <th  class="text-center" data-toggle="phone">Tên Khách Hàng</th>
                                <th  class="text-center" data-hide="phone">Email</th>
                                <th  class="text-center" data-hide="phone">Vai Trò</th>
                                <th  class="text-center" data-hide="phone">Trạng thái</th>
                                <th  class="text-center" data-hide="phone" >Thao Tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <form action="{{ route('admins.accounts.update', $item->id) }}" method="POST" >
                                            @csrf
                                            @method('PUT')
                                            <select name="is_active" id="" class="form-control"
                                                    onchange="confirmSubmit(this) " data-default-value="{{$item->is_active}}">
                                                <!-- Các tùy chọn trạng thái với giá trị thực tế -->
                                                <option value="1" {{ $item->is_active == '1' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="0" {{ $item->is_active == '0' ? 'selected' : '' }}>Khóa Tài Khoản</option>
                                            </select>
                                        </form>

                                    </td>
                                    <td class="text-right text-center">
                                        <div class="btn-group">
                                            <form action="{{ route('admins.accounts.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger btn btn-xs" style="border-radius: 3px; height: 27px">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script>
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');

            if (confirm('Bạn có chắc chắn thay đổi trạng thái đơn hàng thành ' + selectedOption + ' không?')) {
                form.submit();
            } else {
                selectElement.value = defaultValue;
            }
        }
    </script>
@endsection

