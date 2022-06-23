
    
@extends('layouts.dashboard')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="container my-4">
        <div>
            <p class="mb-2 px-0">* Data ini di update setiap 30 menit sekali. Terakhir update data pada <span class="font-weight-bold" id="lastupdate">xxx</span></p>

            <div class="form-group row">
                <label for="idkota" class="col-md-2 col-form-label col-form-label-sm">BULAN TAHUN</label>
                <div class="col-sm-4">
                    <select class="sel2 form-control form-control-sm" id="thnbln" required>
                        @foreach ($thnbln as $d)
                            <option value="{{ $d->thnbln }}">{{ $d->thnbln2 }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>



        {{-- Jual ALL --}}
        <div>
            <div class="row mt-4 px-0">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header text-white">
                            <div class="w-100 d-inline-flex">
                                <span id="judulall" style="align-self: center;" class="mr-3">PENJUALAN TOTAL</span> 
                            </div>
                        </div>
                        <div class="card-body py-1">
                            <div class="row" id="sp_bulanini">
                                <div class="col col-sm-4" id="tablejualall">

                                </div>
                                <div class="col col-sm-8" id="graphjualalldasar">
                                    <canvas id="graphjualall"></canvas>
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
                                <span id="judulgudang" style="align-self: center;" class="mr-3">PENJUALAN PER GUDANG</span> 
                            </div>
                        </div>
                        <div id="divbulaninigudang" class="card-body py-1">
                            <div>
                                <ul id="gudanghead" class="nav nav-pills">

                                </ul>
                                <hr class="mt-1">
                                <span id="namagudang" class="font-weight-bold">SEMUA GUDANG</span>
                                <div class="row">
                                    <div class="col col-sm-4" id="tablejualallgudang">
    
                                    </div>
                                    <div class="col col-sm-8" id="graphjualallgudangdasar">
                                        <canvas id="graphjualallgudang"></canvas>
                                    </div>
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
                                <span id="judulsalesman" style="align-self: center;" class="mr-3">PENJUALAN PER SALESMAN</span> 
                            </div>
                        </div>
                        <div class="card-body py-1" id="divbulaninisalesman">
                            <div >
                                <ul id="salesmanhead" class="nav nav-pills">

                                </ul>
                                <hr class="mt-1">
                                <span id="namasalesman" class="font-weight-bold">SEMUA SALESMAN</span>
                                <div class="row">
                                    <div class="col col-sm-4" id="tablejualallsalesman">
    
                                    </div>
                                    <div class="col col-sm-8" id="graphjualallsalesmandasar">
                                        <canvas id="graphjualallsalesman"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SURAT PESAN SETAHUN KEBELAKANG --}}
        {{-- <div>
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
        </div> --}}
   

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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

    $(document).ready(function(){
        $('.sel2').select2(
            {
            // placeholder: "Pilih",
            // allowClear: true
            }
        );

        $('#thnbln').on('select2:select', function (e) {
            var data = e.params.data;
            getdata();
        });

        getdata();
        
    });


    function getdata(pkdsalesman = 'na', pkdgudang = 'na'){
        var thnbln = $('#thnbln').val();
        loading2(1, 'body', 'Opening ...');

        var pdata = {mode:'getdasboardjual',
                    kdsalesman: pkdsalesman,
                    kdgudang: pkdgudang,
                    thnbln: thnbln,
                    _token: _token};

        $.ajax({
                url: '{{ route("d23ashbjual.store") }}',
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

                        switch (data.mode) {
                            case 1:
                                creategraph('graphjualall', data.graphx, data.graphy);
                                $('#tablejualall').html(data.html);
                                $('#gudanghead').html(data.htmlgudang);
                                $('#salesmanhead').html(data.htmlsalesman);

                                $(".tombolgudang").on("click", function () {
                                    var kode = $(this).attr('data-kode');
                                    $('.tombolgudang').removeClass('active');
                                    $(this).addClass('active');
                                    getdata('na', kode);
                                });                            

                                $(".tombolsalesman").on("click", function () {
                                    var kode = $(this).attr('data-kode');
                                    $('.tombolsalesman').removeClass('active');
                                    $(this).addClass('active');
                                    getdata(kode, 'na');
                                });
                                
                                $('.tombolgudang:first').click();
                                $('.tombolsalesman:first').click();

                                var jdl = $('#thnbln').find(':selected').text();
                                $('#judulall').text('PENJUALAN  ' + jdl);
                                $('#judulgudang').text('PENJUALAN PER GUDANG  ' + jdl);
                                $('#judulsalesman').text('PENJUALAN PER SALESMAN  ' + jdl);
                                
                                break;

                            case 2:
                                // gudang
                                creategraph('graphjualallgudang', data.graphx, data.graphy);
                                $('#tablejualallgudang').html(data.html);
                                $('#namagudang').text(pkdgudang);
                                break;

                            case 3:
                                // salesman
                                creategraph('graphjualallsalesman', data.graphx, data.graphy);
                                $('#tablejualallsalesman').html(data.html);
                                $('#namasalesman').text(pkdsalesman);
                                break;
                        }


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
