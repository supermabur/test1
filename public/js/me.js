


function testmejs(){
    alert('okeee');
}


function fillthedatatable(datatableid = '', purl = '', pcolumns = '', pdata = '')
{
    // format xColumns = [namakolom*, tipekolom*, 'sum', 'invis']
    // tipekolom = string, number, datetime, action

    var numFormat = $.fn.dataTable.render.number('.',',',2,'');
    var Xcolumns=[];

    for (i=0; i < pcolumns.length ; i++){
        var xcol = {title: pcolumns[i][0], data: pcolumns[i][0], name: pcolumns[i][0]};

        switch(pcolumns[i][1]){
            case 'number':
                Object.assign(xcol, {render: numFormat, className: 'text-right'});
                break;

            case 'datetime':
                Object.assign(xcol, {className: 'text-center'});
                break;

            case 'action':
                Object.assign(xcol, {className: 'text-right', orderable: false, searchable: false});
                break;
        }

        if(pcolumns[i].includes("invis")){
            Object.assign(xcol, {visible : false});
        }

        Xcolumns.push(xcol);
    }

    console.log(Xcolumns);

    // var Xcolumns=
    // [
    //     {title: 'Tahun Bulan', data: 'tahunbulan', name: 'tahunbulan'},
    //     {title: 'Faktur Pending', data: 'fakturpending', name: 'fakturpending', className: 'text-right'},
    //     {title: 'Total Pending', data: 'totalpending', name: 'totalpending', className: 'text-right'},
    //     {title: 'Faktur Pending Pros', data: 'fakturpendingpros', name: 'fakturpendingpros', className: 'text-right'},
    //     {title: 'Total Pending Pros', data: 'totalpendingpros', name: 'totalpendingpros', className: 'text-right'},
    //     {title: 'Action', data: 'action', name: 'action', orderable: false, searchable: false, className: "text-right"}
    // ];

    // var xUrl = "{{ route('grctrl.show', $menuid) }}"   ;
    // var xnum = {render: numFormat, className: 'text-right'};
    // var xrentext = {render: function(datum, type, row) {
    //                         return $("<div/>").html(datum).text(); 
    //                     },
    //                     className: 'text-center'
    //                 };
    // var xhide = {visible : false};
    // var xorderablefalse = {orderable : false, searchable:false};


    // for (i=0; i < xNative.length ; i++){
    //     switch (xNative[i]){
    //         case 'NEWDECIMAL':
    //             Object.assign(Xcolumns[i], xnum);
    //         break;
    //     }
    //     switch (Xcolumns[i].title){
    //         case 'id': Object.assign(Xcolumns[i], xhide); break;
    //         case 'action' : Object.assign(Xcolumns[i], xorderablefalse); break;
    //     }

    //     if (xrendertext1.includes(Xcolumns[i].title)){
    //         Object.assign(Xcolumns[i], xrentext);
    //     }
    // }


    // var appe = '<tfoot><tr>';
    // for (i=0; i < Xcolumns.length ; i++){
    //     appe = appe + '<th></th>';
    // }
    // appe = appe + '</tr></tfoot>';
    // $('tfoot').remove();
    // $('#user_table').append(appe);


    var btnrefresh = {
                    'titleAttr' : 'Refresh Data',
                    'className' : 'custom-btn-refresh',
                    'text' : '<i class="fa fa-sync" style="margin-right: 4px;"></i> Refresh Data',
                    'action' : function ( e, dt, node, config ) {
                                    fill_datatable();
                                }
                };
            


    // buttonx.unshift(btnrefresh);

    var dataTable = $('#' + datatableid).DataTable({
        dom: 'Bfrltip',
        destroy: true,
        lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
        // buttons: buttonx,
        processing: true,
        language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
        serverSide: true,
        ajax:{  
                url: purl,
                type: "POST",
            //     data:{menuid:xmenuid, fdate1:xfdate1, fdate2:xfdate2, fgudang:xfgudang },
                data:pdata,
                dataType:"json",
                dataFilter: function(response){
                        // console.log(response);
                        return response;
                    }
                },
        columns:Xcolumns
        // ,
        // "footerCallback": function (row, data, start, end, display) {
        //         var api = this.api();

        //         // Remove the formatting to get integer data for summation
        //         var intVal = function (i) {
        //             return typeof i === 'string' ?
        //                 i.replace(/[\$,]/g, '') * 1 :
        //                 typeof i === 'number' ?
        //                 i : 0;
        //         };

        //         // // Total over all pages
        //         // total = api
        //         //     .column(6)
        //         //     .data()
        //         //     .reduce(function (a, b) {
        //         //         return intVal(a) + intVal(b);
        //         //     }, 0);

        //         // Total over this page

        //         for (i=0; i < xNative.length ; i++){
        //             switch (xNative[i]){
        //                 case 'NEWDECIMAL':
        //                     pageTotal = api
        //                                 .column(i, {
        //                                     page: 'current'
        //                                 })
        //                                 .data()
        //                                 .reduce(function (a, b) {
        //                                     return intVal(a) + intVal(b);
        //                                 }, 0);
                    
        //                     // Update footer
        //                     $(api.column(i).footer()).html(formatNumber(pageTotal));
        //                 break;
        //             }

        //         }
        //     }                    
    });
}