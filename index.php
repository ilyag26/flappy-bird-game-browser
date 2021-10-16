<?php 
require "db.php";

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Flappy Stars</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 		<link rel="stylesheet" href="style_index.css">
 		<style>
.button1{
  border:1px solid black;
  font-size: 10px;
  float:right;
  background-color:white;
  color: black;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-right: 3%;
  padding:2% 5% ;
}
.button1:hover{
  box-shadow: 8px 5px white;
  transition: all .5s ease;
}
.col1{
    color:#FF47C5;
}
 		</style>
 </head>
 <body>

<?php if(isset($_SESSION['logged_user'])) :	?>
<div class="container" >
      <div class="row" style="margin:20px auto;margin-left:-410px">
    <div class="col">
      <span style="float:right;font-size:20px;">Level access: 
          <?php
$login=$_SESSION['logged_user']->login;
$servername = "localhost";
$username = "id11922656_root";
$password = "";
$dbname = "id11922656_users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `users` WHERE login='$login'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($row['access_level']<3){
             echo '<span style="color:white;font-size:20px;">' . $row['access_level'] . '</span>';
        }else{
             echo '<span style="color:purple;font-size:20px;">' . $row['access_level'] . '</span>';
        }
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?></span>
    </div>
    <div class="col">
        <nav>
    <ul>
      <li><a href="/settings.php" style="color:white">Настройки</a></li>
      <li><a class="logout" href="/logout.php" style="color:white">Выйти</a></li>
      <li style="color:white"><a href="#" style="color:white">О нас</a></li>
    </ul>
  </nav>
    </div>
  </div>
</div>
 		<div class="bg">
 		<h1> Ваш логин:<span style="color:green;
	text-align: center;"><?php echo $_SESSION['logged_user']->login; ?></span> 		    </h1>
 		<hr style="width:50%;margin-top: -10px;"></hr>
 		<div>
<img src="imgs/coins.png" width=50 height="50"> 
 		    <span> 
 <?php
$login=$_SESSION['logged_user']->login;
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM `users` WHERE login='$login'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
             echo '<span style="color:white;font-size:20px;margin-left:-5px;">' . $row['coins'] . '</span>';
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
 		    </span>
 		    <br>
 		</div>
 		</div>
 	<div class="score" style="padding:20px;">
		<h1>Рейтинг</h1>
	<hr style="width:50%;margin-top: -10px;"></hr><br>
	<table >
<tr>
    <td class="main">Имя:</td>
    <td class="main">Счет:</td>
</tr>
<?php
$servername = "localhost";
$username = "id11922656_root";
$password = "";
$dbname = "id11922656_users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
          if($row['access_level']<3){
         echo '<tr>
			     <td class="col">' . $row['login'] . '</td>
			     <td class="col" >' . $row['score'] . '</td>
			 </tr>';
        }else{
              echo '<tr>
			     <td class="col1">' . $row['login'] . '</td>
			     <td class="col1">' . $row['score'] . '</td>
			 </tr>';
        }
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
</table>
 	</div>
 	<a href="game.php" class="button1 clearfix">Играть!<br>- 2/3 монетки</a>
 	
 	<?php else :  ;?>
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
 		Играй с друзьями из инстаграма, зарабатывай деньги, бей рекорды!
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