<?php
//db connectie
include 'conn.php';
session_start(); 
if($_SESSION["ID"]){
    header("Location: account");
}
?>
<!DOCTYPE html>
<html>
<?php include_once "head.php";?>
    <link rel="stylesheet" href="style/index-min.css">
<body>
<div class="svg-top">
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="1337" width="1337">
  <defs>
    <path id="path-1" opacity="1" fill-rule="evenodd" d="M1337,668.5 C1337,1037.455193874239 1037.455193874239,1337 668.5,1337 C523.6725684305388,1337 337,1236 370.50000000000006,1094 C434.03835568300906,824.6732385973953 6.906089672974592e-14,892.6277623047779 0,668.5000000000001 C0,299.5448061257611 299.5448061257609,1.1368683772161603e-13 668.4999999999999,0 C1037.455193874239,0 1337,299.544806125761 1337,668.5Z"/>
    <linearGradient id="linearGradient-2" x1="0.79" y1="0.62" x2="0.21" y2="0.86">
      <stop offset="0" stop-color="rgb(88,62,213)" stop-opacity="1"/>
      <stop offset="1" stop-color="rgb(23,215,250)" stop-opacity="1"/>
    </linearGradient>
  </defs>
  <g opacity="1">
    <use xlink:href="#path-1" fill="url(#linearGradient-2)" fill-opacity="1"/>
  </g>
</svg>
</div>
<div class="svg-bottom">
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="896" width="967.8852157128662">
  <defs>
    <path id="path-2" opacity="1" fill-rule="evenodd" d="M896,448 C1142.6325445712241,465.5747656464056 695.2579309733121,896 448,896 C200.74206902668806,896 5.684341886080802e-14,695.2579309733121 0,448.0000000000001 C0,200.74206902668806 200.74206902668791,5.684341886080802e-14 447.99999999999994,0 C695.2579309733121,0 475,418 896,448Z"/>
    <linearGradient id="linearGradient-3" x1="0.5" y1="0" x2="0.5" y2="1">
      <stop offset="0" stop-color="rgb(40,175,240)" stop-opacity="1"/>
      <stop offset="1" stop-color="rgb(18,15,196)" stop-opacity="1"/>
    </linearGradient>
  </defs>
  <g opacity="1">
    <use xlink:href="#path-2" fill="url(#linearGradient-3)" fill-opacity="1"/>
  </g>
</svg>
</div>

<section class="container">
  <section class="wrapper">
    <header>
      <div class="logo">
        <span>Logo</span>
      </div>
      <h1>Welcome</h1>
      <p id="usertext">User Login</p>
    </header>
    <section class="main-content">
      <form action="" id="AdminLogin" method="POST"  name="AdminLogin">
        <input type="text" name="username" id="username" placeholder="origin username" required>
        <div class="line"></div>
        <input type="password" name="password" id="password" placeholder="password" required>
        <button type="submit" name="verstuur">Login</button>
      </form>
    <form action="" id="AdminRegister" method="POST"  name="AdminRegister" style="display:none;">
        <input type="text" name="username" id="username" placeholder="origin username" required>
        <div class="line"></div>
        <input type="password" name="password" id="adminpassword" placeholder="password" required>
        <div class="line"></div>
        <input type="password" name="Rpassword" id="Rpassword" placeholder="password" required>
        <button type="submit" name="verstuur">Register</button>
      </form>
    </section>
    <footer>
      <p id="RegisterButtonContainer"><a id="RegisterButton" title="Register">Register</a></p>
      <p id="LoginButtonContainer" style="display:none;"><a id="LoginButton" title="Register">Login</a></p>
    </footer>
  </section>
</section>
    <script>
        $("#AdminLogin").submit(function(e) {
            // stops from acutlly posting the post so we can use ajax insted
            e.preventDefault(); 

            var form = $(this);
               // posts a ajax call to form.php
            $.ajax({
                type: "POST",
                url: "loginAdmin.php",
                data: form.serialize(), // serializes the form's elements.
                //  when it is a sucsess so this with the data it got back
                success: function(data)
                {
                    // it gets a JSON string back so we need to parse it
                //    var dataJSON = JSON.parse(data);
                    if(data){
                        location.href = 'account';
                    }else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Password or Username is wrong please try again',
                        })
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        });
        $("#AdminRegister").submit(function(e) {
            // stops from acutlly posting the post so we can use ajax insted
            e.preventDefault(); 

            var form = $(this);
               // posts a ajax call to form.php
            $.ajax({
                type: "POST",
                url: "RegisterAdmin.php",
                data: form.serialize(), // serializes the form's elements.
                //  when it is a sucsess so this with the data it got back
                success: function(data)
                {
                    // it gets a JSON string back so we need to parse it
                    (data)
                    if(data){
                        location.href = 'account';
                    }
                }
            });
        });
        $( "#RegisterButton" ).click(function() {
          $("#usertext").text('User Register');
          $( "#AdminLogin" ).hide();
          $( "#RegisterButtonContainer" ).hide();
          $( "#AdminRegister" ).show();
          $( "#LoginButtonContainer" ).show();
        });

        $( "#LoginButton" ).click(function() {
          $("#usertext").text('User Login');
          $( "#AdminRegister" ).hide();
          $( "#LoginButtonContainer" ).hide();
          $( "#AdminLogin" ).show();
          $( "#RegisterButtonContainer" ).show();
        });

    </script>
</body>
</html>