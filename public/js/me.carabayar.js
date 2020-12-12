(function($){
    var bayarsettings = '';
    var total = 0;

    function gethtml(listcarabayar = ''){
        var ht = 
        '<div class="card card-light shadow">' +
        '    <div class="card-header">' +
        '        <h3 class="card-title"><i class="fas fa-money-bill-alt mr-2"></i>Pilih Jenis Pembayaran</h3>' +
        '    </div>' +
        '   <div class="card-body">        '    +
        '        <div class="form-group row">' +
        '            <div class="col-md-12">' ;


        ht += 
        '<div class="form-group row">\
            <div class="col-md-12 input-group input-group-sm">\
                <select class="selectpicker form-control form-control-sm" id="bayaridcarabayar" name="bayaridcarabayar" required>\
                    <option disabled selected value style="display:none;">Pilih jenis bayar</option>';

        var lcb = listcarabayar;
        for (var key in lcb) {
            ht += '<option value="' + lcb[key]['id'] + '" data-inputnokartu="' + lcb[key]['inputnokartu'] + '" data-chargeusepersen="' + lcb[key]['chargeusepersen'] + '" data-chargevalue="' + lcb[key]['chargevalue'] + '">' + lcb[key]['nama'] + '</option>'
        };

        ht +=
        '        </select>\
            </div>\
        </div>';

        ht +=
        '<div class="row">\
        <div class="input-group input-group-sm mb-1 col-md-4">\
                <div class="input-group-prepend">\
                    <span class="input-group-text">Jumlah</span>\
                </div>\
                <input type="number" class="form-control bayarhitungjumlah text-right" id="bayarjumlah" name="bayarjumlah" value="0">\
            </div>\
            <div class="input-group input-group-sm mb-1 col-md-4">\
                <div class="input-group-prepend">\
                    <span class="input-group-text">Charge(%)</span>\
                </div>\
                <input type="number" class="form-control bayarhitungjumlah text-right" id="bayarchargepersen" name="bayarchargepersen" value="0">\
            </div>\
            <div class="input-group input-group-sm mb-1 col-md-4">\
                <div class="input-group-prepend">\
                    <span class="input-group-text">Charge(Nom)</span>\
                </div>\
                <input type="number" class="form-control bayarhitungjumlah text-right" id="bayarchargenominal" name="bayarchargenominal" value="0">\
            </div>\
        </div>';

        ht +=
        '<div class="row">\
            <div class="input-group input-group-sm mb-1 col-md-4">\
                <div class="input-group-prepend">\
                    <span class="input-group-text">Total</span>\
                </div>\
                <input type="number" class="form-control text-right" id="bayartotal" name="bayartotal" value="0" readonly>\
            </div>\
            <div class="input-group input-group-sm mb-1 col-md-4">\
                <div class="input-group-prepend">\
                    <span class="input-group-text">No Kartu</span>\
                </div>\
                <input type="text" class="form-control text-right" id="bayarnokartu" name="bayarnokartu" value="">\
            </div>\
            <div class="input-group input-group-sm mb-1 col-md-4">\
                <button type="button" class="btn btn-info btn-sm" id="btnbayaradd" data-toggle="tooltip" title="Tambahkan ke daftar Pembayaran">\
                    <i class="fa fa-plus" style="margin-right: 4px;"></i>\
                    Tambah\
                </button>\
            </div>\
        </div>';
        
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


    $.fn.setcarabayar = function(options)
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

        this.html(gethtml(settings.listcarabayar));
        fill_db(settings.urlajaxdatatable, settings.token);

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