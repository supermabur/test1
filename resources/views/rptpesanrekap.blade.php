
    
{{-- @extends('layouts.dashboard')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box me_boxshadow" style="padding:20px; border-top: 0px solid #d2d6de;">

            <h1>{{ $title }}</h1>
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" style="margin-top:0px;margin-bottom:15px">Create Record</button>

            <div class="table-responsive">
                <table class="table display cell-border" id="user_table" width=100%>
                    <thead>
                        <tr>
                            <th width="10%">kdgudang</th>
                            <th width="30%">NamaGudang</th>
                            <th width="10%">Kode</th>
                            <th width="30%">NamaBarang</th>
                            <th width="5%">Saldo</th>
                            <th width="5%">Qtydipesan</th>
                            <th width="5%">SisaSaldo</th>
                            <th width="5%">Action</th>
                
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </div>
    

@endsection



@section('scripts')
<script>
$(document).ready(function(){
    
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{url: "{{ route('rptpersediaan.index') }}",},
        columns:
        [
            {data: 'kdgudang', name: 'kdgudang'},
            {data: 'namagudang', name: 'namagudang'},
            {data: 'kode', name: 'kode'},
            {data: 'namabarang', name: 'namabarang'},
            {data: 'saldo', name: 'saldo'},
            {data: 'qtydipesan', name: 'qtydipesan'},
            {data: 'sisasaldo', name: 'sisasaldo'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"}
        ]
    });
</script>




@endsection --}}










    
@extends('layouts.dashboard')

@section('style')
    <style>
        div.dt-buttons {
            position: relative;
            float: right;
            margin-left: 10px;
        }


        table.dataTable tbody th, table.dataTable tbody td {
            padding: 5px 5px;
        }

        .loading {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 99;
        }
        .loading:after {
            content: "";
            width: 50px;
            height: 50px;
            position: absolute;
            top: -30px;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            border: 0px solid #292929;
            border-top: 2px dotted #5a5a5a;
            border-bottom: 2px dotted #404040;
            border-radius: 50%;
            animation: loading 2s infinite;
        }
        .loading:before {
            font-size: 20px;
            letter-spacing: 1px;
            color: #000000;
            content: "Loading...";
            position: absolute;
            top: 57%;
            text-align: center;
            right: 0;
            left: 0;
            margin: auto;
        }

        @keyframes loading {
            0% {
                transform: rotate(0);
            }
            50% {
                transform: rotate(360deg);
            }
        }

     
                
        @media screen and (max-width: 751px) {
            .table, .dataTables_filter, .dt-buttons{
                font-size: 0.8rem;
                font-weight: 400;
                line-height: 0.8;
            }   
        }

        @media screen and (max-width: 500px) {
            .card-body {
                padding: 0rem;
            }

        }
    </style>
@endsection



@section('content')

    <div class="row">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">
            <!-- <div class="container"> -->

                {{-- <h1>{{ $title }}</h1> --}}

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter_gudang" class="col-md-1 col-form-label">Thn Bulan</label>
                    <div class="col-md-2">
                        <select name="filter_tahunbulan" id="filter_tahunbulan" class="form-control " required>
                            <option value=""></option>
                            @foreach($tahunbulan as $dt)
                                <option value="{{ $dt->tahunbulan1 }}">{{ $dt->tahunbulan2 }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Ambil Data</button>
                    </div>
                </div>

                {{-- <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter" class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-3">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Ambil Data</button>
                    </div>
                </div> --}}



                <div class="card card-primary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body">
                            <div class="table-responsive" id="tablex" width=100% style="margin-top: 10px;">
                                <table class="table display row-border" id="user_table" width=100% >
                                    {{-- <thead>
                                        <tr>
                                            <th width="10%">Kode</th>
                                            <th width="75%">Nama Barang</th>
                                            <th width="5%" class="text-right">Saldo</th>
                                            <th width="5%" class="text-right">Qty di pesan</th>
                                            <th width="5%" class="text-right">Sisa Saldo</th>
                                        </tr>
                                    </thead> --}}
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </form>
                </div>



                {{-- <div class="card card-primary" style="box-shadow: none;margin-top: 0.8rem;">
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body">
                            <div class="table-responsive" id="tablexdetail" width=100% style="margin-top: 10px;">
                                <table class="table display row-border" id="table_detail" width=100% style="font-size: 0.9rem;line-height: 1;">
            
                                </table>
                            </div>
                        </div>
                    </form>
                </div> --}}

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="modaldetail" class="modaldetail modal fade" role="dialog" >
        <div class="modal-dialog modal-xl">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: khaki;">
                    <h5 class="card-title judulbiru" id="juduldetail">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body" style="padding: 0rem;">
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body" >
                            <div class="table-responsive" id="tablexdetail" width=100% style="margin-top: 10px;">
                                <table class="table display row-border" id="table_detail" width=100%> 
                                    {{-- style="font-size: 0.9rem;line-height: 1;"> --}}
            
                                </table>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="modal-footer">
                    </div> --}}
                </div>
            </div>
    
        </div>
    </div>

@endsection



@section('scripts')



<script>
    $(document).ready(function(){

        fill_datatable();

        function fill_datatable(filter_tahunbulan = 'xxx', show0 = 0)
        {
            var numFormat = $.fn.dataTable.render.number('.',',',0,'');
            var Xcolumns=
                [
                    {title: 'Tahun Bulan', data: 'tahunbulan', name: 'tahunbulan'},
                    {title: 'Faktur Pending', data: 'fakturpending', name: 'fakturpending', className: 'text-right'},
                    {title: 'Total Pending', data: 'totalpending', name: 'totalpending', className: 'text-right'},
                    {title: 'Faktur Pending Pros', data: 'fakturpendingpros', name: 'fakturpendingpros', className: 'text-right'},
                    {title: 'Total Pending Pros', data: 'totalpendingpros', name: 'totalpendingpros', className: 'text-right'},
                    {title: 'Action', data: 'action', name: 'action', orderable: false, searchable: false, className: "text-right"}
                ];


            var dataTable = $('#user_table').DataTable({
                dom: 'lBfrtip',
                order: [],
                lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                processing: true,
                // language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                // language: {processing: '<div class="loading" delay-hide="50000"></div> '},
                serverSide: true,
                ajax:{  
                        url: "{{ route('rptpesanrekap.index') }}",
                        data:{filter_tahunbulan:filter_tahunbulan},
                        dataType:"json",
                        dataFilter: function(response){
                                // this to see what exactly is being sent back
                                console.log(response);
                                var json = jQuery.parseJSON( response );
                                // json.recordsTotal = json.total;
                                // json.recordsFiltered = json.total;
                                // json.data = json.list;
                                // alert(json.posts);
                                document.getElementById('judulbiru').innerHTML = 'Last update Data : ' + json.lastupdate; 
                                $('#tablex').show(200);
                                return response;
                            },
                        // success:function(data)
                        //     {
                        //         console.log('---------------------------------');
                        //         console.log(data);
                        //         alert(data.posts);
                        //         // $('#name').val(data.name);
                        //         return data;
                        //     },
                        },
                columns:Xcolumns

            });
        }


        function fill_detail(pid = 'Data Detail')
        {
            var numFormat = $.fn.dataTable.render.number('.',',',0,'');

            var n = pid.indexOf("NON LEASING");
            var Xcolumns=
                [
                    {title: 'Status', data: 'status', name: 'status'},
                    {title: 'Tanggal', data: 'tanggal', name: 'tanggal'},
                    {title: 'Faktur', data: 'faktur', name: 'faktur'},
                    {title: 'Nama Cust', data: 'namacustomer', name: 'namacustomer'},
                    {title: 'Total', data: 'total', name: 'total', render: numFormat, className: 'text-right'},
                    {title: 'Est Kirim', data: 'estkirim', name: 'estkirim'},
                    {title: 'Keterangan', data: 'keterangan', name: 'keterangan'},
                    {title: 'Memo', data: 'memo', name: 'memo'},
                    {title: 'Nama Leasing', data: 'namaleasing', name: 'namaleasing'},
                    {title: 'LS ACC', data: 'isacc', name: 'isacc'},
                    {title: 'LS FakturPO', data: 'ls_fakturpo', name: 'ls_fakturpo'},
                    {title: 'Gudang', data: 'namagudang', name: 'namagudang'}
                ];

            // if (n >= 0)
            // {
            //     Xcolumns=
            //     [
            //         {title: 'Status', data: 'status', name: 'status'},
            //         {title: 'Tanggal', data: 'tanggal', name: 'tanggal'},
            //         {title: 'Faktur', data: 'faktur', name: 'faktur'},
            //         {title: 'Nama Cust', data: 'namacustomer', name: 'namacustomer'},
            //         {title: 'Total', data: 'total', name: 'total', render: numFormat, className: 'text-right'},
            //         {title: 'Est Kirim', data: 'estkirim', name: 'estkirim'},
            //         {title: 'Keterangan', data: 'keterangan', name: 'keterangan'},
            //         {title: 'Memo', data: 'memo', name: 'memo'},
            //         {title: 'Gudang', data: 'namagudang', name: 'namagudang'}
            //     ];
            // }

            // alert(n);

            var dataTable = $('#table_detail').DataTable({
                dom: 'lBfrtip',
                destroy: true,
                scrollY: "50vh",
                scrollCollapse: true,
                order: [],
                lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                processing: true,
                language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                // language: {processing: '<div class="loading" delay-hide="50000"></div> '},
                serverSide: true,
                ajax:{  
                        url: '{{ url("rptpesanrekap_detail")}}',
                        data:{'id':pid},
                        dataType:"json",
                        beforeSend: function() {
                            document.getElementById('juduldetail').innerHTML = 'Sedang mengambil data detail ...'; 
                        },
                        dataFilter: function(response){
                                // this to see what exactly is being sent back
                                console.log(response);
                                var json = jQuery.parseJSON( response );
                                // json.recordsTotal = json.total;
                                // json.recordsFiltered = json.total;
                                // json.data = json.list;
                                // alert(json.posts);
                                document.getElementById('juduldetail').innerHTML = 'DATA DETAIL ' + pid.replace("|", " "); 
                                $('#tablexdetail').show(200);
                                return response;
                            },
                        // success:function(data)
                        //     {
                        //         console.log('---------------------------------');
                        //         console.log(data);
                        //         alert(data.posts);
                        //         // $('#name').val(data.name);
                        //         return data;
                        //     },
                        },
                columns:Xcolumns

            });
        }
   

        $('#filter').click(function(){
            var filter_tahunbulan = $('#filter_tahunbulan').val();
            // var show0 = $('#show0').val();
            

            if(filter_tahunbulan != '' )
            {
                $('#user_table').DataTable().destroy();
                fill_datatable(filter_tahunbulan, 0);
                $('#judulbiru').val("Data XX" + filter_tahunbulan); 
            }
            else
            {
                alert('Tahun Bulan belum dipilih');
            }
        });

        $("#filter_tahunbulan").change(function(){
            // fill_datatable('nxcjasd','TIDAK');
            $('#tablex').hide(300);

        });

        // $('#create_record').click(function(){
        //     $('#sample_form')[0].reset();
        //     $('#form_result').html('');
        //     $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/noimage.png"); 
        //     $('#detail_color').val('#000000');
        //     $('#colorx').html('<i style="background-color:#000000;"></i>');
        //     $('.modal-title').text("Add New Record");
        //     $('#action_button').val("Add");
        //     $('#actionx').val("new");
        //     $('#formModal').modal({
        //                             backdrop: 'static',
        //                             keyboard: false
        //                             });
        //     // $('#formModal').modal('show');
        // });



        // $('body').on('click', '.editProduct', function () {
        //         var product_id = $(this).data('id');
        //         $('.alert-danger').hide();
        //         $.get("{{ route('rptpersediaan.index') }}" +'/' + product_id +'/edit', function (data) {
        //             $('#modelHeading').html("Edit ");
        //             $('#saveBtn').val("edit-user");
        //             $('#ajaxModel').modal({
        //                                     backdrop: 'static',
        //                                     keyboard: false
        //                                     });
        //             $('#product_id').val(data.id);
        //             $('#name').val(data.name);
        //             $('#detail').val(data.detail);
        //         })
        //     });


        $(document).on('click', '.detail', function(){
            var id = $(this).attr('id');
            // $('#tablexdetail').hide(300);
            fill_detail(id);
            // $('#modaldetail').modal(show);


            // $('#form_result').html('');
            // $.ajax({
            //     url:"/rptpesanrekap_detail",
            //     // dataType:"json",
            //     data:{'id':id},
            //     type:"GET",
            //     success:function(data)
            //         {
            //             alert(data);
                        // $('#name').val(data.name);
                        // $('#detail').val(data.detail);
                        // $('#urut').val(data.urut);
                        // $('#detail_color').val(data.detail_color);
                        // $('#colorx').html('<i style="background-color: ' + data.detail_color + ';"></i>');
                        // $('#link').val(data.link);
                        // $('#aktif').prop('checked', data.aktif);
                        // $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/Slide/big/" + data.image); 
                        // $('.modal-title').text("Edit Record");
                        // $('#action_button').val("Edit");
                        // $('#hidden_id').val(data.id);
                        // $('#actionx').val("edit");
                        // $('#imageold').val(data.image);
                        // // $('#formModal').modal('show');
                        // $('#formModal').modal({
                        //                         backdrop: 'static',
                        //                         keyboard: false
                        //                         });
            //         }
            // })
        });



        // $(document).on('click', '.delete', function(){
        //     user_id = $(this).attr('id');
        //     $('#confirmModal').modal('show');
        // });




        // $('#sample_form').on('submit', function(event){
        //     event.preventDefault();
        //     $('#saveBtn').html('Saving...');
        //     $.ajax({
        //         url:"{{ route('rptpersediaan.store') }}",
        //         method:"POST",
        //         data: new FormData(this),
        //         contentType: false,
        //         cache:false,
        //         processData: false,
        //         dataType:"json",
        //         success:function(data)
        //         {
        //             var html = '';
        //             if(data.errors)
        //             {
        //                 html = '<div class="alert alert-danger">';
        //                 for(var count = 0; count < data.errors.length; count++)
        //                 {
        //                 html += '<p>' + data.errors[count] + '</p>';
        //                 }
        //                 html += '</div>';
        //                 $('#form_result').html(html);
        //             }
        //             if(data.success)
        //             {
        //                 html = '<div class="alert alert-success">' + data.success + '</div>';
        //                 $('#sample_form')[0].reset();
        //                 $('#user_table').DataTable().ajax.reload();
        //                 alert(data.success);
        //                 $('#formModal').modal('hide');
        //             }
        //             $('#saveBtn').html('Save changes');
        //         }
        //     })
        // });



    // ------------------------------------------Delete 2
        // $('body').on('click', '.delete', function () {
        //     var product_id = $(this).attr("id");
        //     if (confirm("Are You sure want to delete ! "))
        //     {
        //         $.ajax({
        //                 type: "DELETE",
        //                 data:{_token:'{{ csrf_token() }}'},
        //                 dataType:"json",
        //                 url: "{{ route('rptpersediaan.store') }}"+'/'+product_id,
        //                 success: function (data) {
        //                     $('#user_table').DataTable().ajax.reload();
        //                     },
        //                 error: function (data) {
        //                     console.log('Error:', data);
        //                     }
        //             });
        //     };
        // });  

        

        // $('#image').change(function(){
            
        //     let reader = new FileReader();
        //     reader.onload = (e) => { 
        //         $('#image_preview_container').attr('src', e.target.result); 
        //     }
        //     reader.readAsDataURL(this.files[0]); 

        // });

        

        // //Colorpicker
        // $('.my-colorpicker1').colorpicker()
        // //color picker with addon
        // $('.my-colorpicker2').colorpicker()


    });


</script>



@endsection
