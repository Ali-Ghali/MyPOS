@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الطلبات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الطلبات</h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الطلبات</a></li>
                <li class="breadcrumb-item active">قائمة الطلبات </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">



    <div class="col-xl-10 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="content">

                    <div class="row">

                        <div class="col-md-8">

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title" style="margin-bottom: 10px">الطلبات</h3>

                                    <form action="{{ route('orders.index') }}" method="get">

                                        <div class="row">

                                            <div class="col-md-8">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="ابحث" value="{{ request()->search }}">
                                            </div>

                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-search"></i>ابحث</button>
                                            </div>

                                        </div><!-- end of row -->

                                    </form><!-- end of form -->

                                </div><!-- end of box header -->

                                @if ($orders->count() > 0)
                                    <div class="box-body table-responsive">

                                        <table class="table table-hover">
                                            <tr>
                                                <th>اسم الزبون</th>
                                                <th>السعر</th>
                                                {{-- <th>الحالة</th> --}}
                                                <th>تم اضافته:</th>
                                                <th>العمليات</th>
                                            </tr>

                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->client->name }}</td>
                                                    <td>{{ $order->total_price }}</td>
                                                    {{-- <td>
                                                        <button data-status="@lang('site.' . $order->status)"
                                                            data-url="{{ route('orders.update_status', $order->id) }}"
                                                            data-method="put"
                                                            data-available-status='جاري التحضير", "تم التحضير " ]'
                                                            class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm">
                                                            @lang('site.' . $order->status)
                                                        </button>
                                                    </td> --}}
                                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                    <td>
                                                        @can('عرض طلب')
                                                            <button class="btn btn-primary btn-sm order-products"
                                                                data-url="{{ route('orders.products', $order->id) }}"
                                                                data-method="get">
                                                                <i class="fa fa-list"></i>
                                                                عرض
                                                            </button>
                                                        @endcan
                                                        @can('تعديل طلب')
                                                            <a href="{{ route('clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="fa fa-pencil"></i> تعديل</a>

                                                        @endcan

                                                        <form action="{{ route('orders.destroy', $order->id) }}"
                                                            method="post" style="display: inline-block;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            @can('حذف طلب')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm delete"><i
                                                                        class="fa fa-trash"></i>
                                                                    حذف</button>
                                                            @endcan
                                                        </form>



                                                    </td>

                                                </tr>
                                            @endforeach

                                        </table><!-- end of table -->



                                    </div>

                                @else

                                    <div class="box-body">
                                        <h3>لايوجد بيانات</h3>
                                    </div>

                                @endif

                            </div><!-- end of box -->

                        </div><!-- end of col -->

                        <div class="col-md-4">

                            <div class="box box-primary">

                                <div class="box-header">
                                    <h3 class="box-title" style="margin-bottom: 10px">عرض المنتجات
                                    </h3>
                                </div><!-- end of box header -->

                                <div class="box-body">

                                    <div style="display: none; flex-direction: column; align-items: center;"
                                        id="loading">
                                        <div class="loader"></div>
                                        <p style="margin-top: 10px">تحميل</p>
                                    </div>

                                    <div id="order-product-list">

                                    </div><!-- end of order product list -->

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </section><!-- end of content section -->







            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
