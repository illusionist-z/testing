/**
 * @desc   Pagination to json data as html
 * @type json
 * @author David Jaw Hpan<david.gnext@gmail.com>
 */
var Paging = {
    /**
     * @single single paging in single page
     * @returns {html}
     */
    Pager : function(){
           //this.perpage=1,        
        //this.currentpage,
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
            var html;
            this.para.slice((this.currentpage - 1) * this.perpage,
                    ((this.currentpage - 1) * this.perpage) + this.perpage).each(function() {                        
                html += '<tr>' + $(this).html() + '</tr>';
            });
            $(this.pagingcontainer).html(html);
            renderControls(this.currentpage, this.numPages());
        };
        //for pagination index 
        var renderControls = function(currentPage, numPages) {
            $('.pagination').empty();
            $('#content').show();
            var nextpage = currentPage + 1,
                    prevpage = currentPage - 1;
            //var pageselect = '<select onchange="pager.showPage(parseInt(this.options[this.selectedIndex].value));return false;">';
            // paging index 
            if (0 == numPages) {
                var th_num = $('thead th').length;
                $('tbody').html("<tr><td colspan=" + th_num + "><center>No data to display</center></td></tr>");
            }
            else {
                var pagingControls = '<ul class="pagination" style="margin-left:15px;">';
                pagingControls += '<li><a href="#" onclick="pager.showPage(' + 1 + ');return false;">First</a></li>';
                // check total page number
                if (nextpage <= numPages) {
                    //pervious and next index
                    if (prevpage > 0) {
                        pagingControls += '<li><a href="#" onclick="pager.showPage(' + prevpage + ');return false;">Previous</a></li>';
                    }
                    pagingControls += '<li><a href="#" onclick="pager.showPage(' + nextpage + ');return false;">Next</a></li>';
                }
                else {
                    if (1 == numPages) {
                        $('#content').hide();      //paging disable
                    }
                    else {
                        pagingControls += '<li><a href="#" onclick="pager.showPage(' + prevpage + ');return false;">Previous</a></li>';
                    }
                }
                pagingControls += '<li><a href="#" onclick="pager.showPage(' + numPages + ');return false;">Last</a></li>';
                pagingControls += '<li><span class="btn" style="margin-left:20px;"> Page : ' + currentPage + ' in ' + numPages + '</span></li></ul>';
                $('#content').html(pagingControls);
            }
        };
    },    
    /**
     * @desc Multiple Paging in single page
     * @returns {html}
     */
    MultiPager: function() {        
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
            var html;
            this.para.slice((this.currentpage - 1) * this.perpage,
                    ((this.currentpage - 1) * this.perpage) + this.perpage).each(function() {                        
                html += '<tr>' + $(this).html() + '</tr>';
            });
            $(this.pagingcontainer).html(html);
            renderControls(this.currentpage, this.numPages(),this.content,this.currentpagerobject);
        };
        //for pagination index 
        var renderControls = function(currentPage, numPages,pagingcontainer,id) {
            $(pagingcontainer+' .pagination').empty();
            $(pagingcontainer+' .pagingcontent').show();
            this.currentPage = currentPage;
               this.nextpage = currentPage + 1;               
               this.numPages = numPages;
               this.prevpage = currentPage - 1;
              var th_num = $(pagingcontainer+' thead th').length;
            //var pageselect = '<select onchange="pager.showPage(parseInt(this.options[this.selectedIndex].value));return false;">';
            // paging index 
            if (0 === this.numPages) {                
                $(pagingcontainer+' tbody').html("<tr><td colspan=" + th_num + "><center>No data to display</center></td></tr>");
            }
            else {
                var pagingControls = '<ul class="pagination" style="margin-left:15px;">';
                pagingControls += '<li><a href="#" onclick="'+id+'.showPage(' + 1 + ');return false;">First</a></li>';
                // check total page number
                if (this.nextpage <= this.numPages) {
                    //pervious and next index
                    if (this.prevpage > 0) {
                        pagingControls += '<li><a href="#" onclick="'+id+'.showPage(' + this.prevpage + ');return false;">Previous</a></li>';
                    }
                    pagingControls += '<li><a href="#" onclick="'+id+'.showPage(' + this.nextpage + ');return false;">Next</a></li>';
                }
                else {
                    if (1 == this.numPages) {
                        $(pagingcontainer+ ' .pagingcontent').hide();      //paging disable
                    }
                    else {
                        pagingControls += '<li><a href="#" onclick="'+id+'.showPage(' + this.prevpage + ');return false;">Previous</a></li>';
                    }
                }
                pagingControls += '<li><a href="#" onclick="'+id+'.showPage(' + this.numPages + ');return false;">Last</a></li>';
                pagingControls += '<li><span class="btn" style="margin-left:20px;"> Page : ' + this.currentPage + ' in ' + this.numPages + '</span></li></ul>';
                //appending to tfoot div 
                $(pagingcontainer+" tfoot").html("<tr class='pagingcontent'><td colspan=" + th_num + ">"+pagingControls+"</td></tr>");
            }
        };
    }
};
