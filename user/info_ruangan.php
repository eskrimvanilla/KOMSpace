<?php
session_start();
include("../database/connect.php");

if (!isset($_GET['id_ruangan'])) {
    header("Location: data_ruangan.php");
    exit();
}

$id_ruangan = $_GET['id_ruangan'];
$sql = "
    SELECT r.*, p.tanggal_peminjaman, p.waktu_mulai, p.waktu_selesai 
    FROM ruangan r
    LEFT JOIN peminjaman_ruangan p ON r.id_ruangan = p.id_ruangan
    WHERE r.id_ruangan = '$id_ruangan'
";
$result = mysqli_query($conn, $sql);
$room = mysqli_fetch_array($result);

if (!$room) {
    header("Location: data_ruangan.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Info Ruangan</title>
</head>

<style>
.tab-heading th {
    color: #525F7F !important;
}
</style>

<body>
<nav class="navbar">
    <div class="tulisan">
        <h1 class="logo"><a href="../index.php">
          <span style="background: url(https://cdn.textures4photoshop.com/tex/thumbs/seamless-galaxy-with-stars-texture-for-photoshop-thumb48.jpg) no-repeat center center;
            -webkit-background-clip: text; -webkit-text-stroke: 0.5px #fff;
            color: transparent; background-size: cover;">KOM</span>Space</span>
        </a></h1>
        <div class="container d-flex">
            <ul class="ms-auto" style="list-style-type: none;">
                <li>
                    <a href="ruangan.php">List Ruangan</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;            
                <li>
                    <a href="barang.php">List Barang</a>
                </li>
                &nbsp;&nbsp;&nbsp;            
                &nbsp;&nbsp;&nbsp;
                <li>
                    <a href="data_pinjam_ruang.php">Form Peminjaman</a>
                </li>
                &nbsp;&nbsp;&nbsp;            
                &nbsp;&nbsp;&nbsp;
                <li>
                    <a href="../logout.php" class="d-flex align-items-center"><ion-icon name="log-out-outline" style="font-size: 32px;"></ion-icon></a>
                </li>
            </ul>
        </div>
    </div> 
</nav>

<div class="container">
    <div class="row justify-content-around mt-3">
      <div class="col-lg-5 col-md-auto col-sm-auto mb-5 card-room"> <!-- Adjust the column width based on your layout -->
        <div class="card" style="width: 480px;">
          <img src="../img/<?php echo $room['img']; ?>" alt="Room Image" class="card-img-top card-img" style="max-height: 310px; object-fit: cover;" alt="...">
          <div class="card-body card-info ms-3" style="color: #525F7F;">
            <h5 class="card-title text-title text-start py-2 fs-4 fw-bold" style="font-family: Poppins;"><?php echo $room['nama_ruangan']; ?></h5>
            <table class="card-text text-subtitle text-start">
            <tr>
                    <td style="vertical-align: top;">Lokasi</td>
                    <td class="px-4 pb-2" style="vertical-align: top;">: 
                        &emsp;
                        &ensp;
                        <?php echo $room['lokasi']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Kapasitas</td>
                    <td class="px-4 pb-2" style="vertical-align: top;">: 
                        &emsp;
                        &ensp;
                        <?php echo $room['kapasitas']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Unit Pengelola</td>
                    <td class="px-4 pb-2" style="vertical-align: top;">: 
                        &emsp;
                        &ensp;
                        <?php echo $room['penanggung_jawab']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Pimpinan Unit</td>
                    <td class="px-4 pb-2" style="vertical-align: top;">: 
                        &emsp;
                        &ensp;
                        <?php echo $room['pimpinan_unit']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Ketersediaan Fasilitas</td>
                    <td class="px-4 d-flex" style="vertical-align: top;">: 
                        <ul>
                        <?php echo $room['ketersediaan_fasilitas']; ?>
                        </ul>
                    </td>
                </tr>
                </table>
          </div>
        </div>
    </div>

 <div class="col-lg-7 col-md-auto col-sm-auto mb-5 ps-lg-4">
            <div class="table-responsive d-flex">
                <table class="table table-striped table-hover m-5 text-center">
                    <thead class="table-primary tab-heading lh-lg" style="--bs-table-bg: #ffff;">              
                        <tr>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle lh-base">
                        <?php
                        $peminjamanSql = "SELECT * FROM peminjaman_ruangan WHERE id_ruangan = '$id_ruangan'";
                        $peminjamanResult = mysqli_query($conn, $peminjamanSql);
                        while ($peminjaman = mysqli_fetch_array($peminjamanResult)) {
                        ?>
                        <tr>
                            <td><?php echo $peminjaman["tanggal_peminjaman"]; ?></td>
                            <td><?php echo $peminjaman["waktu_mulai"]; ?></td>
                            <td><?php echo $peminjaman["waktu_selesai"]; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/home.js"></script>
</body>


</html>