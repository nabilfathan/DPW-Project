<?php
require_once 'koneksi.php';

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim'])) {
    
    // Ambil data dari form
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_tamu']);
    $nomor  = mysqli_real_escape_string($conn, $_POST['nomor_telp']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $pesan  = mysqli_real_escape_string($conn, $_POST['pesan']);

    // Validasi
    if (empty($nama) || empty($nomor) || empty($status)) {
        echo "<script>
                alert('Data tidak lengkap!');
                window.location.href='index.php';
              </script>";
        exit();
    }

    // Generate Link
    $baseUrl = "http://localhost/undangan/index.php"; 
    $generatedLink = $baseUrl . "?to=" . urlencode($nama);

    // Query INSERT (created_at akan otomatis terisi karena DEFAULT current_timestamp)
    $query = "INSERT INTO rsvp (nama_tamu, nomor_telp, status, pesan, link_undangan) 
              VALUES ('$nama', '$nomor', '$status', '$pesan', '$generatedLink')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Konfirmasi Berhasil! Terima kasih $nama');
                window.location.href='index.php';
              </script>";
    } else {
        // Tampilkan error spesifik
        echo "<script>
                alert('Gagal menyimpan: " . mysqli_error($conn) . "');
                window.location.href='index.php';
              </script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>