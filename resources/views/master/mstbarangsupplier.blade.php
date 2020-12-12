    
@section('style')
@endsection

@section('filecss')

@endsection

@section('filejs')
    <!-- JavaScript -->
    <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>
@endsection

<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Informasi Cara Upload File</h3>
                </div>
    
                <div class="card-body">
                    
                    <div class="row justify-content-md-center">
                        <p class="col-md-10 text-sm">
                            1. Data harus berada di sheet Pertama
                        </p>
                        <p class="col-md-10 text-sm">
                            2. Format Kolom harus sama dengan contoh excel yang telah disediakan
                        </p>
                        <p class="col-md-10 text-sm">
                            3. Besar file tidak lebih dari 4 Mb
                        </p>
                        <p class="col-md-10 text-sm">
                            4. Contoh Format Excel bisa di download <a href="{{ url('files/supplier/mstbarang/contoh.xlsx') }}" type="button" class="pl-2 pr-2 rounded bg-primary">Disini</a> 
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-9">
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-upload mr-2"></i>Upload File</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">File</label>
                        <div class="col-md-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="namafile" name="namafile" accept=".xlsx, .xls, .csv">
                                <label class="custom-file-label" for="namafile">Klik disini untuk pilih file</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label col-form-label-sm text-md-right">Keterangan</label>
                        <div class="col-md-8">
                            <input type="text" id="keterangan" name="keterangan" class="form-control form-control-sm" required>
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
    $(".custom-file-input").on("change", function() {
        var xx = "Klik disini untuk pilih file";
        var fileName = $(this).val().split("\\").pop();
        if (fileName.length == 0){
            fileName = xx ;
        }
        else{
            if (checkfile(this) == false){
                fileName = xx ;
            }
        }
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function checkfile(sender) {
        var validExts = new Array(".xlsx", ".xls", ".csv");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("Invalid file selected, valid files are of " +
                    validExts.toString() + " types.");
            $($this).val('');
            return false;
        }
        else {
            var fcontoh = "{{ url('files/supplier/mstbarang/contoh.xlsx') }}";
            var xlscontoh = new Array();
            console.log(fcontoh);

            readXlsxFile(fcontoh).then((data) => {
                xlscontoh = data;
            });          

            console.log(xlscontoh);


            var xlsclient = new Array();
            readXlsxFile(sender.files[0], { sheet: 1 }).then(function(data) {
                xlsclient = data;
                // `rows` is an array of rows
                // each row being an array of cells.
            });   
            return true;
        }
    }

    function RemoveAlert(){
            $("input").removeClass("is-invalid");
            $("span").remove(".invalid-feedback");
        }


    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');
        $('.custom-file-label').html('Klik disini untuk pilih file');
        RemoveAlert();

        $('#email').val('');
        $('#idkota').val(1).trigger('change');

        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#active').prop('checked', 1);        
        
        if (actio == 'edit'){
            $.ajax({
            url:"/mstbarangsupplier/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#nama').val(data.nama);
                    $('#kode').val(data.kode);
                    $('#email').val(data.email);
                    $('#notelp').val(data.notelp);
                    $('#nohp').val(data.nohp);
                    $('#alamat').val(data.alamat);
                    $('#idkota').val(data.idkota).trigger('change');

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


        $('#formuser').on('submit', function(event){
            event.preventDefault();
            loading(1, 'Saving Data ...');
            RemoveAlert();


            $('#saveBtn').html('Saving...');

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);

            $.ajax({
                url:"{{ route('mstbarangsupplier.store') }}",
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
                                v.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(v);
                            }

                            if($(v).is("select")){
                                var w = v.nextSibling;
                                w.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(w);
                            }
                        }
                    }
                    if(data.success)
                    {
                        $('#formuser')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        // alert(data.success);
                        console.log(data.success);
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