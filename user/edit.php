<?php
session_start();

include("../database/connect.php");

if (isset($_POST['submit'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $nama_ruangan = $_POST['nama_ruangan'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE peminjaman_ruangan SET
                        nama_ruangan = '$nama_ruangan',
                        tanggal_peminjaman = '$tanggal_peminjaman',
                        waktu_mulai = '$waktu_mulai',
                        waktu_selesai = '$waktu_selesai'
                        WHERE id_peminjaman = $id_peminjaman";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Data berhasil diupdate.";
        header("location: data_pinjam_ruang.php");
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
} else {
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

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
<div class="wrapper">
    <div class="title-text">
        <h1 class="text align-middle title ruangan">Form Edit</h1>
    </div>
            <?php
            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];


                $sql = $sql = "SELECT 
                pr.id_peminjaman AS id_peminjaman,
                u.username AS nama_peminjam,
                r.penanggung_jawab AS nama_penanggung_jawab,
                pr.nama_ruangan,
                pr.tanggal_peminjaman,
                pr.waktu_mulai,
                pr.waktu_selesai,
                pr.status
            FROM
                peminjaman_ruangan pr
            JOIN
                users u ON pr.id_user = u.id_user
            JOIN
                ruangan r ON pr.id_ruangan = r.id_ruangan
            WHERE
                pr.id_user = '$user_id'";

                $result = $conn->query($sql);
            }

            ?>


        <?php
        $id_pinjam = isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : null;
        $data = mysqli_query($conn, "SELECT * FROM peminjaman_ruangan WHERE id_peminjaman = '$id_pinjam'");

        while ($ruang = mysqli_fetch_array($data)) {
        ?>
            <section class="container" id="create">
                <form action="" class="form" method="POST">
                        <input type="hidden" name="id_peminjaman" value="<?php echo $ruang['id_peminjaman']; ?>">
                        <div class="form-outline mb-3">
                            <span class="label success">Nama Ruangan</span>
                            <select class="form-select" name="nama_ruangan" aria-label="Nama Ruangan" required>
                                <option value="" selected disabled>Pilih ruangan</option>
                                <?php
                                $sql = "SELECT * FROM ruangan";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $selected = $row['nama_ruangan'] == $ruang['nama_ruangan'] ? 'selected' : '';
                                        echo "<option value='" . $row['nama_ruangan'] . "' $selected>" . $row['nama_ruangan'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    <div class="input-box">
                        <span class="label success">Tanggal Peminjaman</span>
                        <input type="date" name="tanggal_peminjaman" placeholder="Date Of Booking" value="<?php echo $ruang['tanggal_peminjaman']; ?>" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <span class="label success">Waktu Mulai</span>
                            <input type="time" name="waktu_mulai" placeholder="Booking Start Time" value="<?php echo $ruang['waktu_mulai']; ?>" required />
                        </div>
                        <div class="input-box">
                            <span class="label success">Waktu Selesai</span>
                            <input type="time" name="waktu_selesai" placeholder="Booked Finish Time" value="<?php echo $ruang['waktu_selesai']; ?>" required />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                                            <button name="submit" class="btn btn-primary btn-lg btn-block"
                                            style="--bs-btn-padding-y: 10px;
                                            --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;"
                                            >
                                                Save
                                            </button>
                                        </div>
                </form>
                </section>
        <?php
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/home.js"></script>
</body>
</body>

</html>