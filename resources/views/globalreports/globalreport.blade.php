    
@extends('layouts.dashboard')


@section('content')


    <div class="row" name="globrep" id="globrep">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">


{{-- {{ json_encode($columnnative) }} --}}
 
                <div class="card card-secondary" style="box-shadow: none;margin-top: 0.8rem;padding-top: 0px;">
                    {{-- <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data List</h3>
                    </div> --}}
                    <!-- /.card-header -->
                    {{-- <button onclick="getlayar()"> uyeee </button>
                    <span class="demo" id="demo">zxcasdqwe</span> --}}
            
                    <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                            @if ($fdate1 == 1)
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
        
                            @if ($fdate2 == 1)
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
    
    
    
                    @if ( $fgudang == 1 )
                        <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                            <div class="col-sm-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Gudang</span>
                                    </div>
                                    <select name="fgudang" id="fgudang" class="form-control " required>
                                        <option value="ALL">SEMUA</option>
                                        @foreach($mstgudang as $dt)
                                            <option value="{{ $dt->kode }}">{{ $dt->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <label for="fgudang" class="col-sm-1 col-form-label">Outlet</label>
                            <div class="col-sm-5">
                                <select name="fgudang" id="fgudang" class="form-control " required>
                                    <option value=""></option>
                                    @foreach($composer_mstgudang as $dt)
                                        <option value="{{ $dt->kode }}">{{ $dt->nama }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
    
                    {{-- <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;padding-left: 1.25rem; padding-right: 1.25rem;">
                        <div class="col-sm-2">
                            <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing Order" style="width: 100%">
                                <i class="fa fa-sync" style="margin-right: 4px;"></i>
                                Refresh Data
                            </button>
                        </div>
                        @if ($crud_i == 1)
                            <div class="col-sm-2">
                                <button type="button" name="addnew" id="addnew" class="btn btn-info btn-sm" style="width: 100%">
                                    <i class="fa fa-plus" style="margin-right: 4px;"></i>
                                    Add New
                                </button>
                            </div>
                        @endif
                    </div> --}}



                    <!-- form start -->
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body" style="padding-top: 0rem">
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

                {{-- <div class="card card-secondary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title" id="headeredit">Quick Example</h3>
                        <button type="button" name="btnback" id="btnback" class="btn-danger btn-sm">
                            <i class="fa fa-arrow-alt-circle-left" style="margin-right: 4px;"></i>
                            Back to Data List
                        </button>
                    </div> --}}
                    <!-- /.card-header -->

                    {{-- <div class="card-body"> --}}
                        @if(!empty($editview))
                            <br>
                            @include($editview)
                        @endif
                    {{-- </div> --}}
                {{-- </div> --}}

            </div>
        </div>
    </div>

@endsection



@section('scripts')

    <script>
        function getlayar() {
            var w = window.innerWidth;
            var h = window.innerHeight;
            document.getElementById("demo").innerHTML = "Width: " + w + "<br>Height: " + h;
        }

        $("#addnew, #btnback").click(function(){    
            addneworback();
        });

        function addneworback(){
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            
            if($("#editview").is(":hidden")){
                loading(1);
                $("#headeredit").text("Tambah Data Baru");
                initEdit('new') ;
            } else{
                $("#editview").hide(200);
                $("#globrep").show(200);
            }    
        }

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


        $(document).ready(function(){
            hideeditview();
            fill_datatable();

            function fill_datatable(filter_gudang = '', show0 = 'TIDAK')
            {
                var numFormat = $.fn.dataTable.render.number('.',',',2,'');
                var xmenuid = {{ $menuid }};
                var xUrl = "{{ route('grctrl.show', $menuid) }}"   ;
                var Xcolumns={!! json_encode($dtcolumns) !!};
                var xNative={!! json_encode($columnnative) !!};
                var xrendertext1={!! json_encode($rendertext1) !!};
                var xnum = {render: numFormat, className: 'text-right'};
                var xrentext = {render: function(datum, type, row) {
                                        return $("<div/>").html(datum).text(); 
                                    },
                                    className: 'text-center'
                                };
                var xhide = {visible : false};
                var xorderablefalse = {orderable : false, searchable:false};

                // console.log(xrendertext1);

                for (i=0; i < xNative.length ; i++){
                    switch (xNative[i]){
                        case 'NEWDECIMAL':
                            Object.assign(Xcolumns[i], xnum);
                        break;
                    }

                    // console.log(Xcolumns[i].title);
                    switch (Xcolumns[i].title){
                        case 'id': Object.assign(Xcolumns[i], xhide); break;
                        case 'action' : Object.assign(Xcolumns[i], xorderablefalse); break;
                    }

                    if (xrendertext1.includes(Xcolumns[i].title)){
                        Object.assign(Xcolumns[i], xrentext);
                    }
                }
                // console.log(Xcolumns);


                var appe = '<tfoot><tr>';
                for (i=0; i < Xcolumns.length ; i++){
                    appe = appe + '<th></th>';
                }
                appe = appe + '</tr></tfoot>';
                $('tfoot').remove();
                $('#user_table').append(appe);


                var xfdate1 = $('#fdate1').val();
                var xfdate2 = $('#fdate2').val();
                var xfgudang = $('#fgudang').val();

                var buttonx = {!! json_encode(config('global.dt_button')) !!};

                var btnrefresh = {
                                'titleAttr' : 'Refresh Data',
                                'className' : 'custom-btn-refresh',
                                'text' : '<i class="fa fa-sync" style="margin-right: 4px;"></i> Refresh Data',
                                'action' : function ( e, dt, node, config ) {
                                                fill_datatable();
                                            }
                            };
                
                var btnnew = {
                                'titleAttr' : 'Add New',
                                'className' : 'custom-btn-addnew',
                                'text' : '<i class="fa fa-plus" style="margin-right: 4px;"></i> Add New',
                                'action' : function ( e, dt, node, config ) {
                                                addneworback();
                                            }
                            };
                
                var crudi = "{{ $crud_i }}";
                if (typeof crudi !== "undefined" ){
                    if(crudi=="1"){
                        buttonx.unshift(btnnew);
                    }
                }
                buttonx.unshift(btnrefresh);

                var dataTable = $('#user_table').DataTable({
                    dom: 'Bfrltip',
                    destroy: true,
                    lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                    buttons: buttonx,
                    processing: true,
                    language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
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
                                    // console.log(json.gudang);
                                    // json.recordsTotal = json.total;
                                    // json.recordsFiltered = json.total;
                                    // json.data = json.list;
                                    // alert(json.posts);
                                    // document.getElementById('judulbiru').innerHTML = 'Last update Data : ' + json.lastupdate; 
                                    $('#tablex').show(200);
                
                                    // btnref.button('reset');
                                    // alert('dataFilter');
                                    return response;
                                },
                            // success:function(data)
                            //     {
                            //         // console.log(data);
                            //         // alert('success');
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
                    columns:Xcolumns,
                    // columnDefs: [ {
                    //                 targets: [ 1, 2 ],
                    //                 render: $.fn.dataTable.render.text()
                    //                 } ],

                    "footerCallback": function (row, data, start, end, display) {
                            var api = this.api();
            
                            // Remove the formatting to get integer data for summation
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                            };
            
                            // // Total over all pages
                            // total = api
                            //     .column(6)
                            //     .data()
                            //     .reduce(function (a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0);
            
                            // Total over this page

                            for (i=0; i < xNative.length ; i++){
                                switch (xNative[i]){
                                    case 'NEWDECIMAL':
                                        pageTotal = api
                                                    .column(i, {
                                                        page: 'current'
                                                    })
                                                    .data()
                                                    .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                    }, 0);
                                
                                        // Update footer
                                        $(api.column(i).footer()).html(formatNumber(pageTotal));
                                    break;
                                }

                            }

                            // pageTotal = api
                            //     .column(6, {
                            //         page: 'current'
                            //     })
                            //     .data()
                            //     .reduce(function (a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0);
            
                            // // Update footer
                            // $(api.column(6).footer()).html(pageTotal);
                        }                    
                });
            }
    
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            }

            $('#filter').click(function(){
                var btnref = $(this);
                btnref.button('loading');
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
