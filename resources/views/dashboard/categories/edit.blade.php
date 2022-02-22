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
                <li class="breadcrumb-item active">تعديل قسم </li>
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
                            <h3 class="box-title">تعديل قسم</h3>
                        </div><!-- end of box header -->
                        <div class="box-body">



                            <form action="{{ route('categories.update', $category->id) }}}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('put') }}


                                <div class="form-group">
                                    <label>اسم القسم</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $category->name }}">
                                </div>
                                <input type="hidden" name="id" class="form-control" value="{{ $category->id }}">


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        تعديل</button>
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
