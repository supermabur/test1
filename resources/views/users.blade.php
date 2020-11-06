    


<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">

        <div class="col-sm-9">

            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Data User</h3>
                </div>
    
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label col-form-label-sm text-md-right">Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter name" required>
                        </div>
                    </div>                  

                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label col-form-label-sm text-md-right">Username</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Enter Username" required>
                        </div>
                    </div>
        
                    <div class="form-group row hidexxx">
                        <label for="role" class="col-md-2 col-form-label col-form-label-sm text-md-right">Role</label>
                        <div class="col-md-8">
                            <select class="role form-control form-control-sm" id="role" name="role" placeholder="Pilih role" required>
                                @foreach ($composer_strole as $cp)
                                    <option value="{{ $cp->id }}">{{ $cp->text }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label col-form-label-sm text-md-right">Email</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="hp" class="col-md-2 col-form-label col-form-label-sm text-md-right">Handphone</label>
                        <div class="col-md-8">
                            <input type="tel" class="form-control form-control-sm" id="hp" name="hp" placeholder="Enter Handphone">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label col-form-label-sm text-md-right">Password</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control form-control-sm" id="password" placeholder="Enter password" name="password" required autocomplete="new-password">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-2 col-form-label col-form-label-sm text-md-right">Password</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control form-control-sm" id="password-confirm" placeholder="Enter password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row hidexxx">
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
        <div class="col-sm-9">
            
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-warehouse mr-2"></i>Akses Outlet</h3>
                </div>
    
                <div class="card-body">

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-2 col-form-label col-form-label-sm text-md-right"></label>
                        <div class="col-md-8 row">
                            {{-- <div class="row"> --}}
                                {{-- https://stackoverflow.com/questions/52447032/laravel-store-multiple-checkbox-form-values-in-database --}}
                                @foreach ($composer_mstoutlet as $cp)
                                    <div class="form-check col-sm-4 mb-3">
                                        <input class="form-check-input" type="checkbox" name="outlet[]" value="{{ $cp->id }}" id="outlet{{ $cp->id }}">
                                        <div class="col">
                                            <label class="form-check-label text-sm row" for="outlet{{ $cp->id }}" >{{ $cp->nama }}</label>
                                            <label class="form-check-label text-sm text-secondary row" for="outlet{{ $cp->id }}" style="font-size: .70rem!important;">{{ $cp->alamat }}</label>
                                            <label class="form-check-label text-sm text-secondary row" for="outlet{{ $cp->id }}" style="font-size: .70rem!important;">{{ $cp->kotaname2 }}</label>
                                        </div>
                                    </div>    
                                @endforeach
                            {{-- </div> --}}
                        </div>
                    </div>
            
                </div>
            </div>

        </div>
    </div>


    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            <div class="card card-light shadow">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-images mr-2"></i>Profile picture</h3>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label col-form-label-sm text-md-right"></label>
                        <div class="col-md-8">
                            <label for="pathimage" class="btn btn-primary btn-sm" id="labelimage">Select Image</label>
                            <input type="file" class="form-control-file form-control-sm" id="pathimage" name="pathimage" accept=".jpg" placeholder="Choose image" style="display: none;" >
        
                            <div style="padding-top:10px">    
                                <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 150px;" 
                                    src="{{ url('/images/users/noimage.jpg') }}"  alt="preview image"/>
                            </div>
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



<script>

    $('#pathimage').change(function(){        
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        
        });

    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#role').val('').trigger('change');
        $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/users/noimage.jpg");
        
        if (actio == 'edit'){
            $.ajax({
            url:"/users/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    // console.log(data.outlet);
                    data.outlet.forEach(function(element) {
                        document.getElementById("outlet" + element.idoutlet).checked = true;
                    });

                    $('#name').val(data.data.name);
                    $('#username').val(data.data.username);
                    $('#email').val(data.data.email);
                    $('#hp').val(data.data.hp);
                    $('#role').val(data.data.role_id).trigger('change');
                    $('#password').val('');
                    $('#password-confirm').val('');
                    $('#active').prop('checked', data.data.active);
                    $('#hidden_id').val(data.data.id);

                    var pi = "{{ URL::to('/') }}/images/users/" + data.data.imagepath;
                    $('#image_preview_container').attr('src', pi);

                    $('#imageold').val(data.data.id + '.jpg');
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

        // https://www.jqueryscript.net/other/jQuery-Plugin-For-Selecting-Multiple-Areas-of-An-Image-Select-Areas.html
        // $('img#image_preview_container').selectAreas({
        //     minSize: [10, 10],
        //     aspectRatio: 1,
        //     allowDelete:false,
        //     onChanged: debugQtyAreas,
        //     width: 500,
        //     areas: [
        //         {
        //             x: 10,
        //             y: 20,
        //             width: 100,
        //             height: 100,
        //         }
        //     ]
        // });

        // Log the quantity of selections
        function debugQtyAreas (event, id, areas) {
            console.log(areas.length + " areas", arguments);
        };

        // $('#saveBtn').click(function(){    
        //     alert('asd');        
        // });


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
                url:"{{ route('users.store') }}",
                method:"POST",
                data: fd,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    if(data.errors)
                    {
                        // console.log(data.errors.keys);
                        for(var count = 0; count < data.errors.keys.length; count++)
                        {  
                            var v = document.getElementById(data.errors.keys[count]);
                            if($(v).is("input")){
                                if (count == 0)
                                {
                                    $(v).focus();
                                    v.scrollIntoView(false);
                                }
                                // v.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(v);
                            }

                            if($(v).is("select")){
                                if (count == 0)
                                {
                                    $(v).focus();
                                    v.scrollIntoView(true);
                                }
                                var w = v.nextSibling;
                                // w.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(w);
                            }
                        }
                    }
                    if(data.success)
                    {
                        $('#formuser')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        // console.log(data.success);
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