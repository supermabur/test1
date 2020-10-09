    
    
@extends('layouts.dashboard')


@section('content')
    <div class="row" style="    padding-top: 20px;">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">

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
                        
                                    <div class="form-group" style="display: none;">
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
                                    
                                    <div class="form-check" style="display: none;">
                                        <input type="hidden" name="active" value="0"/>
                                        <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                                        <label class="form-check-label" for="active">Aktif</label>
                                    </div>
                        
                    

                                </div>
                            </div>

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
                        <div class="col-sm-8">
                            <span id="form_result"></span>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <span id="form_result"></span>
                        <div class="col-sm-8" style="text-align-last: justify;">
                            <div class="card-footer">

                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="hidden" name="actionx" id="actionx" />
                                <input type="hidden" name="imageold" id="imageold" />
                                <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">
                                    <i class="fa fa-save" style="margin-right: 4px;"></i>
                                    Save Changes
                                </button>

                            </div>    
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <script>

        $('#pathimage').change(function(){        
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#image_preview_container').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            
            });

        function getData(){
            $('#formuser')[0].reset();
            $('#form_result').html('');
            $('#hidden_id').val('');
            $('#actionx').val('edit');
            $('#role').val('').trigger('change');
            $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/users/noimage.jpg");
            
            $.ajax({
            url:"/editprofile",
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
                }
            })    
        }

        $(document).ready(function() {
            getData();

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
                $('#form_result').html('');

                // ambil semua inputan di form dan di tambahi array menu----------
                var fd =  new FormData(this);

                $.ajax({
                    url:"{{ route('editprofile.store') }}",
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
                            alert(data.success);
                        }
                        $('#saveBtn').html('Save changes');
                        loading(0);
                    }
                })
            });


        });
    </script>
@endsection