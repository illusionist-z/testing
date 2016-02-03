var forgot = {
    checkmail: function (email) {
        $.ajax({
            url: 'checkmail',
            method: 'GET',
            data: {email: email},
            success: function (d) {
               
                data = JSON.parse(d);

                if (data === 'success') {
                    window.location.href = baseUri + 'auth/index/resetpassword?email=' + email;
                } else {
                    $('#emailerror').hide();
                    $('#noemailerror').show();
                    $('#emailaddress').val('');
                }
            }

        });
    },
    sendemail: function (email) {
        $.ajax({
            url: 'sendtomail',
            method: 'GET',
            data: {email: email},
            success: function (d) {
                data = JSON.parse(d);
                if (data === 'success') {
                    window.location.href = baseUri + 'auth/index/sendmail?email=' + email;
                } else {
                    alert("Please check your connection,Try again");
                }
            }
        });
    },
    checkcode: function (code, email) {
        $.ajax({
            url: 'checkcode',
            method: 'GET',
            data: {code: code, email: email},
            // dataType: 'json',
            success: function (c) {
                data = JSON.parse(c);
                if (data === 'success') {
                    window.location.href = baseUri + 'auth/index/newpassword?email=' + email;
                } else {
                    $('#codeerror').hide();
                    $('#checkcodeerror').show();
                }
            }
        });
    },
    // for change password
    changenewpass: function (fnp, email) {
        $.ajax({
            url: 'changepassword',
            method: 'GET',
            data: {fnp: fnp, email: email},
            // dataType: 'json',
            success: function (e) {
                data = JSON.parse(e);
                if (data == 'success') {
                    window.location.href = baseUri + 'auth';
                } else {
                    $('#codeerror').hide();
                    $('#checkcodeerror').show();
                }
            }

        });
    }
};


$(document).ready(function () {
    //for check box
    $("#show").click(function () {
        var show = document.getElementById('show');
        if (show.checked) {
            var fnp = document.getElementById('forgotnewpassword').value;
            var fcp = document.getElementById('forgotcomfirmpassword').value;
            document.getElementById('shownewpassword').value = fnp;
            document.getElementById('showconfirmpassword').value = fcp;
            $('#showpassword').show();
            $('#showconpassword').show();
            $('#hidepassword').hide();
            $('#hideconpassword').hide();
        } else {
            var snp = document.getElementById('shownewpassword').value;
            var scp = document.getElementById('showconfirmpassword').value;
            document.getElementById('forgotnewpassword').value = snp;
            document.getElementById('forgotcomfirmpassword').value = scp;

            $('#hidepassword').show();
            $('#hideconpassword').show();
            $('#showpassword').hide();
            $('#showconpassword').hide();

        }
    });
    $("#btngo").click(function () {
        var email = document.getElementById('emailaddress').value;
        if (email == '') {
            $('#emailerror').show();
            $('#noemailerror').hide();
        } else {
            forgot.checkmail(email);
        }
    });

    //for continue button of sendmail
    $("#btncontinue").click(function () {

        var email = document.getElementById('emailaddress').value;
        var code = document.getElementById('code').value;
        if (code == '') {
            $('#codeerror').show();
            $('#checkcodeerror').hide();
        }
        else {
            forgot.checkcode(code, email);
        }
    });

    //for btnemail of resetpassword
    $("#btnemail").click(function () {
        var email = document.getElementById('emailaddress').value;
        forgot.sendemail(email);
    });

    //for check new password of new password
    $("#btnnewpass").click(function () {
        var email = document.getElementById('emailaddress').value;
        var fnp = document.getElementById('forgotnewpassword').value;
        var fcp = document.getElementById('forgotcomfirmpassword').value;
        if (fnp == '' && fcp == '') {
            $('#newpasserror').hide();
            $('#passlong').hide();
            $('#newpassempty').show();
        }
        else {
            if (fnp != fcp) {
                $('#newpassempty').hide();
                $('#passshort').hide();
                $('#newpasserror').show();
            }
            else {
                if (fnp.length < 6) {
                    $('#passshort').show();
                    $('#newpassempty').hide();
                    $('#newpasserror').hide();
                } else {
                    if (fnp.length > 16) {
                        $('#passlong').show();
                        $('#passshort').hide();
                        $('#newpassempty').hide();
                        $('#newpasserror').hide();
                    }
                    else {
                        forgot.changenewpass(fnp, email);
                    }
                }

            }
        }

    });
});
