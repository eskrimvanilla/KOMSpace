<?php
session_start();

include("../database/connect.php");
    if(isset($_GET['id_peminjaman'])) {
        $idbooked = $_GET['id_peminjaman'];
        mysqli_query($conn, "DELETE FROM peminjaman_ruangan WHERE id_peminjaman = '$idbooked'");
        header("location:data_pinjam_ruang.php");
        exit(); 
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8">
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
    <title>Home</title>

   <title>Home</title>
   <style>
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ruanganRadio = document.getElementById('ruangan');
            const barangRadio = document.getElementById('barang');
            const ruanganSection = document.querySelector('.form-inner .ruangan');
            const barangSection = document.querySelector('.form-inner .barang');

            function toggleSections() {
                if (ruanganRadio.checked) {
                    ruanganSection.classList.add('active');
                    barangSection.classList.remove('active');
                } else if (barangRadio.checked) {
                    ruanganSection.classList.remove('active');
                    barangSection.classList.add('active');
                }
            }

            ruanganRadio.addEventListener('change', toggleSections);
            barangRadio.addEventListener('change', toggleSections);

            toggleSections();
        });
    </script>
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
        <h1 class="text align-middle title ruangan">Peminjaman Ruangan dan Barang</h1>
    </div>

    <div class="form-container">
        <div class="slide-controls">
            <input type="radio" name="slide" id="ruangan" checked>
            <input type="radio" name="slide" id="barang">
            <label for="ruangan" class="slide ruangan">Ruangan</label>
            <label for="barang" class="slide barang">Barang</label>
            <div class="slider-tab"></div>
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
    <div class="form-inner">
         <section class="ruangan">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Tanggal Peminjaman</th>
                                <th scope="col">Waktu Mulai</th>
                                <th scope="col">Waktu Selesai</th>
                                <th scope="col">Penanggung Jawab</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                                </tr>
                                </thead>
                <tbody class="align-middle">
                    <?php
                    if ($result->num_rows > 0) {
                        $nomor = 1;
                        while ($ruang = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $nomor++; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_peminjam"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_ruangan"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["tanggal_peminjaman"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["waktu_mulai"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["waktu_selesai"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_penanggung_jawab"]; ?>
                                </td>
                                <td>
                                    <?php 
                                    $status = $ruang["status"];
                                    if ($status == "Approved") {
                                        echo '<img src="../img-2/approved.svg" alt="Approved">';
                                    } elseif ($status == "Not yet approved") {
                                        echo '<img src="../img-2/notyet.svg" alt="Not yet approved">';
                                    } elseif ($status == "Rejected") {
                                        echo '<img src="../img-2/rejected.svg" alt="Rejected">';
                                    } else {
                                        echo $status;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($ruang["status"] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="edit.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>" class="button edit" onclick="showForm()">
                                                <span class="material-symbols-outlined">edit</span>
                                                <div class="text-edit">Edit</div>
                                            </a>
                                    <?php
                                    }
                                    ?>
                                            <a href="data_pinjam_ruang.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>" class="button delete">
                                                <span class="material-symbols-outlined">delete</span>
                                                <div class="text-edit">Delete</div>
                                            </a>
                                        </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                            </tbody>
                        </table>
                      </div>
                </section>
                    <div class="field butn mb-4">
                        <button type="button" class="btn btn-primary mx-5 float-end d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"  style="--bs-btn-padding-y: 10px; --bs-btn-font-size: 20px;">
                            <iconify-icon icon="ic:baseline-add"></iconify-icon>
                            &nbsp;
                            Pinjam Ruangan
                        </button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Formulir Peminjaman</h1></div>
                            <div class="modal-body">
                                <div class="card-body">
                                <form action="create_room.php" class="form" method="POST">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form7Example3">Nama Ruangan</label>
                                            <select class="form-select" name="nama_ruangan" aria-label="Nama Ruangan" required>
                                                <option value="" selected disabled>Pilih ruangan</option>
                                                    <?php
                                                    $sql = "SELECT * FROM ruangan";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='" . $row['nama_ruangan'] . "'>" . $row['nama_ruangan'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                    </div>


                                        <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Tanggal Booking</label>
                                                <input type="date" name="tanggal_peminjaman" class="form-control" placeholder="dd/mm/yyyy" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="waktu_mulai">Waktu Mulai</label>
                                                    <input type="time" name="waktu_mulai" class="form-control" placeholder="Waktu Mulai" required />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="waktu_selesai">Waktu Selesai</label>
                                                    <input type="time" name="waktu_selesai" class="form-control" placeholder="Waktu Selesai" required />
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <button name="submit" class="btn btn-primary btn-lg btn-block"
                                            style="--bs-btn-padding-y: 10px;
                                            --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;"
                                            >
                                                Booking Sekarang
                                            </button>
                                        </div>
                                    </form>
                                </div>    
                            </div>
                        </div>
                    </div>
            </section>
            <section class="barang">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">
                            <?php
            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];


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
                barang b ON pb.id_barang = b.id_barang
            WHERE
                pb.id_user = '$user_id'";


                $result = $conn->query($sql);
            }

            ?>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Peminjaman</th>
                        <th scope="col">Nama Ruangan</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Jumlah Peminjaman</th>
                        <th scope="col">Penanggung Jawab</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    if ($result->num_rows > 0) {
                        $nomor = 1;
                        while ($barang = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $nomor++; ?>
                                </td>
                                <td>
                                    <?php echo $barang["nama_peminjam"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["nama_barang"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["tanggal_peminjaman"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["jumlah"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["nama_penanggung_jawab"]; ?>
                                </td>
                                <td>
                                <?php 
                                    $status = $barang["status"];
                                    if ($status == "Approved") {
                                        echo '<img src="../img-2/approved.svg" alt="Approved">';
                                    } elseif ($status == "Not yet approved") {
                                        echo '<img src="../img-2/notyet.svg" alt="Not yet approved">';
                                    } elseif ($status == "Rejected") {
                                        echo '<img src="../img-2/rejected.svg" alt="Rejected">';
                                    } else {
                                        echo $status;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($barang["status"] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="editbarang.php?id_peminjaman=<?php echo $barang['id_peminjaman']; ?>" class="button edit" onclick="showForm()">
                                                <span class="material-symbols-outlined">edit</span>
                                                <div class="text-edit">Edit</div>
                                            </a>
                                        <?php
                                    }
                                        ?>
                                        <a href="delete_barang.php?id_peminjaman=<?php echo $barang['id_peminjaman']; ?>" class="button delete">
                                            <span class="material-symbols-outlined">delete</span>
                                            <div class="text-edit">Delete</div>
                                        </a>
                                        </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
        include('../database/connect.php');

        if (isset($_POST['submit'])) {
            $rb = $_POST['nama_barang'];
            $tgl = $_POST['tanggal_peminjaman'];
            $stokitem = $_POST['jumlah'];
            $status = isset($_POST['status']) ? $_POST['status'] : '';

            $selectBarangQuery = "SELECT id_barang, stok_barang FROM barang WHERE nama_barang = '$rb'";
            $result = $conn->query($selectBarangQuery);

            if ($result->num_rows > 0) {
                $barang = $result->fetch_assoc();
                $id_barang = $barang['id_barang'];
                $current_stok = $barang['stok_barang'];

                if ($current_stok >= $stokitem) {
                    $new_stok = $current_stok - $stokitem;

                    $updateStokQuery = "UPDATE barang SET stok_barang = $new_stok WHERE id_barang = $id_barang";

                    if ($conn->query($updateStokQuery) === TRUE) {
                        $insertQuery = "INSERT INTO peminjaman_barang (id_user, id_barang, nama_barang, tanggal_peminjaman, jumlah, status) 
                        VALUES ('" . $_SESSION['id_user'] . "','$id_barang','$rb', '$tgl', '$stokitem', 'Not yet approved')";

                        if ($conn->query($insertQuery) === TRUE) {
                            echo "<script>window.location.href = 'data_pinjam_ruang.php';</script>";
                        } else {
                            echo "Error inserting data: " . $conn->error;
                        }
                    } else {
                        echo "Error updating stock: " . $conn->error;
                    }
                } else {
                    echo "Not enough stock available for borrowing.";
                }
            } else {
                echo "Item not found in the barang table.";
            }
        }
        ?>
                <div class="field butn mb-4">
                        <button type="button" class="btn btn-primary mx-5 float-end d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModalBarang"  style="--bs-btn-padding-y: 10px; --bs-btn-font-size: 20px;">
                            <iconify-icon icon="ic:baseline-add"></iconify-icon>
                            &nbsp;
                            Pinjam Barang
                        </button>
                    </div>
                    <div class="modal fade" id="exampleModalBarang" tabindex="-1" aria-labelledby="exampleModalLabelBarang" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5 text-center" id="exampleModalLabelBarang">Formulir Peminjaman</h1></div>
                            <div class="modal-body">
                                <div class="card-body">
                                <form action="" class="form" method="POST">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form7Example3">Nama Barang</label>
                                            <select class="form-select" name="nama_barang" aria-label="Nama Barang" required>
                                                <option value="" selected disabled>Pilih barang</option>
                                                    <?php
                                                    $sql = "SELECT * FROM barang";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='" . $row['nama_barang'] . "'>" . $row['nama_barang'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                    </div>


                                        <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Tanggal Booking</label>
                                                <input type="date" name="tanggal_peminjaman" class="form-control" placeholder="dd/mm/yyyy" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="jumlah">Jumlah Peminjaman</label>
                                                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah dipinjam" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <button name="submit" class="btn btn-primary btn-lg btn-block"
                                            style="--bs-btn-padding-y: 10px;
                                            --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;"
                                            >
                                                Booking Sekarang
                                            </button>
                                        </div>
                                    </form>
                                </div>    
                            </div>
                          </div>
                      </div>
                </section>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ruanganRadio = document.getElementById('ruangan');
        const barangRadio = document.getElementById('barang');
        const ruanganSection = document.querySelector('section.ruangan');
        const barangSection = document.querySelector('section.barang');

        ruanganRadio.addEventListener('change', function () {
            if (ruanganRadio.checked) {
                ruanganSection.style.display = 'block';
                barangSection.style.display = 'none';
            }
        });

        barangRadio.addEventListener('change', function () {
            if (barangRadio.checked) {
                barangSection.style.display = 'block';
                ruanganSection.style.display = 'none';
            }
        });

        if (ruanganRadio.checked) {
            ruanganSection.style.display = 'block';
            barangSection.style.display = 'none';
        } else if (barangRadio.checked) {
            barangSection.style.display = 'block';
            ruanganSection.style.display = 'none';
        }
    });
    </script>
    
    <script src="../js/home.js"></script>
</body>

</html>