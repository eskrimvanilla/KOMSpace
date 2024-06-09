<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}
include('./database/connect.php');

$query = "SELECT COUNT(*) as total_barang FROM barang";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalBarang = $row['total_barang'];
} else {
    $totalBarang = 0;
}

$query = "SELECT COUNT(*) as total_ruangan FROM ruangan";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalRuangan = $row['total_ruangan'];
} else {
    $totalRuangan = 0;
}

$queryUser = "SELECT COUNT(*) as total_user FROM users";
$resultUser = $conn->query($queryUser);

if ($resultUser) {
    $rowUser = $resultUser->fetch_assoc();
    $totalUser = $rowUser['total_user'];
} else {
    $totalUser = 0;
}

$queryRuang = "SELECT COUNT(*) as total_ruang FROM peminjaman_ruangan";
$totalRuang = $conn->query($queryRuang);


$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;

$queryTotalPeminjamanUser = "SELECT COUNT(*) as total_peminjaman FROM peminjaman_barang WHERE id_user = $id_user";
$resultTotalPeminjamanUser = $conn->query($queryTotalPeminjamanUser);


if ($resultTotalPeminjamanUser) {
    $rowTotalPeminjamanUser = $resultTotalPeminjamanUser->fetch_assoc();
    $totalPeminjamanUser = $rowTotalPeminjamanUser['total_peminjaman'];
} else {
    $totalPeminjamanUser = 0;
}

$queryTotalPeminjamanUserRu = "SELECT COUNT(*) as total_peminjaman FROM peminjaman_ruangan WHERE id_user = $id_user";
$resultTotalPeminjamanUserRu = $conn->query($queryTotalPeminjamanUserRu);


if ($resultTotalPeminjamanUserRu) {
    $rowTotalPeminjamanUserRu = $resultTotalPeminjamanUserRu->fetch_assoc();
    $totalPeminjamanUserRu = $rowTotalPeminjamanUserRu['total_peminjaman'];
} else {
    $totalPeminjamanUserRu = 0;
}
?>

<?php
$sqlRuangan = "SELECT COUNT(*) AS total_ruangan FROM ruangan";
$resultRuangan = $conn->query($sqlRuangan);
$rowRuangan = $resultRuangan->fetch_assoc();
$totalRuangan = $rowRuangan['total_ruangan'];
?>

<?php
$sqlBarang = "SELECT COUNT(*) AS total_barang FROM barang";
$resultBarang = $conn->query($sqlBarang);
$rowBarang = $resultBarang->fetch_assoc();
$totalBarang = $rowBarang['total_barang'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .home {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
   
<nav class="navbar">
    <div class="tulisan">
        <h1 class="logo"><a href="index.php">
          <span style="background: url(https://cdn.textures4photoshop.com/tex/thumbs/seamless-galaxy-with-stars-texture-for-photoshop-thumb48.jpg) no-repeat center center;
            -webkit-background-clip: text; -webkit-text-stroke: 0.5px #fff;
            color: transparent; background-size: cover;">KOM</span>Space</span>
        </a></h1>
        <div class="container d-flex">
            <ul class="ms-auto" style="list-style-type: none;">
                <li>
                    <a href="user/ruangan.php">List Ruangan</a>
                </li>  
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;      
                <li>
                    <a href="user/barang.php">List Barang</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; 
                <li>
                    <a href="user/data_pinjam_ruang.php">Form Peminjaman</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; 
                <li>
                    <a href="logout.php" class="d-flex align-items-center"><ion-icon name="log-out-outline" style="font-size: 32px;"></ion-icon></a>
                </li>
            </ul>
        </div>
    </div> 
</nav>
<br>
<section class="home">
    <h1 class="text">Dashboard</h1>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Total Ruangan</h5>
              <p class="card-text fs-1"><?php echo $totalRuangan; ?></p>
            </div>
        </div>
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Total Barang</h5>
              <p class="card-text fs-1"><?php echo $totalBarang; ?></p>
            </div>
        </div>
    </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<script src="./js/home.js"></script>

</html>