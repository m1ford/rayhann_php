<?php
require_once 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tb_buku WHERE id_buku = '$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='book.php';</script>";
    exit;
}

$sql_kategori = "SELECT * FROM tb_kategori_buku ORDER BY kategori_buku ASC";
$query_kategori = mysqli_query($conn, $sql_kategori);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>

    <h2>Edit Buku</h2>
    <form action="book-update.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">

        <label>Kategori</label><br>
        <select name="id_kategori_buku" required>
            <?php while ($kat = mysqli_fetch_assoc($query_kategori)) { ?>
                <option value="<?= $kat['id_kategori_buku']; ?>" 
                    <?= ($kat['id_kategori_buku'] == $data['id_kategori_buku']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($kat['kategori_buku']); ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Judul Buku</label><br>
        <input type="text" name="judul_buku" value="<?= htmlspecialchars($data['judul_buku']); ?>" required>
        <br><br>

        <label>Penulis</label><br>
        <input type="text" name="penulis" value="<?= htmlspecialchars($data['penulis']); ?>" required>
        <br><br>

        <label>Penerbit</label><br>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($data['penerbit']); ?>" required>
        <br><br>

        <label>Foto Cover Saat Ini</label><br>
        <?php if (!empty($data['Foto_cover'])) { ?>
            <img src="uploads/<?= htmlspecialchars($data['Foto_cover']); ?>" width="120"><br>
        <?php } else { ?>
            Tidak ada foto.<br>
        <?php } ?>
        <br>

        <label>Ganti Foto Cover (Opsional)</label><br>
        <input type="file" name="Foto_cover" accept="image/*">
        <br><br>

        <button type="submit" name="update">Update</button>
        <a href="book.php">Kembali</a>

    </form>

</body>
</html>