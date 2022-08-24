
@extends('layouts.bs5')


@section('content')



    <div class="container my-4">
        <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light border">
            <div class="container">


                <div class="d-flex my-1">
                    <img src="{{ url('images/logokecil.png') }}" style="max-width: 40px; max-height: 40px;" class="me-2"/>
                    <h4 class="align-self-center">SURAT PESAN</h4>
                </div>

                <form class="d-flex my-1">
                    <div class="input-group me-2">
                        <span class="input-group-text" id="basic-addon1" style="width: auto"><i class="fas fa-search"></i></span>
                        <input id="data-filter" type="text" class="form-control form-control-sm" placeholder="Pencarian">
                    </div>
                    <div style="position: relative">
                        <a class="btn btn-outline-secondary mx-2" href="{{ url('cartsp') }}"><i class="fas fa-shopping-cart"></i></a>
                        <span id="cartcount" class="badge bg-warning text-dark" style="position: absolute; right: 4px; top: -10px; border-radius: 10px; {{ $cartcount == 0 ? 'display:none;' : '' }}">
                            {{ $cartcount }}
                        </span>
                    </div>
                    <a class="btn btn-outline-secondary" href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                </form>
            </div>
        </nav>


        {{-- <nav class="navbar fixed-top navbar-light bg-secondary">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="width: auto"><i class="fas fa-search"></i></span>
                    <input id="data-filter" type="text" class="form-control" placeholder="Pencarian">
                </div>
            </div>
        </nav> --}}

        <div >
            <div class="row">
                <div class="col-sm-6 my-3 text-white">
                    <h4>alskdjalskdjaslkdjal</h4>
                </div>
                <div class="col-sm-6 my-2 text-white">
                    <h4>alskdjalskdjaslkdjal</h4>
                </div>
            </div>
        </div>

        <table id="data-table" class="table">
            {{-- <thead>
              <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead> --}}
            <tbody>
                @foreach ($mstbarang as $d)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-2 col-lg-1">
                                    @if ($d->img)
                                        <img src="data:image/png;base64, {{ base64_encode($d->img) }}" class="border rounded" style="max-width: 70px; max-height: 60px;"/>
                                    @else
                                        <div class="border rounded" style="width: 70px; height: 60px; background-image: url('{{ url('images/noimage2.webp') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                                        </div>
                                        {{-- <img src="{{ url('images/noimage2.webp') }}" style="max-width: 105px; max-height: 75px;"/> --}}
                                    @endif
                                </div>

                                <div class="col-sm-10 col-lg-11">
                                    <h5 class="m-0">{{ $d->nama }}</h5>
                                
                                    <div class="text-right">
                                        <button id="btn-cart{{ $d->kodex }}" type="button" data-kode="{{ $d->kode }}" data-nama="{{ $d->nama }}" data-qty="{{ round($d->qty) }}" data-harga="{{ round($d->harga) }}" data-keterangan="{{ $d->keterangan }}" class="btn btn-sm btn-outline-primary btn-cart"><i class="fas fa-cart-plus me-1"></i>Keranjang</button>
                                        <span class="text-nowrap">
                                            <span id="qty{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Qty : ' . number_format($d->qty) }}</span>
                                            <span id="jumlah{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Jml : ' . number_format($d->jumlah) }}</span>    
                                        </span>
                                        <span id="keterangan{{ $d->kodex }}" class="text-primary m-0 small">{{ $d->keterangan != '' ? 'Ket : ' . $d->keterangan : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <h5 class="m-0">{{ $d->nama }}</h5> --}}
                            {{-- <div class="row">
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
                            </div> --}}
                            {{-- <div class="text-right">
                                <button id="btn-cart{{ $d->kodex }}" type="button" data-kode="{{ $d->kode }}" data-nama="{{ $d->nama }}" data-qty="{{ round($d->qty) }}" data-harga="{{ round($d->harga) }}" data-keterangan="{{ $d->keterangan }}" class="btn btn-sm btn-outline-primary btn-cart"><i class="fas fa-cart-plus me-1"></i>Keranjang</button>
                                <span class="text-nowrap">
                                    <span id="qty{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Qty : ' . number_format($d->qty) }}</span>
                                    <span id="jumlah{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Jml : ' . number_format($d->jumlah) }}</span>    
                                </span>
                                <span id="keterangan{{ $d->kodex }}" class="text-primary m-0 small text-nowrap">{{ $d->keterangan != '' ? 'Ket : ' . $d->keterangan : '' }}</span>
                            </div> --}}

                            {{-- <div class="my-1">
                                <p id="keterangan{{ $d->kodex }}" class="text-primary m-0 small">{{ $d->keterangan != '' ? 'Ket : ' . $d->keterangan : '' }}</p>
                            </div> --}}
                        {{-- </td> --}}

                        {{-- <td id="col{{ $d->kodex }}" style="width: 130px" class="text-end">  --}}
                            {{-- <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-danger btn-qty" type="button" data-type="min" data-kode="{{ $d->kode }}" {{ $d->qty >0 ? '' : 'disabled' }}><i class="fas fa-minus-circle"></i></button>
                                </div>
                                <input id="qty{{ $d->kode }}" name="{{ $d->kode }}" type="text" class="form-control text-center font-weight-bold input-number" value="{{ $d->qty }}" min="0" max="999">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-qty" type="button" data-type="plus" data-kode="{{ $d->kode }}"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                            <div class="text-right">
                                <button id="note{{ $d->kode }}" type="button" class="btn btn-sm btn-outline-info" disabled><i class="far fa-clipboard mr-1"></i>Note</button>
                            </div> --}}
                            {{-- <div class="text-center">
                                <p id="qty{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Qty : ' . number_format($d->qty) }}</p>
                                <br>
                                <p id="jumlah{{ $d->kodex }}" class="badge bg-success text-white mb-1">{{ $d->qty == 0 ? '' : 'Jml : ' . number_format($d->jumlah) }}</p>
                                <br>    
                            </div> --}}

                            {{-- <div class="text-right">
                                <button id="btn-cart{{ $d->kodex }}" type="button" data-kode="{{ $d->kode }}" data-nama="{{ $d->nama }}" data-qty="{{ round($d->qty) }}" data-harga="{{ round($d->harga) }}" data-keterangan="{{ $d->keterangan }}" class="btn btn-sm btn-outline-primary btn-cart w-100"><i class="fas fa-cart-plus me-1"></i>Keranjang</button>
                            </div> --}}
                        {{-- </td> --}}
                    </tr>                        
                @endforeach
            </tbody>
          </table>
    </div>


    <div class="modal fade small" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog small h-auto" style="max-width: 500px !important">
            <div class="modal-content">
                <div class="modal-header bg-light py-1">
                    <h5 class="modal-title" id="modaltitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-modal" action="" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-body py-2">
                        <div class="container">

                            <div class="mb-1 row">
                                <label class="col-4 col-form-label">Qty</label>
                                <div class="col-5">
                                    <input id="qqty" type="number" class="form-control form-control-sm" name="qty" min="0" required>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-4 col-form-label">Harga</label>
                                <div class="col-5">
                                    <input id="qharga" type="number" class="form-control form-control-sm" name="harga" min="0" required>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label class="col-4 col-form-label">Keterangan</label>
                                <div class="col-8">
                                    <textarea id="qketerangan" name="keterangan" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between py-1">
                        <input id="modalkode" name="kode" type="hidden">
                        <button id="btn-hapus" type="submit" form="form-modal" class="btn btn-sm btn-danger" value="hapusitem"><i class="fas fa-trash-alt me-2"></i>Hapus</button>
                        <button id="btn-simpan" type="submit" form="form-modal" class="btn btn-sm btn-primary" value="saveqty"><i class="far fa-save me-2"></i>Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ url('js/filter-table.min.js') }}"></script>

    <script>
        $(function(){
            $('#data-table').filterTable('#data-filter');
        });



        $('.btn-cart').click(function(e){
            e.preventDefault();
            $('#form-modal')[0].reset();

            var kode = $(this).attr('data-kode');
            var nama = $(this).attr('data-nama');
            var qty = $(this).attr('data-qty');
            var harga = $(this).attr('data-harga');
            var keterangan = $(this).attr('data-keterangan');

            if (qty == 0) {qty = '';}
            if (harga == 0) {harga = '';}

            $('#modaltitle').text(nama);
            $('#modalkode').val(kode);
            $('#qqty').val(qty);
            $('#qharga').val(harga);
            $('#qketerangan').val(keterangan);
            $('#exampleModalCenter').modal('show');
        });


        function saveqty(kode){
            loading2(1, '#col' + kode, 'Saving ...');
            var note = $('#pnote' + kode).text();
            var qty = $('#qty' + kode).val();
            var harga = 1000;
            var pdata = {mode:'saveqty', 
                        kode: kode,
                        note: note,
                        qty: qty,
                        harga: harga,
                        _token: _token};
            $.ajax({
                    url: '{{ route("newsp.store") }}',
                    type:"POST",
                    data:pdata,
                    async: true,
                    dataFilter: function(response){
                            return response;
                        },
                    success:function(data){
                        console.log(data);
                        if(data.error){
                            alert('ERROR!!!  ' + data.error);
                        }
                        else{
                            // console.log(data);
                        }
                        loading2(0, '#col' + kode);
                    }
            });  
        };


        $('#form-modal').on('submit', function(event){
            event.preventDefault();

            var mod = $(document.activeElement).val();

            if (mod != 'saveqty') {
                if (confirm('Yakin akan menghapus item ini ? ') != true) {
                    return;
                }
            }

            var q = $('#qqty').val();
            if (q < 1) {
                alert('Qty tidak boleh kurang atau sama dengan 0');
                return;
            }

            var fd =  new FormData(this);
            fd.append("mode", mod);

            var prosmsg = 'Menyimpan';
            if (mod != 'saveqty') {
                prosmsg = 'Menghapus'
            }
            loading2(1, '.modal-content', prosmsg + ' data ...');

            $.ajax({
                url:"{{ route('newsp.store') }}",
                method:"POST",
                data: fd,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    console.log(data);
                    if(data.error){
                        alert('ERROR!!!  ' + data.error);
                    }
                    else{
                        if (mod == 'saveqty') {
                            $q = parseFloat(data.qty).toLocaleString(window.document.documentElement.lang);
                            $j = parseFloat(data.jumlah).toLocaleString(window.document.documentElement.lang);
                            $('#qty' + data.kodex).text('Qty : ' + $q);
                            $('#jumlah' + data.kodex).text('Jml : ' + $j);
                            if (data.keterangan) {$('#keterangan' + data.kodex).text('Ket : ' + data.keterangan);}else{$('#keterangan' + data.kodex).text('');}

                            $('#btn-cart' + data.kodex).attr('data-qty', data.qty); 
                            $('#btn-cart' + data.kodex).attr('data-harga', data.harga); 
                            $('#btn-cart' + data.kodex).attr('data-keterangan', data.keterangan);                             
                        }
                        else{
                            $('#qty' + data.kodex).text('');
                            $('#jumlah' + data.kodex).text('');
                            $('#keterangan' + data.kodex).text('');                            

                            $('#btn-cart' + data.kodex).attr('data-qty', 0); 
                            $('#btn-cart' + data.kodex).attr('data-harga', 0); 
                            $('#btn-cart' + data.kodex).attr('data-keterangan', ''); 
                        }

                        showcartcount(data.cartcount);
                        $('#exampleModalCenter').modal('hide');
                    }
                    loading2(0, '.modal-content');
                }
            })
        });
        

        function showcartcount(qty){
            $('#cartcount').text(qty);
            if (qty == 0) {
                $('#cartcount').hide();
            } else {
                $('#cartcount').show();
            } 
        }


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
                        $('#note' + kode).attr('disabled', true);
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
                $(".btn-qty[data-type='min'][data-kode='"+name+"']").removeAttr('disabled');
                $('#note' + name).removeAttr('disabled');
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-qty[data-type='plus'][data-kode='"+name+"']").removeAttr('disabled');
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue && valueCurrent >= minValue) {
                console.log('bbb');
                saveqty(name);
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