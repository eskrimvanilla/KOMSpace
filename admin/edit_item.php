
<?php
session_start();

include("../database/connect.php");


if(isset($_POST['save'])){
    $iditem = $_POST['id_barang'];
    $nameitem = $_POST['nama_barang'];
    $codeitem = $_POST['kode_barang'];
    $pjb = $_POST['penanggung_jawab'];
    $amount = $_POST['stok_barang'];
    mysqli_query($conn, "UPDATE barang SET nama_barang = '$nameitem', kode_barang = '$codeitem', penanggung_jawab = '$pjb' ,
        stok_barang = '$amount' WHERE id_barang = '$iditem'");
    header('location:data_barang.php');
    exit();
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
        include('../database/connect.php');
        $iditem = $_GET['id_barang'];
        $data = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '$iditem'");

        while ($item = mysqli_fetch_array($data)) {
        ?>
            <section class="container" id="create">
                <form action="" class="form" method="POST">
                    <input type="hidden" name="id_barang" value="<?php echo $item['id_barang']; ?>">
                    <div class="input-box">
                    <span class="label success">Nama Barang</span>
                        <input type="text" name="nama_barang" value="<?php echo $item['nama_barang'] ?>" placeholder="Room Name" required />
                    </div>
                    <div class="column">
                    <div class="input-box">
                    <span class="label success">Kode Barang</span>
                        <input type="text" name="kode_barang" value="<?php echo $item['kode_barang'] ?>" placeholder="ID Room" required />
                    </div>
                    <div class="input-box">
                    <span class="label success">Penaggung Jawab</span>
                        <input type="text" name="penanggung_jawab" value="<?php echo $item['penanggung_jawab'] ?>" placeholder="Responsible Person" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                        <span class="label success">Stok</span>
                            <input type="text" name="stok_barang" id="stok" value="<?php echo $item['stok_barang'] ?>" required />
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
<script src="../js/home.js"></script>

</html>