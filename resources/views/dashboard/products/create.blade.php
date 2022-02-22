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
                <li class="breadcrumb-item active">اضافة منتج </li>
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

                        <div class="box-header">
                            <h3 class="box-title">اضافة منتج</h3>
                        </div><!-- end of box header -->
                        <div class="box-body">



                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="form-group">
                                    <label>الأقسام</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">كل الأقسام</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label>اسم المنتج</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label>وصف المنتج</label>
                                    <textarea name="description"
                                        class="form-control ckeditor">{{ old('description') }}</textarea>
                                </div>




                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="image" class="dropify"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div><br>

                                <div class="form-group">
                                    <img src="{{ asset('assets/images/product_images/default.png') }}"
                                        style="width: 100px" class="img-thumbnail image-preview" alt="">
                                </div>

                                <div class="form-group">
                                    <label>سعر الشراء</label>
                                    <input type="number" name="purchase_price" step="0.01" class="form-control"
                                        value="{{ old('purchase_price') }}">
                                </div>

                                <div class="form-group">
                                    <label>سعر البيع</label>
                                    <input type="number" name="sale_price" step="0.01" class="form-control"
                                        value="{{ old('sale_price') }}">
                                </div>

                                <div class="form-group">
                                    <label>المخزن</label>
                                    <input type="number" name="stock" class="form-control"
                                        value="{{ old('stock') }}">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        اضافة</button>
                                </div>

                            </form><!-- end of form -->

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
