




<div class="row">
    <div class="col-md-12 mb-1">
        <input type="text" id="brgnama" name="brgnama" class="form-control form-control-sm" placeholder="Ketik kata kunci barang disini" required>
    </div>
    
    <div class="col-md-8 mb-1 d-none">
        <input type="number" id="brgid" name="brgidbarang" class="form-control form-control-sm">
    </div>
</div>

<div class="row">
    <div class="input-group input-group-sm mb-1 col-md-4">
        <div class="input-group-prepend">
            <span class="input-group-text">Qty</span>
        </div>
        <input type="number" class="form-control brghitungjumlah text-right" id="brgqty" name="brgqty" >
    </div>

    <div class="input-group input-group-sm mb-1 col-md-4">
        <div class="input-group-prepend">
            <span class="input-group-text">Harga</span>
        </div>
        <input type="number" class="form-control formatnumber brghitungjumlah text-right" id="brgharga" name="brgharga" >
    </div>

    <div class="input-group input-group-sm mb-1 col-md-4">
        <div class="input-group-prepend">
            <span class="input-group-text">Disc(%)</span>
        </div>
        <input type="number" class="form-control formatnumber brghitungjumlah text-right" id="brgdisc" name="brgdisc" >
    </div>
</div>

<div class="row">
    <div class="input-group input-group-sm mb-1 col-md-4">
        <div class="input-group-prepend">
            <span class="input-group-text">Jumlah</span>
        </div>
        <input type="number" class="form-control formatnumber text-right" id="brgjumlah" name="brgjumlah" readonly>
    </div>
    
    <div class="input-group input-group-sm mb-1 col-md-8">
        <div class="input-group-prepend">
            <span class="input-group-text">Keterangan</span>
        </div>
        <input type="text" class="form-control" id="brgketerangan" name="brgketerangan">
    </div>
</div>


<div class="modal fade" id="brgmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="bodydetail" style="font-size: 0.8rem;">
                <div class="table-responsive" id="brgtable" width=100% style="margin-top: 10px;">
                    <table class="table display row-border" id="brgtable_detail" width=100%> 

                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>



<script>


    $(document).ready(function() {
            $('.formatnumber').number( true, 2 );
        });


    $( "#brgnama" ).keypress(function( event ) {
        if ( event.which == 13 ) {
            event.preventDefault();
            
            var tnama = $(this).val();
            if(tnama.length > 1){
                fill_detailbrg(tnama);
            }
            else{
                alert('Kata kunci harus lebih dari 1 huruf');
                $(this).select();
            }
        }
    });

    $('.brghitungjumlah').change(function () {
        hitungjumlah();
    });

    function hitungjumlah(){
        var q = $("#brgqty").val();
        var h = $("#brgharga").val();
        var d = $("#brgdisc").val();
        var j = q * ((100 - d)/100) * h;

        $("#brgjumlah").val(j);
    }

    function fill_detailbrg(pkey = '')
        {
            var md = $('#brgmodal');
            var databrg = '';
            md.modal('show');
            
            document.getElementById("bodydetail").innerHTML = "<div class='table-responsive' id='brgtable' width=100% style='margin-top: 10px;'>" +
                                                                    "<table class='table display row-border' id='brgtable_detail' width=100%> </table></div>";

            var numFormat = $.fn.dataTable.render.number('.',',',0,'');

            var Xcolumns=
                [
                    {title: 'nama', data: 'nama', name: 'nama'},
                    {title: 'harga', data: 'harga', name: 'harga', render: numFormat, className: 'text-right'},
                    {title: 'disc', data: 'disc', name: 'disc', render: numFormat, className: 'text-right'}
                ];

            var dataTablex = $('#brgtable_detail').DataTable({
                dom: 'lfrtip',
                destroy: true,
                keys: {
                    keys: [ 13 /* ENTER */, 38 /* UP */, 40 /* DOWN */, 27 /*ESCAPE*/ ]
                    }, 
                scrollY: "50vh",
                scrollCollapse: true,
                order: [],
                lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
                // buttons: Buttonsx,
                processing: true,
                language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                // language: {processing: '<div class="loading" delay-hide="50000"></div> '},
                serverSide: true,
                ajax:{  
                        url: '{{ url("searchdatabarang")}}',
                        data:{'key':pkey},
                        dataType:"json",
                        // beforeSend: function() {
                        //     alert('before');
                        // },
                        dataFilter: function(response){
                                // this to see what exactly is being sent back
                                // console.log(response);
                                // var json = jQuery.parseJSON( response );
                                // json.recordsTotal = json.total;
                                // json.recordsFiltered = json.total;
                                // json.data = json.list;
                                return response;
                            },
                        // success:function(data)
                        //     {
                        //         // console.log('---------------------------------');
                        //         // console.log(data);
                        //         // alert(data.posts);
                        //         // $('#name').val(data.name);
                        //         // return data;
                        //     },
                        // error: function(err){
                        //         console.log(err);
                        //     }

                        },
                columns:Xcolumns,
                // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                //     // alert(aData['Status'] + ' ' + aData['status'] );
                //     // switch(aData['3harinomemo']){
                //     //     case 'kuning':
                //     //         $('td', nRow).css('background-color', '#ffff75')
                //     //         break;
                //     // }
                // }
                fnInitComplete: function(oSettings, json) {
                    var jml = json['recordsTotal'];
                    var cc = document.querySelector("#brgtable_detail > tbody > tr.odd > td:nth-child(1)");

                    switch(jml){
                        case 0:
                            alert('Data tidak ditemukan!')
                            md.modal('hide');   
                            break;

                        case 1:
                            cc.click();

                            // Get highlighted row data
                            var data = dataTablex.row(0).data();
                        
                            databrg = data;
                            md.modal('hide');                      
                            break;

                        default:
                            // click row pertama supaya bisa langsung dipilih barangnya
                            cc.click();
                    }

                }
            });
            
            // Handle event when cell gains focus
            $('#brgtable_detail').on('key-focus.dt', function(e, datatable, cell){
                // Select highlighted row
                $(dataTablex.row(cell.index().row).node()).addClass('selected');
            });

            // Handle event when cell looses focus
            $('#brgtable_detail').on('key-blur.dt', function(e, datatable, cell){
                // Deselect highlighted row
                $(dataTablex.row(cell.index().row).node()).removeClass('selected');
            });
                
            // Handle key event that hasn't been handled by KeyTable
            $('#brgtable_detail').on('key.dt', function(e, datatable, key, cell, originalEvent){
                // If ENTER key is pressed
                console.log(key);
                switch (key){
                    case 13:
                        // Get highlighted row data
                        var data = dataTablex.row(cell.index().row).data();
                        
                        // FOR DEMONSTRATION ONLY
                        // console.log(data);
                        databrg = data;
                        md.modal('hide');

                        break;

                    case 27:
                        clearbrg();
                        break;

                }
            });       

            $('#brgmodal').on('hidden.bs.modal', function () {
                if (databrg == ''){
                    clearbrg();
                }
                else{
                    $("#brgnama").val(databrg.nama);
                    $("#brgharga").val(databrg.harga);
                    $("#brgdisc").val(databrg.disc);
                    $("#brgqty").val(1);
                    $("#brgqty").select();
                    $("#brgid").val(databrg.id);
                    hitungjumlah();
                }
            })
                
            function clearbrg(){
                $("#brgnama").val("");
                $("#brgnama").focus();
                $("#brgharga").val(0);
                $("#brgdisc").val(0);
                $("#brgqty").val(0);
                $("#brgid").val(0);
                hitungjumlah();
            }
        }


</script>