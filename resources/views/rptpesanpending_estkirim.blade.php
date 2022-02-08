
    
@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <h4>ahai</h4>
    </div>


    <!-- Modal -->
    <div id="modaldetail" class="modaldetail modal fade" role="dialog" >
        <div class="modal-dialog  modal-lg">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #baff76;">
                    <h5 class="card-title judulbiru" id="juduldetail">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body" style="padding: 0rem;">
                    <form role="form" style="font-size: 0.8rem;">
                        <div class="card-body" id="bodydetail">
                            <div class="table-responsive" id="tablexdetail" width=100% style="margin-top: 10px;">
                                <table class="table display row-border" id="table_detail" width=100%> 
                                    {{-- style="font-size: 0.9rem;line-height: 1;"> --}}
            
                                </table>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer" style="font-size: 0.8rem;justify-content: initial;">
                        <div>
                            <div>Keterangan Warna</div>
                            <div style="background-color: #ffff75">  Leasing Belum ada follow up lebih dari 3 hari  </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

@endsection



@section('scripts')



<script>
    $(document).ready(function(){

    });


</script>



@endsection
