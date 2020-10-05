<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>{{$title ?? '' ?? ''}}</title>
  @yield('csrf-token')
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">




  <!-- Font Awesome -->
  <link rel="stylesheet" href= "{{ url('adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('adminlte3/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/daterangepicker/daterangepicker.css') }}">
  {{-- DatePicker --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

  <link rel="stylesheet" href="{{ url('css/highCheckTree.css') }}">

  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('adminlte3/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Datatables -->
  {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.5.2/css/keyTable.dataTables.min.css">

  {{-- Loading --}}
  <link type="text/css" rel="stylesheet" href="{{ url('css/waitMe.min.css') }}">

  {{-- Image Select Area --}}
  <link type="text/css" rel="stylesheet" href="{{ url('css/jquery.selectareas.css') }}">

  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


  <!-- eki -->
  <link rel="stylesheet" href="{{ url('css/eki.css') }}">
  
  <style>
    a:hover {
        cursor: pointer;
    }

    .image-cropper {
    width: 150px;
    height: 150px;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    text-align-last: center;
    }

    .profile-pic {
      display: inline;
      margin: 0 auto;
      height: 100%;
      width: auto;
    }

    /* .card-footer{
      background-color: lightgray;
    } */
  </style>

  @yield('style')


  <script>
    // var gr_menuid;
    // var gr_columnheader;
    // var gr_dtcolumns;
    // var gr_columnnative;
    // var gr_data;
    // var gr_urlshowwithid;


  </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="    background-color: aliceblue;">
  {{-- <div class="content-wrapper" style="margin-left: 0px;"> --}}
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
      @yield('content')
      {{-- <div class="contentxxx" id="box">

      </div> --}}


      @if (!str_contains($title ?? '', 'USER'))  
          <div id="modaleditprofile" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Profile</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      @include('users')
                    </div>
                  </div>
              </div>
          </div>                  
    
          <script>
            $(document).on('click', '.EditProfileBtn', function(){
              var sites = {!! json_encode($composer_cur_user->toArray()) !!};
              $('#formx')[0].reset();
              $('#form_result').html('');
              $('#hidden_id').val('');
              $('#role').val('').trigger('change');
              $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/users/noimage.jpg");
              
              $.ajax({
                url:"/users/"+sites.id+"/edit",
                dataType:"json",
                success:function(data)
                    {
                        $('#name').val(data.name);
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                        $('#hp').val(data.hp);
                        $('#role').val(data.role_id).trigger('change');
                        $('#password').val('');
                        $('#password-confirm').val('');
                        $('#active').prop('checked', data.active);
                        $('#hidden_id').val(data.id);
    
                        var pi = "{{ URL::to('/') }}/images/users/" + data.id + ".jpg";
                        if(doesFileExist(pi)){
                            $('#image_preview_container').attr('src', pi);
                        }
    
                        $('#imageold').val(data.id + '.jpg');
                        $("#modaleditprofile .hidexxx").hide();
                        $('#modaleditprofile').modal({
                                                backdrop: 'static',
                                                keyboard: false
                                                });
                    }
                })    
            });
          </script>
    
      @endif


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('adminlte3/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
{{-- <script src="{{ url('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- ChartJS -->
<script src="{{ url('adminlte3/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('adminlte3/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('adminlte3/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('adminlte3/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('adminlte3/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('adminlte3/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('adminlte3/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Summernote -->
<script src="{{ url('adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('adminlte3/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('adminlte3/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('adminlte3/dist/js/demo.js') }}"></script>


<!-- Datatables -->
{{-- <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ url('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.5.2/js/dataTables.keyTable.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ url('js/highchecktree.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ url('js/waitMe.min.js') }}"></script> 
<script src="{{ url('js/memst.js') }}"></script> 
<script src="{{ url('js/jquery.selectareas.min.js') }}"></script>



</body>
</html>

<script>


    function pasangprofileimage(){
      var sites = {!! json_encode($composer_cur_user->toArray()) !!};
      var pi = "{{ URL::to('/') }}/images/users/" + sites.id + ".jpg";
      if(doesFileExist(pi)){
        $('.profileimg').attr('src', pi);
      }
    }

    function doesFileExist(urlToFile) {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', urlToFile, true);
        xhr.send();
        switch(xhr.status){
            case "404", 404 :
            return false;
            break;
          default:
            return true;
            break;
        }
    }
    
    pasangprofileimage();

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

  // function doesFileExist(urlToFile) {
  //       var xhr = new XMLHttpRequest();
  //       xhr.open('HEAD', urlToFile, false);
  //       xhr.send();
        
  //       if (xhr.status == "404") {
  //           return false;
  //       } else {
  //           return true;
  //       }
  //   }

  // function pasangprofileimage(){
  //   var sites = {!! json_encode($composer_cur_user->toArray()) !!};
  //   var pi = "{{ URL::to('/') }}/images/users/" + sites.id + ".jpg";
  //   if(doesFileExist(pi)){
  //       $('.profileimg').attr('src', pi);
  //   }
  // }

    // $(document).ready(function() {
    //   pasangprofileimage();
    // });

  // function GoMenu(d){
  //   // loading(1);
  //     var pid = d.getAttribute("data-id");
  //     $(".contentxxx").html('');
  //     $(".metitle").html('Loading ...');
  //     $.ajax(
  //       {
  //         url:"{{ route('gr.index') }}",
  //         data:{id:pid},
  //         success: function(data){
  //           // console.log(data);
  //           $(".contentxxx").html(data.view);
  //           $(".metitle").html(data.title);

  //           if (data.usegr == 1) {
  //             gr_menuid = data.menuid;
  //             gr_columnheader = data.columnheader;
  //             gr_dtcolumns = data.dtcolumns;
  //             gr_columnnative = data.columnnative;
  //             gr_data = data.data;
  //             gr_urlshowwithid = data.urlshowwithid;
  //           }
  //           // loading(0);
  //         }
  //       }
  //     );
  // }    



</script> 

@yield('scripts')