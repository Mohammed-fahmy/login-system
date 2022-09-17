<?php 
session_start();

if(isset($_SESSION['id'])){

    echo "<a href='logout.php'>logout</a>  " ."     well come your id is " . $_SESSION['id'] ;

       
}else{
   echo "you should <a href='signup.html'>signup</a> , if you have account <a href='login.php'>Login</a>";
}




 
// header("location:signup.html");

?>