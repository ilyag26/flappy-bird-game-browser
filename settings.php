<?php  
require "db.php";



$errors = array();
$data = $_POST;
$logged_user_login = $_SESSION['logged_user']->login;


if(isset($data['apply'])){
	$user = R::findOne('users', 'login = ?', array($logged_user_login));

	
	if($data['new_login'] == ''){
		$errors[] = 'Enter new login';
	} 
	
	if($user['login'] != $logged_user_login){
		$errors[] = 'Not found user';
	} 
	if(R::count('users', "login = ?", array($data['new_login'])) > 0){
		$errors[] = 'User alredy created';
	}
	if(password_verify($data['password'], $user->password)){
		
	}else{
		$errors[] = 'Incorrext password';
	}
	


	if(empty($errors)){
		$user->login=$data['new_login'];
		$_SESSION['logged_user']->login=$data['new_login'];
		R::store( $user );

	} 
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Settings</title>
	 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="style_index.css">
</head>
<body>

	<?php if(isset($_SESSION['logged_user'])) :	?>

 	<div class="container " tyle="text-align:center;">
      <div class="row" style="margin:20px auto;margin-left:-600px">
    <div class="col">
    </div>
    <div class="col">
  <nav>
    <ul>
      <li><a href="/index.php" style="color:white">Home</a></li>
    </ul>
  </nav>
    </div>
  </div>

		<form action="/settings.php" method="POST">
			<div class="center_set">
				Изменить логин
				<div class="rename"> 
					Введите логин на который хотите изменить<input type="text" name="new_login"></span>
				</div>
				<div class="rename"> 
					Введите ваш пароль для проверки вашей личности <input type="password" name="password"> 
				</div>
			</div>
			<button style="margin-right: 50%; margin-left: 50%;" type="submit" name="apply">Apply
			</button>
		</form>
		<?php 
		if(empty($errors)){
		} else {
			echo '<div style="color:red;">'.array_shift($errors).' </div>';
		}
		?>


		<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->




		<?php 	
		$errors1 = array();
		$data = $_POST;
		$logged_user_login = $_SESSION['logged_user']->login;
		$logged_user_password = $_SESSION['logged_user']->password;


		if(isset($data['apply1'])){
			$user = R::findOne( 'users', ' login = ? ', array($logged_user_login));

			if($data['password'] == ''){
				$errors1[] = 'Enter password';
			} 
			if($data['new_password'] == ''){
				$errors1[] = 'Enter new password';
			} 
			if(password_verify($data['password'], $user->password)){

			}else{
				$errors1[] = 'Incorrext password';
			}
			if($data['password']==$data['new_password']){
				$errors1[] = 'Enter new password';
			}

			if(empty($errors)){
				$user->password=password_hash($data['new_password'], PASSWORD_DEFAULT);
				$_SESSION['logged_user']->password=password_hash($data['new_password'], PASSWORD_DEFAULT);
				R::store( $user );
			} 


		}
		?>
		<hr style="background-color:white;">
		<form action="/settings.php" method="POST">
			<div class="center_set">
				Изменить пароль
				<div class="rename"> 
					Введите ваш настоящий пароль <input type="password" name="password"> <span style="color: black"></span>
				</div>
				<div class="rename"> 
					Введите пароль на который хотите изменить<input type="password" name="new_password"></span>
				</div>
			</div>
			<button style="margin-right: 50%; margin-left: 50%;" type="submit" name="apply1">Apply
			</button> 
		</form>
		<?php
		if(empty($errors1)){
		} else {
			echo '<div style="color:red;">'.array_shift($errors1).' </div>';
		}
		?>


</div>
 	
 	<?php else :  ;?>
 	 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Settings</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 		<link rel="stylesheet" href="style_index.css">

 </head>
 <body>
 	<div class="container ">
      <div class="row" style="margin:20px auto;margin-left:-600px">
    <div class="col">
    </div>
    <div class="col">
  <nav>
    <ul>
      <li><a href="/login.php" style="color:white">Войти</a></li>
      <li><a href="/register.php" style="color:white">Зарегистрироваться</a></li>
      <li><a class="logout" href="#" style="color:white">О нас</a></li>
    </ul>
  </nav>
    </div>
  </div>
</div>

 	<div class="bg">
 		<h1>Об игре</h1>
 		<hr style="width:50%;margin-top: -10px;"></hr>
 		<img src="img/1.PNG" width=200 height="300">
 		</div>
 		<div class="score">
		<h1>Рейтинг</h1>
	<hr style="width:50%;margin-top: -10px;"></hr><br>
<p>Войдите для просмотра</p>
</table>
 	</div>
 		

    <?php endif; ?>


 	

 	
 </body>
 </html>