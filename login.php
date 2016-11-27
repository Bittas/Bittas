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
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>BitTas Login & Sign Up </title>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">  
  <link rel="stylesheet" href="css/login.css">  
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
      <label>Email
        <input type="email"/>
      </label>
	  <label>No
        <input type="text"/>
      </label>
      <label>Password
        <input type="password"/>
      </label>
      <label>Confirm password
        <input type="password"/>
      </label>
      <input type="submit"/>
    </div>
  </div>
</div>
  
    <script src="js/login.js"></script>

</body>
</html>
<?php ob_end_flush();?>