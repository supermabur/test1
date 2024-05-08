

@section('filecss')
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"/>
@endsection

@section('filejs')
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
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
                        <label for="id" class="col-md-2 col-form-label col-form-label-sm text-md-right">ID</label>
                        <div class="col-md-8">
                            <input type="text" id="id" name="id" class="form-control form-control-sm" required readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label col-form-label-sm text-md-right">Nama</label>
                        <div class="col-md-8">
                            <input type="text" id="nama" name="nama" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="notelp" class="col-md-2 col-form-label col-form-label-sm text-md-right">Telepon</label>
                        <div class="col-md-8">
                            <input type="tel" id="notelp" name="notelp" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label col-form-label-sm text-md-right">Jarak</label>
                        <div class="col-md-8">
                            <input type="number" id="jarak" name="jarak" class="form-control form-control-sm" min="0" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label col-form-label-sm text-md-right">Potongan</label>
                        <div class="col-md-8">
                            <input type="number" id="potongan" name="potongan" class="form-control form-control-sm" min="0" required readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label col-form-label-sm text-md-right">Pajak</label>
                        <div class="col-md-8">
                            <input type="number" id="pajak" name="pajak" class="form-control form-control-sm" min="0" required readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label col-form-label-sm text-md-right">Harga</label>
                        <div class="col-md-8">
                            <input type="number" id="harga" name="harga" class="form-control form-control-sm" min="0" required readonly>
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

        $('#id').val('');
        $('#nama').val('');
        $('#notelp').val('');
        $('#jarak').val(0);
        $('#potongan').val(0);
        $('#harga').val(0);

        $('#actionx').val(actio);
        
        if (actio == 'edit'){
            $.ajax({
            url:"/tempuh/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#notelp').val(data.notelp);

                    $('#jarak').val(data.jarak);
                    $('#potongan').val(data.potongan);
                    $('#harga').val(data.harga);

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

        $("#jarak").focusout(function(){
            var jarak = $("#jarak").val(); 
            var harga = jarak * 10000;
            var potongan = 0;
            if (jarak >= 50) {
                potongan = harga * 0.05;
                if (jarak >= 100) {
                    potongan = harga * 0.10;
                }
                harga = harga - potongan;
            } else {
                
            }
            $("#potongan").val(potongan);
            $("#harga").val(harga);
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
                url:"{{ route('tempuh.store') }}",
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