
    
@extends('layouts.dashboard')

@section('content')

    <div class="container my-4">
        <p class="mb-5 px-0">* Data ini di update setiap 30 menit sekali. Terakhir update data pada <span class="font-weight-bold" id="lastupdate">xxx</span></p>

        {{-- SURAT PESAN BULAN INI --}}
        <div>
            <div class="row mt-4 px-0">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100 d-inline-flex">
                                <span style="align-self: center;" class="mr-3">SURAT PESAN BULAN INI</span> 
                            </div>
                        </div>
                        <div class="card-body py-1">
                            <div class="row" id="sp_bulanini">
                                <div class="col col-sm-4" id="tablebulanini">

                                </div>
                                <div class="col col-sm-8" id="graphpesanbulaninidasar">
                                    <canvas id="graphpesanbulanini"></canvas>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="cbspbulanlalu">
                                <label class="form-check-label" for="cbspbulanlalu">Tampilkan bulan lalu</label>
                            </div>

                            <div class="row" id="sp_bulanlalu" style="display: none">
                                <hr class="w-100">
                                <h6 class="w-100 font-weight-bold">SURAT PESAN BULAN LALU</h6>
                                <div class="col col-sm-4" id="tablebulanlalu">

                                </div>
                                <div class="col col-sm-8" id="graphpesanbulanlaludasar">
                                    <canvas id="graphpesanbulanlalu"></canvas>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        {{-- SURAT PESAN BULAN INI PERGUDANG --}}
        <div>
            <div class="row mt-4 px-0">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100 d-inline-flex">
                                <span style="align-self: center;" class="mr-3">SURAT PESAN BULAN INI PER GUDANG</span> 
                            </div>
                        </div>
                        <div id="divbulaninigudang" class="card-body py-1">
                            <div>
                                <ul class="nav nav-pills">
                                    @foreach ($bulaninigudang as $d)
                                        <li class="nav-item">
                                            <button class="nav-link btn btn-sm btn-light p-0 px-1 m-1 bulaninigudangtombol" id="bulanini{{ $loop->iteration }}" href="#" onclick="showbulaninigudang('{{ $loop->iteration }}')">
                                                <p class="m-0 font-weight-bold">{{ $d->kdgudang }}</p> 
                                                <small class="">{{ number_format($d->jumlah) }}</small>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                <hr class="mt-1">
                                <span id="bulanininamagudang" class="font-weight-bold">SEMUA GUDANG</span>
                                <div class="row">
                                    <div class="col col-sm-4" id="tablebulaninigudang">
    
                                    </div>
                                    <div class="col col-sm-8" id="graphpesanbulaninigudangdasar">
                                        <canvas id="graphpesanbulaninigudang"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="cbspgudangbulanlalu">
                                <label class="form-check-label" for="cbspgudangbulanlalu">Tampilkan bulan lalu</label>
                            </div>

                            <div class="row" id="spgudang_bulanlalu" style="display: none">
                                <hr class="w-100">
                                <h6 class="w-100 font-weight-bold">SURAT PESAN BULAN LALU</h6>
                                <div class="col col-sm-4" id="tablegudangbulanlalu">

                                </div>
                                <div class="col col-sm-8" id="graphpesangudangbulanlaludasar">
                                    <canvas id="graphpesangudangbulanlalu"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SURAT PESAN BULAN INI PERSALESMAN --}}
        <div>
            <div class="row mt-4 px-0">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100 d-inline-flex">
                                <span style="align-self: center;" class="mr-3">SURAT PESAN BULAN INI PER SALESMAN</span> 
                            </div>
                        </div>
                        <div class="card-body py-1" id="divbulaninisalesman">
                            <div >
                                <ul class="nav nav-pills">
                                    @foreach ($bulaninisalesman as $d)
                                        <li class="nav-item">
                                            <button class="nav-link btn btn-sm btn-light p-0 px-1 m-1 bulaninisalesmantombol" id="bulaninisalesman{{ $loop->iteration }}" href="#" onclick="showbulaninisalesman('{{ $loop->iteration }}')">
                                                <p class="m-0 font-weight-bold">{{ $d->namasalesman }}</p> 
                                                <p class="m-0 d-none kdsalesman">{{ $d->kdsalesman }}</p> 
                                                <small class="">{{ number_format($d->jumlah) }}</small>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                                <hr class="mt-1">
                                <span id="bulanininamasalesman" class="font-weight-bold">SEMUA SALESMAN</span>
                                <div class="row">
                                    <div class="col col-sm-4" id="tablebulaninisalesman">
    
                                    </div>
                                    <div class="col col-sm-8" id="graphpesanbulaninisalesmandasar">
                                        <canvas id="graphpesanbulaninisalesman"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="cbspsalesmanbulanlalu">
                                <label class="form-check-label" for="cbspsalesmanbulanlalu">Tampilkan bulan lalu</label>
                            </div>

                            <div class="row" id="spsalesman_bulanlalu" style="display: none">
                                <hr class="w-100">
                                <h6 class="w-100 font-weight-bold">SURAT PESAN BULAN LALU</h6>
                                <div class="col col-sm-4" id="tablesalesmanbulanlalu">

                                </div>
                                <div class="col col-sm-8" id="graphpesansalesmanbulanlaludasar">
                                    <canvas id="graphpesansalesmanbulanlalu"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SURAT PESAN SETAHUN KEBELAKANG --}}
        <div>
            <div class="row mt-4 px-0">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100"><h6>SURAT PESAN SATU TAHUN KEBELAKANG</h6></div>
                        </div>
                        <div class="card-body py-1">
                            <div class="row">
                                <div class="col col-sm-4" id="tablesetahun">

                                </div>
                                <div class="col col-sm-8" id="graphpesansetahundasar">
                                    <canvas id="graphpesansetahun"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

        {{-- OVERDUE --}}
        <div class="mt-5">
            {{-- <h4 class="m-2">
                <i class="far fa-dot-circle mr-2"></i>Pesanan yang sudah melewati batas estimasi kirim
            </h4> --}}

            {{-- <div class="row mt-4 px-4">
                <div class="col-sm-6">
                    <div class="card card-warning">
                        <div class="card-header text-white d-flex justify-content-between">
                            <div class="w-100"><h6>PENDING</h6></div>
                            <div class="w-100 text-right"><h6>Total : {{ $data_totoverdue->totpending }}</h6></div>
                        </div>
                        <div class="card-body py-1">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Estimasi kirim</th>
                                    <th scope="col" class="text-right">Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pendingoverdue as $d)
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showdetail('{{ $d->statuskirim }}', '-{{ $d->selisihestkirim }}', '{{ $d->status }}')" class="text-dark">
                                                    @if ($d->selisihestkirim == 0)
                                                        Hari ini                                                                                        
                                                    @else
                                                        {{ $d->selisihestkirim }} Hari yang lalu
                                                    @endif    
                                                </a>
                                            </td>
                                            <td class="text-right">{{ $d->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>     
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">                
                    <div class="card card-warning">
                        <div class="card-header text-white d-flex justify-content-between">
                            <div class="w-100"><h6>PENDING PROSES</h6></div>
                            <div class="w-100 text-right"><h6>Total : {{ $data_totoverdue->totpendingproses }}</h6></div>
                        </div>
                        <div class="card-body py-1">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Estimasi kirim</th>
                                    <th scope="col" class="text-right">Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pendingprosesoverdue as $d)
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showdetail('{{ $d->statuskirim }}', '-{{ $d->selisihestkirim }}', '{{ $d->status }}')" class="text-dark">
                                                    @if ($d->selisihestkirim == 0)
                                                        Hari ini                                                                                        
                                                    @else
                                                        {{ $d->selisihestkirim }} Hari yg lalu
                                                    @endif    
                                                </a>
                                            </td>
                                            <td class="text-right">{{ $d->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>     
                        </div>
                    </div>
                </div>


            </div> --}}
        </div>
    </div>


    <!-- Modal -->
    <div id="modaldetail" class="modaldetail modal fade" role="dialog" >
        <div class="modal-dialog  modal-lg">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2c506e;">
                    <h5 class="card-title judulbiru" id="juduldetail">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body" style="padding: 0rem;">
                    <div class="card-body" id="bodydetail">
                        <div id="divcont" class="small table-responsive">

                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<script>

    $(document).ready(function(){
        getbulanini();
    });


    $('#cbspbulanlalu').on('change', function() { 
        // From the other examples
        if (this.checked) {
            $("#sp_bulanlalu").show(300);
        }
        else{
            $("#sp_bulanlalu").hide(300);
        }
    });


    $('#cbspgudangbulanlalu').on('change', function() { 
        // From the other examples
        if (this.checked) {
            $("#spgudang_bulanlalu").show(300);
        }
        else{
            $("#spgudang_bulanlalu").hide(300);
        }
    });


    $('#cbspsalesmanbulanlalu').on('change', function() { 
        // From the other examples
        if (this.checked) {
            $("#spsalesman_bulanlalu").show(300);
        }
        else{
            $("#spsalesman_bulanlalu").hide(300);
        }
    });


    function showbulaninigudang(elem){
        loading2(1, '#divbulaninigudang', 'Opening ...');

        var pkdgudang = $('#bulanini' + elem).find('p').text();
        var pdata = {mode:'showbulaninigudang', 
                    kdgudang: pkdgudang,
                    _token: _token};

        $.ajax({
                url: '{{ route("dashb.store") }}',
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
                        $('.bulaninigudangtombol').removeClass('active');
                        
                        creategraph('graphpesanbulaninigudang', data.x, data.y);
                        $('#tablebulaninigudang').html(data.data);

                        creategraph('graphpesangudangbulanlalu', data.lalux, data.laluy);
                        $('#tablegudangbulanlalu').html(data.datalalu);

                        $('#bulanini' + elem).addClass('active');
                        $('#bulanininamagudang').text(data.namagudang);
                    }
                    loading2(0, '#divbulaninigudang');
                }

        });           
    }


    function showbulaninisalesman(elem){
        loading2(1, '#divbulaninisalesman', 'Opening ...');

        var pkdsalesman = $('#bulaninisalesman' + elem).find('.kdsalesman').text();
        var pdata = {mode:'showbulaninisalesman', 
                    kdsalesman: pkdsalesman,
                    _token: _token};

        $.ajax({
                url: '{{ route("dashb.store") }}',
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
                        $('.bulaninisalesmantombol').removeClass('active');

                        creategraph('graphpesanbulaninisalesman', data.x, data.y);
                        $('#tablebulaninisalesman').html(data.data);

                        creategraph('graphpesansalesmanbulanlalu', data.lalux, data.laluy);
                        $('#tablesalesmanbulanlalu').html(data.datalalu);


                        $('#bulaninisalesman' + elem).addClass('active');

                        $('#bulanininamasalesman').text(data.namasalesman);
                    }
                    loading2(0, '#divbulaninisalesman');
                }

        });           
    }


    function getbulanini(){
        loading2(1, 'body', 'Opening ...');

        var ket = $('#tketerangan').val();
        var pdata = {mode:'getdasboard',
                    _token: _token};

        $.ajax({
                url: '{{ route("dashb.store") }}',
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
                        $('#lastupdate').text(data.lastupdate);

                        creategraph('graphpesanbulanini', data.bulaninix, data.bulaniniy);
                        $('#tablebulanini').html(data.bulanini);

                        creategraph('graphpesanbulanlalu', data.bulanlalux, data.bulanlaluy);
                        $('#tablebulanlalu').html(data.bulanlalu);


                        creategraph('graphpesansetahun', data.setahunx, data.setahuny);
                        $('#tablesetahun').html(data.setahun);

                        showbulaninigudang(1);
                        showbulaninisalesman(1);
                    }
                    loading2(0, 'body');
                }

        });   
    }


    function creategraph(pidelement, xValues, yValues){
        document.querySelector("#" + pidelement + 'dasar').innerHTML = '<canvas id="' + pidelement + '"></canvas>';

        new Chart(pidelement, {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
                }]
            },
            options: {
                    legend: {display: false},
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    callback: function(label, index, labels) {
                                        return parseInt(label/1000000).toLocaleString() +'M';
                                    }
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: '1M = 1,000,000'
                                }
                            }
                        ]
                    }
                }
            });
    }


</script>



@endsection
