<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <title>Home</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Itim", cursive;
        }
    
        body {
            min-height: 100vh;
            justify-content: center;
            background: rgb(10, 5, 59);
        }
    
        .navbar .tulisan {
            padding-left: 20px;
            width: 100%;
            display: flex;
            flex-direction: row;
            --bs-bg-opacity: 1;
            background-color: rgba(88, 76, 200, 1) !important;
        }
    
        .navbar .tulisan ul {
            justify-content: space-between;
            font-size: 20px;
            align-items: center;
            display: flex;
            flex-direction: row;
            padding: 0 20px 0 0 !important;
            margin-bottom: 0 !important;
        }
    
        .navbar {
            padding: 0% !important;
        }
    
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 10px;
            position: relative;
        }
    
        .navbar ul li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 100%;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }
    
        .navbar ul li a:hover::after {
            transform: scaleX(1);
        }
    
        h1.logo span {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-weight: bold;
        }
    
        h1.text {
            position: relative;
            font-size: 38px;
            font-weight: 500;
            color: #fff;
            text-align: center;
        }
    
        .availability {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 10px 10px rgba(61, 55, 55, 1);
            padding: 20px;
            width: 300px;
            display: flex;
            align-items: center;
            margin-left: 20px;
            margin-right: 20px;
            transition: transform 0.3s ease-in-out;
        }
    
        .availability:hover {
            box-shadow: 10px 10px #867ca7;
            transform: scale(1.05);
        }

        div {
            display: block;
            unicode-bidi: isolate;
        }

        /*Form modal*/
        .modal-header {
            background: #F7941E;
            color: #fff;
        }
        
        .required:after {
            content: "*";
            color: red;
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
<div class="form-inner">
         <section class="ruangan">
                <section class="table">
                    <div class="table-responsive d-flex">
                        <table class="table table-hover m-5 text-center table-sm ps-5">
                            <thead class="table-primary tab-heading" style="--bs-table-bg: #635CA9;">>              
                <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Penanggung Jawab</th>
                <th scope="col">Stok</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <?php
                    include('../database/connect.php');
                    $sql = "SELECT * FROM barang";
                    $result = mysqli_query($conn, $sql);
                    $nomor = 1;
                    while ($ruang = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $ruang["kode_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $ruang["nama_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $ruang["penanggung_jawab"]; ?>
                            </td>
                            <td>
                                <?php echo $ruang["stok_barang"]; ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tr>
            </tbody>
        </table>
      </div>
      </section>
      </section>
      </div>
      </div>
</section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/home.js"></script>
</body>

</html>