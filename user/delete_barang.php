<?php
session_start();

include("../database/connect.php");
if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];

    $sql_delete = "DELETE FROM peminjaman_barang WHERE id_peminjaman = '$id_peminjaman'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Record deleted successfully";
        header("Location: data_pinjam_ruang.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
