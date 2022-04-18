<?php

$roomname=$_GET['roomname'];
include 'db_connect.php';

$sql="SELECT * FROM `rooms` WHERE roomname='$roomname'";

$result=mysqli_query($conn,$sql);

if($result){
    if(mysqli_num_rows($result)==0){

        $message="This room does not exist.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatting";';
        echo '</script>';
    }
}else{
    echo "ERROR ".mysqli_error($conn);
}




?>

<!-- //chatroomcode -->


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Bootstrap core CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    
    <link href="css/product.css" rel="stylesheet">
  
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
    height:350px;
    overflow-y:scroll;
}
</style>
</head>
<body>


<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white  border-bottom box-shadow">
     <h5 class="my-0 mr-md-auto font-weight-normal">MyAnonymous.Com</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark right" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About</a>
        <a class="p-2 text-dark" href="#">Contact</a>
       
      </nav>
    
    </div>
<h2>Chat Messages <?php  echo $roomname;?></h2>

<div class="container">
    <div class="anyClass">

        
    </div>
</div>



<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<button class="btn btn-primary" name="submitmsg" id="submitmsg">Send</button>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>




<script type="text/javascript">

setInterval(runFunction,1000);
function runFunction(){
        $.post("htcont.php",{room:'<?php echo $roomname?>'},
        function(data,status){
            document.getElementsByClassName('anyClass')[0].innerHTML=data;
        })
    }




// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});


$("#submitmsg").click(function(){
    var clientmsg=$("#usermsg").val();

$.post("postmsg.php",{text:clientmsg,room:'<?php echo $roomname?>',ip:'<?php echo
 $_SERVER['REMOTE_ADDR']?>'},


function(data,status){
    document.getElementsByClassName('anyClass')[0].innerHTML=data;});

    $("#usermsg").val("");
    return false;

});


</script>
</body>
</html>