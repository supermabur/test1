
;(function($)
{
	$.simplePlugin = function(element, options)
	{	
		var	plugin = this,
			$elm = $(element),
			defaults = {
				background: 'red',
				alert: true
			}
	
		var _init = function()
		{
			plugin.options = $.extend( {}, defaults, options );
			$elm.click(function(){
				console.log('gg');
				$(this).css('background-color', plugin.options.background);
			})
        }
        
		_init();
	}
	
	$.fn.changeBg = function(options) 
	{
		return this.each(function() 
		{
			if ($(this).data('changeBg') == undefined) {
				var plugin = new $.simplePlugin(this, options);
				$(this).data('changeBg', plugin);
			}
		});
	}
	
	$.fn.mstbarang = function(options) 
	{
		return this.each(function() 
		{
            var settings = $.extend({
                // These are the defaults.
                urlx:'',
                tokenx:''
            }, options );


            $(this).html("");

            var htmlx = "";
            htmlx = "<div class='form-group'>" ;
            htmlx += "  <label>Barang</label>";
            htmlx += "  <div class='input-group input-group-sm'>";
            htmlx += "      <input type='text' class='form-control' id='mstbaranginput'>";
            htmlx += "      <span class='input-group-append'>";
            htmlx += "          <button type='button' class='btn btn-info btn-flat mstbarangbtnadd'>+</button>";
            htmlx += "      </span>";
            htmlx += "  </div>";
            htmlx += "</div>";


            htmlx += "<div class='modal fade' id='mstbarangmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            htmlx += "  <div class='modal-dialog' role='document'>";
            htmlx += "    <div class='modal-content'>";
            htmlx += "      <div class='modal-header'>";
            htmlx += "        <h5 class='modal-title' id='exampleModalLabel'>Modal title x</h5>";
            htmlx += "        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            htmlx += "          <span aria-hidden='true'>&times;</span>";
            htmlx += "        </button>";
            htmlx += "     </div>";
            htmlx += "      <div class='modal-body'>";
            htmlx += "          <div class='table-responsive' id='mstbarangtable' width=100% style='margin-top: 10px;'>";
            htmlx += "              <table class='table display cell-border' id='user_table' width=100%>";
            htmlx += "              </table>";
            htmlx += "          </div>";
            htmlx += "      </div>";
            htmlx += "      <div class='modal-footer'>";
            htmlx += "        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            htmlx += "       <button type='button' class='btn btn-primary'>Save changes</button>";
            htmlx += "      </div>";
            htmlx += "    </div>";
            htmlx += "  </div>";
            htmlx += "</div>";      
            $(this).html(htmlx);


            $('.mstbarangbtnadd').click(function(){
                $('#mstbarangmodal').modal('show'); 
                console.log('datadata')
                $('#mstbarangtable').Datatable();
                // $('#mstbarangtable').Datatable({
                //     dom: 'lBfrtip',
                //     keys: true,
                //     processing: true,
                //     serverSide: true,
                //     ajax:{  
                //             url: "/databrowser",
                //             data:{datamenu:1},
                //             dataType:"json",
                //             dataFilter: function(response){
                //                     console.log(response);
                //                     var json = jQuery.parseJSON( response );
                //                     return response;
                //                 },
                //             success:function(data)
                //                 {
                //                     console.log(data);
                //                     return data;
                //                 },
                //             },
                //     // columns:Xcolumns
                // });
            });





            var inp = document.getElementById('mstbaranginput');
            inp.addEventListener("keypress", function(e){
                if (e.which == 13) {
                    e.preventDefault();
                    console.log(inp.value);

                    $.ajax({
                        url:settings.urlx,
                        method:"POST",
                        data: {datamenu:1},
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            alert(data.success);
                            // var html = '';
                            // if(data.errors)
                            // {
                            //     html = '<div class="alert alert-danger">';
                            //     for(var count = 0; count < data.errors.length; count++)
                            //     {
                            //     html += '<p>' + data.errors[count] + '</p>';
                            //     }
                            //     html += '</div>';
                            //     $('#form_result').html(html);
                            // }
                            // if(data.success)
                            // {
                            //     // $('#formx')[0].reset();
                            //     // $('#user_table').DataTable().ajax.reload();
                            //     alert(data.success);
                            //     // document.getElementById('btnback').click();
                            // }
                            // $('#saveBtn').html('Save changes');
                            // loading(0);
                        }
                    })


                }
             })            

        });
        


        
	}

})(jQuery)