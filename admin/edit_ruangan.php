<?php
session_start();
        include('../database/connect.php');

        if (isset($_POST['save'])) {
            $idroom = $_POST['id_ruangan'];
            $nameroom = $_POST['nama_ruangan'];
            $coderoom = $_POST['kode_ruangan'];
            $pjr = $_POST['penanggung_jawab'];
            $lok = $_POST['lokasi'];
            $kap = $_POST['kapasitas'];
            $pun = $_POST['pimpinan_unit'];
            $kes = $_POST['ketersediaan_fasilitas'];

            $targetdir = "../img/";
            $img = $targetdir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $img);

            mysqli_query($conn, "UPDATE ruangan SET 
                    nama_ruangan = '$nameroom', 
                    kode_ruangan = '$coderoom',
                    penanggung_jawab = '$pjr',
                    lokasi = '$lok',
                    kapasitas = '$kap',
                    pimpinan_unit = '$pun',
                    ketersediaan_fasilitas = '$kes',
                    img = '$img' WHERE id_ruangan = '$idroom'");
            
            header("location: data_ruangan.php");
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <style>
.label {
  color: white;
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
<div class="wrapper">
    <div class="title-text">
        <h1 class="text align-middle title ruangan">Form Edit</h1>
    </div>
        <?php
        $idroom = $_GET['id_ruangan'];
        $data = mysqli_query($conn, "SELECT * FROM ruangan WHERE id_ruangan = '$idroom'");

        while ($room = mysqli_fetch_array($data)) {
        ?>
            <section class="container" id="create">
                <form action="" class="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruangan" value="<?php echo $room['id_ruangan']; ?>">
                    <div class="input-box">
                    <span class="label success">Nama Ruangan</span>
                        <input type="text" name="nama_ruangan" value="<?php echo $room['nama_ruangan'] ?>" placeholder="Nama Ruangan" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Kode Ruangan</span>
                        <input type="text" name="kode_ruangan" value="<?php echo $room['kode_ruangan'] ?>" placeholder="Kode Ruangan" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Penaggung Jawab</span>>
                        <input type="text" name="penanggung_jawab" value="<?php echo $room['penanggung_jawab'] ?>" placeholder="Penanggung Jawab" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Lokasi</span>>
                        <input type="text" name="lokasi" value="<?php echo $room['lokasi'] ?>" placeholder="Lokasi" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Kapasitas</span>>
                        <input type="text" name="kapasitas" value="<?php echo $room['kapasitas'] ?>" placeholder="Kapasitas" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Pimpinan Unit</span>>
                        <input type="text" name="pimpinan_unit" value="<?php echo $room['pimpinan_unit'] ?>" placeholder="Pimpinan Unit" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Ketersediaan Fasilitas</span>>
                        <input type="text" name="ketersediaan_fasilitas" value="<?php echo $room['ketersediaan_fasilitas'] ?>" placeholder="Ketersediaan Fasilitas" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                        <span class="label success">Image</span>
                            <input type="file" name="img" id="img" value="<?php echo $room['img'] ?>" required />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                                            <button name="save" class="btn btn-primary btn-lg btn-block"
                                            style="--bs-btn-padding-y: 10px;
                                            --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;"
                                            >
                                                Save
                                            </button>
        </div>
                </form>
            <?php
        }
            ?>
            </section>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    
<script src="../js/home.js"></script>

</html>