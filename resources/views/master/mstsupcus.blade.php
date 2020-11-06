    
@section('style')

@endsection

<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">

        <div class="col-sm-9">

            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-id-card mr-2"></i>Kontak</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label for="jenis" class="col-md-2 col-form-label col-form-label-sm text-md-right">Jenis</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="jenis" name="jenis" placeholder="" required>
                                <option value=0>Supplier + Customer</option>                        
                                <option value=1>Supplier</option>                         
                                <option value=2>Customer</option>                         
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
                        <label for="nohp" class="col-md-2 col-form-label col-form-label-sm text-md-right">Handphone</label>
                        <div class="col-md-8">
                            <input type="tel" id="nohp" name="nohp" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="aktif" class="col-md-2 col-form-label col-form-label-sm text-md-right">Aktif</label>
                        <div class="col-md-8" id="aktif" class="form-control" style="align-self: center;">
                            {{-- A checkbox input in not sent in the request when it's unchecked, in that case the hidden input will be sent with the value 0. When the Checkox is checked, it will overwrite the value to 1. --}}
                            <input type="hidden" name="active" value="0"/>
                            <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-sm-9">
            
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-home mr-2"></i>Alamat</h3>
                </div>
    
                <div class="card-body">
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
                </div>
            </div>
        </div>


        <div class="col-sm-9">
            
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-taxi mr-2"></i>Status Pajak</h3>
                </div>
    
                <div class="card-body">

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
        </div>




        <div class="col-sm-9">
            
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-cash-register mr-2"></i>Hutang Piutang</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label for="terminbeli" class="col-md-2 col-form-label col-form-label-sm text-md-right">Termin Beli (hari)</label>
                        <div class="col-md-8">
                            <input type="number" id="terminbeli" name="terminbeli" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="terminjual" class="col-md-2 col-form-label col-form-label-sm text-md-right">Termin Jual (hari)</label>
                        <div class="col-md-8">
                            <input type="number" id="terminjual" name="terminjual" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="maxhutang" class="col-md-2 col-form-label col-form-label-sm text-md-right">Maksimal Hutang</label>
                        <div class="col-md-8">
                            <input type="number" id="maxhutang" name="maxhutang" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="maxpiutang" class="col-md-2 col-form-label col-form-label-sm text-md-right">Maksimal Piutang</label>
                        <div class="col-md-8">
                            <input type="number" id="maxpiutang" name="maxpiutang" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
    

    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            @include('layouts.footersaveback')
        </div>
    </div>

</form>


{{-- @section('filejs')
    <script src="{{ url('js/image-uploader.min.js') }}"></script>
@endsection

@section('script')

@endsection --}}

<script>

    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');

        $('#jenis').val(0);
        $('#email').val('');
        $('#terminbeli').val(0);
        $('#terminjual').val(0);
        $('#maxhutang').val(0);
        $('#maxpiutang').val(0);

        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#active').prop('checked', 1);        
        
        if (actio == 'edit'){
            $.ajax({
            url:"/mstsupcus/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#nama').val(data.nama);
                    $('#jenis').val(data.jenis);
                    $('#email').val(data.email);
                    $('#notelp').val(data.notelp);
                    $('#nohp').val(data.nohp);
                    $('#alamat').val(data.alamat);
                    $('#idkota').val(data.idkota).trigger('change');

                    $('#ispkp').val(data.ispkp);
                    $('#npwp').val(data.npwp);
                    $('#terminbeli').val(data.terminbeli);
                    $('#terminjual').val(data.terminjual);
                    $('#maxhutang').val(data.maxhutang);
                    $('#maxpiutang').val(data.maxpiutang);
                    $('#active').prop('checked', data.aktif);

                    $('#hidden_id').val(data.id);
                    $("#globrep").hide(200);
                    $("#editview").show(200);

                    loading(0);
                }
            })     
        }
        else{
            $("#globrep").hide(200);
            $("#editview").show(200);
            loading(0);
        }
    }

    $(document).ready(function() {
        $('.role').select2();

        function RemoveAlert(){
            $("input").removeClass("is-invalid");
            $("span").remove(".invalid-feedback");
        }


        $('#formuser').on('submit', function(event){
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
                        $('#formuser')[0].reset();
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