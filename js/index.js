    $("#AdminLogin").submit(function (e) {
        // stops from acutlly posting the post so we can use ajax insted
        e.preventDefault();

        var form = $(this);
        // posts a ajax call to form.php
        $.ajax({
            type: "POST",
            url: "loginAdmin.php",
            data: form.serialize(), // serializes the form's elements.
            //  when it is a sucsess so this with the data it got back
            success: function (data) {
                // it gets a JSON string back so we need to parse it
                //    var dataJSON = JSON.parse(data);
                if (data) {
                    location.href = 'account';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password or Username is wrong please try again',
                    })
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });
    $("#AdminRegister").submit(function (e) {
        // stops from acutlly posting the post so we can use ajax insted
        e.preventDefault();

        var form = $(this);
        // posts a ajax call to form.php
        $.ajax({
            type: "POST",
            url: "RegisterAdmin.php",
            data: form.serialize(), // serializes the form's elements.
            //  when it is a sucsess so this with the data it got back
            success: function (data) {
                // it gets a JSON string back so we need to parse it
                (data)
                if (data) {
                    location.href = 'account';
                }
            }
        });
    });
    $("#RegisterButton").click(function () {
        $("#usertext").text('User Register');
        $("#AdminLogin").hide();
        $("#RegisterButtonContainer").hide();
        $("#AdminRegister").show();
        $("#LoginButtonContainer").show();
    });

    $("#LoginButton").click(function () {
        $("#usertext").text('User Login');
        $("#AdminRegister").hide();
        $("#LoginButtonContainer").hide();
        $("#AdminLogin").show();
        $("#RegisterButtonContainer").show();
    });