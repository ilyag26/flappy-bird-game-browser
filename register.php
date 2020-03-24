<?php 
require "db.php";

$errors = array();

$data = $_POST;
if(isset($data['do_signup'])){

	$data['score']=0;
	$data['access_level']=1;
    $data['coins']=12;
    
	if(trim($data['login']) == ''){
		$errors[] = 'Не тупи, введи логин!';
	} 
	if($data['password'] == ''){
		$errors[] = 'Забыл про пароль!';
	} 
	if(trim($data['email']) == ''){
		$errors[] = 'А почту?';
	} 
	if($data['password_2'] != $data['password']){
		$errors[] = 'Твои пароли не совпадаю!';
	} 

	if(R::count('users', "login = ?", array($data['login'])) > 0){
		$errors[] = 'Бро, такой пользователь уже существует!';
	} 

	if(R::count('users', "email = ?", array($data['email'])) > 0){
		$errors[] = 'Эта почта занята!';
	} 

	if(empty($errors)){
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->score = $data['score'];
		$user->coins = $data['coins'];
		$user->access_level = $data['access_level'];
		$user->password = $data['password'];
		R::store($user);
		echo '<div style="color:green;"> Register successful</div>';
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
    <form action="/register.php" method="post">
  <h2>Регистрация</h2>
  <p>
      <label for="Email" class="floatLabel" >Логин</label>
      	<input type="text" name="login" value="<?php echo @$data['login']; ?>">
  </p>
		<p>
			<label for="Email" class="floatLabel" >Email</label>
			<input id ="email" type="email" name="email" placeholder="email"
				value=" <?php echo @$data['email']; ?> ">
		</p>
		<p>
			<label for="password" class="floatLabel">Пароль</label>
			<input type="password" name="password" placeholder="password">
		</p>
		<p>
			<label for="confirm_password" class="floatLabel">Повторите пароль</label>
			
				<input type="password" name="password_2" placeholder="password again">
		</p>
		<p>
		
			<input type="submit" value="Создать!" name="do_signup" id="submit">
				<button><a href="/login.php">Login</a></button>
			<button><a href="/index.php">Home</a></button>
		</p>
			<div style="color: red;" class="center">
		<span><?php 
		if(empty($errors)){
	} else {
		echo '<div style="color:red;">'.array_shift($errors).' </div>';
	}
		?>
	</span> 
</div>
		</form>

</body>
</html>