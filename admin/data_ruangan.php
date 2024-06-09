<?php
session_start();
include("../database/connect.php");
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <style>.room-image {
    max-height: 310px;
    max-width: 25%;
    object-fit: cover;
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
<div class="form-inner">
            <section class="ruangan">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">
                            <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Ruangan</th>
                    <th scope="col">Kode Ruangan</th>
                    <th scope="col">Penanggung Jawab</th>
                    <th scope="col">Image</th>
                    <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    include("../database/connect.php");
                    $data = mysqli_query($conn, "SELECT * FROM ruangan");
                    $nomor = 1;
                    while ($room = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $room["nama_ruangan"]; ?></td>
                            <td><?php echo $room["kode_ruangan"]; ?></td>
                            <td><?php echo $room["penanggung_jawab"]; ?></td>
                            <td><img src="../img/<?php echo $room['img']; ?>" alt="Room Image" class="card-img-top card-img room-image" alt="..."></td>

                            <td>
                                <div class="opsi">
                                    <a href="edit_ruangan.php?id_ruangan=<?php echo $room['id_ruangan']; ?>" class="button edit" onclick="showForm()">
                                        <span class="material-symbols-outlined">edit</span>
                                        <div class="text-edit">Edit</div>
                                    </a>
                                    <a href="delete.php?id_ruangan=<?php echo $room['id_ruangan']; ?>" class="button delete">
                                        <span class="material-symbols-outlined">delete</span>
                                        <div class="text-edit">Delete</div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <div class="field butn mb-4">
                        <button type="button" class="btn btn-primary mx-5 float-end d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"  style="--bs-btn-padding-y: 10px; --bs-btn-font-size: 20px;">
                            <iconify-icon icon="ic:baseline-add"></iconify-icon>
                            <tr>+</tr>
                            &nbsp;
                            Tambahkan Ruangan
                        </button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Penambahan Barang</h1></div>
                            <div class="modal-body">
                                <div class="card-body">
                                <form action="add_room.php" class="form" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Nama Ruangan</label>
                                                <input type="text" name="nama_ruangan" class="form-control" placeholder="Nama ruangan" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Kode Ruangan</label>
                                                <input type="text" name="kode_ruangan" class="form-control" placeholder="Kode ruangan" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Penanggung Jawab</label>
                                                <input type="text" name="penanggung_jawab" class="form-control" placeholder="Penanggung Jawab" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Lokasi</label>
                                                <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Kapasitas</label>
                                                <input type="number" name="kapasitas" class="form-control" placeholder="Kapasitas" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Pimpinan Unit</label>
                                                <input type="text" name="pimpinan_unit" class="form-control" placeholder="Pimpinan Unit" required />
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Ketersediaan Fasilitas</label>
                                                <textarea name="ketersediaan_fasilitas" class="form-control" placeholder="Ketersediaan Fasilitas" required ></textarea>
                                            </div>
                                    <div class="form-outline mb-3">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="tanggal_peminjaman">Image</label>
                                                <input type="file" name="img" id="img" class="form-control" placeholder="Image" required />
                                            </div>
                                    <div class="d-flex justify-content-center mt-4">
                                            <button name="submit" class="btn btn-primary btn-lg btn-block"
                                            style="--bs-btn-padding-y: 10px;
                                            --bs-btn-padding-x: 40px; --bs-btn-font-size: 27px;"
                                            >
                                                Tambahkan Ruangan
                                            </button>
                                        </div>
                                    </form>
                                </div>    
                            </div>
                        </div>
                    </div>
            </section>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    
    <script src="../js/home.js"></script>
</body>
</html>
