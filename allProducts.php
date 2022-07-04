<?php

require"config.php";






$query1="SELECT * FROM products";
$runQuery1=mysqli_query($con,$query1);
$total1=mysqli_num_rows($runQuery1);
// echo $total;
;
if($total1!=0){
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafatria Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="homeadmin.php">Cafeteria&nbsp;&nbsp;<i class="fas fa-coffee"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="allUsers.php">Users</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="allProducts.php">Products</a>
                    </li>
                </ul>
                <div class="d-flex ">
                <!-- <a class="me-2 nav-link text-light" href="profile.php"><i class="fa-solid fa-circle-user me-2"></i><?= $name?></a> -->
                    <a class="me-5 nav-link text-light" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <h1 class="text-center">All Product</h1>
<a href="addProduct.php" class="float-end">Add New Product?</a>
<table class="table table-bordered border-primary container table-striped">
<thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>



    <?php
    while($result1=mysqli_fetch_assoc($runQuery1)){
    // echo $result['username']."".$result['RoomNo']."".$result['Ext']."<br>";

echo"<tr>
          <td>". $result1['name']."</td>
          <td>". $result1['price']."</td>
          <td><img src='".$result1['image']."' height='100px' wight='100px'></td>
         
          <td><a href='update_Product.php?id=$result1[id]'><input type='submit' value='Edit' class='btn btn-info'></input></a>
          <a href='delete_product.php?id=$result1[id]'><input type='submit' value='Delete' class='btn btn-info'></input></a></td>
          </tr>";


}
}else{
    header("Location:addProduct.php");
}

// $conn = mysqli_connect("localhost", "root","","cafe");

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// if(isset($_POST['submit'])){
// $ProductName=$_POST['productname'];
// $Price=$_POST['price'];
// $Category=$_POST['category'];
// $img1=$_FILES['productpicture'];
// $imgName1=$img1['name'];
// $imgtype1=$img1['type'];
// $imgTmpName1=$img1['tmp_name'];
// $imgError1=$img1['error'];
// $imgSiza1=$img1['size'];
// $imgSizemb1=$imgSiza1/(1024**2);
// $extan1=pathinfo($imgName1,PATHINFO_EXTENSION);
// $errors1=[];

// if($imgError1 > 0){
// $errors1[]="There is erreo while uploading";
// }elseif(!in_array($extan1,['jpg','png','gif','jpeg'])){
//     $errors1[]="File must be images";
// }elseif($imgSizemb1  >1){
//     $errors1[]="images must less than 1 mb";
// }


// if(empty($errors1)){
// $randStr1=uniqid();
// $imgNewName1="$randStr1.$extan1";
// move_uploaded_file($imgTmpName1,"uploads/$imgNewName1");
// }
// else{
//     print_r($errors1);
// }

// $query1="INSERT INTO `products`(name,image,price) VALUES ('$ProductName','$imgName1','$Price')";
// $runQuery1=mysqli_query($con,$query1);
// if($runQuery1){
//     echo $ProductName1."<br>";
//     echo $imgName1;
// }else{
//     echo"Error";
// }

// }


?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>