

{{-- https://github.com/techlab/jquery-smartwizard --}}

@section('filecss')
    <!-- CSS -->
    <link href="https://unpkg.com/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('filejs')
    <!-- JavaScript -->
    <script src="https://unpkg.com/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
@endsection


<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">

        <div class="col-sm-9">

            {{-- <div class="card card-light shadow">
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
                            <input type="hidden" name="active" value="0"/>
                            <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                        </div>
                    </div>
        
    

                </div>
            </div> --}}
        </div>
    </div>



    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            <div id="smartwizard">

                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link" href="#step-1">
                        Step 1
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#step-2">
                        Step 2
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#step-3">
                        Step 3
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#step-4">
                        Step 4
                      </a>
                    </li>
                </ul>
            
                <div class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                        <div class="card card-light shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-users mr-2"></i>Header Faktur</h3>
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
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        Step 2 Content
                    </div>
                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        Step 3 Content
                    </div>
                    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                        Step 4 Content
                    </div>
                </div>
            </div>

        </div>  
    </div>  
    

    <div class="row justify-content-md-center">
        <div class="col-sm-9 mb-4" style="text-align-last: justify;">
            <div class="card-footer shadow">
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


    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#role').val('').trigger('change');
        $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/users/noimage.jpg");
        $('#smartwizard').smartWizard("reset");
        
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
        // $('#smartwizard').smartWizard({autoAdjustHeight: false});

        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'dots', // theme for the wizard, related css need to include for other than default theme
            justified: true, // Nav menu justification. true/false
            darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
            autoAdjustHeight: false, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            // enableURLhash: true, // Enable selection of the step based on url hash
            // transition: {
            //     animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            //     speed: '400', // Transion animation speed
            //     easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
            // },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'center', // left, right, center
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                showFinishButton: true, // show/hide a Previous button
                toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            },
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // Add done state on navigation
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },
            keyboardSettings: {
                keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                keyLeft: [37], // Left key code
                keyRight: [39] // Right key code
            },
            lang: { // Language variables for button
                next: 'Selanjutnya',
                previous: 'Sebelumnya',
                finish: 'selesai'
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Highlight step with errors
            hiddenSteps: [] // Hidden steps
            });


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