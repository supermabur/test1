
    
@extends('layouts.dashboard')



@section('content')   

    <form method="post" id="formx" class="form-vertical" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="row">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Company Setting</h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="name" class="col-sm-6 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name" value="" maxlength="32" required="" autofocus>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="aktif" class="col-sm-6 col-form-label">Aktif</label>
                            <div class="col-sm-6">
                                {{-- A checkbox input in not sent in the request when it's unchecked, in that case the hidden input will be sent with the value 0. When the Checkox is checked, it will overwrite the value to 1. --}}
                                <input type="hidden" name="active" value="0"/>
                                <input id="active" name="active" value="1" class="form-check" type="checkbox" value="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="text-align: left; padding-top:0px" for="image">Image</label>
                            <div class="col-sm-10">
                                <label for="image" class="btn btn-primary btn-sm" id="labelimage">Select Image</label>
                                <input type="file" class="form-control-file form-control-sm" id="image" name="image" accept="image/*" placeholder="Choose image" style="display: none;" >
            
                                <div style="padding-top:10px">    
                                    <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 150px;" 
                                        src="{{url('/images/noimage.png')}}" alt="preview image"/>
            
                                </div>
                            </div>
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
            <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">
                <i class="fa fa-save" style="margin-right: 4px;"></i>
                Save Changes
            </button>
        </div>


    </form>


    {{-- <div id="form" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label" style="text-align: left">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control textarea"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left">Warna Deskripsi</label>
            
                            <div class="col-sm-2 input-group my-colorpicker2" style="padding-left:15px;">
                                <div class="input-group-addon" id="colorx" name="colorx">
                                    <i></i>
                                </div>
                                <input id="detail_color" name="detail_color" type="text" class="form-control" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left">Urut</label>
                            <div class="col-sm-2">
                                <input id="urut" name="urut" class="form-control" type="number" value="0">
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left">Link</label>
                            <div class="col-sm-10">
                                <textarea id="link" name="link" required="" placeholder="Masukkan link" class="form-control"></textarea>
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left; padding-top:0px" for="aktif">Aktif</label>
                            <div class="col-sm-10">
                                <input id="aktif" name="aktif" class="form-check-input" type="checkbox" value="true">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align: left; padding-top:0px" for="image">Image</label>
                            <div class="col-sm-10">
                                <label for="image" class="btn btn-primary btn-sm" id="labelimage">Select Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" placeholder="Choose image" style="display: none;" >

                                <div style="padding-top:10px">    
                                    <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 150px;" 
                                        src="{{url('/images/noimage.png')}}" alt="preview image"/>

                                </div>
                            </div>
                        </div>


                        <div class="modal-footer" style="background: linear-gradient(to right, rgb(0, 121, 145), rgb(120, 255, 214));">
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="hidden" name="actionx" id="actionx" />
                            <input type="hidden" name="imageold" id="imageold" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                        <span id="form_result"></span>

                    </form>
                </div>
            </div>
        </div>
    </div> --}}


@endsection