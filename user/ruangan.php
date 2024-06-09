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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'><title>Daftar Ruangan</title>
</head>

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

<main class="home">
        <div class="container text-center">
            <div class="row justify-content-around mt-3">
                <?php
                include("../database/connect.php");
                $sql = "SELECT * FROM ruangan";
                $result = mysqli_query($conn, $sql);
                while ($room = mysqli_fetch_array($result)) {
                ?>
                <div class="col-auto mb-5 card-room">
                    <a class="card" style="width: 18rem; height: 380px; text-decoration: none;" href="info_ruangan.php?id_ruangan=<?php echo $room['id_ruangan']; ?>">
                        <img src="../img/<?php echo $room['img']; ?>" alt="img" class="card-img-top card-img" style="height: 195px;">
                        <div class="card-body card-info">
                            <h5 class="card-title text-title"><?php echo $room['nama_ruangan']; ?></h5>
                            <p class="card-text text-subtitle"><?php echo $room['kode_ruangan']; ?></p>
                            <div class="card-icon">
                                <span class="material-symbols-outlined icn">arrow_right_alt</span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                }
                ?>
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