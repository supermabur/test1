    


<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">

        <div class="col-sm-5">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                </div>
    
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter name" required>
                    </div>
            
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Enter Username" required>
                    </div>
        
                    <div class="form-group hidexxx">
                        <label for="role">Role</label>
                        <select class="role form-control form-control-sm" id="role" name="role" placeholder="Pilih role" required>
                            @foreach ($composer_strole as $cp)
                                <option value="{{ $cp->id }}">{{ $cp->text }}</option>                        
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Email">
                    </div>
            
                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="tel" class="form-control form-control-sm" id="hp" name="hp" placeholder="Enter Handphone">
                    </div>
            
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" placeholder="Enter password" name="password" required autocomplete="new-password">
                    </div>
            
                    <div class="form-group">
                        <label for="password-confirm">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password-confirm" placeholder="Enter password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    
                    <div class="form-check hidexxx">
                        <input type="hidden" name="active" value="0"/>
                        <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                        <label class="form-check-label" for="active">Aktif</label>
                    </div>
        
    

                </div>
            </div>



            {{-- <div class="form-group row">
                <label for="aktif">Aktif</label>
                <div class="col-sm-6" id="aktif" class="form-control"> --}}
                    {{-- A checkbox input in not sent in the request when it's unchecked, in that case the hidden input will be sent with the value 0. When the Checkox is checked, it will overwrite the value to 1. --}}
                    {{-- <input type="hidden" name="active" value="0"/>
                    <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                </div>
            </div> --}}

        </div>

        <div class="col-sm-3">
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
        </div>  
    </div>
    

    <div class="row justify-content-md-center">
        <div class="col-sm-8" style="text-align-last: justify;">
            <div class="card-footer">
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
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#hp').val(data.hp);
                    $('#role').val(data.role_id).trigger('change');
                    $('#password').val('');
                    $('#password-confirm').val('');
                    $('#active').prop('checked', data.active);
                    $('#hidden_id').val(data.id);

                    var pi = "{{ URL::to('/') }}/images/users/" + data.id + ".jpg";
                    if(doesFileExist(pi)){
                        $('#image_preview_container').attr('src', pi);
                    }

                    $('#imageold').val(data.id + '.jpg');
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

        $('#formuser').on('submit', function(event){
            event.preventDefault();
            loading(1, 'Saving Data ...');

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
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                        html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#form_result').html(html);
                    }
                    if(data.success)
                    {
                        $('#formuser')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        // alert(data.success);
                        document.getElementById('btnback').click();
                    }
                    $('#saveBtn').html('Save changes');
                    loading(0);
                }
            })
        });


    });
</script>