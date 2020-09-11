    


<form method="post" id="formx" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row">
        {{-- <div class="form-group row">
            <label for="name" class="col-sm-6 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="32" required="" autofocus>
            </div>
        </div> --}}
        

        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter name" required>
            </div>
    
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select class="role form-control form-control-sm" id="role" name="role" required>
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
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-sm" id="password" placeholder="Enter password" name="password" required autocomplete="new-password">
            </div>
    
            <div class="form-group">
                <label for="password-confirm">Password</label>
                <input type="password" class="form-control form-control-sm" id="password-confirm" placeholder="Enter password" name="password_confirmation" required autocomplete="new-password">
            </div>
            
            <div class="form-check">
                <input type="hidden" name="active" value="0"/>
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                <label class="form-check-label" for="active">Aktif</label>
            </div>

            {{-- <div class="form-group row">
                <label for="aktif">Aktif</label>
                <div class="col-sm-6" id="aktif" class="form-control"> --}}
                    {{-- A checkbox input in not sent in the request when it's unchecked, in that case the hidden input will be sent with the value 0. When the Checkox is checked, it will overwrite the value to 1. --}}
                    {{-- <input type="hidden" name="active" value="0"/>
                    <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                </div> --}}
            </div>
        </div>

    </div>

    <span id="form_result"></span>

    <div class="card-footer">
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="actionx" id="actionx" />
        <input type="hidden" name="imageold" id="imageold" />
        <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">
            <i class="fa fa-save" style="margin-right: 4px;"></i>
            Save Changes
        </button>
    </div>


</form>





<script>

    function initEdit(actio = 'new', id = '1'){
        $('#formx')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#role').val('').trigger('change');
        
        if (actio == 'edit'){
            $.ajax({
            url:"/users/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#role').val(data.role_id).trigger('change');
                    $('#password').val('');
                    $('#password-confirm').val('');
                    $('#active').prop('checked', data.active);
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

        $('#formx').on('submit', function(event){
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
                        $('#formx')[0].reset();
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