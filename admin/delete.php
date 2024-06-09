<?php
include('../database/connect.php');

if (isset($_GET['id_ruangan'])) {
    $idroom = $_GET['id_ruangan'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete related rows in peminjaman_ruangan
        $stmt = $conn->prepare("DELETE FROM peminjaman_ruangan WHERE id_ruangan = ?");
        $stmt->bind_param("i", $idroom);
        $stmt->execute();
        $stmt->close();

        // Delete the row in ruangan
        $stmt = $conn->prepare("DELETE FROM ruangan WHERE id_ruangan = ?");
        $stmt->bind_param("i", $idroom);
        $stmt->execute();
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Redirect to data_ruangan.php
        header("Location: data_ruangan.php");
        exit();
    } catch (Exception $e) {
        // Roll back the transaction if something failed
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
} else {
    echo "No id_ruangan provided.";
}
?>
