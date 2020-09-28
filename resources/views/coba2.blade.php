

    <div class="row">
        <div class="col-md-12 outerbox">
            <div class="box" style="border-top: 0px solid #d2d6de;">
            <!-- <div class="container"> -->

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter_gudang" class="col-sm-1 col-form-label">Outlet</label>
                    <div class="col-sm-4">
                        <select name="filter_gudang" id="filter_gudang" class="form-control " required>
                            <option value=""></option>
                            @foreach($composer_mstgudang as $dt)
                                <option value="{{ $dt->kode }}">{{ $dt->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="show0" class="col-sm-1 col-form-label">Saldo 0</label>
                    <div class="col-sm-3">
                        <select name="show0" id="show0" class="form-control " required>
                            <option value="TIDAK">Tidak Ditampilkan</option>
                            <option value="YA">Ditampilkan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row" style="margin-bottom: 0.2rem;margin-top: 0.2rem;">
                    <label for="filter" class="col-sm-1 col-form-label"> </label>
                    <div class="col-sm-3">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Refresh Data</button>
                    </div>
                </div>


                <div class="row">
                    <div class = "mstbrg">
                        asdasd
                        {{$namex}}
                        {{$namexx}}
                        @if (!empty($namexxx))
                            {{$namexxx}}
                        @endif
                    </div>
        
                    {{-- <div class='table-responsive' id='mstbarangtable' width=100% style='margin-top: 10px;'>
                        <table class='table display cell-border' id='user_table' width=100%>
                        </table>
                    </div> --}}
                            
                </div>

                <div class="card card-primary" style="box-shadow: none;margin-top: 0.8rem;">
                    <div class="card-header">
                        <h3 class="card-title judulbiru" id="judulbiru">Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body">
                            <div class="table-responsive" id="tablex" width=100% style="margin-top: 10px;">
                                <table class="table display cell-border" id="user_table" width=100%>
                                    {{-- <thead>
                                        <tr>
                                            <th width="10%">Kode</th>
                                            <th width="75%">Nama Barang</th>
                                            <th width="5%" class="text-right">Saldo</th>
                                            <th width="5%" class="text-right">Qty di pesan</th>
                                            <th width="5%" class="text-right">Sisa Saldo</th>
                                        </tr>
                                    </thead> --}}
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </form>
                </div>




            </div>
        </div>
    </div>



<script>
    $(document).ready(function(){   

        $('#filter').click(function(){
            alert('uyeeeaah');
        });

    });

</script>

