

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title ?? '' ?? ''}}</title>
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href= "{{ url('adminlte3/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font: Source Sans Pro -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <!-- eki -->
    {{-- <link rel="stylesheet" href="{{ url('css/eki.css') }}"> --}}

    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');

        @font-face {
            font-family: 'roboto_condensedregular';
            src: url('robotocondensed-regular-webfont.woff2') format('woff2'),
                url('robotocondensed-regular-webfont.woff') format('woff'),
                url('RobotoCondensed-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
        font-family: "Roboto Condensed", sans-serif;
        [ ... ]
        }
        h6 {
        font-family:'Signika', Arial, Helvetica, sans-serif;
        [ ... ]
        }

    </style>

  </head>
  <body>
    


    <div class="">

        
        <div class="card my-1 small">
            <div class="card-body small py-1">
                <table id="data-table" class="table">
                    <tbody>
                        <tr>
                            <td class="py-0">
                                <table id="data-table" class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-0" style="width: 200px">
                                                <img src="https://www.giripalma.com/ecom/img/logo.webp" style="max-width: 50px; max-height: 50px;" class="me-2"/>
                                            </td>
                                            <td class="py-0 text-end">
                                                GIRPALMA
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </td>
                            <td class="py-0 text-end">
                                <table id="data-table" class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-0">
                                                FAKTUR
                                            </td>
                                            <td class="py-0">
                                                : GIRPALMA
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </td>
                        </tr>  
                    </tbody>
                </table>
            </div>
        </div>
        
            
        <div class="card my-1 small">
            <h6 class="card-header bg-secondary text-white small"><i class="far fa-user me-2"></i>DATA CUSTOMER</h6>
            <div class="card-body small py-1">
                <table id="data-table" class="table">
                    <tbody>
                        <tr>
                            <td class="py-0" style="width: 200px">Nama</td>
                            <td class="py-0">{{ $pesanhead->csnama ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="py-0">Alamat</td>
                            <td class="py-0">{{ $pesanhead->csalamat ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="py-0">Kota</td>
                            <td class="py-0">
                                @foreach ($mstongkir as $d)
                                    @if (($pesanhead->cskota ?? '') == $d->id)
                                        {{ $d->kota }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="py-0">No HP</td>
                            <td class="py-0">{{ $pesanhead->csnohp ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="py-0">Outlet</td>
                            <td class="py-0">
                                @foreach ($mstgudang as $d)
                                    @if (($pesanhead->kdgudang ?? '') == $d->kode)
                                        {{$d->nama}}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="py-0">Leasing</td>
                            <td class="py-0">
                                @foreach ($mstleasing as $d)
                                    @if (($pesanhead->kdleasing ?? '') == $d->kode)
                                        {{ $d->nama }}
                                    @endif                               
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-0 py-0">Keterangan</td>
                            <td class="border-bottom-0 py-0">{{ $pesanhead->keterangan ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card my-1 small">
            <h6 class="card-header bg-secondary text-white small"><i class="far fa-list-alt me-2"></i>DAFTAR BARANG</h6>
            <div class="card-body small py-1">
                <table id="data-table" class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="text-start" style="border-bottom-color: #dee2e6;">Nama</th>
                        <th scope="col" class="text-start" style="border-bottom-color: #dee2e6;">Keterangan</th>
                        <th scope="col" class="text-end" style="border-bottom-color: #dee2e6;">Qty</th>
                        <th scope="col" class="text-end" style="border-bottom-color: #dee2e6;">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($mstbarang as $d)
                            <tr>
                                <td class="@if ($loop->last) border-bottom-0 @endif">{{ $d->nama }}</td>
                                <td class="@if ($loop->last) border-bottom-0 @endif">{{ $d->keterangan }}</td>
                                <td class="text-end @if ($loop->last) border-bottom-0 @endif">{{ number_format($d->qty) }}</td>
                                <td class="text-end @if ($loop->last) border-bottom-0 @endif">{{ number_format($d->jumlah) }}</td>
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

        <div id="cardbayar" class="card my-1 small">
            <h6 class="card-header bg-secondary text-white small"><i class="fas fa-cash-register me-2"></i>DETAIL DP</h6>
            <div class="card-body small py-1">
                <table class="table table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-start">Jenis</th>
                            <th scope="col" class="text-start">NoBukti</th>
                            <th scope="col" class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="bodybayar">
                        {!! $pesanbayar !!}
                    </tbody>
                </table>
            </div>
        </div>
        

        <div class="card my-1 small">
            <h6 class="card-header bg-secondary text-white small"><i class="fas fa-receipt me-2"></i>REKAP TRANSAKSI</h6>
            <div class="card-body small py-1">
                <table id="data-table" class="table">
                    <tbody>
                        <tr>
                            <td class="py-0" style="width: 200px">Total Barang</td>
                            <td class="py-0 text-end">{{ $total["totalbarang"] }}</td>
                        </tr>  
                        <tr>
                            <td class="py-0">Ongkir</td>
                            <td class="py-0 text-end">{{ $total["ongkir"] }}</td>
                        </tr>  
                        <tr>
                            <td class="py-0">Total</td>
                            <td class="py-0 text-end"><h6 class="fw-bold">{{ $total["total"] }}</h6></td>
                        </tr>  
                        <tr>
                            <td class="py-0">DP</td>
                            <td class="py-0 text-end">{{ $total["totaldp"] }}</td>
                        </tr>  
                        <tr>
                            <td class="py-0 border-bottom-0">Kurang Bayar</td>
                            <td class="py-0 border-bottom-0 text-end fw-bold">{{ $total["kurangbayar"] }}</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>


    </div>


  </body>
</html>


{{-- @section('content')






@endsection


@section('scripts')

    <script>

    </script>
@endsection --}}