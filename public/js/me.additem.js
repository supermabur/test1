(function($){
    var bayarsettings = '';
    var total = 0;

    function gethtml(listcarabayar = ''){
        var ht = 
        '<div class="card card-light shadow">' +
        '    <div class="card-header">' +
        '        <h3 class="card-title"><i class="fas fa-money-bill-alt mr-2"></i>Pilih Jenis Pembayaran</h3>' +
        '    </div>' +
        '    <div class="card-body">        '    +
        '        <div class="form-group row">' +
        '            <div class="col-md-12">' ;

        ht = 
            '<div class="row">\
                <div class="col-md-12 mb-1">\
                    <input type="text" id="brgnama" name="brgnama" class="form-control form-control-sm" placeholder="Ketik kata kunci barang disini" required>\
                </div>\
            \
                <div class="col-md-8 mb-1 d-none">\
                    <input type="number" id="brgid" name="brgidbarang" class="form-control form-control-sm">\
                </div>\
            </div>\
            \
            <div class="row">\
                <div class="input-group input-group-sm mb-1 col-md-4">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text">Qty</span>\
                    </div>\
                    <input type="number" class="form-control brghitungjumlah text-right" id="brgqty" name="brgqty" >\
                </div>\
            \
                <div class="input-group input-group-sm mb-1 col-md-4">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text">Harga</span>\
                    </div>\
                    <input type="number" class="form-control formatnumber brghitungjumlah text-right" id="brgharga" name="brgharga" >\
                </div>\
            \
                <div class="input-group input-group-sm mb-1 col-md-4">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text">Disc(%)</span>\
                    </div>\
                    <input type="number" class="form-control formatnumber brghitungjumlah text-right" id="brgdisc" name="brgdisc" >\
                </div>\
            </div>\
            \
            <div class="row">\
                <div class="input-group input-group-sm mb-1 col-md-4">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text">Jumlah</span>\
                    </div>\
                    <input type="number" class="form-control formatnumber text-right" id="brgjumlah" name="brgjumlah" readonly>\
                </div>\
                <div class="input-group input-group-sm mb-1 col-md-8">\
                    <div class="input-group-prepend">\
                        <span class="input-group-text">Keterangan</span>\
                    </div>\
                    <input type="text" class="form-control" id="brgketerangan" name="brgketerangan">\
                </div>\
            </div>'

        ht = 
            '<div class="modal fade" id="brgmodal" tabindex="-1" role="dialog" aria-hidden="true">\
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">\
                    <div class="modal-content">\
                        <div class="modal-header">\
                            <h5 class="modal-title">Daftar Barang</h5>\
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                <span aria-hidden="true">&times;</span>\
                            </button>\
                        </div>\
            \
                        <div class="modal-body" id="bodydetail" style="font-size: 0.8rem;">\
                            <div class="table-responsive" id="brgtable" width=100% style="margin-top: 10px;">\
                                <table class="table display row-border" id="brgtable_detail" width=100%>\
                                </table>\
                            </div>\
                        </div>\
            \
                        <div class="modal-footer">\
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                        </div>\
                    </div>\
                </div>\
            </div>'

        
        ht +=
        '            </div>' +
        '        </div>' +
        '    </div>' +
        '</div>' ;


        ht += 
        '<div class="card card-light shadow">' +
        '    <div class="card-header">' +
        '        <div class="row">' +
        '            <h3 class="card-title col"><i class="fas fa-list mr-2"></i>Daftar Pembayaran</h3>' +
        '            <h3 class="card-title col text-right font-weight-bold bayartotal">Total = 0</h3>                ' +                
        '        </div>                           ' +
        '    </div>' +
        '    <div class="card-body">          ' +
        '        <div class="form-group row">' +
        '            <div class="col-md-12" style="font-size: 0.8rem;">' +
        '                <style>' +
        '                    #tablebayartmp > thead > tr > th {' +
        '                        padding: 10px 18px;' +
        '                    border-bottom: 1px solid #d2d2d2;' +
        '                    background-color: #dadada;' +
        '                    }' +
        '                    #tablebayartmp  {' +
        '                        border-bottom: 1px solid #e5e5e5;' +
        '                    }' +
        '                </style>' +
        '                <div class="table-responsive" width=100%>' +
        '                    <table class="table display cell-border" id="tablebayartmp" width=100%>' +
        '                    </table>' +
        '                </div>' +
        '            </div>' +
        '        </div>       ' +             
        '    </div>' +
        '</div>  ';

        return ht;
    }


    function elemtable(){
        var card = document.createElement("div");
        card.className = "card card-light shadow";

        var cardhead = document.createElement("div"); cardhead.className="card-header";
        var cardr = document.createElement("div"); cardhead.className="row";



        var cardbody = document.createElement("div"); cardbody.className="card-body";

        card.appendChild(cardhead);
        card.appendChild(cardbody);

        return card;
    }

    $.fn.setadditem = function(options)
    { 
        // Default options
        var settings = $.extend({
            listcarabayar: '',
            token: '',
            urlajaxdatatable: '',
            idoutlet: '',
            onaddremoveitem : function() {}
            }, options );
        
        bayarsettings = settings;
        
        console.log('setadditem');

        var bawah = document.createElement("div");
        bawah.className = "cobacoba append";

        console.log(bawah);

        var closeButton = document.createElement("button");
        closeButton.className = "scotch-close close-button";
        closeButton.innerHTML = "×";

        bawah.appendChild(closeButton);
        this.html(elemtable());


        jQuery.get("me.additem.txt", undefined, function(data) {
            alert(data);
        }, "html").done(function() {
            alert("second success");
        }).fail(function(jqXHR, textStatus) {
            alert(textStatus);
        }).always(function() {
            alert("finished");
        });


        // this.html(gethtml(settings.listcarabayar));
        // fill_db(settings.urlajaxdatatable, settings.token);

    };


    function fill_db(purl='', ptoken = '')
        {
            var pret = {  
                url: purl,
                type:"POST",
                data:{mode:'showbayartmpdb',
                        _token: ptoken},
                dataFilter: function(response){
                    var json = jQuery.parseJSON( response );
                    var jml = 0;
                    $.each(json.data, function (i) {
                        jml += Number(json.data[i].total);
                    });
                    total = jml;
                    $('.bayartotal').text('Total Bayar = ' + number_format(jml, 2));   

                    console.log(typeof bayarsettings.onadditem);

                    // if (typeof bayarsettings.onadditem == 'function') { // make sure the callback is a function
                        var r = {total:jml};
                        bayarsettings.onaddremoveitem(r);
                    // }
                    // else{
                    //     console.log('not');
                    // }

                    return response;
                },

            };

            var numFormat = $.fn.dataTable.render.number(',','.',0,'');
            var numFormatdesimal2 = $.fn.dataTable.render.number(',','.',2,'');

            var Xcolumns=
                [
                    {title: 'Nama', data: 'nama', name: 'nama'},
                    {title: 'NoKartu', data: 'nokartu', name: 'nokartu'},
                    {title: 'Jumlah', data: 'jumlah', name: 'jumlah', render: numFormat, className: 'text-right'},
                    {title: 'Charge %', data: 'chargepers', name: 'chargepers', render: numFormatdesimal2, className: 'text-right'},
                    {title: 'Charge Nom', data: 'chargenominal', name: 'chargenominal', render: numFormat, className: 'text-right'},
                    {title: 'Total', data: 'total', name: 'total', render: numFormat, className: 'text-right'},
                    {title: 'action', data: 'action', name: 'action', className: 'text-right'}
                ];

            var dataTablex = $('#tablebayartmp').DataTable({
                dom: 'rt',
                destroy: true,
                scrollCollapse: true,
                order: [],
                ordering: false,
                bSort: false,
                lengthMenu: [[-1], ['ALL']],
                processing: true,
                language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
                serverSide: true,
                columns:Xcolumns,
                ajax:pret
            });
            
    }


    $(document).on('click', '#btnbayaradd', function (e) {
        e.preventDefault();
        RemoveAlert();

        $.ajax({  
            url: bayarsettings.urlajaxdatatable,
            type:"POST",
            data:{mode:'savekebayartmpdb',
                    idcarabayar: $("#bayaridcarabayar").val(),
                    nama: $("#bayaridcarabayar option:selected").text(),
                    jumlah: $("#bayarjumlah").val(),
                    chargepersen: $("#bayarchargepersen").val(),
                    chargenominal: $("#bayarchargenominal").val(),
                    total: $("#bayartotal").val(),
                    nokartu: $("#bayarnokartu").text(),
                    idoutlet: bayarsettings.idoutlet,
                    _token: bayarsettings.token},
            // async: false,
            dataType:"json",
            success:function(data)
            {
                if(data.errors)
                {
                    for(var count = 0; count < data.errors.keys.length; count++)
                    {  
                        var v = document.getElementById('bayar' + data.errors.keys[count]);
                        if($(v).is("input")){
                            if (count == 0)
                            {
                                $(v).focus();
                                v.scrollIntoView(false);
                            }
                            // v.classList.add('is-invalid');
                            $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(v);
                        }

                        if($(v).is("select")){
                            if (count == 0)
                            {
                                $(v).focus();
                                v.scrollIntoView(true);
                            }
                            var w = v.nextSibling;
                            // w.classList.add('is-invalid');
                            $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(w);
                        }
                    }
                }
                if(data.success)
                {
                    $('#tablebayartmp').DataTable().ajax.reload();
                    $('#bayaridcarabayar').val(0);
                    $('#bayaridcarabayar').focus();
                    $("#bayarjumlah").val(0);
                    $("#bayarchargepersen").val(0);
                    $("#bayarchargenominal").val(0);
                    $("#bayartotal").val(0);
                    $("#bayarnokartu").val('');
                }
                loading(0);
            }

        });
    });

    function RemoveAlert(){
        $("input").removeClass("is-invalid");
        $("span").remove(".invalid-feedback");
    }

    $(document).on('change', '#bayaridcarabayar', function (e) {
        e.preventDefault();

        var inputnokartu = $(this).find("option:selected").attr('data-inputnokartu');
        $("#bayarnokartu").prop("readonly",false);
        if (inputnokartu == 0){
            $("#bayarnokartu").val('');
            $("#bayarnokartu").prop("readonly",true);
        }

        var chargeusepersen = $(this).find("option:selected").attr('data-chargeusepersen');
        var chargevalue = $(this).find("option:selected").attr('data-chargevalue');
        if (chargeusepersen == 1){
            $("#bayarchargepersen").prop("readonly",false);
            $("#bayarchargenominal").prop("readonly",true);
            $("#bayarchargepersen").val(chargevalue);
            $("#bayarchargenominal").val(0);
        }
        else{
            $("#bayarchargepersen").prop("readonly",true);
            $("#bayarchargenominal").prop("readonly",false);
            $("#bayarchargenominal").val(chargevalue);
            $("#bayarchargepersen").val(0);
        }
        $("#bayarjumlah").select();
    });


    $(document).on('click', '.bayarbtnedit', function(){
        console.log($(this).data('bayaridcarabayar'));
    });


    $(document).on('click', '.bayarbtndelete', function(){
        // console.log($(this).data('idbarang'));
        var id = $(this).data('idcarabayar');
        $.ajax({
            url: bayarsettings.urlajaxdatatable,
            type:"POST",
            data:{mode:'deletebayartmpdb',
                    idcarabayar:id,
                    _token: bayarsettings.token},
            dataFilter: function(response){
                    // console.log(response);
                    return response;
                },
            success: function(response){
                    // console.log(response);
                    $('#tablebayartmp').DataTable().ajax.reload();
                    return response;
                },
            error: function(err){
                    // console.log(err);
                }
        });
    });


    $(document).on('change', '.bayarhitungjumlah', function (e) {
        e.preventDefault();
        hitungjumlah();
    });


    function hitungjumlah(){
        var cp = $("#bayarchargepersen");
        var cn = $("#bayarchargenominal");
        var j = $("#bayarjumlah").val();

        var cp_ro = $("#bayarchargepersen").prop("readonly");

        if(cp_ro){
            cp.val( number_format((cn.val()/j) * 100,2) );
        }
        else{
            cn.val( j * cp.val() / 100);
        }

        var t = parseInt(cn.val()) + parseInt(j) ;
        $("#bayartotal").val(t);

    }


     function number_format(number, decimals) {
        var dec_point = '.';
        var thousands_sep = ',';
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }

})(jQuery);