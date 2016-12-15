<?php
    ob_start();
    require_once("include/config.php");
    require_once("include/function.php");
    sessionKontrolIndexPage();
	$sonuc="";
	if(@$_POST["giris"])
	{
		$email =@$_POST["email"];
		$parola =@$_POST["parola"];
        
		
		$sonuc=girisYap($email,$parola);
	}
  if (@$_POST["kaydol"]) {
    $email =@$_POST["email"];
    $parola =@$_POST["parola"];
    $no=@$_POST["no"];
    $sonuc=kaydol($email,$parola,$no);
  }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>BitTas Login & Sign Up </title>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">  
  <link rel="stylesheet" href="css/login.css">  
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
</head>

<body>
<div class="panel">
  <ul id="menu" class="panel__menu">
    <hr/>
    <li id="signIn"> <a href="#">Login</a></li>
    <li id="signUp"><a href="#">Sign up</a></li>
  </ul>
  <div class="panel__wrap">
  
    <div id="signInBox" class="panel__box active">
	<form method="post">
      <label>Email
	  	<input type="email"   name="email" placeholder="E-mail" required/> 
      </label>
      <label>Password
	  	<input type="password" class="giris" name="parola" placeholder="parola" required/> 
       </label>
      <input type="submit" name="giris" value="Giriş" id="btngiris"/>
	  </form>
    </div>
    <div id="signUpBox" class="panel__box">
    <form method="post">
      <label>Email
        <input type="email" name="email" id="email" placeholder="E-mail" required />
      </label>
    <label>No
        <input type="text" name="no" id="no" placeholder="No" required />
      </label>
      <label>Password
        <input type="password" name="parola" id="parola" placeholder="Parola" required/>
      </label>
      <label>Confirm password
        <input type="password" name="parolaTekrar" id="parolaTekrar" placeholder="Parola tekrar" required />
      </label>
      <input type="submit" name="kaydol" value="Kaydol" id="btnKaydol" />
    </form>
    </div>
  </div>
</div>
  
    <script src="js/login.js"></script>
    <script type="text/javascript">
        $("#btnKaydol").click(function () {
            debugger;
            var email = $('#email').val();
            var no = $('#no').val();
            var parola = $('#parola').val();
            var parolaTekrar = $('#parolaTekrar').val();
            if (parola == "" || parolaTekrar=="" || email=="" || no=="") {
              alert("Boş alanları doldurun");
                return false;
            } else if (parola != parolaTekrar) {
              alert("Parolalar aynı değil");
                return false;
            }
            else {
                return true;
            }
        });
    </script>
</body>
</html>
<?php ob_end_flush();?>