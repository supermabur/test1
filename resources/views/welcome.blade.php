

    
@extends('layouts.dashboard')

@section('style')
    <style>

    </style>
@endsection



@section('content')
    <h1>Selamat datang di Backoffice Giripalma</h1>

    @include('globalreports\globalreport2')
@endsection



@section('scripts')
    <script>

        function GoMenu(elem){
            var dataId = $(elem).data('id');
                alert(dataId);
        }

    </script>
@endsection
