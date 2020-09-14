
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
            console.log('qwe');
            $(this).html("");

            var htmlx = "";
            htmlx = "<div class='form-group'>" ;
            htmlx += "  <label>Barang</label>";
            htmlx += "  <div class='input-group input-group-sm'>";
            htmlx += "      <input type='text' class='form-control'>";
            htmlx += "      <span class='input-group-append'>";
            htmlx += "          <button type='button' class='btn btn-info btn-flat btnaddmstbarang'>+</button>";
            htmlx += "      </span>";
            htmlx += "  </div>";
            htmlx += "</div>";


            htmlx += "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            htmlx += "  <div class='modal-dialog' role='document'>";
            htmlx += "    <div class='modal-content'>";
            htmlx += "      <div class='modal-header'>";
            htmlx += "        <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>";
            htmlx += "        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            htmlx += "          <span aria-hidden='true'>&times;</span>";
            htmlx += "        </button>";
            htmlx += "     </div>";
            htmlx += "      <div class='modal-body'>";
            htmlx += "        ...";
            htmlx += "      </div>";
            htmlx += "      <div class='modal-footer'>";
            htmlx += "        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            htmlx += "       <button type='button' class='btn btn-primary'>Save changes</button>";
            htmlx += "      </div>";
            htmlx += "    </div>";
            htmlx += "  </div>";
            htmlx += "</div>";      
            $(this).html(htmlx);


            $('.btnaddmstbarang').click(function(){
                alert('owyeah');
                $('#exampleModal').modal('show'); 
            });

		});
	}

})(jQuery)