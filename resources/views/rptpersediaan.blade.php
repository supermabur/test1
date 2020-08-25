    
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
                            @foreach($gudang as $dt)
                                <option value="{{ $dt->kdgudang }}">{{ $dt->namagudang }}</option>
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


        // $(document).on('click', '.edit', function(){
        //     var id = $(this).attr('id');
        //     $('#form_result').html('');
        //     $.ajax({
        //         url:"/rptpersediaan/"+id+"/edit",
        //         dataType:"json",
        //         success:function(data)
        //             {
        //                 // alert(data.detail_color);
        //                 $('#name').val(data.name);
        //                 $('#detail').val(data.detail);
        //                 $('#urut').val(data.urut);
        //                 $('#detail_color').val(data.detail_color);
        //                 $('#colorx').html('<i style="background-color: ' + data.detail_color + ';"></i>');
        //                 $('#link').val(data.link);
        //                 $('#aktif').prop('checked', data.aktif);
        //                 $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/Slide/big/" + data.image); 
        //                 $('.modal-title').text("Edit Record");
        //                 $('#action_button').val("Edit");
        //                 $('#hidden_id').val(data.id);
        //                 $('#actionx').val("edit");
        //                 $('#imageold').val(data.image);
        //                 // $('#formModal').modal('show');
        //                 $('#formModal').modal({
        //                                         backdrop: 'static',
        //                                         keyboard: false
        //                                         });
        //             }
        //     })
        // });
        

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
