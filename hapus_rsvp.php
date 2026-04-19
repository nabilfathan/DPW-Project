<?php
$conn = mysqli_connect("localhost", "root", "", "db_undanganpratikum");

if (isset($_GET['id'])) {
    // Bersihkan input ID
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "DELETE FROM rsvp WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='dashboard.php'; 
              </script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>