
$(document).ready(function () {

   $('#search_salary').click(function(){     
       var $form = $('#search_frm').serialize();
        alert("aaaa");
        window.location.href = baseUri + 'salary/search?'+$form;
    })
});
