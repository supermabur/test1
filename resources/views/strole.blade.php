    

{{-- referensi treeview --}}
{{-- https://www.jqueryscript.net/other/jQuery-Plugin-To-Create-Checkbox-Tree-View-highchecktree.html --}}

<!-- form start -->

{{-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> --}}
{{-- <script src="{{ url('js/highchecktree.js') }}"></script>
<link rel="stylesheet" href="{{ url('css/highCheckTree.css') }}"> --}}


<form method="post" id="formx" class="form-horizontal" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="name" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="32" required="" autofocus>
                </div>
            </div>
        
            <div class="form-group row">
                <label for="aktif" class="col-sm-1 col-form-label">Aktif</label>
                <div class="col-sm-5">
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

                


                <form class="form-horizontal">
                    <div class="card-body">
                        <div id="tree-container">
                        </div>

                        <div class="treeview"></div>

                    </div>
                </form>
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


    var mockData = [];
        mockData.push({
        item:{
            id: 'id1',
            label: 'label1',
            checked: 'false'
        },
        children: [{
            item:{
            id: 'id11',
            label: 'label11',
            checked: false
            } 
        },{
            item:{
            id: 'id12',
            label: 'label12',
            checked: '1'
            } 
        },{
            item:{
            id: 'id13',
            label: 'label13',
            checked: ''
            } 
        }]
        });

        mockData.push({
        item:{
            id: 'id2',
            label: 'label2',
            checked: false
        },
        children: [{
            item:{
            id: 'id21',
            label: 'label21',
            checked: false
            } 
        },{
            item:{
            id: 'id22',
            label: 'label22',
            checked: true
            } 
        },{
            item:{
            id: 'id23',
            label: 'label23',
            checked: false
            } 
        }]
        });

        mockData.push({
        item:{
            id: 'id3',
            label: 'label3',
            checked: false
        },
        children: [{
            item:{
            id: 'id31',
            label: 'label31',
            checked: true
            } 
        },{
            item:{
            id: 'id32',
            label: 'label32',
            checked: false
            },
            children: [{
            item:{
                id: 'id321',
                label: 'label321',
                checked: false
            }
            },{
            item:{
                id: 'id322',
                label: 'label322',
                checked: false
            }
            }]
        }]
    });

    
    function initializePlugins() {
        $('#tree-container').highCheckTree({
            data: mockData
        });
    };

    // $('#tree-container').highCheckTree({
    //     data: mockData
    // });


    function initEdit(actio = 'new', id = ''){
        $('#formx')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        
        if (actio == 'edit') {
            $.ajax({
                url:"/strole/"+id+"/edit",
                dataType:"json",
                success:function(data)
                    {
                        console.log(data.menu);
                        $('#name').val(data.data.name);
                        $('#active').prop('checked', data.data.active);
                        // $('.modal-title').text("Edit Record");
                        $('#action_button').val("Edit");
                        $('#hidden_id').val(data.data.id);
                        $('#actionx').val("edit");
                        $("#globrep").hide(200)
                        $("#editview").show(200);


                        var xxx= data.menu;
                        console.log(mockData);

                        $('#tree-container').highCheckTree({
                            data: xxx
                        });

                    }
            })       
        }
        else
        {
            $("#globrep").hide(200)
            $("#editview").show(200);
        }

    }


    $(document).ready(function() {

        $('#formx').on('submit', function(event){
            event.preventDefault();
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