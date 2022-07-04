<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

require_once "config.php";

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();



$sql = "SELECT p.image , p.name 
from products p, orders o , users u 
where p.id= o.product_id and u.id= o.user_id
ORDER BY o.orderdate desc limit 2 "; 
$result = $con->query($sql);
// $sqlall= "SELECT * FROM orders ORDER BY orderdate desc";
// $resultall = $con->query($sqlall);
   
$i = 0;
   
if (!empty($result) && $result->num_rows > 0) {  
  
    // Output data of each row
    $image_product= array();
    $name_product=array();
    while($row = $result->fetch_assoc()) {
        echo "<br>";  
        
           
        array_push($image_product,$row['image']); 
        array_push($name_product,$row['name']); 

    } 
}
else {
    echo "0 results";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cafeteria</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">
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
                        <a class="nav-link active" aria-current="page" href="#">My Orders</a>
                    </li>
                </ul>
                <div class="d-flex ">
                <a class="me-2 nav-link text-light" href="profile.php"><i class="fa-solid fa-circle-user me-2"></i><?= $name?></a>
                    <a class="me-5 nav-link text-light" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>



    <div class="content">
        <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3  col-xl-4 px-sm-2 px-0  border border-success rounded mt-2 ms-2 mb-5">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline text-dark">Make an order</span>
                </a>
                <input id=demoInput type=number min=0 >
                <button onclick="increment()">+</button>
                <button onclick="decrement()">-</button>
                <script>
                function increment() {
                    document.getElementById('demoInput').stepUp();
                }
                function decrement() {
                    document.getElementById('demoInput').stepDown();
                }
                </script> 
            </div>
        </div>
        <div class="col py-3 container">
            <h3 class="container" style="left=50%">Latest Order</h3>
            <div class="row align-items-center">
                <span class="col-lg-6" width="50%">
                    <img  src= "<?=$image_product[0]?>" width="200px" height="200px"></br>
                    <h2 class="mx-5"><?=$name_product[0]?></h2>
                </span>
                <span class="col-lg-6" width="50%" style="float=right">
                    <img  src= "<?=$image_product[1]?>" width="200px" height="200px"></br>
                    <h2 class="mx-5"><?=$name_product[1]?></h2>
                </span>
            </div>
            <hr style="border=1px solid black">
                 <?php


$sql3 = "SELECT id,name,image,price FROM products ORDER BY id  "; 
$result3 = $con->query($sql3);

   
$i = 0;
   
if (!empty($result3) && $result3->num_rows > 0) {  
  
    // Output data of each row

    $id_product=array();
    $images_product= array();
    $names_product=array();
    $price_product=array();
    while($row = $result3->fetch_assoc()) {
        echo "<br>";
        array_push($id_product,$row['id']);             
        array_push($images_product,$row['image']); 
        array_push($names_product,$row['name']); 
        array_push($price_product,$row['price']); 

    } 
}
else {
    echo "0 results";
}
                ?>              
    <h1 class="container-fluid" style="text-decoration=underline">Drinks</h1>            
    <div class="row align-items-center">

<?php 
    for ($i=0;$i<count($id_product);$i++)
    {
?>
        <span class="col-lg-4" width="50%">
                    <img  src= "<?=$images_product[$i]?>" width="200px" height="200px"></br>
                    <h6 class="mx-5"><?=$names_product[$i]."  ".$price_product[$i]."$"?></h6>
        </span>   
<?php }?>
    </div>    
          
        </div>
    </div>
</div>
    </div>
</body>
</html>