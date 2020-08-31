    
@extends('layouts.dashboard')


@section('content')


    <div class="row">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">

            {{ $fdate1 }}
            {{ $fdate2 }}

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                @if ( $fgudang == 0 )
                    <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                        <label for="filter_gudang" class="col-sm-1 col-form-label">Outlet</label>
                        <div class="col-sm-4">
                            <select name="filter_gudang" id="filter_gudang" class="form-control " required>
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

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter" class="col-sm-1 col-form-label"> </label>
                    <div class="col-sm-3">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Refresh Data</button>
                    </div>
                </div>



                <div class="card card-primary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data</h3>
                    </div>
                    <!-- /.card-header -->
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

    @include($editview)

@endsection



@section('scripts')

    <script>


        $(document).ready(function(){

            // fill_datatable();

            function fill_datatable(filter_gudang = '', show0 = 'TIDAK')
            {
                var numFormat = $.fn.dataTable.render.number('.',',',0,'');
                var xmenuid = {{ $menuid }};
                var xUrl = "{{ route('gr.show', $menuid) }}"   ;
                var Xcolumns={!! json_encode($dtcolumns) !!};
                alert(xUrl);
                    // [
                    //     {title: 'Kode', data: 'kode', name: 'kode'},
                    //     {title: 'Nama Barang', data: 'namabarang', name: 'namabarang'},
                    //     {title: 'Saldo', data: 'saldo', name: 'saldo', render: numFormat, className: 'text-right'},
                    //     {title: 'Qty di pesan', data: 'qtydipesan', name: 'qtydipesan', render: numFormat, className: 'text-right'},
                    //     {title: 'Sisa Saldo', data: 'sisasaldo', name: 'sisasaldo', render: numFormat, className: 'text-right'}
                    // ];


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
                            data:{menuid:xmenuid, asd:'123qwe' },
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
                            //         alert('success');
                            //         // console.log('---------------------------------');
                            //         // console.log(data);
                            //         // alert(data.posts);
                            //         // $('#name').val(data.name);
                                    
                            //         return data;
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

        function setDatePicker(){
            $(".datepicker").datetimepicker({
                format: "YYYY-MM-DD",
                useCurrent: true
            })
        }

    </script>

@endsection
