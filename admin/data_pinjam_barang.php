<?php
session_start();
include('../database/connect.php');

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];


    if (isset($_GET['action']) && $_GET['action'] === 'approve') {

        mysqli_query($conn, "UPDATE peminjaman_barang SET status = 'Approved' WHERE id_peminjaman = '$id_peminjaman'");
    } 

    elseif (isset($_GET['action']) && $_GET['action'] === 'reject') {

        mysqli_query($conn, "UPDATE peminjaman_barang SET status = 'Rejected' WHERE id_peminjaman = '$id_peminjaman'");
    }

    header("location: data_pinjam_barang.php");
} else {
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

    <style>.approve{
    background-color: green;
}</style>
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

<div class="form-inner">
         <section class="ruangan">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Penanggung Jawab</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            $sql = "SELECT 
            pb.id_peminjaman AS id_peminjaman,
            u.username AS nama_peminjam,
            b.penanggung_jawab AS nama_penanggung_jawab,
            pb.nama_barang,
            pb.tanggal_peminjaman,
            pb.jumlah,
            pb.status
        FROM
            peminjaman_barang pb
        JOIN
            users u ON pb.id_user = u.id_user
        JOIN
            barang b ON pb.id_barang = b.id_barang";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            ?>
                        <?php
                        $nomor = 1;
                        while ($item = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $item["nama_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $item["nama_peminjam"]; ?>
                            </td>
                            <td>
                                <?php echo $item["tanggal_peminjaman"]; ?>
                            </td>
                            <td>
                                <?php echo $item["nama_penanggung_jawab"]; ?>
                            </td>
                            <td>
                                <?php echo $item["jumlah"]; ?>
                            </td>
                            <td>
                                    <?php
                                    if ($item['status'] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="data_pinjam_barang.php?id_peminjaman=<?php echo $item['id_peminjaman']; ?>&action=approve" class="button approve edit" onclick="showForm()">
                                                <span class="material-symbols-outlined">done</span>
                                                <div class="text-edit" name="approve">Approve</div>
                                            </a>
                                            <a href="data_pinjam_barang.php?id_peminjaman=<?php echo $item['id_peminjaman']; ?>&action=reject" class="button delete reject">
                                                <span class="material-symbols-outlined">close</span>
                                                <div class="text-edit" name="approve">Reject</div>
                                            </a>
                                        </div>
                                    <?php
                                    } else if ($item['status'] == "Rejected") {
                                        echo '<img src="../img-2/rejected.svg" alt="Rejected">';
                                    } else {
                                        echo '<img src="../img-2/approved.svg" alt="Approved">';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }}
                        ?>
                    </tbody>
            </table>
        </section>

    </main>
</body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="../js/home.js"></script>

</html>