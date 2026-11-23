<?php
require_once 'koneksi.php';
$sql_kategori = "SELECT * FROM tb_kategori_buku ORDER BY kategori_buku ASC";
$query_kategori = mysqli_query($conn, $sql_kategori);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>

    <h2>Tambah Buku Baru</h2>
    <form action="book-simpan.php" method="POST" enctype="multipart/form-data">
        
        <label>Kategori</label><br>
        <select name="id_kategori_buku" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($kat = mysqli_fetch_assoc($query_kategori)) { ?>
                <option value="<?= $kat['id_kategori_buku']; ?>"><?= htmlspecialchars($kat['kategori_buku']); ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label>Judul Buku</label><br>
        <input type="text" name="judul_buku" required>
        <br><br>

        <label>Penulis</label><br>
        <input type="text" name="penulis" required>
        <br><br>

        <label>Penerbit</label><br>
        <input type="text" name="penerbit" required>
        <br><br>

        <label>Foto Cover</label><br>
        <input type="file" name="Foto_cover" accept="image/*" required>
        <br><br>

        <button type="submit" name="simpan">Simpan</button>
        <a href="book.php">Kembali</a>

    </form>

</body>
</html>