
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection
@section('content')
{{--    @dd($data)--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Danh sách sản phẩm</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Sản phẩm</a>
                </li>
                <li class="active">
                    <strong>Danh sách sản phẩm</strong>
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
                                        <div class="btn-group">
                                            <a href="{{ route('admins.products.create_variant') }}">
                                                <button type="button" class="btn btn-danger dropdown-toggle" onclick="toggleDropdown()">
                                                    <i class="fa fa-plus"></i> Thêm mới sản phẩm
                                                </button>
                                            </a>
{{--                                            <div class="dropdown-menu-add">--}}
{{--                                                <a class="dropdown-item" href="{{ route('admins.products.create') }}">Sản phẩm thường</a>--}}
{{--                                                <a class="dropdown-item" href="{{ route('admins.products.create_variant') }}">Sản phẩm biến thể</a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table-bordered text-center footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>

                                <th  class="text-center" data-toggle="true">STT</th>
                                <th  class="text-center" data-toggle="phone">Tên </th>
                                <th  class="text-center" data-hide="all">Mô tả</th>
                                <th  class="text-center" data-hide="phone">Mã</th>
                                <th  class="text-center" data-hide="phone">Hình ảnh</th>
                                <th  class="text-center" data-hide="phone">Gía Niêm Yết</th>
                                <th  class="text-center" data-hide="phone">Gía Sale</th>
                                <th  class="text-center" data-hide="phone">Trạng Thái</th>
                                <th  class="text-center" data-hide="phone" >Thao Tác</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>
                                        @if(str_contains($item->img_thumb, '/products'))
                                            <img src="{{ Storage::url($item->img_thumb) }}" alt="" style="max-width: 100px; height: 70px"></td>
                                        @else
                                        <img src="{{ $item->img_thumb }}" alt="" style="max-width: 100px; height: 70px"></td>

                                        @endif
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->price_sale }}</td>

                                    <td class="footable-visible">
                                            <span class="{{ $item->is_active == true ? 'label label-primary' : 'label label-danger'}}">
                                            {{ $item->is_active == true ? 'Hoạt động' : 'Không hoạt đôộng'}}
                                            </span>
                                    </td>
                                    <td class="text-right text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admins.products.show', $item->id) }}" ><button class="btn-primary btn btn-xs" style="border-radius: 3px; height: 27px"><i class="fa fa-eye"></i></button></a>
                                            <a href="{{ route('admins.products.edit', $item->id) }}" ><button class="btn-success btn btn-xs" style="border-radius: 3px; height: 27px"><i class="fa fa-edit"></i></button></a>
                                            <form action="{{ route('admins.products.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger btn btn-xs" style="border-radius: 3px; height: 27px"><i class="fa fa-trash"></i></button>
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
        function toggleDropdown() {
            const dropdownMenu = document.querySelector('.dropdown-menu-add');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(event) {
            const isClickInside = document.querySelector('.btn-group').contains(event.target);
            if (!isClickInside) {
                document.querySelector('.dropdown-menu-add').style.display = 'none';
            }
        });
    </script>
    <script src="{{ asset('backend/js/plugins/footable/footable.all.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();

        });

    </script>
@endsection
{{--<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>--}}

{{--<script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script>--}}

<!-- FooTable -->

