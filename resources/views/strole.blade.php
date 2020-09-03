    



<!-- form start -->
<form method="post" id="formx" class="form-horizontal" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-2 control-label" style="text-align: left">Name (max 32 char)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="32" required="" autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 control-label" style="text-align: left; padding-top:0px" for="aktif">Aktif</label>
        <div class="col-sm-10">
            <input id="aktif" name="aktif" class="form-check-input" type="checkbox" value="true">
        </div>
    </div>

    <div class="modal-footer" style="background: linear-gradient(to right, rgb(0, 121, 145), rgb(120, 255, 214));">
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="actionx" id="actionx" />
        <input type="hidden" name="imageold" id="imageold" />
        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
    </div>
    <span id="form_result"></span>

</form>

<script>
    function initEdit(actio = 'new'){
        $('#formx')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        
        if (actio == 'edit') {
            var id = $(this).attr('id');
            $.ajax({
                url:"/strole/"+id+"/edit",
                dataType:"json",
                success:function(data)
                    {
                        $('#name').val(data.name);
                        $('#aktif').prop('checked', data.aktif);
                        // $('.modal-title').text("Edit Record");
                        $('#action_button').val("Edit");
                        $('#hidden_id').val(data.id);
                        $('#actionx').val("edit");
                        return true;
                    }
            })            
        }
        else
        {
            return true;
        }

    }


    $(document).ready(function() {

        $('#formx').on('submit', function(event){
            event.preventDefault();
            alert('asd');
            $('#saveBtn').html('Saving...');
            $.ajax({
                url:"{{ route('strole.store') }}",
                method:"POST",
                data: new FormData(this),
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
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#formx')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                        alert(data.success);
                        document.getElementById('btnback').click();
                    }
                    $('#saveBtn').html('Save changes');
                }
            })
        });



        // // https://www.studentstutorial.com/laravel/laravel-ajax-insert

        // $('#butsave').on('click', function() {
        //   var name = $('#name').val();
        //   var active = $('#active').val();
        //   if(name!=""){
        //     //   $("#butsave").attr("disabled", "disabled");
        //       $.ajax({
        //           url: "/strole",
        //           type: "POST",
        //           data: {
        //               _token: $("#csrf").val(),
        //               type: 1,
        //               name: name,
        //               active: active
        //           },
        //           cache: false,
        //           success: function(dataResult){
        //               console.log(dataResult);
        //               var dataResult = JSON.parse(dataResult);
        //               if(dataResult.statusCode==200){
        //                 window.location = "/userData";				
        //               }
        //               else if(dataResult.statusCode==201){
        //                  alert("Error occured !");
        //               }
                      
        //           }
        //       });
        //   }
        //   else{
        //       alert('Please fill all the field !');
        //   }
        // });


    });
</script>