@extends('clients.layouts.index')

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between my-md-2 my-2">
                        <h3 class="fs-1">Danh sách đơn hàng</h3>
                        <div class="row my-2">
                            <div class="col-md-20">
                                <form method="POST" action="" style="display: inline-block;">
                                    <input type="text" name="keyword" class="form-control"
                                           placeholder="Tìm kiếm sản phẩm"/>
                            </div>
                            <input class="btn btn-primary my-md-0 my-1" style="height: 38px; margin-left: 10px"
                                   name="btn_search" type="submit" value="Tìm kiếm">
                            </form>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Số hóa đơn</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">PT thanh toán</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                        </thead>
                        {{--                    <tbody>--}}
                        {{--                    <?php--}}
                        {{--                    if (isset($list_order)) {--}}
                        {{--                    foreach ($list_order as $order) :--}}
                        {{--                        extract($order);--}}
                        {{--                        $pttt = get_payment($pttt);--}}
                        {{--                        $del_order = "?act=delete_order&id=$ma";--}}
                        {{--                        $edit_order = "?act=edit_order&id_order=$ma";--}}
                        {{--                        $detail_order = "?act=detail_order&id_order=$ma";--}}
                        {{--                        $status = get_status($trang_thai);--}}
                        {{--                        ?>--}}
                        {{--                    <tr>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $ma ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $ho_ten ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $ngay_dat ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= number_format($tong_dh, 0, '.', '.') . " ₫"  ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $ma_dh ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $dia_chi ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $pttt ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $ngay_dat ?>--}}
                        {{--                        </td>--}}
                        {{--                        <td class="text-center">--}}
                        {{--                                <?= $status ?>--}}
                        {{--                        </td>--}}

                        {{--                        <td class="text-center">--}}
                        {{--                            <!-- <a href="?act=update_order" class="btn btn-warning">Sửa</a> -->--}}
                        {{--                            <a href="<?= $detail_order ?>" class="btn btn-warning">--}}
                        {{--                                Xem chi tiết--}}
                        {{--                            </a>--}}
                        {{--                                <?php--}}
                        {{--                                if ($trang_thai!=0 && $trang_thai!=5 && $trang_thai!=4) {--}}
                        {{--                                    echo ' <a href=" '.$edit_order.'" class="btn btn-warning">Sửa</a>';--}}
                        {{--                                }--}}

                        {{--                                // if ($trang_thai==5) {--}}
                        {{--                                //     echo '<a style="margin-left: 3px;" onclick="return confirm(\'Bạn có xoá không?\')" href="'.$del_order.'" class="btn btn-danger">Xóa</a>';--}}
                        {{--                                // }--}}
                        {{--                                ?>--}}
                        {{--                        </td>--}}
                        {{--                    </tr>--}}
                        {{--                    <?php endforeach; }?>--}}
                        {{--                    </tbody>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
