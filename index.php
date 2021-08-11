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
  <?php include_once 'background.php'?>
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
        <form action="" id="AdminLogin" method="POST" name="AdminLogin">
          <input type="text" name="username" id="username" placeholder="origin username" required>
          <div class="line"></div>
          <input type="password" name="password" id="password" placeholder="password" required>
          <button type="submit" name="verstuur">Login</button>
        </form>
        <form action="" id="AdminRegister" method="POST" name="AdminRegister" style="display:none;">
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
  <script src="js/index-min.js"></script>
</body>

</html>