
@extends('layouts.dashboard')


@section('content')
    <div class="container my-4">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($mstbarang as $d)
                    <tr>
                        <td><img src="data:image/png;base64, {{ base64_encode($d->img) }}"/></td>
                        <td>
                            <h5 class="m-0">{{ $d->nama }}</h5>
                            <div class="row">
                                <div class="col my-1">
                                    <p class="m-0 font-weight-bold"><small>Jenis</small></p>
                                    <p class="m-0">{{ $d->namajenis }}</p>
                                </div>
                                <div class="col my-1">
                                    <p class="m-0 font-weight-bold"><small>Merk</small></p>
                                    <p class="m-0">{{ $d->namamerk }}</p>
                                </div>
                                <div class="col my-1">
                                    <p class="m-0"><small>Saldo</small></p>
                                    <p class="m-0">{{ number_format($d->saldoglobal) }}</p>
                                </div>
                                <div class="col my-1">
                                    <p class="m-0"><small>Harga</small></p>
                                    <p class="m-0">{{ number_format($d->hargajual) }}</p>
                                </div>
                            </div>
                        
                        </td>
                        <td style="width: 130px"> 
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-danger btn-qty" type="button" data-type="min" data-kode="{{ $d->kode }}"><i class="fas fa-minus-circle"></i></button>
                                </div>
                                <input id="qty{{ $d->kode }}" name="{{ $d->kode }}" type="text" class="form-control text-center font-weight-bold input-number" value="0" min="0" max="10">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-qty" type="button" data-type="plus" data-kode="{{ $d->kode }}"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-outline-info"><i class="far fa-clipboard mr-1"></i>Note</button>
                            </div>
                        </td>
                    </tr>                        
                @endforeach
            </tbody>
          </table>

    </div>
@endsection


@section('scripts')

    <script>
        $('.btn-qty').click(function(e){
            e.preventDefault();
            
            kode = $(this).attr('data-kode');
            type = $(this).attr('data-type');
            var input = $("#qty" + kode);
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'min') {
                    
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-qty[data-type='min'][data-kode='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-qty[data-type='plus'][data-kode='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });

        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
@endsection