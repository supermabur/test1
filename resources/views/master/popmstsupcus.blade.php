    
@section('style')

@endsection



<div class="modal fade show" id="modalpopsupplier" tabindex="-1" role="dialog" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <h3 class="modal-title">Master Supplier</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="post" id="formpopmstsupcus" class="form-vertical" enctype="multipart/form-data" novalidate>
                    @csrf
    
                    <div class="row justify-content-md-center">
    
                        <div class="col-sm-9">
    
                                    <h3 class="card-title bg-light w-100 p-2 mb-2"><i class="fas fa-id-card mr-2"></i>Kontak</h3>     <br>               

                                    <div class="form-group row">
                                        <label for="jenis" class="col-md-2 col-form-label col-form-label-sm text-md-right">Jenis</label>
                                        <div class="col-md-8">
                                            <select class="slct2 form-control form-control-sm" id="jenis" name="jenis" placeholder="" required>
                                                <option value=0>Supplier + Customer</option>                        
                                                <option value=1>Supplier</option>                         
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nama</label>
                                        <div class="col-md-8">
                                            <input type="text" id="nama" name="nama" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="sku" class="col-md-2 col-form-label col-form-label-sm text-md-right">email</label>
                                        <div class="col-md-8">
                                            <input type="email" id="email" name="email" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="notelp" class="col-md-2 col-form-label col-form-label-sm text-md-right">Telepon</label>
                                        <div class="col-md-8">
                                            <input type="tel" id="notelp" name="notelp" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="aktif" class="col-md-2 col-form-label col-form-label-sm text-md-right">Aktif</label>
                                        <div class="col-md-8" id="aktif" class="form-control" style="align-self: center;">
                                            <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                                        </div>
                                    </div>
    
                            
                                    <h3 class="card-title bg-light w-100 p-2 mb-2"><i class="fas fa-home mr-2"></i>Alamat</h3> <br>
                    
                                    <div class="form-group row">
                                        <label for="alamat" class="col-md-2 col-form-label col-form-label-sm text-md-right">Alamat</label>
                                        <div class="col-md-8">
                                            <input type="text" id="alamat" name="alamat" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="idkota" class="col-md-2 col-form-label col-form-label-sm text-md-right">Kota</label>
                                        <div class="col-sm-8">
                                            <select class="role form-control form-control-sm" id="idkota" name="idkota" required>
                                                @foreach ($composer_kota as $cp)
                                                    <option value="{{ $cp->id }}" >{{ $cp->name2 }}</option>                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                            
                                    <h3 class="card-title bg-light w-100 p-2 mb-2"><i class="fas fa-taxi mr-2"></i>Status Pajak</h3> <br>
                    
                                    <div class="form-group row">
                                        <label for="ispkp" class="col-md-2 col-form-label col-form-label-sm text-md-right">PKP</label>
                                        <div class="col-md-8">
                                            <select class="slct2 form-control form-control-sm" id="ispkp" name="ispkp" placeholder="" required>
                                                <option value=0>TIDAK</option>                        
                                                <option value=1>YA</option>                        
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="npwp" class="col-md-2 col-form-label col-form-label-sm text-md-right">NPWP</label>
                                        <div class="col-md-8">
                                            <input type="text" id="npwp" name="npwp" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                            
                        </div>
    
                    </div>
                    
    
                </form>



            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- @section('filejs')
    <script src="{{ url('js/image-uploader.min.js') }}"></script>
@endsection

@section('script')

@endsection --}}

<script>


function showModalPopSupplier(){
            $('#modalpopsupplier').modal('show');
        }



    $(document).ready(function() {
        $('.role').select2();

        function RemoveAlert(){
            $("input").removeClass("is-invalid");
            $("span").remove(".invalid-feedback");
        }


        $('#formpopmstsupcus').on('submit', function(event){
            event.preventDefault();
            loading(1, 'Saving Data ...');
            RemoveAlert();


            $('#saveBtn').html('Saving...');

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);

            $.ajax({
                url:"{{ route('mstsupcus.store') }}",
                method:"POST",
                data: fd,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        // console.log(data.errors.keys);
                        for(var count = 0; count < data.errors.keys.length; count++)
                        {  
                            var v = document.getElementById(data.errors.keys[count]);
                            if($(v).is("input")){
                                // v.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(v);
                            }

                            if($(v).is("select")){
                                var w = v.nextSibling;
                                // w.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(w);
                            }
                        }
                    }
                    if(data.success)
                    {
                        console.log(data.success);
                        $('#formpopmstsupcus')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        // alert(data.success);
                        showToast(0, data.success);
                        document.getElementById('btnback').click();
                    }
                    $('#saveBtn').html('Save changes');
                    loading(0);
                    
                }
            })
        });


    });
</script>