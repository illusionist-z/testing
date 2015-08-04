/**
 * @author David
 * @desc   Pagination to json data as html
 * @type json
 */
var Paging = {
  Pager : function (){
      this.perpage = 3;
      this.currentpage = 1;
      this.pagingcontainer = 'tbody';
      //get average page number
      this.numPages = function() {
	       var numPages = 0;
	        if (this.para != null && this.perpage != null) {
	            numPages = Math.ceil(this.para.length / this.perpage);
	        }	         
	        return numPages;
	    };
	//show page on click 
	    this.showPage = function(page) {                
	        this.currentpage = page;
	        var html = '';                
	        this.para.slice((page-1) * this.perpage,
	            ((page-1)*this.perpage) + this.perpage).each(function() {
	            html += '<tr>' + $(this).html() + '</tr>';
	        });
	 
	        $(this.pagingcontainer).html(html);	 
	        renderControls( this.currentpage, this.numPages());
	    }
	 //for pagination index 
	    var renderControls = function( currentPage, numPages) {
	        var pagingControls = '<ul class="pagination">';
	        for (var i = 1; i <= numPages; i++) {
	            if (i != currentPage) {
	                pagingControls += '<li><a href="#" onclick="pager.showPage(' + i + '); return false;">' + i + '</a></li>';
	            } else {
	                pagingControls += '<li><a>' + i + '</a></li>';
	            }
	        }	 
        pagingControls += '</ul>';            
            $('#content').html(pagingControls);
	    }           
  }
};