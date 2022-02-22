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
                <li class="breadcrumb-item active">اضافة زبون </li>
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
                            <h3 class="box-title">اضافة زبون</h3>
                        </div><!-- end of box header -->
                        <div class="box-body">



                            <form action="{{ route('clients.store') }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="form-group">
                                    <label>اسم الزبون</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                @for ($i = 0; $i < 2; $i++)
                                    <div class="form-group">
                                        <label>رقم هاتف الزبون</label>
                                        <input type="text" name="phone[]" class="form-control">
                                    </div>
                                @endfor

                                <div class="form-group">
                                    <label>عنوان الزبون</label>
                                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
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
