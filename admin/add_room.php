<?php
include("../database/connect.php");

    $idroom = isset ($_POST['id_ruangan']) ? $_POST['id_ruangan'] : "";
    $nameroom = $_POST['nama_ruangan'];
    $coderoom = $_POST['kode_ruangan'];
    $pjr = $_POST['penanggung_jawab'];
    $location = $_POST['lokasi'];
    $capacity = $_POST['kapasitas'];
    $head = $_POST['pimpinan_unit'];
    $available = $_POST['ketersediaan_fasilitas'];

    $targetdir = "../img/";
    $img = $targetdir.basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $img);
    
    include("../database/connect.php");

    mysqli_query($conn, "INSERT INTO ruangan(nama_ruangan, kode_ruangan, penanggung_jawab ,img, lokasi, kapasitas, pimpinan_unit, ketersediaan_fasilitas)
    VALUES('$nameroom', '$coderoom','$pjr' ,'$img', '$location', '$capacity', '$head', '$available')");

    include('data_ruangan.php');
?>