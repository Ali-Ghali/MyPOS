@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    المنتجات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> المنتجات</h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">المنتجات</a></li>
                <li class="breadcrumb-item active">قائمة المنتجات </li>
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

                    <div class="box box-primary">

                        <div class="box-header with-border">


                            <h3 class="box-title" style="margin-bottom: 15px">المنتجات
                                <small>{{ $products->count() }}</small>
                            </h3>

                            <form action="{{ route('products.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control" placeholder="ابحث"
                                            value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <select name="category_id" class="form-control">
                                            <option value="">كل الأقسام</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            بحث</button>
                                        @can('اضافة منتج')
                                            <a href="{{ route('products.create') }}" class="btn btn-primary"><i
                                                    class="fa fa-plus"></i> اضف منتج</a>

                                        @endcan

                                    </div>

                                </div>
                            </form><!-- end of form -->

                        </div><!-- end of box header -->
                        <div class="box-body">

                            @if ($products->count() > 0)
                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>الوصف</th>
                                            <th>القسم</th>
                                            <th>المخزن</th>
                                            <th>صورة</th>
                                            <th>سعر الشراء</th>
                                            <th>سعر البيع</th>
                                            <th>مكسب %</th>
                                            <th>مكسب</th>

                                            <th>العمليات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{!! $product->description !!}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td><img src="{{ $product->image_path }}" style="width: 100px"
                                                        class="img-thumbnail" alt=""></td>
                                                <td>{{ $product->purchase_price }}</td>
                                                <td>{{ $product->sale_price }}</td>
                                                <td>{{ $product->profit_percent }} %</td>
                                                <td>{{ $product->profit_price }}</td>


                                                <td>
                                                    @can('تعديل منتج')
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            تعديل المنتج</a>
                                                    @endcan


                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="post" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        @can('حذف منتج')
                                                            <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                                    class="fa fa-trash"></i>
                                                                حذف المنتج</button>
                                                        @endcan
                                                    </form><!-- end of form -->

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table><!-- end of table -->



                            @else

                                <h2>البيانات غير موجودة</h2>

                            @endif

                        </div><!-- end of box body -->


                    </div><!-- end of box -->

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
