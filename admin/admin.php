
<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}
include('../database/connect.php');

$query = "SELECT COUNT(*) as total_barang FROM barang";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalbarang = $row['total_barang'];
} else {
    $totalbarang = 0;
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

if ($totalRuang) {
    $rowRuang = $totalRuang->fetch_assoc();
    $totalRuang = $rowRuang['total_ruang'];
} else {
    $totalRuang = 0;
}

$queryBarang = "SELECT COUNT(*) as total_barang FROM peminjaman_barang";
$totalBarang1 = $conn->query($queryBarang);

if ($totalBarang1) {
    $rowBarang = $totalBarang1->fetch_assoc();
    $totalBarang1 = $rowBarang['total_barang'];
} else {
    $totalBarang1 = 0;
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">

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
        <h1 class="logo"><a href="admin.php">
          <span style="background: url(https://cdn.textures4photoshop.com/tex/thumbs/seamless-galaxy-with-stars-texture-for-photoshop-thumb48.jpg) no-repeat center center;
            -webkit-background-clip: text; -webkit-text-stroke: 0.5px #fff;
            color: transparent; background-size: cover;">KOM</span>Space</span>
        </a></h1>
        <div class="container d-flex">
            <ul class="ms-auto" style="list-style-type: none;">
                <li>
                    <a href="data_ruangan.php">Data Ruangan</a>
                </li>  
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;      
                <li>
                    <a href="data_pinjam_ruang.php">Data Pinjam Ruang</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; 
                <li>
                    <a href="data_barang.php">Data Barang</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; 
                <li>
                <li>
                    <a href="data_pinjam_barang.php">Data Pinjam Barang</a>
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
    <h1 class="text">Dashboard Admin</h1>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Total Barang</h5>
              <p class="card-text fs-1"><?php echo $totalbarang; ?></p>
            </div>
        </div>
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Total Barang</h5>
              <p class="card-text fs-1"><?php echo $totalRuangan; ?></p>
            </div>
        </div>
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Peminjaman Ruangan</h5>
              <p class="card-text fs-1"><?php echo $totalRuang; ?></p>
            </div>
        </div>
        <div class="availability card col-6 mx-5 mb-5" style="width: 16rem; height: 16rem;">
            <div class="text-content card-body d-flex align-items-center justify-content-center flex-column">
              <h5 class="card-title">Peminjaman Barang</h5>
              <p class="card-text fs-1"><?php echo $totalBarang1; ?></p>
            </div>
        </div>


        <div class="form-inner">
         <section class="ruangan">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Username</th>
                                </tr>
                                </thead>
                <tbody class="align-middle">
                    <?php
                    include('../database/connect.php');
                    $sql = "SELECT id_user, nim, username FROM users";
                    $result = mysqli_query($conn, $sql);
                    while ($user = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $user["id_user"]; ?>
                            </td>
                            <td>
                                <?php echo $user["nim"]; ?>
                            </td>
                            <td>
                                <?php echo $user["username"]; ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<script src="../js/home.js"></script>

</html>