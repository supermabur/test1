    
@extends('layouts.dashboard')


@section('content')


    <div class="row" name="globrep" id="globrep">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">


{{-- {{ json_encode($columnnative) }} --}}

                <div class="card card-secondary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data</h3>
                    </div>
                    <!-- /.card-header -->

            
                    <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                        @if ($fdate1 == 1)
                            <label for="fdate1" class="col-sm-1 col-form-label">Tanggal</label>
                            <div class="col-sm-2">
                                <input type="text"  name="fdate1" id="fdate1" class="form-control datepicker"  required/>
                            </div>
                        @endif
    
                        @if ($fdate2 == 1)
                            <label for="fdate2" class="col-sm-1 col-form-label">s/d</label>
                            <div class="col-sm-2">
                                <input type="text"  name="fdate2"  id="fdate2" class="form-control datepicker"  required/>
                            </div>
                        @endif
                    </div>
    
    
    
                    @if ( $fgudang == 1 )
                        <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                            <label for="fgudang" class="col-sm-1 col-form-label">Outlet</label>
                            <div class="col-sm-5">
                                <select name="fgudang" id="fgudang" class="form-control " required>
                                    <option value=""></option>
                                    @foreach($composer_mstgudang as $dt)
                                        <option value="{{ $dt->kode }}">{{ $dt->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
    
    
                    {{-- <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                        <label for="show0" class="col-sm-1 col-form-label">Saldo 0</label>
                        <div class="col-sm-3">
                            <select name="show0" id="show0" class="form-control " required>
                                <option value="TIDAK">Tidak Ditampilkan</option>
                                <option value="YA">Ditampilkan</option>
                            </select>
                        </div>
                    </div> --}}
    
                    <div class="form-group row" style="padding-left: 1.25rem; padding-right: 1.25rem;">
                        {{-- <label for="filter" class="col-sm-1 col-form-label"> </label> --}}
                        <div class="col-sm-2">
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm" style="width: 100%">Refresh Data</button>
                        </div>
                        @if ($crud_i == 1)
                            <div class="col-sm-2">
                                <button type="button" name="addnew" id="addnew" class="btn btn-info btn-sm" style="width: 100%">Add New</button>
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

                <div class="card card-primary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                      <h3 class="card-title" id="headeredit">Quick Example</h3>
                      <button type="button" name="btnback" id="btnback" class="btn btn-dark btn-sm">Back</button>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        @include($editview)
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection



@section('scripts')

    <script>
        $("#addnew, #btnback").click(function(){    
            if($("#editview").is(":hidden")){
                $("#headeredit").text("Tambah Data Baru");
                initEdit('new') ;
            } else{
                $("#editview").hide(200);
                $("#globrep").show(200);
            }          
        });

        $(document).on('click', '.btnedit', function(){
            if($("#editview").is(":hidden")){
                $("#headeredit").text("Edit Data");
                var id = $(this).attr('data-id');
                initEdit('edit', id) 
            }
        });

        $(function(){
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        });


        function hideeditview() {
            var element = document.getElementById("editview");
            element.classList.remove("invisible");
            $("#editview").hide();
        }

        $(document).ready(function(){



            hideeditview();
            fill_datatable();

            function fill_datatable(filter_gudang = '', show0 = 'TIDAK')
            {
                var numFormat = $.fn.dataTable.render.number('.',',',0,'');
                var xmenuid = {{ $menuid }};
                var xUrl = "{{ route('gr.show', $menuid) }}"   ;
                var Xcolumns={!! json_encode($dtcolumns) !!};

                var xfdate1 = $('#fdate1').val();
                var xfdate2 = $('#fdate2').val();
                var xfgudang = $('#gudang').val();

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
                                    // var json = jQuery.parseJSON( response );
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
    

            $('#filter').click(function(){
                // var filter_gudang = $('#filter_gudang').val();
                // var show0 = $('#show0').val();

                // if(filter_gudang != '' )
                // {
                    // $('#user_table').DataTable().destroy();
                    fill_datatable();
                    // $('#judulbiru').val("Data XX" + filter_gudang); 
                // }
                // else
                // {
                //     alert('Outlet belum dipilih');
                // }
            });

            $("#filter_gudang").change(function(){
                // fill_datatable('nxcjasd','TIDAK');
                $('#tablex').hide(300);

            });



        });


    </script>

@endsection
