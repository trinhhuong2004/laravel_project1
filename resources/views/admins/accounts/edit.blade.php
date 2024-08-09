@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Danh sách danh mục</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <a>Danh mục</a>
                </li>
                <li class="active">
                    <strong>{{ $title }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Thông tin danh mục</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> Dữ liệu</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <form action="{{ route('admins.accounts.update', $user->id) }} " class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group"><label class="col-sm-2 control-label">Trạng Thái:</label>
                                        <div class="col-sm-4">
                                            <fieldset>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="1" {{ $user->is_active == true ? 'checked' : '' }} name="is_active">
                                                    <span class="label label-primary">Hoạt động</span>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="0" {{ $user->is_active == false ? 'checked' : '' }} name="is_active">
                                                    <span class="label label-danger">Không hoạt động</span>
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>

                                    <div class="btn-create">
                                        <button type="submit" class="btn-primary">Cập nhật</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
