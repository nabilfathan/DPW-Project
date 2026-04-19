<?php
include 'koneksi.php';

// Logika Tambah Data
if (isset($_POST['submit_tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_tamu']);
    $telp = mysqli_real_escape_string($conn, $_POST['nomor_telp']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query_insert = "INSERT INTO rsvp (nama_tamu, nomor_telp, status) VALUES ('$nama', '$telp', '$status')";

    if (mysqli_query($conn, $query_insert)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($conn) . "');</script>";
    }
}

// Logika Update Data (Proses Simpan Hasil Edit)
if (isset($_POST['update_rsvp'])) {
    $id_update = mysqli_real_escape_string($conn, $_POST['id']);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_tamu']);
    $nomor  = mysqli_real_escape_string($conn, $_POST['nomor_telp']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $pesan  = mysqli_real_escape_string($conn, $_POST['pesan']);

    $query_update = "UPDATE rsvp SET nama_tamu='$nama', nomor_telp='$nomor', status='$status', pesan='$pesan' WHERE id='$id_update'";

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($conn) . "');</script>";
    }
}


// Fitur DELETE (Hapus Tamu)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM rsvp WHERE id = $id");
    header("Location: dashboard.php#tamu");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --gold: #b39359;
            --dark-bg: #0a0a0a;
            --card-bg: #141414;
            --border: rgba(179, 147, 89, 0.2);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
        }

        h1,
        h2,
        h3,
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .glass-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
        }

        .input-luxury {
            background: transparent;
            border-bottom: 1px solid var(--border);
            color: #fff;
            padding: 8px 0;
            width: 100%;
            font-size: 13px;
            transition: 0.3s;
        }

        .input-luxury:focus {
            border-bottom-color: var(--gold);
            outline: none;
        }

        .btn-premium {
            border: 1px solid var(--gold);
            color: var(--gold);
            transition: 0.4s;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 10px;
            padding: 12px 24px;
        }

        .btn-premium:hover {
            background: var(--gold);
            color: #000;
        }

        label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #71717a;
            display: block;
            margin-bottom: 0.25rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .section-title div {
            flex: 1;
            height: 1px;
            background: var(--border);
        }
    </style>
    <script>
        // Cek status login SEBELUM halaman dimuat
        if (sessionStorage.getItem('isLoggedIn') !== 'true') {
            window.location.replace("login.php");
        }

        function logout() {
            sessionStorage.removeItem('isLoggedIn');
            window.location.replace("login.php");
        }
    </script>
</head>

<body class="flex min-h-screen">

    <aside class="w-64 bg-black border-r border-zinc-900 hidden lg:flex flex-col p-8">
        <h1 class="text-2xl font-serif italic text-center mb-10">Invitation</h1>
        <nav class="space-y-6 text-[11px] uppercase tracking-widest">
            <a href="#" class="text-amber-600 block">Dashboard</a>
            <a href="#mempelai" class="text-zinc-500 hover:text-white block">Mempelai</a>
            <a href="#acara" class="text-zinc-500 hover:text-white block">Jadwal & Lokasi</a>
            <a href="#galeri" class="text-zinc-500 hover:text-white block">Media</a>
            <a href="#tamu" class="text-zinc-500 hover:text-white block">Daftar Tamu</a>
        </nav>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto p-10 md:p-16">
        <header class="flex justify-between items-end mb-16 border-b border-zinc-900 pb-8">
            <div>
                <h2 class="text-4xl font-serif italic mb-2 text-white">Management Suite</h2>
                <p class="text-zinc-500 text-[10px] uppercase tracking-[0.2em]">Wedding Invitation • Admin Panel</p>
            </div>

            <div class="flex gap-4">
                <a href="index.php" target="_blank" class="btn-premium px-6 py-2 flex items-center hover:bg-zinc-900 transition">
                    <i class="far fa-eye mr-2 text-[10px]"></i> View Live Site
                </a>

                <button onclick="logout()" class="text-[10px] uppercase tracking-widest text-zinc-600 hover:text-red-500 transition border border-zinc-800 px-6 py-2">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </div>
        </header>

        <section id="mempelai" class="mb-20">
            <div class="section-title">
                <h3 class="text-xl font-serif italic">Mempelai</h3>
                <div></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="glass-card p-8 space-y-6">
                    <p class="text-amber-600 text-[10px] uppercase font-bold mb-4 italic">Pihak Pria</p>
                    <div><label>Nama Lengkap</label><input type="text" class="input-luxury" value="Nabil"></div>
                    <div><label>Nama Ayah</label><input type="text" class="input-luxury" value="Fulan"></div>
                    <div><label>Nama Ibu</label><input type="text" class="input-luxury" value="Fulanah"></div>
                </div>
                <div class="glass-card p-8 space-y-6">
                    <p class="text-amber-600 text-[10px] uppercase font-bold mb-4 italic">Pihak Wanita</p>
                    <div><label>Nama Lengkap</label><input type="text" class="input-luxury" value="Titik"></div>
                    <div><label>Nama Ayah</label><input type="text" class="input-luxury" value="Fulan"></div>
                    <div><label>Nama Ibu</label><input type="text" class="input-luxury" value="Fulanah"></div>
                </div>
            </div>
        </section>

        <section id="acara" class="mb-20">
            <div class="section-title">
                <h3 class="text-xl font-serif italic">Acara & Lokasi</h3>
                <div></div>
            </div>
            <div class="glass-card p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <div><label>Tanggal Akad</label><input type="date" class="input-luxury" value="2024-07-20"></div>
                    <div><label>Waktu Resepsi</label><input type="text" class="input-luxury" value="10.00 WIB - Selesai"></div>
                    <div><label>Countdown ISO</label><input type="text" class="input-luxury" value="2024-07-20T08:00:00"></div>
                </div>
                <div class="space-y-6">
                    <div><label>Nama Gedung</label><input type="text" class="input-luxury" value="Gedung Serba Guna FT UNRI"></div>
                    <div><label>Alamat Lengkap</label><input type="text" class="input-luxury" value="Kampus Binawidya, Panam, Pekanbaru"></div>
                    <div><label>Link Google Maps</label><input type="text" class="input-luxury text-amber-600" value="https://goo.gl/maps/..."></div>
                </div>
            </div>
        </section>

        <?php
        // Bagian 1: Koneksi
        $conn = mysqli_connect("localhost", "root", "", "db_undanganpratikum");

        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Bagian 2: Query Data
        $query_rsvp = mysqli_query($conn, "SELECT * FROM rsvp ORDER BY id DESC");
        $total_data = mysqli_num_rows($query_rsvp); // Menghitung jumlah data
        ?>

        <div class="flex flex-col gap-10 mb-20">

            <section id="galeri">
                <div class="section-title">
                    <h3 class="text-xl font-serif italic">Gallery & Music</h3>
                    <div></div>
                </div>
                <div class="glass-card p-8">
                    <label class="mb-4 block text-zinc-400">Background Music (URL/File)</label>
                    <input type="text" class="input-luxury mb-8 w-full" value="romantic_piano.mp3">

                    <label class="block text-zinc-400">Photos (Max 6)</label>
                    <div class="grid grid-cols-2 md:grid-cols-6 gap-3 mt-4">
                        <div class="aspect-square bg-zinc-900 border border-zinc-800 rounded-lg flex items-center justify-center relative group overflow-hidden">
                            <span class="text-[10px] text-zinc-600 group-hover:hidden uppercase tracking-widest">Img_1</span>
                            <button class="hidden group-hover:flex items-center justify-center bg-red-500/20 w-full h-full text-red-500 transition-all">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <label class="aspect-square border-2 border-dashed border-zinc-800 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-gold hover:bg-gold/5 transition-all">
                            <i class="fas fa-plus text-zinc-700 mb-1"></i>
                            <span class="text-[8px] text-zinc-700 uppercase">Upload</span>
                            <input type="file" class="hidden">
                        </label>
                    </div>
                </div>
            </section>

            <section id="tamu">
                <div class="section-title flex justify-between items-end">
                    <div>
                        <h3 class="text-xl font-serif italic">RSVP List</h3>
                        <div class="w-12 h-[2px] bg-gold mt-1"></div>
                    </div>
                    <button onclick="toggleModal('modalTambah')" class="text-[10px] bg-gold/10 text-gold border border-gold/50 px-4 py-2 rounded hover:bg-gold hover:text-black transition-all uppercase tracking-widest font-bold flex items-center gap-2">
                        <i class="fas fa-plus"></i> Add Guest
                    </button>

                    <span class="text-[10px] bg-zinc-900 text-gold border border-gold/30 px-3 py-1 rounded-full uppercase tracking-tighter">
                        Total: <?= $total_data ?> Guests
                    </span>
                </div>


                <div class="glass-card overflow-hidden mt-6 shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-950 text-zinc-500 uppercase text-[10px] tracking-widest">
                                <tr>
                                    <th class="p-5 text-left font-medium">Guest Information</th>
                                    <th class="p-5 text-center font-medium">Status</th>
                                    <th class="p-5 text-right font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-900/50">
                                <?php
                                if ($total_data > 0) {
                                    while ($row = mysqli_fetch_assoc($query_rsvp)) {
                                        // Logika warna status sederhana
                                        $status_color = (strtolower($row['status']) == 'hadir') ? 'text-green-500 bg-green-500/10' : 'text-zinc-500 bg-zinc-500/10';
                                ?>
                                        <tr class="hover:bg-white/[0.02] transition-colors group">
                                            <td class="p-5">
                                                <div class="font-semibold text-zinc-200 group-hover:text-gold transition-colors tracking-wide">
                                                    <?= htmlspecialchars($row['nama_tamu']) ?>
                                                </div>
                                                <div class="text-zinc-500 text-[10px] flex items-center gap-2 mt-1">
                                                    <i class="fas fa-phone-alt text-[8px]"></i>
                                                    <?= htmlspecialchars($row['nomor_telp']) ?>
                                                </div>
                                            </td>
                                            <td class="p-5 text-center">
                                                <span class="px-3 py-1 rounded-full text-[9px] font-bold border border-current <?= $status_color ?>">
                                                    <?= strtoupper($row['status']) ?>
                                                </span>
                                            </td>
                                            <td class="p-5">
                                                <div class="flex justify-end gap-4">
                                                    <button type="button"
                                                        onclick="openEditModal('<?= $row['id'] ?>', '<?= addslashes(htmlspecialchars($row['nama_tamu'])) ?>', '<?= addslashes(htmlspecialchars($row['nomor_telp'])) ?>', '<?= $row['status'] ?>', '<?= addslashes(htmlspecialchars($row['pesan'])) ?>')"
                                                        class="text-zinc-500 hover:text-blue-400 transition-all transform hover:scale-110">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <a href="dashboard.php?hapus=<?= $row['id'] ?>"
                                                        onclick="return confirm('Hapus data <?= htmlspecialchars($row['nama_tamu']) ?>?')"
                                                        class="text-zinc-500 hover:text-red-500 transition-all transform hover:scale-110">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='p-10 text-center text-zinc-600 italic tracking-widest uppercase text-xs'>No RSVP data found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
        <div class="sticky bottom-10 flex justify-end">
            <button class="btn-premium bg-amber-900/10 backdrop-blur-md shadow-2xl">Simpan Perubahan</button>
        </div>

        <div id="copyToast" class="fixed top-10 left-1/2 -translate-x-1/2 bg-amber-600 text-black px-6 py-3 rounded-full text-xs font-bold tracking-widest opacity-0 transition-all duration-500 pointer-events-none uppercase">
            JSON Copied! Paste to GitHub.
        </div>

    </main>
    <div id="modalTambah" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
        <div class="glass-card w-full max-w-md p-8 border border-gold/20">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-serif italic text-gold">Add New Guest</h3>
                <button onclick="toggleModal('modalTambah')" class="text-zinc-500 hover:text-white"><i class="fas fa-times"></i></button>
            </div>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Full Name</label>
                    <input type="text" name="nama_tamu" required class="input-luxury w-full" placeholder="Enter guest name...">
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Phone Number</label>
                    <input type="text" name="nomor_telp" required class="input-luxury w-full" placeholder="0812xxxx">
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Status</label>
                    <select name="status" class="input-luxury w-full bg-zinc-900">
                        <option value="Hadir">HADIR</option>
                        <option value="Tidak Hadir">TIDAK HADIR</option>
                        <option value="Pending">PENDING</option>
                    </select>
                </div>

                <button type="submit" name="submit_tambah" class="w-full bg-gold py-3 text-black font-bold uppercase tracking-widest text-xs hover:bg-yellow-600 transition-all mt-4">
                    Save Guest Data
                </button>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
        <div class="glass-card w-full max-w-md p-8 border border-gold/20">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-serif italic text-gold">Edit Guest Data</h3>
                <button onclick="toggleModal('modalEdit')" class="text-zinc-500 hover:text-white"><i class="fas fa-times"></i></button>
            </div>

            <form action="" method="POST" class="space-y-5">
                <input type="hidden" name="id" id="edit_id">

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Full Name</label>
                    <input type="text" name="nama_tamu" id="edit_nama" required class="input-luxury w-full">
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Phone Number</label>
                    <input type="text" name="nomor_telp" id="edit_nomor" required class="input-luxury w-full">
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Status</label>
                    <select name="status" id="edit_status" class="input-luxury w-full bg-zinc-900">
                        <option value="Hadir">HADIR</option>
                        <option value="Tidak Hadir">TIDAK HADIR</option>
                        <option value="Pending">PENDING</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-zinc-500 uppercase tracking-widest mb-2">Message</label>
                    <textarea name="pesan" id="edit_pesan" class="input-luxury w-full h-24 bg-zinc-900"></textarea>
                </div>

                <div class="flex gap-3 mt-4">
                    <button type="submit" name="update_rsvp" class="flex-1 bg-gold py-3 text-black font-bold uppercase tracking-widest text-xs hover:bg-yellow-600 transition-all">
                        Update Data
                    </button>
                    <button type="button" onclick="toggleModal('modalEdit')" class="px-6 py-3 border border-zinc-700 text-zinc-400 font-bold uppercase tracking-widest text-xs hover:bg-zinc-800 transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
        }

        function openEditModal(id, nama, nomor, status, pesan) {
            // Isi data ke dalam input modal
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_nomor').value = nomor;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_pesan').value = pesan;

            // Munculkan modal
            toggleModal('modalEdit');
        }
    </script>
</body>

</html>