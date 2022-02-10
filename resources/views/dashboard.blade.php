
    
@extends('layouts.dashboard')

@section('content')

    <div class="container my-4">

        {{-- 2 MINGGU --}}
        <div>
            <div class="row mt-4 px-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100"><h6>SURAT PESAN BULAN INI</h6></div>
                        </div>
                        <div class="card-body py-1">
                            <canvas id="graphpesanbulanini"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

        {{-- OVERDUE --}}
        <div class="mt-5">
            <h4 class="m-2">
                <i class="far fa-dot-circle mr-2"></i>Pesanan yang sudah melewati batas estimasi kirim
            </h4>

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

    function getbulanini(){
        loading2(1, 'body', 'Opening ...');

        var ket = $('#tketerangan').val();
        var pdata = {mode:'getbulanini',
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
                        creategraph('graphpesanbulanini', data.bulaninix, data.bulaniniy);


                        
                        

                    }
                    loading2(0, 'body');
                }

        });   
    }


    function creategraph(pidelement, xValues, yValues){
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
                                        return label/1000000+'M';
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
