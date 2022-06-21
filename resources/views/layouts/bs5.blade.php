<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <title>{{$title ?? '' ?? ''}}</title>
    @yield('csrf-token')
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href= "{{ url('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    {{-- Loading --}}
    <link type="text/css" rel="stylesheet" href="{{ url('css/waitMe.min.css') }}">

    @yield('filecss')      

    <!-- eki -->
    {{-- <link rel="stylesheet" href="{{ url('css/eki.css') }}"> --}}


  </head>
  <body>
    
    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>    
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    
    <script src="{{ url('js/waitMe.min.js') }}"></script> 
    @yield('filejs')
  </body>
</html>

<script>
    let _token   = $('meta[name="csrf-token"]').attr('content');

    function loading2(run = 1, xclass = '', xtext = 'Please wait ...'){
        if (run > 0){
            $(xclass).waitMe({
                //none, rotateplane, stretch, orbit, roundBounce, win8, 
                //win8_linear, ios, facebook, rotation, timer, pulse, 
                //progressBar, bouncePulse or img
                effect: 'pulse',
                //place text under the effect (string).
                text: xtext,
                //background for container (string).
                bg: 'rgba(255,255,255,0.9)',
                //color for background animation and text (string).
                color: '#000',
                //max size
                maxSize: '',
                //wait time im ms to close
                waitTime: -1,
                //url to image
                source: '',
                //or 'horizontal'
                textPos: 'vertical',
                //font size
                fontSize: ''
            });
        }
        else{
            $(xclass).waitMe("hide");
        }

    }

    function loading(run = 1, xtext = 'Please wait ...'){
            if (run > 0){
                $('.box').waitMe({
                    //none, rotateplane, stretch, orbit, roundBounce, win8, 
                    //win8_linear, ios, facebook, rotation, timer, pulse, 
                    //progressBar, bouncePulse or img
                    effect: 'pulse',
                    //place text under the effect (string).
                    text: xtext,
                    //background for container (string).
                    bg: 'rgba(255,255,255,0.9)',
                    //color for background animation and text (string).
                    color: '#000',
                    //max size
                    maxSize: '',
                    //wait time im ms to close
                    waitTime: -1,
                    //url to image
                    source: '',
                    //or 'horizontal'
                    textPos: 'vertical',
                    //font size
                    fontSize: ''
                });
            }
            else{
                $('.box').waitMe("hide");
            }

        }
</script> 

@yield('scripts')