    
@extends('layouts.dashboard')

{{-- @section('style')
    <style>
    </style>
@endsection --}}



@section('content')

    <div class="row">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">
            <!-- <div class="container"> -->

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

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="show0" class="col-sm-1 col-form-label">Saldo 0</label>
                    <div class="col-sm-3">
                        <select name="show0" id="show0" class="form-control " required>
                            <option value="TIDAK">Tidak Ditampilkan</option>
                            <option value="YA">Ditampilkan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter" class="col-sm-1 col-form-label"> </label>
                    <div class="col-sm-3">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Refresh Data</button>
                    </div>
                </div>


                <div class="row">
                    <div class = "mstbrg">
                        asdasd
                    </div>
        
                    {{-- <div class='table-responsive' id='mstbarangtable' width=100% style='margin-top: 10px;'>
                        <table class='table display cell-border' id='user_table' width=100%>
                        </table>
                    </div> --}}
                            
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




            </div>
        </div>
    </div>


@endsection



@section('scripts')



<script>
    $(document).ready(function(){

        $('.mstbrg').mstbarang({
            urlx:"{{ route('databrowser.store') }}"
        });

        fill_datatable();

        function fill_datatable(filter_gudang = '', show0 = 'TIDAK')
        {
            var numFormat = $.fn.dataTable.render.number('.',',',0,'');
            var Xcolumns=
                [
                    {title: 'Kode', data: 'kode', name: 'kode'},
                    {title: 'Nama Barang', data: 'namabarang', name: 'namabarang'},
                    {title: 'Saldo', data: 'saldo', name: 'saldo', render: numFormat, className: 'text-right'},
                    {title: 'Qty di pesan', data: 'qtydipesan', name: 'qtydipesan', render: numFormat, className: 'text-right'},
                    {title: 'Sisa Saldo', data: 'sisasaldo', name: 'sisasaldo', render: numFormat, className: 'text-right'}
                ];


            var dataTable = $('#user_table').DataTable({
                dom: 'lBfrtip',
                keys: true,
                lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                buttons: {!! json_encode(config('global.dt_button')) !!},
                processing: true,
                // language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                // language: {processing: '<div class="loading" delay-hide="50000"></div> '},
                serverSide: true,
                ajax:{  
                        url: "{{ route('rptpersediaan.index') }}",
                        data:{filter_gudang:filter_gudang, show0:show0},
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
   

        $('#filter').click(function(){
            var filter_gudang = $('#filter_gudang').val();
            var show0 = $('#show0').val();

            if(filter_gudang != '' )
            {
                $('#user_table').DataTable().destroy();
                fill_datatable(filter_gudang, show0);
                $('#judulbiru').val("Data XX" + filter_gudang); 
            }
            else
            {
                alert('Outlet belum dipilih');
            }
        });

        $("#filter_gudang").change(function(){
            // fill_datatable('nxcjasd','TIDAK');
            $('#tablex').hide(300);

        });


    });


</script>



@endsection

