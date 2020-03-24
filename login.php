<?php
require "db.php";

$data = $_POST;

if(isset($data['do_login']))
{
	$errors = array();
	
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if($user){
		if($data['password']=== $user->password||password_verify($data['password'], $user->password)){
			echo '<script>window.location.href = "index.php";</script>';
			$_SESSION['logged_user'] = $user;
		} else {
			$errors[]='incorrect password';
		} 
	}else {
		$errors[]='incorrect login';
	} 
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="style_reg.css">
</head>
<body>
     <form action="/login.php" method="post">
  <h2>Войди в аккаунт!</h2>
  <p>
      <label for="Email" class="floatLabel" >Твой Логин</label>
      		<input type="text" name="login">
  </p>
		<p>
			<label for="Email" class="floatLabel" >Твой пароль!</label>
			<input type="password" name="password" placeholder="password">
		</p>
	
		<p>

			<button><a href="/register.php">Регистрация</a></button>
			<button type="submit" name="do_login">Войти</button>
			<button><a href="/index.php">Главная</a></button>
	</p>
		</div>

	<div style="color: red;" class="center">
		<span>
			<?php 
			if( empty($errors)){

			}else{
				echo '<div style="color:red;">'.array_shift($errors).' </div>';
			}
			?>
		</span> 
	</div>  
		</form>
</body>
</html>