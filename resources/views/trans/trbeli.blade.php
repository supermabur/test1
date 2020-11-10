

{{-- https://github.com/techlab/jquery-smartwizard --}}

@section('filecss')
    <!-- CSS -->
    <link href="https://unpkg.com/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"/>
@endsection


@section('filejs')
    <!-- JavaScript -->
    <script src="https://unpkg.com/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="{{ url('js/me.js') }}"></script>
@endsection


{{-- CSS buat subtext e bootstrapselect --}}
<style>
    .bootstrap-select .dropdown-menu li small {
    padding-left: 0px;
    display: block;
    margin-top: -3px;
    }    
</style>


<form method="post" id="formuser" class="form-vertical" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            <div id="smartwizard">

                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link" href="#step-1">
                        <strong>Step 1</strong> <br> Masukan informasi Transaksi 
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#step-2">
                        <strong>Step 2</strong> <br> Data Barang  
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#step-3">
                        <strong>Step 3</strong> <br> Pembayaran 
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
                                    <label for="idoutlet" class="col-md-2 col-form-label col-form-label-sm text-md-right">Outlet</label>
                                    <div class="col-md-8">
                                        <select class="selectpicker form-control form-control-sm" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" id="idoutlet" name="idoutlet" required>
                                            @foreach ($composer_usersoutlet as $cp)
                                                <option value="{{ $cp->idoutlet }}" data-subtext="{{ $cp->alamat . ' ' . $cp->notelp }}">{{ $cp->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>        

                                <div class="form-group row">
                                    <label for="idsupcus" class="col-md-2 col-form-label col-form-label-sm text-md-right">Supplier</label>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="selectpicker form-control form-control-sm" id="idsupcus" name="idsupcus" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" required>
                                            @foreach ($composer_supplier as $cp)
                                                <option value="{{ $cp->id }}" data-subtext="{{ $cp->alamat . ' ' . $cp->notelp }}">{{ $cp->nama }}</option>                        
                                            @endforeach                                            
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" onclick="showModalPopSupplier()" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top" title="Tambah Supplier Baru"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fakturreff" class="col-md-2 col-form-label col-form-label-sm text-md-right">Faktur Supplier</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm" id="fakturreff" name="fakturreff" placeholder="" required>
                                        <small class="text-muted">Faktur supplier bisa berupa nomer surat jalan, no invoice, dll</small>
                                    </div>
                                </div>                    
                
            
                            </div>
                        </div>
                    </div>

                    
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <div class="card card-light shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-users mr-2"></i>Daftar Barang</h3>
                            </div>
                
                            <div class="card-body">           
        
                                <div class="form-group row">
                                    <label for="idoutlet" class="col-md-2 col-form-label col-form-label-sm text-md-right">Outlet</label>
                                    <div class="col-md-8">
                                        <select class="selectpicker form-control form-control-sm" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" id="idoutlet" name="idoutlet" required>
                                            @foreach ($composer_usersoutlet as $cp)
                                                <option value="{{ $cp->idoutlet }}" data-subtext="{{ $cp->alamat . ' ' . $cp->notelp }}">{{ $cp->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>        

                                <div class="form-group row">
                                    <label for="idsupcus" class="col-md-2 col-form-label col-form-label-sm text-md-right">Supplier</label>
                                    <div class="col-md-8 input-group input-group-sm">
                                        <select class="selectpicker form-control form-control-sm" id="idsupcus" name="idsupcus" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" required>
                                            @foreach ($composer_supplier as $cp)
                                                <option value="{{ $cp->id }}" data-subtext="{{ $cp->alamat . ' ' . $cp->notelp }}">{{ $cp->nama }}</option>                        
                                            @endforeach                                            
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" onclick="showModalPopSupplier()" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top" title="Tambah Supplier Baru"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <div class="table-responsive" width=100%>
                                            <table class="table display cell-border" id="tablebeli" width=100%>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>                    
                
            
                            </div>
                        </div>
                    </div>


                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        Step 3 Content
                    </div>
                </div>
            </div>

        </div>  
    </div>  
    

    <div class="row justify-content-md-center">
        <div class="col-sm-9">
            <div class="card-footer shadow mb-4" style="background-color: white; ">
                <span id="form_result"></span>
            
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="hidden" name="actionx" id="actionx" />
                <input type="hidden" name="imageold" id="imageold" />
            
                <div class="row">
                    <div class="col">
                        <button type="button" name="btnback" id="btnback" class="btn btn-danger btn-sm hidexxx">
                            <i class="fa fa-arrow-alt-circle-left" style="margin-right: 4px;"></i>
                            Cancel and Back 
                        </button>
                    </div>
                    
                    <div class="col text-center">
                        <button type="button" class="btn btn-warning btn-sm" onclick="$('#smartwizard').smartWizard('prev');" >
                            <i class="fa fa-backward" style="margin-right: 4px;"></i>
                            Previous
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="$('#smartwizard').smartWizard('next');" >
                            <i class="fa fa-forward" style="margin-right: 4px;"></i>
                            Next
                        </button>
                    </div>

                    <div class="col text-right">
                        <button type="submit" class="btn btn-info btn-sm btn-finish" id="saveBtn" value="create">
                            <i class="fa fa-save" style="margin-right: 4px;"></i>
                            Save Changes
                        </button>     
                    </div>
                </div>

            </div>   
        </div>
    </div>

</form>



@include('master\popmstsupcus')



<script>


    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formuser')[0].reset();
        $('#form_result').html('');
        $('#actionx').val(actio);
        $('#hidden_id').val('');
        $('#role').val('').trigger('change');
        $('#image_preview_container').attr('src', "{{ URL::to('/') }}/images/users/noimage.jpg");
        $('#smartwizard').smartWizard("reset");
        $('.btn-finish').hide();   
        
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
        fillthedatatable('tablebeli', {});



        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'dots', // theme for the wizard, related css need to include for other than default theme
            justified: true, // Nav menu justification. true/false
            darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
            autoAdjustHeight: false, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            enableURLhash: true, // Enable selection of the step based on url hash
            // transition: {
            //     animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            //     speed: '400', // Transion animation speed
            //     easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
            // },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'center', // left, right, center
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
                toolbarExtraButtons: [
                    // $('<button type="button"><i class="fas fa-backward mr-2"></i></button>')
                    //     .text('Previous')
                    //     .addClass('btn btn-sm sw-btn-prev')
                    //     .on('click', function(){ 
                    //     // alert('Hmmm button click');                            
                    // }),                     
                    // $('<button type="button"></button>')
                    //     .text('Next')
                    //     .addClass('btn btn-sm sw-btn-next')
                    //     .on('click', function(){ 
                    //     // alert('Hmmm button click');                            
                    // }),                     
                    // $('<button type="button"></button>')
                    //     .text('Finish')
                    //     .addClass('btn btn-sm btn-finish btn-info')
                    //     .on('click', function(){ 
                    //     alert('Finsih button click');                            
                    // })
                          ] // Extra buttons to show on toolbar, array of jQuery input/buttons elements  backward
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
                previous: 'Sebelumnya'
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Highlight step with errors
            hiddenSteps: [] // Hidden steps
            });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
                if(anchorObject.prevObject.length - 1 == nextStepIndex){
                    $('.btn-finish').show(); 
                }else{
                    $('.btn-finish').hide();                
                }
            });


        $('#btnaddsupplier').click(function(){    
            alert('asd');        
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
                url:"{{ route('trbeli.store') }}",
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