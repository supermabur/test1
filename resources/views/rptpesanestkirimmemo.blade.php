<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <title>Surat Pesan Estimasi Kirim dan Status Memo</title>
    </head>
    <body>
        <div class="bg-dark">
            <div class="container py-2 text-white">
                <p class="m-0 small">Data di update setiap 30 menit sekali</p>
                <p class="m-0 small">Terakhir update pada {{ $lastupdate[0]->lastupdate }}</p>        
            </div>
        </div>


        <div class="container">
            <h5 class="m-0 mt-5 p-2 bg-primary text-white">Surat pesan 3 Hari sebelum estimasi kirim</h5>
            <div class="row mx-0" style="background-color: #007bff03;">
                <table class="table table-sm mx-2">
                    {{-- <thead class="">
                        <tr>
                            <th scope="col" class="text-white"></th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($mendekatiestkirim as $i)
                            @if ($i->kirimjatuhtempo >= 0)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="m-0">{{ $i->faktur }}</h6>
                                                <p class="small m-0">Tanggal Pesan {{ $i->tanggal }}</p>
                                                <p class="small m-0">
                                                    Estimasi Kirim 
                                                    <span class="badge badge-{{ $i->kirimjatuhtempo == 0 ? 'danger' : 'warning' }}" style="white-space: normal!important;">{{ $i->kirimjatuhtempo == 0 ? 'Harusnya kirim hari ini' : $i->kirimjatuhtempo . ' hari lagi' }}</span> 
                                                </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <h6 class="m-0 mt-1 font-weight-bold"><small>{{ $i->namacustomer . ' (' . $i->nohpcustomer . ')' }}</small></h6>
                                                <h6 class="m-0"><small style="font-size: 67%">{{ $i->alamatcustomer }}</small></h6>
                                                <h6 class="m-0 mt-1" ><small class="font-weight-bold">Memo </small> <small class="text-primary" style="font-size: 67%">{{ $i->memo }}</small></h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>                                
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>




            <h5 class="m-0 mt-5 p-2 bg-danger text-white">Surat pesan 2021 yang sudah melewati estimasi kirim</h5>
            <div class="row mx-0" style="background-color: #ff000003;">
                <table class="table table-sm mx-2">
                    {{-- <thead class="">
                        <tr>
                            <th scope="col" class="text-white"></th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($mendekatiestkirim as $i)
                            @if ($i->kirimjatuhtempo < 0)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="m-0">{{ $i->faktur }}</h6>
                                                <p class="small m-0">Tanggal Pesan {{ $i->tanggal }}</p>
                                                <p class="small m-0">
                                                    Estimasi Kirim 
                                                    <span class="badge badge-danger" style="white-space: normal!important;">Harusnya dikirim {{ abs($i->kirimjatuhtempo) }} hari yg lalu</span> 
                                                </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <h6 class="m-0 mt-1"><small>{{ $i->namacustomer . ' (' . $i->nohpcustomer . ')' }}</small></h6>
                                                <h6 class="m-0"><small class="small" style="font-size: 67%">{{ $i->alamatcustomer }}</small></h6>
                                                <h6 class="m-0 mt-1"><small class="font-weight-bold">Memo </small> <small class="text-primary" style="font-size: 67%">{{ $i->memo }}</small></h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>                                
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>




            <h5 class="m-0 mt-5 p-2 bg-warning">Surat pesan 2021 yang belum ada MEMO (Non Leasing)</h5>
            <div class="row mx-0" style="background-color: #ffae0003;">
                <table class="table table-sm mx-2">
                    {{-- <thead class="">
                        <tr>
                            <th scope="col" class="text-white"></th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($gaadamemo as $i)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6 class="m-0">{{ $i->faktur }}</h6>
                                            <p class="small m-0">Tanggal Pesan {{ $i->tanggal }}</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="m-0 mt-1"><small>{{ $i->namacustomer . ' (' . $i->nohpcustomer . ')' }}</small></h6>
                                            <h6 class="m-0"><small class="small" style="font-size: 67%">{{ $i->alamatcustomer }}</small></h6>
                                            <h6 class="m-0 mt-1"><small class="font-weight-bold"> {{ !empty($i->keterangan) ? "Keterangan" : "" }} </small> <small class="text-primary" style="font-size: 67%">{{ $i->keterangan }}</small></h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>     
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>