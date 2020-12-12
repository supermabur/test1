

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
    <script src="{{ url('js/jquery.number.min.js') }}"></script>
    <script src="{{ url('js/me.carabayar.js') }}"></script>
@endsection


{{-- CSS buat subtext e bootstrapselect --}}
<style>
    .bootstrap-select .dropdown-menu li small {
    padding-left: 0px;
    display: block;
    margin-top: -3px;
    }    
</style>

       


    <div class="row justify-content-md-center">

        @if (count($composer_usersoutlet) == 0 )
            <div class="col-sm-9">
                <div class="card card-danger shadow">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Anda Tidak Bisa Melakukan transaksi Ini</h3>
                    </div>
        
                    <div class="card-body">
                        
                        <div class="row justify-content-md-center">
                            <p class="col-md-10 text-sm">
                                1. User anda belum mempunyai akses ke outlet
                            </p>
                            <p class="col-md-10 text-sm">
                                2. Mintalah kepada owner atau manager anda untuk membukakan akses ke outlet
                            </p>
                            <p class="col-md-10 text-sm">
                                3. Jika anda sudah diberikan hak akses ke outlet, Klik Refresh atau tekan tombol F5 pada keyboard
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-sm-9 @if (count($composer_usersoutlet) == 0 ) d-none @endif">
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
                        <form method="post" id="formstep1" name="formstep1" class="form-vertical" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card card-light shadow">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Header Faktur</h3>
                                </div>
                    
                                <div class="card-body">    
                                    
                                    <div class="form-group row">
                                        <label for="idoutlet" class="col-md-2 col-form-label col-form-label-sm text-md-right">Outlet</label>
                                        <div class="col-md-8">
                                            <select class="selectpicker form-control form-control-sm" multiple data-max-options="1" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" id="idoutlet" name="idoutlet" required>
                                                @foreach ($composer_usersoutlet as $cp)
                                                    <option value="{{ $cp->idoutlet }}" data-subtext="{{ $cp->alamat . ' ' . $cp->notelp }}">{{ $cp->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>        

                                    <div class="form-group row">
                                        <label for="idsupcus" class="col-md-2 col-form-label col-form-label-sm text-md-right">Supplier</label>
                                        <div class="col-md-8 input-group input-group-sm">
                                            <select class="selectpicker form-control form-control-sm" multiple data-max-options="1" id="idsupcus" name="idsupcus" data-container="body" data-style="btn-default" data-live-search="true" data-size="5" data-show-subtext ="true" required>
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
                    
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm">
                                        Launch Small Modal
                                    </button>

                                    <div class="modal fade" id="modal-sm">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Small Modal</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>One fine body&hellip;</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                          <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                      <!-- /.modal -->

                                </div>
                            </div>
                        </form>
                    </div>

                    
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                        <form action="..." method="post" id="formtmpbeli" name="formtmpbeli" class="form-vertical" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card card-light shadow">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Pilih Barang</h3>
                                </div>
                    
                                <div class="card-body">           

                                    <div class="form-group row">
                                        {{-- <label class="col-md-2 col-form-label col-form-label-sm text-md-right">Barang</label> --}}
                                        <div class="col-md-12">
                                            @include('compo.barang')
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- <label class="col-md-2 col-form-label col-form-label-sm text-md-right"></label> --}}
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-info btn-sm" id="saveBtn" value="create">
                                                <i class="fa fa-plus" style="margin-right: 4px;"></i>
                                                Tambahkan ke daftar Pembelian
                                            </button>     

                                            {{-- <div class="dropright">
                                                <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-info-circle" style="margin-right: 4px;"></i>Info
                                                </button>
        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <p class="dropdown-item"><small>Jika barang yang diinput sudah ada di dalam daftar pembelian, maka qty yang baru akan di tambahkan ke daftar pembelian. Harga dan diskon menggunakan harga dan diskon yang terbaru</small></p>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>     --}}
                                        

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                Launch demo modal
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    ...
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>                                            

                                        </div>

                                    </div>   



                                    
                                    <input type="hidden" name="brgstat" id="brgstat" value="new" />

                                </div>
                            </div>
                        </form>


                        <div class="card card-light shadow">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="card-title col"><i class="fas fa-list mr-2"></i>Daftar Pembelian</h3>
                                    <h3 class="card-title col text-right belisubtotal">Total : 0</h3>                                
                                </div>                           
                            </div>
                
                            <div class="card-body">          
                                <div class="form-group row">
                                    <div class="col-md-12" style="font-size: 0.8rem;">
                                        <style>
                                            #tablebelitmp > thead > tr > th {
                                                padding: 10px 18px;
                                                border-bottom: 1px solid #d2d2d2;
                                                background-color: #dadada;
                                            }

                                            #tablebelitmp  {
                                                border-bottom: 1px solid #e5e5e5;
                                            }
                                        </style>

                                        <div class="table-responsive" width=100%>
                                            <table class="table display cell-border" id="tablebelitmp" width=100%>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>                    
                            </div>

                        </div>                        
                    </div>


                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                        <div class="carabayar" id="carabayar">
                            
                        </div>
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
                    
                    @if (count($composer_usersoutlet) > 0 ) 
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

                        {{-- <div class="col text-right">
                            <button type="submit" class="btn btn-info btn-sm btn-finish" id="saveBtn" value="create">
                                <i class="fa fa-save" style="margin-right: 4px;"></i>
                                Save Changes
                            </button>     
                        </div>                     --}}
                    @endif
                </div>

            </div>   
        </div>
    </div>



@include('master.popmstsupcus')



<script>
    let _token   = $('meta[name="csrf-token"]').attr('content');

    function ajaxgettmp(useasync = true, showtotal = true){
        var pret = {  
                        url: '{{ route("trbeli.store") }}',
                        type:"POST",
                        data:{mode:'showtmpdb',
                                _token: _token},
                        async: useasync,
                        beforeSend: function(data) {
                            },
                        dataFilter: function(response){
                                if (showtotal){
                                    var json = jQuery.parseJSON( response );
                                    var jml = 0;
                                    $.each(json.data, function (i) {
                                        jml += Number(json.data[i].jumlah);
                                    });
                                    $('.belisubtotal').text('Total = ' + formatNumber(jml));   
                                }
                                return response;
                            },
                        error: function(err){
                                // console.log(err);
                            }

                    };
        return pret;
    }       

    function fill_detailtmp()
        {
            var numFormat = $.fn.dataTable.render.number('.',',',0,'');

            var Xcolumns=
                [
                    {title: 'Nama', data: 'nama', name: 'nama'},
                    {title: 'Qty', data: 'qty', name: 'qty', render: numFormat, className: 'text-right'},
                    {title: 'Harga', data: 'harga', name: 'harga', render: numFormat, className: 'text-right'},
                    {title: 'Disc(%)', data: 'disc', name: 'disc', render: numFormat, className: 'text-right'},
                    {title: 'Jumlah', data: 'jumlah', name: 'jumlah', render: numFormat, className: 'text-right'},
                    {title: 'Keterangan', data: 'info', name: 'info'},
                    {title: 'action', data: 'action', name: 'action', className: 'text-right'}
                ];

            var dataTablex = $('#tablebelitmp').DataTable({
                dom: 'rt',
                destroy: true,
                scrollCollapse: true,
                order: [],
                ordering: false,
                bSort: false,
                lengthMenu: [[-1], ['ALL']],
                processing: true,
                language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                serverSide: true,
                columns:Xcolumns,
                ajax:ajaxgettmp()
            });
            
        }

    $(document).on('click', '.btnedit', function(){
        console.log($(this).data('idbarang'));
    });

    $(document).on('click', '.btndelete', function(){
        // console.log($(this).data('idbarang'));
        var idbrg = $(this).data('idbarang');
        $.ajax({
            url: '{{ route("trbeli.store") }}',
                        type:"POST",
                        data:{mode:'deletetmpdb',
                                idbarang:idbrg,
                                _token: _token},
                        async: false,
                        dataFilter: function(response){
                                // console.log(response);
                                return response;
                            },
                        success: function(response){
                                // console.log(response);
                                $('#tablebelitmp').DataTable().ajax.reload();
                                return response;
                            },
                        error: function(err){
                                // console.log(err);
                            }
        });
    });


    $('#formtmpbeli').on('submit', function(event){
        event.preventDefault();
            loading(1, 'Menambah Data ...');
            RemoveAlert();

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);
            fd.append('mode', 'saveketempdb');
            fd.append('idoutlet', $('#idoutlet').val());
            fd.append('idsupcus', $('#idsupcus').val());
            fd.append('fakturreff', $('#fakturreff').val());

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
                        $('#formtmpbeli')[0].reset();
                        $('#tablebelitmp').DataTable().ajax.reload();
                        $('#brgnama').select();
                        // console.log(data.success);
                    }
                    loading(0);
                }
            })

    });


    function RemoveAlert(){
            $("input").removeClass("is-invalid");
            $("span").remove(".invalid-feedback");
        }


    function initEdit(actio = 'new', id = '1', mode = ''){
        $('#formtmpbeli')[0].reset();
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
            // cek dulu apakah ada data di temporary
            var re = $.ajax(ajaxgettmp(false, false));
            // console.log(re.responseJSON.data[0]['info']);
            // console.log(re.responseJSON.data[0]);
            // console.log(re.responseJSON.data.length);

            if(re.responseJSON.data.length > 0){
                var tanya = confirm('Masih ada transaksi yang belum selesai... \nBuka kembali transaksi tersebut?');
                if (tanya){
                    var dd = re.responseJSON.data[0];
                    $('#idoutlet').selectpicker('val', [dd['idoutlet']]);
                    $('#idsupcus').selectpicker('val', [dd['idsupcus']]);
                    $('#fakturreff').val(dd['fakturreff']);
                }
                else{
                    $.ajax({  
                        url: '{{ route("trbeli.store") }}',
                        type:"POST",
                        data:{mode:'deletealltmpdb',
                                _token: _token},
                        async: false,
                        dataFilter: function(response){
                                // console.log(response);
                                return response;
                            },
                        success: function(response){
                                // console.log(response);
                                return response;
                            },
                        error: function(err){
                                // console.log(err);
                            }

                    });
                }
            }


            $("#globrep").hide(200);
            $("#editview").show(200);
            loading(0);
        }
        
        fill_detailtmp();
    }


    // $('body').on('keypress', 'input, select, textarea, button, option, selectpicker', function(e) {
    //     if (e.which === 13) {
    //         var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
    //         focusable = form.find('input, select, textarea, button, option, selectpicker').filter(':visible');
    //         next = focusable.eq(focusable.index(this)+1);
    //         if (next.length) {
    //             next.focus();
    //         }
    //         return false;
    //     }
    // });


    $(document).ready(function() {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        var plistcarabayar ={!! json_encode($composer_mstcarabayar) !!};
        var sss = $(".carabayar").setcarabayar({token:_token, 
                                            listcarabayar:plistcarabayar, 
                                            urlajaxdatatable:'{{ route("trbeli.store") }}', 
                                            idoutlet:8,
                                            onaddremoveitem: function(data){
                                                console.log(data);
                                            }
                                        });

        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'dots', // theme for the wizard, related css need to include for other than default theme
            justified: true, // Nav menu justification. true/false
            darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
            autoAdjustHeight: false, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            enableURLhash: false, // Enable selection of the step based on url hash
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
                keyNavigation: false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
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

        // Initialize the showStep event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection) {
            if (stepDirection=='forward'){
                if (stepIndex==0){
                    $('#brgnama').select();
                }
            }
            else{
                if (stepIndex==2){
                    $('#brgnama').select();
                }
            }
        });


        $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
            switch(currentStepIndex){
                case 0:
                    RemoveAlert();
                    var adaerror = 0;
                    var fr = document.getElementById('formstep1');
                    var fd =  new FormData(fr);
                    fd.append('mode', 'cektab1');

                    $.ajax({
                        url:"{{ route('trbeli.store') }}",
                        method:"POST",
                        data: fd,
                        async: false,
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            if(data.errors)
                            {
                                adaerror = 1;
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
                        }
                    });
                    // console.log(adaerror);
                    if (adaerror == 1){
                        return false;
                    }
                    break;
            };

            if(anchorObject.prevObject.length - 1 == nextStepIndex){
                $('.btn-finish').show(); 
            }else{
                $('.btn-finish').hide();                
            }
        });

    
    
    });
</script>