    
@section('style')
    {{-- <link  href="/path/to/cropper.css" rel="stylesheet">
    <script src="/path/to/cropper.js"></script> --}}
@endsection

<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">

        <div class="col-sm-9">

            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-cookie-bite mr-2"></i>Informasi Barang</h3>
                </div>
    
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nama</label>
                        <div class="col-md-8">
                            <input type="text" id="nama" name="nama" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sku" class="col-md-2 col-form-label col-form-label-sm text-md-right">SKU</label>
                        <div class="col-md-8">
                            <input type="text" id="sku" name="sku" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="barcode" class="col-md-2 col-form-label col-form-label-sm text-md-right">Barcode</label>
                        <div class="col-md-8">
                            <input type="text" id="barcode" name="barcode" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idmerk" class="col-md-2 col-form-label col-form-label-sm text-md-right">Merk</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="idmerk" name="idmerk" placeholder="Pilih Merk" required>
                                @foreach ($composer_mstmerk as $cp)
                                    <option value="{{ $cp->id }}">{{ $cp->nama }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idjenis" class="col-md-2 col-form-label col-form-label-sm text-md-right">Jenis</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="idjenis" name="idjenis" placeholder="Pilih Jenis" required>
                                @foreach ($composer_mstjenis as $cp)
                                    <option value="{{ $cp->id }}">{{ $cp->nama }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="idsatuan" class="col-md-2 col-form-label col-form-label-sm text-md-right">Satuan</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="idsatuan" name="idsatuan" placeholder="Pilih Satuan" required>
                                @foreach ($composer_mstsatuan as $cp)
                                    <option value="{{ $cp->id }}">{{ $cp->nama }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-2 col-form-label col-form-label-sm text-md-right">Deskripsi</label>
                        <div class="col-md-8">
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control form-control-sm" required>
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
                    <h3 class="card-title"><i class="fas fa-tag mr-2"></i>Harga</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label for="hpp" class="col-md-2 col-form-label col-form-label-sm text-md-right">HPP</label>
                        <div class="col-md-8">
                            <input type="number" id="hpp" name="hpp" class="form-control form-control-sm formatnumber" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga" class="col-md-2 col-form-label col-form-label-sm text-md-right">Harga</label>
                        <div class="col-md-8">
                            <input type="number" id="harga" name="harga" class="form-control form-control-sm formatnumber" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="disc" class="col-md-2 col-form-label col-form-label-sm text-md-right">Disc (%)</label>
                        <div class="col-md-8">
                            <input type="number" id="disc" name="disc" class="form-control form-control-sm" min="0" max="100" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="saldomin" class="col-md-2 col-form-label col-form-label-sm text-md-right">Saldo Min</label>
                        <div class="col-md-8">
                            <input type="number" id="saldomin" name="saldomin" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="saldomax" class="col-md-2 col-form-label col-form-label-sm text-md-right">Saldo Max</label>
                        <div class="col-md-8">
                            <input type="number" id="saldomax" name="saldomax" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>


                    {{-- 'idvarian1' => $request->idvarian1,
                    'idvarian2' => $request->idvarian2,
                    'idvarian3' => $request->idvarian3, --}}

                </div>
            </div>
        </div>



        <div class="col-sm-9">
            
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-images mr-2"></i>Image</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 " ></label>
    
                        <div style="padding-top:10px" class="col-md-8">    
                            <label for="pathimage" class="btn btn-secondary btn-sm" id="labelimage"><i class="fas fa-file-image mr-2"></i>Select Image</label>
                            <input type="file" class="form-control-file form-control-sm" id="pathimage" name="pathimage" accept=".jpg" placeholder="Choose image" style="display: none;" >

                            <div style="padding-top:10px">    
                                <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 200px;" 
                                    src="{{ url('/images/barang/noimage.jpg') }}"  alt="preview image"/>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        {{-- <div class="col-sm-3">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Profile picture</h3>
                </div>

                <div class="card-body">
                    <label for="pathimage" class="btn btn-primary btn-sm" id="labelimage">Select Image</label>
                    <input type="file" class="form-control-file form-control-sm" id="pathimage" name="pathimage" accept=".jpg" placeholder="Choose image" style="display: none;" >

                    <div style="padding-top:10px">    
                        <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 150px;" 
                            src="{{ url('/images/users/noimage.jpg') }}"  alt="preview image"/>
                    </div>

                </div>
            </div>
        </div>   --}}
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



    $('#pathimage').change(function(){        
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });

    function AddMerk() {
        var inp = prompt("Masukkan Nama Merk Baru", "");
        if (inp != null) {
            var fd =  {'nama':inp};

            var formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("nama", inp);
            formData.append("actionx", "new");
            formData.append("active", 1);

            $.ajax({
                url:"{{ route('mstmerk.store') }}",
                method:"POST",
                data: formData,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        showToast(1, data.errors);
                    }
                    if(data.success)
                    {
                        //  append option
                        $("#idmerk").append('<option value="' + data.success.id + '">' + data.success.nama + '</option>');
                        $("#idmerk").val(data.success.id);
                        $("#idmerk").trigger('change');
                        $("#idmerk").select2("close");
                        showToast(0, "Penyimpanan Merk Baru, Berhasil !!!");
                    }
                }
            })
        }
    }

    function AddJenis() {
        var inp = prompt("Masukkan Nama Jenis Baru", "");
        if (inp != null) {
            var fd =  {'nama':inp};

            var formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("nama", inp);
            formData.append("actionx", "new");
            formData.append("active", 1);

            $.ajax({
                url:"{{ route('mstjenis.store') }}",
                method:"POST",
                data: formData,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        showToast(1, data.errors);
                    }
                    if(data.success)
                    {
                        //  append option
                        $("#idjenis").append('<option value="' + data.success.id + '">' + data.success.nama + '</option>');
                        $("#idjenis").val(data.success.id);
                        $("#idjenis").trigger('change');
                        $("#idjenis").select2("close");
                        showToast(0, "Penyimpanan Jenis Baru, Berhasil !!!");
                    }
                }
            })
        }
    }


    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#idmerk').val('').trigger('change');
        $('#idjenis').val('').trigger('change');
        $('#idsatuan').val('1').trigger('change');
        $('#active').prop('checked', 1);        
        $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/barang/noimage.jpg");
        
        if (actio == 'edit'){
            $.ajax({
            url:"/mstbarang/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#nama').val(data.nama);
                    $('#sku').val(data.sku);
                    $('#barcode').val(data.barcode);
                    $('#idmerk').val(data.idmerk).trigger('change');
                    $('#idjenis').val(data.idjenis).trigger('change');
                    $('#idsatuan').val(data.idsatuan).trigger('change');

                    $('#deskripsi').val(data.deskripsi);
                    $('#hpp').val(data.hpp);
                    $('#harga').val(data.harga);
                    $('#disc').val(data.disc);
                    $('#saldomin').val(data.saldomin);
                    $('#saldomax').val(data.saldomax);
                    $('#active').prop('checked', data.aktif);

                    var pi = "{{ URL::to('/') }}/images/barang/" + data.id + ".jpg";
                    console.log(pi);
                    $('#image_preview_container').attr('src', pi);
                    $('#imageold').val(data.id + '.jpg');

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

        $('#idmerk').select2().on('select2:open', function () {
            var a = $(this).data('select2');
            if (!$('.select2-link').length) {
                a.$results.parents('.select2-results')
                        .append('<div class="select2-link" style="text-align-last: center;"><button class="btnadduye btn btn-sm"><i class="fa fa-plus" style="margin-right: 4px;"></i>Tambah Merk Baru</button></div>')
                        .on('click', function (b) {
                            AddMerk();
                            // add your code
                        });
            }
        });

        $('#idjenis').select2().on('select2:open', function () {
            var a = $(this).data('select2');
            if (!$('.select2-link').length) {
                a.$results.parents('.select2-results')
                        .append('<div class="select2-link" style="text-align-last: center;"><button class="btnadduye btn btn-sm"><i class="fa fa-plus" style="margin-right: 4px;"></i>Tambah Jenis Baru</button></div>')
                        .on('click', function (b) {
                            AddJenis();
                            // add your code
                        });
            }
        });


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
                url:"{{ route('mstbarang.store') }}",
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