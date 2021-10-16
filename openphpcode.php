<?php
$url = 'https://flappy-bird-game-browser.000webhostapp.com/';
$str = file($url);
foreach($str as $num_str => $stro) :
    echo "Line #<b>($num_str)</b>: ".htmlspecialchars($stro)."<hr>\n";
    endforeach;
    ?>