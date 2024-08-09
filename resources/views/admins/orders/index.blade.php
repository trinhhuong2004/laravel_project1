
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
                                            <button type="button" class="btn btn-danger dropdown-toggle" onclick="toggleDropdown()" disabled="">
                                                <i class="fa fa-plus" ></i> Thêm mới sản phẩm
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table-bordered text-center footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Trạng thái thanh toán</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($listOrder as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->receiver_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($order->total_price, 0, '.', '.') }} đ</td>
                                        <td>{{ $order->receiver_address }}</td>
                                        <td>
                                            <form action="{{ route('admins.orders.update', $order->id) }}" method="POST" >
                                                @csrf
                                                @method('PUT')
                                                <select name="order_status" id="" class="form-control"
                                                onchange="confirmSubmit(this) " data-default-value="{{$order->order_status}}">
                                                    @foreach($order_status as $key => $item)
                                                        <option value="{{ $key }}"
                                                            {{ $key == $order->order_status ? 'selected' : '' }}
                                                            {{ $order->order_status == 'cancel' ? 'disabled' : '' }}
                                                        >
                                                            {{ $item }}
                                                        </option>

                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            @switch($order->payment_status)
                                                @case('unpaid')
                                                    Chưa thanh toán
                                                    @break
                                                @case('paid')
                                                    Đã thanh toán
                                                    @break
                                                @default
                                                    Không xác định
                                            @endswitch
                                        </td>
                                        <td class="text-right text-center">
                                            <a href="{{ route('admins.orders.show', $order->id) }}" ><button class="btn-primary btn btn-xs" style="border-radius: 3px; height: 27px"><i class="fa fa-eye"></i></button></a>


                                                <div class="btn-group"><form action="{{ route('admins.orders.destroy', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button {{$order->order_status === $type_canel_order ? '' : 'disabled'}}  type="submit" class="btn-danger btn btn-xs" style="border-radius: 3px; height: 27px"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>


                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
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
{{--<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>--}}
{{--<script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>--}}

{{--<script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script>--}}

<!-- FooTable -->

