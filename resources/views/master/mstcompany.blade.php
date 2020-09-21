
    
@extends('layouts.dashboard')



@section('content')   

    <form method="post" id="formx" class="form-vertical" enctype="multipart/form-data" novalidate>
        @csrf
        <br>
        <div class="row justify-content-md-center">
            <div class="col-sm-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Company Setting</h3>
                    </div>

                    <div class="card-body">
{{-- {{ $data }} asd  --}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Masukkan nama" maxlength="32" required="" autofocus
                                        value="{{  !empty($data->name) ? $data->name : '' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label col-form-label-sm">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Masukkan alamat"
                                        value="{{  !empty($data->alamat) ? $data->alamat : '' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idkota" class="col-sm-3 col-form-label col-form-label-sm">Kota</label>
                            <div class="col-sm-9">
                                <select class="role form-control form-control-sm" id="idkota" name="idkota" required>
                                    @foreach ($kota as $cp)
                                        <option value="{{ $cp->id }}" @if($cp->id == $data->idkota) selected="selected" @endif>{{ $cp->name2 }}</option>                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="notelp" class="col-sm-3 col-form-label col-form-label-sm">No Telp</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control form-control-sm" id="notelp" placeholder="Masukkan nomer telpon" name="notelp" required
                                        value="{{  !empty($data->notelp) ? $data->notelp : '' }}">
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-sm" id="email" placeholder="Masukkan email" name="email" required 
                                        value="{{  !empty($data->email) ? $data->email : '' }}">
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-3 col-form-label col-form-label-sm">Deskripsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="deskripsi" placeholder="Masukkan Deskripsi" name="deskripsi" required 
                                    value="{{ !empty($data->deskripsi) ? $data->deskripsi : '' }}">
                            </div>
                        </div>
                        
                        {{-- <div class="form-group row">
                            <label for="active" class="col-sm-3 col-form-label col-form-label-sm">Aktif</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="active" value="0"/>
                                <input type="checkbox" class="form-check-input" id="active" name="active" value="1" style="margin-left: 0;"
                                    @if($data->active==1) CHECKED @endif>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>      
            

            <div class="col-sm-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Logo</h3>
                    </div>

                    <div class="card-body">

                        {{-- <div class="row"> --}}
                            {{-- <label class="col-sm-3 control-label" style="text-align: left; padding-top:0px" for="image">Image</label> --}}
                            {{-- <label for="logo" class="col-sm-3 col-form-label col-form-label-sm">Logo</label>
                            <div class="col-sm-9"> --}}
                                <label for="pathlogo" class="btn btn-primary btn-sm" id="labelimage">Select Image</label>
                                <input type="file" class="form-control-file form-control-sm" id="pathlogo" name="pathlogo" accept="image/*" placeholder="Choose image" style="display: none;" >
            
                                <div style="padding-top:10px">    
                                    <img id="image_preview_container" class="img-fluid img-thumbnail" alt="Responsive image" style="max-height: 150px;" 
                                        src="{{ !empty($data->pathlogo) ? url('/images/company/'.$data->pathlogo) : url('/images/company/noimage.png') }}"  alt="preview image"/>
            
                                </div>
                            {{-- </div> --}}
                        {{-- </div>   --}}

                    </div>
                </div>
            </div>  

        </div>

        <span id="form_result"></span>

        <div class="card-footer">
            <input type="hidden" name="hidden_id" id="hidden_id"/>
            <input type="hidden" name="actionx" id="actionx" />
            <input type="hidden" name="imageold" id="imageold" value="{{  !empty($data->pathlogo) ? $data->pathlogo : 'noimage.png' }}"/>
            <button type="submit" class="btn btn-info  btn-sm" id="saveBtn" value="create">
                <i class="fa fa-save" style="margin-right: 4px;"></i>
                Save Changes
            </button>
        </div>


    </form>


@endsection



@section('scripts')


<script>

    $(document).ready(function() {
        $('#pathlogo').change(function(){
            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        
        });
        
        $('.role').select2();

        $('#formx').on('submit', function(event){
            event.preventDefault();
            // loading(1, 'Saving Data ...');

            $('#saveBtn').html('Saving...');
            $('#form_result').html('');

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);

            $.ajax({
                url:"{{ route('mstcompany.store') }}",
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
                    // loading(0);
                }
            })
        });


    });
</script>

@endsection