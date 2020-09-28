    
{{-- @extends('layouts.dashboard')


@section('content') --}}

    <div class="row" name="globrep" id="globrep">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">

{{-- {{ json_encode($columnnative) }} --}}

                <div class="card card-secondary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data</h3>
                    </div>
                    <!-- /.card-header -->

            
                    <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                            @if ($fdate1 ?? 0 == 1)
                                <!-- Date range -->            
                                <div class="col-sm-3">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Tanggal
                                            </span>
                                        </div>
                                        <input type="text" name="fdate1" id="fdate1" class="form-control float-right datepicker" id="reservation" required>
                                    </div>
                                </div>
                            @endif
        
                            @if ($fdate2 ?? 0 == 1)
                                <div class="col-sm-3">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                S/d
                                            </span>
                                        </div>
                                        <input type="text" name="fdate2" id="fdate2" class="form-control float-right datepicker" id="reservation" required>
                                    </div>
                                </div>
                            @endif
                    </div>
    
    
    
                    @if ( $fgudang ?? 0 == 1 )
                        <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Gudang</span>
                                    </div>
                                    <select name="fgudang" id="fgudang" class="form-control " required>
                                        <option value="ALL">SEMUA</option>
                                        @foreach($composer_mstgudang as $dt)
                                            <option value="{{ $dt->kode }}">{{ $dt->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

    
                    <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                        {{-- <label for="filter" class="col-sm-1 col-form-label"> </label> --}}
                        <div class="col-sm-2">
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm" style="width: 100%">
                                <i class="fa fa-sync" style="margin-right: 4px;"></i>
                                Refresh Data
                            </button>
                        </div>
                        @if ($crud_i ?? 0 == 1)
                            <div class="col-sm-2">
                                <button type="button" name="addnew" id="addnew" class="btn btn-info btn-sm" style="width: 100%">
                                    <i class="fa fa-plus" style="margin-right: 4px;"></i>
                                    Add New
                                </button>
                            </div>
                        @endif
                    </div>



                    <!-- form start -->
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body">
                            <div class="table-responsive" id="tablex" width=100% style="margin-top: 10px;">
                                <table class="table display cell-border" id="user_table" width=100%>
                                    
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </form>
                </div>




            </div>
        </div>
    </div>

    
    <div class="row invisible" name="editview" id="editview">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">

                <div class="card card-secondary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title" id="headeredit">Quick Example</h3>
                        <button type="button" name="btnback" id="btnback" class="btn-danger btn-sm">
                            <i class="fa fa-arrow-alt-circle-left" style="margin-right: 4px;"></i>
                            Back
                        </button>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body meinclude">
                        
                        @if(!empty($editview))
                            @includeif($editview)
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

{{-- @endsection --}}



{{-- @section('scripts') --}}

    <script>

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

        
        $("#addnew, #btnback").click(function(){    
            if($("#editview").is(":hidden")){
                loading(1);
                $("#headeredit").text("Tambah Data Baru");
                initEdit('new') ;
            } else{
                $("#editview").hide(200);
                $("#globrep").show(200);
            }          
        });
    

        $('#filter').click(function(){
            fill_datatable();
        });

        $(document).on('click', '.btnedit', function(){
            if($("#editview").is(":hidden")){
                loading(1);
                $("#headeredit").text("Edit Data");
                var id = $(this).attr('data-id');
                initEdit('edit', id);
            }
        });

        $(function(){
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            }).datepicker("setDate",'now');;
        });


        function hideeditview() {
            var element = document.getElementById("editview");
            element.classList.remove("invisible");
            $("#editview").hide();
        }


        function fill_datatable(filter_gudang = '', show0 = 'TIDAK')
        {
            if (gr_dtcolumns){
                var numFormat = $.fn.dataTable.render.number('.',',',0,'');
                var xmenuid = gr_menuid;
                var xUrl = gr_urlshowwithid ;
                var Xcolumns=gr_dtcolumns;

                var xfdate1 = $('#fdate1').val();
                var xfdate2 = $('#fdate2').val();
                var xfgudang = $('#fgudang').val();

                var dataTable = $('#user_table').DataTable({
                    dom: 'lBfrtip',
                    destroy: true,
                    lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                    buttons: {!! json_encode(config('global.dt_button')) !!},
                    processing: true,
                    // language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                    // language: {processing: '<div class="loading" delay-hide="50000"></div> '},
                    serverSide: true,
                    ajax:{  
                            url: xUrl,
                            data:{menuid:xmenuid, fdate1:xfdate1, fdate2:xfdate2, fgudang:xfgudang },
                            dataType:"json",
                            dataFilter: function(response){
                                    // this to see what exactly is being sent back
                                    // console.log(response);
                                    var json = jQuery.parseJSON( response );
                                    // console.log(json.gudang);
                                    // json.recordsTotal = json.total;
                                    // json.recordsFiltered = json.total;
                                    // json.data = json.list;
                                    // alert(json.posts);
                                    // document.getElementById('judulbiru').innerHTML = 'Last update Data : ' + json.lastupdate; 
                                    $('#tablex').show(200);
                                    // alert('dataFilter');
                                    return response;
                                },
                            // success:function(data)
                            //     {
                            //         console.log(data);
                            //         alert('success');
                            //         // console.log('---------------------------------');
                            //         // alert(data.posts);
                            //         // $('#name').val(data.name);
                                    
                            //         // return data;
                            //     },
                            // error : function(xhr, textStatus, errorThrown){
                            //         alert('error');
                            //         lh.ajaxUtils.handleAjaxError(xhr, textStatus, errorThrown);
                            //         // console.log(xhr);
                            //         console.log('STATUS :> ' + textStatus);
                            //         console.log('errorThrown :> ' + errorThrown);
                            //     },
                            },
                    columns:Xcolumns

                });
            }
        }

        $(document).ready(function(){

            hideeditview();
            fill_datatable();


            $("#filter_gudang").change(function(){
                // fill_datatable('nxcjasd','TIDAK');
                $('#tablex').hide(300);

            });



        });


    </script>

{{-- @endsection --}}
