{{-- @extends('layouts.app') --}}
@extends('layouts.dashboard')

@section('content')
    <form role="form">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Text</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat btnui">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "mstbrg">
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){

            $('.btnui').changeBg({background: 'yellow'});
            $('.mstbrg').mstbarang({
                urlx:"{{ route('databrowser.store') }}",
                tokenx:"{{ csrf_token() }}"
            });
        });
    </script>
@endsection