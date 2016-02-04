$(document).ready(function () {
    document.getElementById('divId').style.display = 'none';
    document.getElementById('editinfo').style.display = 'none';

    $('#edit').on('click', function () {
        var content = $("#editinfo").html();
        $('#document').replaceWith('<div class="editinfo"  style="width: 36%;display: inline-block;float: right;margin-right: 62%;">' + content + '</div>');
        document.getElementById('save').disabled = false;
        document.getElementById('divId').style.display = '';
        document.getElementById('word-export').disabled;
    });

    jQuery(document).ready(function ($) {
        $("#word-export").on('click', function (event) {
            $("#letterhead").wordExport();
        });
    });

});

