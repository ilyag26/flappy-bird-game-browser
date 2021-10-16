<?php 
require "db.php";

?>
 
 <?php if(isset($_SESSION['logged_user'])):	?>
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
             $sdd=$row['coins'];
    }
} 

?>
<?php if($sdd>=3):	?>
<?php
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$query = $conn->prepare("SELECT * FROM `users` WHERE login='$login'"); // prepate a query
// $query->bind_param('i', $productId); // binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
$query->execute(); // actually perform the query
$result = $query->get_result(); // retrieve the result so it can be used inside PHP
$r = $result->fetch_array(MYSQLI_ASSOC);

// Check connection
            
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


              $sql3 = "UPDATE `users` SET coins=coins-3 WHERE login='$login'";
if (mysqli_query($conn, $sql3)) {
    echo " ";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" type="text/css" href="style/happystyles.css">
 <title>HappyStars</title>
 
 <style>
body{
    background-color:black;
}
#canvas{
	margin:20px;
    display: block;
	border:1px solid white;
	margin-left:auto;
	margin-right:auto;
}
#canvas2{
	margin:9px;
    display: block;
	border:1px white solid;
	border-radius:20px;
		margin-left:auto;
	margin-right:auto;
}
 </style>
</head>
<body>
 <canvas id="canvas" width="288" height="512"></canvas><br>
 <canvas id="canvas2" width="250" height="50"></canvas>
 <h1 id="h11" style="color:red;display:none;text-align:center;">Ты проиграл!<br>ХАХАХА</h1>
 <script>
 document.cookie = "bd = " + 0;
 //for db php
    var bd = 0;
         //set cvs options
    var cvs = document.getElementById("canvas");
    var ctx = cvs.getContext("2d");
    var cvs2 = document.getElementById("canvas2");
    var ctx2 = cvs2.getContext("2d");
    var gap = 95;
    
    //bird possition
    var x = 10;
    var y = 150;
    var grav = 0;
 
    	
    //create blocks
    var pipe=[];
    pipe[0]={
    	x: cvs.width,
    	y: 0
    }
    var move = 5;
    var chekgrav = 0;
    //set images
    var k = 0;
    var bird = new Image();
    var backg = new Image();
    var frontg = new Image();
    var pipeUp = new Image();
    var pipeBottom = new Image();
    var blackbg = new Image();
    var score = 0;
    var money = 0;
    var checkbird = 0;
    bird.src = "imgs/bird.png";
     bird.id = "iiii";
    backg.src = "imgs/bg.png";
    frontg.src = "imgs/fg.png";
    pipeUp.src = "imgs/pipeUp.png";
    pipeBottom.src = "imgs/pipeBottom.png";
    blackbg.src = "imgs/blackbg.png";
    
    //audio files
    var flyA = new Audio();
    var scoreA = new Audio();
    
    flyA.src = "audio/fly.mp3";
    scoreA.src = "audio/score.mp3";

    //If button press 
  function fun(){
     if(event.keyCode == '38'||event.which == 1||event.keyCode== '32'){
           document.cookie = "bd = " + 0;
           document.cookie = "score = " + 0;
           document.cookie = "money = " + 0;
          y -= move;
        
    }
     if(event.keyCode == '40'){
         
           y += move;
        
     }
  }
    document.addEventListener("mousedown",fun,false);
document.addEventListener("keydown",fun,false);
    var score = 0;
    var money = 0;
    //get images
    function draw(){

        ctx.drawImage(backg,0,0);
    	ctx2.drawImage(blackbg,0,0);
    	for(var i=0; i<pipe.length; i++){
    	ctx.drawImage(pipeUp,pipe[i].x,pipe[i].y);
    	ctx.drawImage(pipeBottom,pipe[i].x,pipe[i].y
    		+pipeUp.height + gap);
    
    	pipe[i].x--;
    
    	if(pipe[i].x == 125){
    		pipe.push({
    			x:cvs.width,
    			y:Math.floor(Math.random()*
    				pipeUp.height) -
    			 pipeUp.height
    			});
    	       }

    if(x+bird.width >= pipe[i].x
    	&& x<=pipe[i].x+pipeUp.width
    	&&(y<=pipe[i].y + pipeUp.height
    	|| y + bird.height >= pipe[i].y +pipeUp.height +gap)|| y + bird.height >= cvs.height - frontg.height){
    	document.cookie = "k = " + 1;
  document.cookie = "bd = " + 1;

       document.getElementById("canvas").style.display="none";
  
   document.getElementById("canvas2").style.display="none";
   document.getElementById("h11").style.display="block";
  location.href = 'https://flappy-bird-game-browser.000webhostapp.com/';
  
 



    }
            if (pipe[i].x == 4) {
                score++;
                money++;
                chekgrav++;
                move=move+2;
                if(chekgrav == 2){
                    grav=grav+0.7;
                }
                
document.cookie = "score = " + score;
document.cookie = "money = " + money;
console.log(document.cookie = money);
                scoreA.play();
            }

        }

    	ctx.drawImage(frontg,2,cvs.height - frontg.height);
        ctx2.fillStyle= "white";
        ctx2.font = "24px Verdana";
        ctx2.fillText("     Score: "+score,25,20);

    	ctx.drawImage(bird,x,y);
    y += grav;
    	requestAnimationFrame(draw);
    	
    }




    pipeBottom.onload = draw;


 </script>
                 <?php
                 $coins= $_COOKIE['money'];
                 $ks = $_COOKIE['k'];
$value= $_COOKIE['score']; 
$bdcheck= $_COOKIE['bd']; 
$login=$_SESSION['logged_user']->login;
$servername = "localhost";
$username = "id11922656_root";
$password = "Zinkovw2";
$dbname = "id11922656_users";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$query = $conn->prepare("SELECT * FROM `users` WHERE login='$login'"); // prepate a query
// $query->bind_param('i', $productId); // binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
$query->execute(); // actually perform the query
$result = $query->get_result(); // retrieve the result so it can be used inside PHP
$r = $result->fetch_array(MYSQLI_ASSOC);

// Check connection
            
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if($bdcheck==1&&$value>$r['score']){
               $sql = "UPDATE `users` SET score='$value' WHERE login='$login'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
}
           }
           
              $sql2 = "UPDATE `users` SET coins=coins+$coins WHERE login='$login'";
if (mysqli_query($conn, $sql2)) {
    echo "Coins updated successfully";
}

mysqli_close($conn);   
          
?>

</body>
</html>
<?php else:  ?>
<body>
    
    <h1 style="color:black;text-align:center;"><a href="index.php" style="text-decoration:none;text-transform:uppercase;">Донать!</a></h1>
    
</body>

<?php endif; ?>
<?php else:  ?>
<body>
    
   <h1 style="color:black;text-align:center;"><a href="login.php" style="text-deca=oration:none;text-transform:uppercase;">Войди в аккаунт!</a></h1> 
    
</body>

<?php endif; ?>
  