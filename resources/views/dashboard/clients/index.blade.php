@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الزبائن
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الزبائن</h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الزبائن</a></li>
                <li class="breadcrumb-item active">قائمة الزبائن </li>
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

                            <h3 class="box-title" style="margin-bottom: 15px">الزبائن
                                <small>{{ $clients->count() }}</small>
                            </h3>

                            <form action="{{ route('clients.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control" placeholder="ابحث"
                                            value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            ابحث</button>
                                        @can('اضافة زبون')
                                            <a href="{{ route('clients.create') }}" class="btn btn-primary"><i
                                                    class="fa fa-plus"></i>
                                                اضافة زبون</a>
                                        @endcan
                                    </div>

                                </div>
                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @if ($clients->count() > 0)
                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الزبون</th>
                                            <th>رقم هاتف الزبون</th>
                                            <th>عنوان الزبون</th>
                                            <th>اضافة طلب</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($clients as $index => $client)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ implode('-', $client->phone) }}</td>
                                                <td>{{ $client->address }}</td>
                                                <td>
                                                    @can('اضافة طلب')
                                                        <a href="{{ route('clients.orders.create', $client->id) }}"
                                                            class="btn btn-primary btn-sm">اضافة طلب</a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('تعديل زبون')
                                                        <a href="{{ route('clients.edit', $client->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                                            تعديل</a>
                                                    @endcan

                                                    <form action="{{ route('clients.destroy', $client->id) }}"
                                                        method="post" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        @can('حذف زبون')
                                                            <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                                    class="fa fa-trash"></i>
                                                                حذف</button>
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
