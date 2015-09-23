// selects all the divs of class='sample',hides them, finds the first, and shows it
$('div.sample').hide().first().show();

// binds a click event-handler to a elements whose class='display'
$('a.display').on('click', function(e) {
    // prevents the default action of the link
    e.preventDefault();

    // assigns the currently visible div.sample element to a variable
    var that = $('div.sample:visible'),
        // assigns the text of the clicked-link to a variable for comparison purposes
        t = $(this).text();

    // checks if it was the 'next' link, and ensures there's a div to show after the currently-shown one
    if (t == 'NEXT' && that.next('div.sample').length > 0) {
        // hides all the div.sample elements
        $('div.sample').hide();

        // shows the 'next'
        that.next('div.sample').show()
    }
    // exactly the same as above, but checking that it's the 'prev' link
    // and that there's a div 'before' the currently-shown element.
    else if (t == 'PREV' && that.prev('div.sample').length > 0) {
        $('div.sample').hide();
        that.hide().prev('div.sample').show()
    }
});

$(document).ready(function () {

    // ユーザーのクリックした時の動作。


    $('#btnEditInfo').click(function () {
        //document.getElementById('txtname').disabled=false;
        document.getElementById('btn_savedetail').disabled=false;
        document.getElementById('txtbsalary').disabled=false;
        document.getElementById('txtbsalary').disabled=false;
        document.getElementById('txtovertimerate').disabled=false;
        document.getElementById('txtallowance').disabled=false;
    });

    $("#btn_savedetail").click(function () {
       $member_id=document.getElementById('member_id').value; 
       $b_salary=document.getElementById('txtbsalary').value;
       $overtime_rate=document.getElementById('txtovertimerate').value;
       $specific_deduce=document.getElementById('txtallowance').value;
       if($specific_deduce=="")
       {
         window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+$b_salary+'/'+$overtime_rate+'/0/'+$member_id;  
       }
       else{
       window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+$b_salary+'/'+$overtime_rate+'/'+$specific_deduce+'/'+$member_id;
        }
    });
   
});
