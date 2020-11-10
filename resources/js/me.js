


      function fillthedatatable(datatableid = '', xurl = '', xcolumns = '', xdata = '')
      {
          var numFormat = $.fn.dataTable.render.number('.',',',2,'');
          var xUrl = "{{ route('grctrl.show', $menuid) }}"   ;
          var xnum = {render: numFormat, className: 'text-right'};
          var xrentext = {render: function(datum, type, row) {
                                  return $("<div/>").html(datum).text(); 
                              },
                              className: 'text-center'
                          };
          var xhide = {visible : false};
          var xorderablefalse = {orderable : false, searchable:false};

          // console.log(xrendertext1);

          for (i=0; i < xNative.length ; i++){
              switch (xNative[i]){
                  case 'NEWDECIMAL':
                      Object.assign(Xcolumns[i], xnum);
                  break;
              }

              // console.log(Xcolumns[i].title);
              switch (Xcolumns[i].title){
                  case 'id': Object.assign(Xcolumns[i], xhide); break;
                  case 'action' : Object.assign(Xcolumns[i], xorderablefalse); break;
              }

              if (xrendertext1.includes(Xcolumns[i].title)){
                  Object.assign(Xcolumns[i], xrentext);
              }
          }
          // console.log(Xcolumns);


          var appe = '<tfoot><tr>';
          for (i=0; i < Xcolumns.length ; i++){
              appe = appe + '<th></th>';
          }
          appe = appe + '</tr></tfoot>';
          $('tfoot').remove();
          $('#user_table').append(appe);


          var btnrefresh = {
                          'titleAttr' : 'Refresh Data',
                          'className' : 'custom-btn-refresh',
                          'text' : '<i class="fa fa-sync" style="margin-right: 4px;"></i> Refresh Data',
                          'action' : function ( e, dt, node, config ) {
                                          fill_datatable();
                                      }
                      };
                    
          buttonx.unshift(btnrefresh);

          var dataTable = $('#' + datatableid).DataTable({
              dom: 'Bfrltip',
              destroy: true,
              lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'ALL']],
              buttons: buttonx,
              processing: true,
              language: {processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
              serverSide: true,
              ajax:{  
                      url: xUrl,
                  //     data:{menuid:xmenuid, fdate1:xfdate1, fdate2:xfdate2, fgudang:xfgudang },
                      data:xdata,
                      dataType:"json",
                      dataFilter: function(response){
                              return response;
                          },
                      },
              columns:Xcolumns,
              "footerCallback": function (row, data, start, end, display) {
                      var api = this.api();
      
                      // Remove the formatting to get integer data for summation
                      var intVal = function (i) {
                          return typeof i === 'string' ?
                              i.replace(/[\$,]/g, '') * 1 :
                              typeof i === 'number' ?
                              i : 0;
                      };
      
                      // // Total over all pages
                      // total = api
                      //     .column(6)
                      //     .data()
                      //     .reduce(function (a, b) {
                      //         return intVal(a) + intVal(b);
                      //     }, 0);
      
                      // Total over this page

                      for (i=0; i < xNative.length ; i++){
                          switch (xNative[i]){
                              case 'NEWDECIMAL':
                                  pageTotal = api
                                              .column(i, {
                                                  page: 'current'
                                              })
                                              .data()
                                              .reduce(function (a, b) {
                                                  return intVal(a) + intVal(b);
                                              }, 0);
                          
                                  // Update footer
                                  $(api.column(i).footer()).html(formatNumber(pageTotal));
                              break;
                          }

                      }
                  }                    
          });
        }