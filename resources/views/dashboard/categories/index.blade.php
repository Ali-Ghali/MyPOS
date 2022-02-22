@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الاقسام
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الاقسام</h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الاقسام</a></li>
                <li class="breadcrumb-item active">قائمة الاقسام </li>
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

                <h3 class="box-title" style="margin-bottom: 15px">الاقسام
                    <small>{{ $categories->count() }}</small>
                </h3>
                <br><br>
                <form action="{{ route('search') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="ابحث" value="">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                ابحث</button>
                            @can('اضافة قسم')
                                <a href="{{ route('categories.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> اضافة قسم</a>
                            @endcan


                        </div>

                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->

            <div class="table-responsive">
                @if ($categories->count() > 0)
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>تم اضافته</th>
                                <th>عدد المنتجات</th>
                                <th>المنتجات المرتبطين</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td><a href="{{ route('products.index', ['category_id' => $category->id]) }}"
                                            class="btn btn-info btn-sm">المنتجات</a></td>
                                    <td>
                                        @can('تعديل القسم')
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                تعديل القسم</a>

                                        @endcan


                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                            style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            @can(' حذف القسم')
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                        class="fa fa-trash"></i> حذف القسم</button>
                                            @endcan
                                            <input type="hidden" name="id" class="form-control"
                                                value="{{ $category->id }}">
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
