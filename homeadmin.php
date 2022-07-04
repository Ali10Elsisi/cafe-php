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
$stmt = $con->prepare('SELECT name,image FROM admins WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name,$image);
$stmt->fetch();
$stmt->close();




?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cafeteria</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="homeadmin.php">Cafeteria&nbsp;&nbsp;<i class="fas fa-coffee"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
						<a class="nav-link active" aria-current="page" href="allProducts.php">Products</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link active" aria-current="page" href="allUsers.php">Users</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Manual Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Checks</a>
					</li>
                </ul>
                <div class="d-flex ">
                <a class="me-2 nav-link text-light" href="profileadmin.php"><img class="rounded-circle me-2"  src="uploads/<?=$image?>" alt=""width="40" height="24"><?= $name?></a>
                    <a class="me-5 nav-link text-light" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>