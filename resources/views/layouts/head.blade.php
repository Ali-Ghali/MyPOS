<!-- Title -->
<title>@yield("title")</title>
{{-- <!-- Bootstrap 3.3.7 --> --}}
<link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />
{{-- morris --}}
<link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">
<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

<style>
    .mr-2 {
        margin-right: 5px;
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid #367FA9;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 1s linear infinite;
        /* Safari */
        animation: spin 1s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style>


<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
