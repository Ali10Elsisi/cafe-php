<?php


 require"config.php";


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
                
                    <a class="me-5 nav-link text-light" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <h1 class="text-center text-danger m-3 "> Add User</h1>
    <form class="container" method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" required name="username">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" required name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputConfirmPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputConfirmPassword1" required name="confirmPassword">
        </div>
        <div class="mb-3">
            <label for="exampleInputRoomNo" class="form-label">Room No</label>
            <input type="text" class="form-control" id="exampleInputRoomNo" required name="rommno">
        </div>
        <div class="mb-3">
            <label for="exampleInputExt" class="form-label">EXT.</label>
            <input type="text" class="form-control" id="exampleInputExt" required name="ext">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Profile Picture</label>
            <input class="form-control" type="file" id="formFile" required name="profilepicture">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <button type="reset" class="btn btn-info">Reset</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>




<?php
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $rommno=$_POST['rommno'];
    $ext=$_POST['ext'];
    $img=$_FILES['profilepicture'];
    $imgName=$img['name'];
    $imgtype=$img['type'];
    $imgTmpName=$img['tmp_name'];
    $imgError=$img['error'];
    $imgSiza=$img['size'];
    $imgSizemb=$imgSiza/(1024**2);
    $extan=pathinfo($imgName,PATHINFO_EXTENSION);
    $errors=[];

    if($imgError>0){
    $errors[]="There is erreo while uploading";
    }elseif(!in_array($extan,['jpg','png','gif','jpeg'])){
        $errors[]="File must be images";
    }elseif($imgSizemb  >1){
        $errors[]="images must less than 1 mb";
    }
//     if(empty($username)){
// $errors[]="UserName is Required";
//     }elseif(is_numeric($username) || ! is_string($username)){

//         $errors[]="Name must be String";
//     }elseif(strlen($username)< 5 || strlen($username)>10){
//         $errors[]="min length is 5 and max length is 10";
//     }

//     if(empty($email)){
//         $errors[]="email is Required";
//             }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        
//                 $errors[]="Name must be Email";
//             }
//             if(empty($password)){
//                 $errors[]="Password is Required";
//             }elseif(strlen($password)< 8 || strlen($password)>30){
//                 $errors[]="min length is 8 and max length is 30";
//             }
//             if(empty($rommno)){
//                 $errors[]="Room No is Required";
//             }elseif(!is_numeric($rommno)){
//                 $errors[]="Room No Must Be Number";
//             }
//             if(empty($ext)){
//                 $errors[]="EXT is Required";
//             }elseif(!is_numeric($ext)){
//                 $errors[]="EXT Must Be Number";
//             }

    if(empty($errors)){
    $randStr=uniqid();
    $imgNewName="$randStr.$extan";
    $folder="uploads/$imgNewName";
    move_uploaded_file($imgTmpName,$folder);


    }
    else{
        print_r($errors);
    }
    
    $query="INSERT INTO `users`(username,email,password,Ext,image,RoomNo) VALUES ('$username','$email','$password','$ext','$folder','$rommno')";
    $runQuery=mysqli_query($con,$query);
    if($runQuery){
        header("Location:allUsers.php");
    }else{
        echo"Error";
    }
    
    }
    




?>