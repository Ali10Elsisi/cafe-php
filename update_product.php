<?php


 require"config.php";
 $id=$_GET['id'];
 $query="SELECT * FROM products WHERE id='$id'";
 $runQuery=mysqli_query($con,$query);
 $result=mysqli_fetch_assoc($runQuery)

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cafatria Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Cafeteria&nbsp;&nbsp;<i class="fas fa-coffee"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="addUser.php">Users</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="addProduct.php">Products</a>
                    </li>
                </ul>
                <div class="d-flex ">
                <!-- <a class="me-2 nav-link text-light" href="profile.php"><i class="fa-solid fa-circle-user me-2"></i><?= $name?></a> -->
                    <a class="me-5 nav-link text-light" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <h1 class="text-center text-danger m-3"> Update Product</h1>
    <form class="container" method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputProductName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="exampleInputproductname" aria-describedby="productnameHelp" value="<?php echo $result['name']?>" required name="productname">
        </div>
        <div class="mb-3">
            <label for="exampleInputprice" class="form-label">Price</label>
            <input type="number" class="form-control" id="exampleInputprice" value="<?php echo $result['price']?>" required name="price">
        </div>
        <div class="mb-3">
            <label for="exampleInputExt" class="form-label">Category</label>
            <a href="" class="float-end">Add Category</a>
            <select class="form-select" aria-label="Default select example" name="category">
                <option selected>Hot Drinks</option> 
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

        </div> 
        <div class="mb-3">
            <label for="formFile" class="form-label">Product Picture</label>
            <input class="form-control" type="file" id="formFile" value="<?php echo$result['image']?>" required name="productpicture">
        </div>

        <button type="submit" class="btn btn-primary" name="updateproduct">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>

<?php
if(isset($_POST['updateproduct'])){
    $ProductName=$_POST['productname'];
    $Price=$_POST['price'];
    $Category=$_POST['category'];
    $img=$_FILES['productpicture'];
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

    if(empty($errors)){
        $randStr=uniqid();
        $imgNewName="$randStr.$extan";
        $folder="uploads/$imgNewName";
        move_uploaded_file($imgTmpName,$folder);
    
    
        }
        else{
            print_r($errors);
        }
        
        $query="UPDATE `products` set name='$ProductName',price='$Price',image='$folder' WHERE id='$id'";

        $runQuery=mysqli_query($con,$query);
        if($runQuery){
            header("Location:allProducts.php");
        }else{
            echo"Error";
        }
        
        }
        
    
    
    
    
    ?>