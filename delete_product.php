<?php

require"connectDB.php";
$id=$_GET['id'];
$query="DELETE FROM products WHERE id='$id'";
 $runQuery=mysqli_query($conn,$query);
//  $result=mysqli_fetch_assoc($runQuery)
if($runQuery){
    header("Location:allProducts.php");
}else{
    echo"Error";
}

?>