<?php
session_start();

include('../database/connect.php');

if (isset($_POST['submit'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $nama_barang = $_POST['nama_barang'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $jumlah = $_POST['jumlah'];

    // Select the current peminjaman data
    $selectPeminjamanQuery = "SELECT * FROM peminjaman_barang WHERE id_peminjaman = $id_peminjaman";
    $result = $conn->query($selectPeminjamanQuery);

    if ($result->num_rows > 0) {
        $peminjaman = $result->fetch_assoc();
        $id_barang = $peminjaman['id_barang'];
        $current_jumlah = $peminjaman['jumlah'];

        // Select the current stock from the barang table
        $selectBarangQuery = "SELECT stok_barang FROM barang WHERE id_barang = $id_barang";
        $result = $conn->query($selectBarangQuery);

        if ($result->num_rows > 0) {
            $barang = $result->fetch_assoc();
            $original_stok = $barang['stok_barang'];

            // Calculate the new stock
            $new_stok = $original_stok + $current_jumlah - $jumlah;

            // Update the stock in the barang table
            $updateStokQuery = "UPDATE barang SET stok_barang = $new_stok WHERE id_barang = $id_barang";
            if ($conn->query($updateStokQuery) === TRUE) {

                // Update the peminjaman_barang table
                $updateQuery = "UPDATE peminjaman_barang SET nama_barang = '$nama_barang', tanggal_peminjaman = '$tanggal_peminjaman', jumlah = '$jumlah' WHERE id_peminjaman = $id_peminjaman";
                if ($conn->query($updateQuery) === TRUE) {
                    echo "Data berhasil diupdate";
                    header("Location: data_pinjam_ruang.php");
                    exit();
                } else {
                    echo "Error updating peminjaman_barang: " . $conn->error;
                }
            } else {
                echo "Error updating stock: " . $conn->error;
            }
        } else {
            echo "Item not found in the barang table.";
        }
    } else {
        echo "Peminjaman not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman Barang</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
            <span style="background: url(https://cdn.textures4photoshop.com/tex/thumbs/seamless-galaxy-with-stars-texture-for-photoshop-thumb48.jpg) no-repeat center center; -webkit-background-clip: text; -webkit-text-stroke: 0.5px #fff; color: transparent; background-size: cover;">KOM</span>Space
        </a></h1>
        <div class="container d-flex">
            <ul class="ms-auto" style="list-style-type: none;">
                <li><a href="ruangan.php">List Ruangan</a></li>
                <li><a href="barang.php">List Barang</a></li>
                <li><a href="data_pinjam_ruang.php">Form Peminjaman</a></li>
                <li><a href="../logout.php" class="d-flex align-items-center"><ion-icon name="log-out-outline" style="font-size: 32px;"></ion-icon></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper">
    <div class="title-text">
        <h1 class="text align-middle title ruangan">Form Edit</h1>
    </div>
    <?php
    $id_pinjam = isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : null;
    $data = mysqli_query($conn, "SELECT * FROM peminjaman_barang WHERE id_peminjaman = '$id_pinjam'");
    while ($barang = mysqli_fetch_array($data)) {
    ?>
    <section class="container" id="create">
        <form action="" class="form" method="POST">
            <input type="hidden" name="id_peminjaman" value="<?php echo $barang['id_peminjaman']; ?>">
            <div class="form-outline mb-3">
                <span class="label success">Nama Barang</span>
                <select class="form-select" name="nama_barang" aria-label="Nama Barang" required>
                    <option value="" selected disabled>Pilih Barang</option>
                    <?php
                    $sql = "SELECT * FROM barang";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = $row['nama_barang'] == $barang['nama_barang'] ? 'selected' : '';
                            echo "<option value='" . $row['nama_barang'] . "' $selected>" . $row['nama_barang'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <span class="label success">Tanggal Peminjaman</span>
                <input type="date" name="tanggal_peminjaman" placeholder="Tanggal Peminjaman" value="<?php echo $barang['tanggal_peminjaman']; ?>" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <span class="label success">Jumlah Dipinjam</span>
                    <input type="number" name="jumlah" placeholder="Jumlah Dipinjam" value="<?php echo $barang['jumlah']; ?>" required />
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button name="submit" class="btn btn-primary btn-lg btn-block" style="--bs-btn-padding-y: 10px; --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;">
                    Save
                </button>
            </div>
        </form>
    </section>
    <?php
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="../js/home.js"></script>
</body>
</html>
