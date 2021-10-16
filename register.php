<?php 
$code = 9594;
require "db.php";
$errors = array();
 $check=false;
$data = $_POST;
if(isset($data['do_signup'])){
    if(R::count('users', "email = ?", array($data['email'])) > 0){
		$errors[] = 'Эта почта занята!';
	} else{

if($data['code1']==9594){
    $data['score']=0;
	$data['access_level']=1;
    $data['coins']=12;
    
	if(trim($data['login']) == ''){
		$errors[] = 'Логин - введите его!';
	} 
	if($data['password'] == ''){
		$errors[] = 'Забыли про пароль!';
	} 
	if(trim($data['email']) == ''){
		$errors[] = 'А почту?';
	} 
	if($data['password_2'] != $data['password']){
		$errors[] = 'Ваши пароли не совпадаю!';
	} 

	if(R::count('users', "login = ?", array($data['login'])) > 0){
		$errors[] = 'Такой пользователь уже существует!';
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
		echo '<div style="color:green;">Аккаунт создан успешно!</div>';
	} 
}else{
    $check=true;
}
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
      <label for="Email" class="floatLabel" >Ваш Instagram Логин</label>
      	<input type="text" name="login" value="<?php echo @$data['login']; ?>">
  </p>
		<p>
			<label for="Email" class="floatLabel" >Email</label>
			<input id ="email" type="email" name="email" placeholder="email"
				value=" <?php echo @$data['email']; ?> ">
		</p>
		<p>
			<label for="password" class="floatLabel">Пароль</label>
			<input type="password" value=" <?php echo @$data['password']; ?> " name="password" placeholder="password">
		</p>
		<p>
			<label for="confirm_password" class="floatLabel">Повторите пароль</label>
			
				<input type="password" value=" <?php echo @$data['password_2']; ?> " name="password_2" placeholder="password again">
		</p>
		<p>
		<input  class="btn btn-dark" type="submit" value="Создать" name="sab" required="required">
				<button><a href="/login.php">Login</a></button>
			<button><a href="/index.php">Home</a></button>
		</p>
			<div style="color: red;" class="center">
			    <?php
$urok="Подтверждение почты";

error_reporting( E_ERROR );  

if (isset($_POST['login']))   {$name1   = $_POST['login'];  if ($name1 == '') {unset($name1);}}
if (isset($_POST['email']))  {$email  = $_POST['email'];  if ($email == '') {unset($email);}}
if (isset($_POST['sposob']))  {$sposob  = $_POST['sposob'];  if ($sposob == '') {unset($sposob);}}
if (isset($_POST['sab']))   {$sab   = $_POST['sab'];  if ($sab == '')  {unset($sab);}}

if (isset($name1) ) {
$name1=stripslashes($name1);
$name1=htmlspecialchars($name1);
}
if (isset($email) ) {
$email=stripslashes($email);
$email=htmlspecialchars($email);
}
$address2=$email;
$note_text="$urok \r\n Ваш код доступа - $code";
if (isset($name1)  &&  isset ($sab) ) {
mail($address2,$urok,$note_text,"Content-type:text/plain; windows-1251"); 
// message
echo "<p style=''>
Уважаемый, <b>$name1</b>, на вашу почту был отправлен код доступа, введити его в поле ниже<br> 
<input type='text' name='code1' placeholder='code'>
-<b><input type='submit' value='Поддтвердить!' name='do_signup' id='submit'><b>";
}

?>
		<span><?php 
		if(empty($errors)){
	} else {
		echo '<div style="color:red;">'.array_shift($errors).' </div>';
	}
	if($check==true){
	    echo "<b>Код подтверждения не верный</b>";
	}
		?>
	</span> 
</div>
		</form>

</body>
</html>