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
                <li class="breadcrumb-item active">تعديل الطلب </li>
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

                        <div class="col-md-6">

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title" style="margin-bottom: 10px">الأقسام</h3>

                                </div><!-- end of box header -->

                                <div class="box-body">

                                    @foreach ($categories as $category)
                                        <div class="panel-group">

                                            <div class="panel panel-info">

                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse"
                                                            href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                                    </h4>
                                                </div>

                                                <div id="{{ str_replace(' ', '-', $category->name) }}"
                                                    class="panel-collapse collapse">

                                                    <div class="panel-body">

                                                        @if ($category->products->count() > 0)

                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>الاسم</th>
                                                                    <th>المخزن</th>
                                                                    <th>السعر</th>
                                                                    <th>اضافة</th>
                                                                </tr>

                                                                @foreach ($category->products as $product)
                                                                    <tr>
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->stock }}</td>
                                                                        <td>{{ $product->sale_price }}</td>
                                                                        <td>
                                                                            <a href="" id="product-{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-price="{{ $product->sale_price }}"
                                                                                class="btn {{ in_array($product->id, $order->products->pluck('id')->toArray())? 'btn-default disabled': 'btn-success add-product-btn' }} btn-sm">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table><!-- end of table -->

                                                        @else
                                                            <h5>لايوجد بيانات</h5>
                                                        @endif

                                                    </div><!-- end of panel body -->

                                                </div><!-- end of panel collapse -->

                                            </div><!-- end of panel primary -->

                                        </div><!-- end of panel group -->

                                    @endforeach

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                        </div><!-- end of col -->

                        <div class="col-md-6">

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title">الطلبات</h3>

                                </div><!-- end of box header -->

                                <div class="box-body">



                                    <form
                                        action="{{ route('clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}"
                                        method="post">

                                        {{ csrf_field() }}
                                        {{ method_field('put') }}

                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>المنتج</th>
                                                    <th>الكمية</th>
                                                    <th>السعر</th>
                                                </tr>
                                            </thead>

                                            <tbody class="order-list">

                                                @foreach ($order->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td><input type="number"
                                                                name="products[{{ $product->id }}][quantity]"
                                                                data-price="{{ $product->sale_price }}"
                                                                class="form-control input-sm product-quantity" min="1"
                                                                value="{{ $product->pivot->quantity }}"></td>
                                                        <td class="product-price">
                                                            {{ $product->sale_price * $product->pivot->quantity }}
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm remove-product-btn"
                                                                data-id="{{ $product->id }}"><span
                                                                    class="fa fa-trash"></span></button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table><!-- end of table -->

                                        <h4>الاجمالي : <span class="total-price">{{ $order->total_price }}</span>
                                        </h4>

                                        <button class="btn btn-primary btn-block" id="form-btn"><i
                                                class="fa fa-edit"></i> تعديل الطلب</button>

                                    </form><!-- end of form -->

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                            @if ($client->orders->count() > 0)
                                <div class="box box-primary">

                                    <div class="box-header">

                                        <h3 class="box-title" style="margin-bottom: 10px">
                                            الطلبات السابقة
                                            <small>{{ $orders->count() }}</small>
                                        </h3>

                                    </div><!-- end of box header -->

                                    <div class="box-body">

                                        @foreach ($orders as $order)

                                            <div class="panel-group">

                                                <div class="panel panel-success">

                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse"
                                                                href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                        </h4>
                                                    </div>

                                                    <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                                        class="panel-collapse collapse">

                                                        <div class="panel-body">

                                                            <ul class="list-group">
                                                                @foreach ($order->products as $product)
                                                                    <li class="list-group-item">{{ $product->name }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </div><!-- end of panel body -->

                                                    </div><!-- end of panel collapse -->

                                                </div><!-- end of panel primary -->

                                            </div><!-- end of panel group -->

                                        @endforeach



                                    </div><!-- end of box body -->

                                </div><!-- end of box -->

                            @endif

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </section><!-- end of content -->






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
