<?php

require"config.php";
$id=$_GET['id'];
$id=$_GET['id'];
 $query="DELETE FROM users WHERE id='$id'";
 $runQuery=mysqli_query($con,$query);
//  $total=mysqli_num_rows($runQuery);
//  $result=mysqli_fetch_assoc($runQuery)
if($runQuery){
    header("Location:allUsers.php");
}else{
    echo"Error";
}

?>