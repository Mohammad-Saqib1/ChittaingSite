<?php

include 'db_connect.php';
$room=$_POST['room'];
$sql="SELECT msg,stime,ip FROM msgs WHERE room='$room'";

$res="";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($rows=mysqli_fetch_assoc($result)){
        $res=$res. '<div class="container">';
        //$res=$res. $rows['ip'];
        $res=$res.$rows['msg'];
        $res=$res.'</p> <span class="time-right">'   .$rows["stime"] . '</span></div>';
    }
}
echo $res;


?>