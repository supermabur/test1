    
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
                    <h3 class="card-title"><i class="fas fa-cookie-bite mr-2"></i>Informasi Bayar</h3>
                </div>
    
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nama</label>
                        <div class="col-md-8">
                            <input type="text" id="nama" name="nama" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputnokartu" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nomer Kartu</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="inputnokartu" name="inputnokartu" placeholder="Jika Pembayaran menggunakan Kartu" required>
                                <option value=0>Tidak perlu Diinput</option>                        
                                <option value=1>Harus Diinput</option>                        
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="chargeusepersen" class="col-md-2 col-form-label col-form-label-sm text-md-right">Charge</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="chargeusepersen" name="chargeusepersen" placeholder="Charge" required>
                                <option value=0>Memakai Nominal</option>                        
                                <option value=1>Memakai Persen</option>                        
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="chargevalue" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nilai Charge</label>
                        <div class="col-md-8">
                            <input type="number" id="chargevalue" name="chargevalue" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="idjenis" class="col-md-2 col-form-label col-form-label-sm text-md-right">Jenis</label>
                        <div class="col-md-8">
                            <select class="slct2 form-control form-control-sm" id="idjenis" name="idjenis" placeholder="Pilih Jenis" required>
                                @foreach ($composer_mstjenis as $cp)
                                    <option value="{{ $cp->id }}">{{ $cp->nama }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

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

    </div>
    

    <div class="row justify-content-md-center">
        <div class="col-sm-9 mb-4" style="text-align-last: justify;">
            <div class="card-footer shadow" style="background-color: white">
                <span id="form_result"></span>

                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="hidden" name="actionx" id="actionx" />
                <input type="hidden" name="imageold" id="imageold" />
                <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">
                    <i class="fa fa-save" style="margin-right: 4px;"></i>
                    Save Changes
                </button>

                <button type="button" name="btnback" id="btnback" class="btn-danger btn-sm hidexxx">
                    <i class="fa fa-arrow-alt-circle-left" style="margin-right: 4px;"></i>
                    Back 
                </button>
            </div>    
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
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#active').prop('checked', 1);    
        $('#chargevalue').val(0);    
        
        if (actio == 'edit'){
            $.ajax({
            url:"/mstcarabayar/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#nama').val(data.nama);
                    $('#inputnokartu').val(data.inputnokartu);
                    $('#chargeusepersen').val(data.chargeusepersen);
                    $('#chargevalue').val(data.chargevalue);
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
                url:"{{ route('mstcarabayar.store') }}",
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