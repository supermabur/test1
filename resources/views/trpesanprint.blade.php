
@extends('layouts.bs5')


@section('content')

    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 100% !important;
        }

        .loader {
            border: 4px solid #6c757d;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 24px;
            height: 24px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>


    <div class="container my-4">
        <div id="loader" class="bg-white rounded border p-2" style="position: fixed; top: 90px; right: 12px; z-index: 99999; display: none;">
            <div class="loader"></div>
            <span>Saving ...</span>
        </div>

        <nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light border">
            <div class="container">
                <div class="d-flex my-1">
                    <img src="{{ url('images/logokecil.png') }}" style="max-width: 50px; max-height: 50px;" class="me-2"/>
                    <h4 class="align-self-center">{{ $title ?? '' }}</h4>
                </div>
                <form class="d-flex my-1">
                    <div style="position: relative">
                        <a class="btn btn-outline-secondary mx-2" href="{{ url('newsp') }}"><i class="fas fa-arrow-circle-left me-2"></i><small>Kembali ke Surat Pesan</small></a>
                    </div>
                    <a class="btn btn-outline-secondary" href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                </form>
            </div>
        </nav>


        <div >
            <div class="row">
                <div class="col-md-6 my-3 text-white">
                    <h4>alskdjalskdjaslkdjalsdjalsdalksdjalksdjalsjdalksdj</h4>
                </div>
                <div class="col-md-6 my-2 text-white">
                    <h4>alskdjalskdjaslkdjalsdjalsdalksdjalksdjalsjdalksdj</h4>
                </div>
            </div>
        </div>


        <div class="card my-4">
            <h5 class="card-header bg-secondary text-white"><i class="far fa-list-alt me-2"></i>DAFTAR BARANG</h5>
            <div class="card-body">
                <div id="kosong" class="text-center {{ $cartcount == 0 ? '' : 'd-none' }}">
                    <h6 class="my-2">Belum ada barang yang diorder</h6>
                    <a class="btn btn-outline-secondary m-2" href="{{ url('newsp') }}"><i class="fas fa-arrow-circle-left me-2"></i><small>Order barang sekarang</small></a>
                </div>

                <table id="data-table" class="table {{ $cartcount == 0 ? 'd-none' : '' }}">
                    <thead>
                      <tr>
                        <th scope="col" style="border-bottom-color: #dee2e6;">Nama</th>
                        <th scope="col" style="border-bottom-color: #dee2e6;">Keterangan</th>
                        <th scope="col" class="text-end" style="border-bottom-color: #dee2e6;">Qty</th>
                        <th scope="col" class="text-end" style="border-bottom-color: #dee2e6;">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($mstbarang as $d)
                            <tr id="row{{ $d->kodex }}">
                                <td class="@if ($loop->last) border-bottom-0 @endif">{{ $d->nama }}</td>
                                <td id="keterangan{{ $d->kodex }}" class="@if ($loop->last) border-bottom-0 @endif">{{ $d->keterangan }}</td>
                                <td id="qty{{ $d->kodex }}" class="text-end @if ($loop->last) border-bottom-0 @endif">{{ number_format($d->qty) }}</td>
                                <td id="jumlah{{ $d->kodex }}" class="text-end @if ($loop->last) border-bottom-0 @endif">{{ number_format($d->jumlah) }}</td>
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @if ($cartcount != 0)
            
            <div class="card my-4">
                <h5 class="card-header bg-secondary text-white"><i class="far fa-user me-2"></i>DATA CUSTOMER</h5>
                <div class="card-body">
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="sv form-control form-control-sm" id="csnama" value="{{ $pesanhead->csnama ?? '' }}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea id="csalamat" name="alamat" class="sv form-control" cols="30" rows="2">{{ $pesanhead->csalamat ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Kota</label>
                        <div class="col-sm-5">
                            <select id="cskota" class="sv sel2 form-control form-control-sm">
                                <option value=""></option>
                                @foreach ($mstongkir as $d)
                                    <option value="{{ $d->id }}" data-biayax="{{ number_format($d->biaya) }}" data-biaya="{{ round($d->biaya) }}"
                                        {{ ($pesanhead->cskota ?? '') == $d->id ? 'selected' : '' }}>
                                        {{ $d->kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Ongkir</label>
                        <div class="col-sm-5">
                            <input id="ongkir" type="number" class="sv form-control form-control-sm" value="{{ round($pesanhead->ongkir ?? '') }}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-5">
                            <input id="csnohp" type="tel" class="sv form-control form-control-sm" value="{{ $pesanhead->csnohp ?? '' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Outlet</label>
                        <div class="col-sm-5">
                            <select id="kdgudang" class="sv form-control form-control-sm sel2">
                                <option value=""></option>
                                @foreach ($mstgudang as $d)
                                    <option value="{{ $d->kode }}" {{ ($pesanhead->kdgudang ?? '') == $d->kode ? 'selected' : '' }}>{{ $d->nama . '  (' . $d->kode . ')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea id="keterangan" class="sv form-control" cols="30" rows="2">{{ $pesanhead->keterangan ?? '' }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
            


            <div class="card my-4">
                <h5 class="card-header bg-secondary text-white"><i class="fas fa-receipt me-2"></i>REKAP TRANSAKSI</h5>
                <div class="card-body">
                    <div class="mb-2 row">
                        <label class="col-sm-6 col-form-label">Total Barang</label>
                        <div class="col-sm-6 text-end">
                            <h5 id="totalbarang">{{ $total["totalbarang"] }}</h5>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-6 col-form-label">Ongkir</label>
                        <div class="col-sm-6 text-end">
                            <h5 id="ongkirtotal">{{ $total["ongkir"] }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2 row">
                        <label class="col-sm-6 col-form-label">Total</label>
                        <div class="col-sm-6 text-end">
                            <h4 id="total">{{ $total["total"] }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2 row">
                        <label class="col-sm-6 col-form-label">DP</label>
                        <div class="col-sm-6 text-end">
                            <h5 id="totaldp" class="totaldp">{{ $total["totaldp"] }}</h5>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-6 col-form-label text-danger">Kurang Bayar</label>
                        <div class="col-sm-6 text-end">
                            <h5 id="kurangbayar" class="text-danger">{{ $total["kurangbayar"] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            

            <div id="cardbayar" class="card my-4">
                <h5 class="card-header bg-secondary text-white"><i class="fas fa-cash-register me-2"></i>PEMBAYARAN</h5>
                <div class="card-body">
                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">Leasing</label>
                        <div class="col-sm-5 px-0">
                            <select id="kdleasing" class="sv sel2 form-control form-control-sm sel2">
                                <option value=""></option>      
                                @foreach ($mstleasing as $d)
                                    <option value="{{ $d->kode }}" {{ ($pesanhead->kdleasing ?? '') == $d->kode ? 'selected' : '' }}>{{ $d->nama }}</option>                                
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label class="col-sm-2 col-form-label">DP</label>
                        <div class="col-sm-10 p-2 border rounded">
                            <div class="row">
                                <div class="col-sm-12 text-end">
                                    <h5>Total DP : <span class="totaldp">{{ $total["totaldp"] }}</span></h5>
                                </div>
                            </div>

                            <hr class="mb-1">

                            <table class="table table-sm">
                                <thead>
                                <tr class="small">
                                    <th scope="col">Jenis</th>
                                    <th scope="col">NoBukti</th>
                                    <th scope="col" class="text-end">Jumlah</th>
                                </tr>
                                </thead>
                                <tbody id="bodybayar">
                                    {!! $pesanbayar !!}
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        @endif

    </div>





@endsection


@section('scripts')

    <script>

    </script>
@endsection