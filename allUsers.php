<?php

require"config.php";






$query="SELECT * FROM users";
$runQuery=mysqli_query($con,$query);
$total=mysqli_num_rows($runQuery);
// echo $total;
;
if($total!=0){
    ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafatria User</title>
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
    <h1 class="text-center">All Users</h1>

<a href="addUser.php" class="float-end">Add New User?</a>
<table class="table table-bordered border-primary container table-striped">
<thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Room No</th>
      <th scope="col">EXT</th>
      <th scope="col">Action</th>
    </tr>
  </thead>



    <?php
    while($result=mysqli_fetch_assoc($runQuery)){
    // echo $result['username']."".$result['RoomNo']."".$result['Ext']."<br>";

echo"<tr>
          <td>". $result['username']."</td>
          <td><img src='".$result['image']."' height='100px' wight='100px'></td>
          <td>". $result['RoomNo']."</td>
          <td>". $result['Ext']."</td>
          <td><a href='update_user.php?id=$result[id]'><input type='submit' value='Edit' class='btn btn-info'></input></a>
          <a href='delete_user.php?id=$result[id]'><input type='submit' value='Delete' class='btn btn-info'></input></a></td>
          </tr>";

        //   &username=$result[username]&image=$result[image]&roomno=$result[RoomNo]&ext=$result[Ext]
}
}else{
    header("Location:addUser.php");
}
// $con = mysqli_connect("localhost", "root","","cafee");

// // Check connection
// if (!$con) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// if(isset($_POST['submit'])){
// $username=$_POST['username'];
// $email=$_POST['email'];
// $password=$_POST['password'];
// $rommno=$_POST['rommno'];
// $ext=$_POST['ext'];
// $img=$_FILES['profilepicture'];
// $imgName=$img['name'];
// $imgtype=$img['type'];
// $imgTmpName=$img['tmp_name'];
// $imgError=$img['error'];
// $imgSiza=$img['size'];
// $imgSizemb=$imgSiza/(1024**2);
// $extan=pathinfo($imgName,PATHINFO_EXTENSION);
// $errors=[];

// if($imgError > 0){
// $errors[]="There is erreo while uploading";
// }elseif(!in_array($extan,['jpg','png','gif','jpeg'])){
//     $errors[]="File must be images";
// }elseif($imgSizemb  >1){
//     $errors[]="images must less than 1 mb";
// }


// if(empty($errors)){
// $randStr=uniqid();
// $imgNewName="$randStr.$extan";
// move_uploaded_file($imgTmpName,"uploads/$imgNewName");
// }
// else{
//     print_r($errors);
// }

// $query="INSERT INTO `users`(username,email,password,Ext,image,RoomNo) VALUES ('$username','$email','$password','$ext','$imgName','$rommno')";
// $runQuery=mysqli_query($conn,$query);
// if($runQuery){
//     echo $username."<br>";
//     echo $imgName;
// }else{
//     echo"Error";
// }

// }


?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>