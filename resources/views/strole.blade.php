    

{{-- referensi treeview --}}
{{-- https://www.jqueryscript.net/other/jQuery-Plugin-To-Create-Checkbox-Tree-View-highchecktree.html --}}

<!-- form start -->

<form method="post" id="formx" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="name" class="col-sm-6 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="32" required="" autofocus>
                </div>
            </div>
        
            <div class="form-group row">
                <label for="aktif" class="col-sm-6 col-form-label">Aktif</label>
                <div class="col-sm-6">
                    {{-- A checkbox input in not sent in the request when it's unchecked, in that case the hidden input will be sent with the value 0. When the Checkox is checked, it will overwrite the value to 1. --}}
                    <input type="hidden" name="active" value="0"/>
                    <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Menu</h3>
                </div>

                <div class="card-body">
                    <div id="tree-container">
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <span id="form_result"></span>

    <div class="card-footer">
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="actionx" id="actionx" />
        <input type="hidden" name="imageold" id="imageold" />
        <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">Save Changes</button>
    </div>


</form>





<script>
    function initEdit(actio = 'new', id = '1'){
        $('#formx')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        
        $.ajax({
            url:"/strole/"+id+"/edit",
            dataType:"json",
            success:function(data)
                {
                    $('#name').val(data.data.name);
                    $('#active').prop('checked', data.data.active);
                    if (actio = 'edit') {
                        $('#hidden_id').val(data.data.id);
                    }
                    $("#globrep").hide(200);
                    $("#editview").show(200);

                    $('#tree-container').highCheckTree({
                        data: data.menu
                    });
                    
                    clickmenu();
                }
        })       
    }

    function clickmenu(){
        var divs = document.querySelectorAll('.collapsed'); 
        if (divs.length > 0 ){
            for (i = 0; i < divs.length ; ++i) {
                try {
                    divs[i].click();
                }
                catch(err) {
                    console.log(err.message);
                }                            
            };
            // recursive dong
            clickmenu();
        }
    }



    $(document).ready(function() {

        $('#formx').on('submit', function(event){
            event.preventDefault();

            $('#saveBtn').html('Saving...');

            // ambil menu yg tercentang----------
            var lis = document.getElementById("tree-container").getElementsByTagName("li");
            var mnu = [];
            for (var i = 0; i < lis.length; i++) {
                if(lis[i].innerHTML.indexOf('checked') > -1){
                    mnu.push($(lis[i]).attr('rel'));
                } 
            }

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);
            fd.append('mnu', mnu);

            $.ajax({
                url:"{{ route('strole.store') }}",
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
                        alert(data.success);
                        document.getElementById('btnback').click();
                    }
                    $('#saveBtn').html('Save changes');
                }
            })
        });


    });
</script>