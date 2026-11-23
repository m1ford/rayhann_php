<?php
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>data buku</title>
</head>
<body>

    <h2>data buku</h2>
    <a href="book-tambah.php">tambah buku</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>no</th>
            <th>kategori</th>
            <th>judul buku</th>
            <th>penulis</th>
            <th>penerbit</th>
            <th>foto cover</th>
            <th>created at</th>
            <th>aksi</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT tb_buku.*, tb_kategori_buku.kategori_buku 
                                      FROM tb_buku 
                                      INNER JOIN tb_kategori_buku 
                                      ON tb_buku.id_kategori_buku = tb_kategori_buku.id_kategori_buku");
        
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['kategori_buku']); ?></td>
            <td><?= htmlspecialchars($row['judul_buku']); ?></td>
            <td><?= htmlspecialchars($row['penulis']); ?></td>
            <td><?= htmlspecialchars($row['penerbit']); ?></td>
            <td>
                <?php if (!empty($row['foto_cover'])) { ?>
                    <img src="uploads/<?= htmlspecialchars($row['foto_cover']); ?>" width="100">
                <?php } else { ?>
                    tidak ada foto
                <?php } ?>
            </td>
            <td><?= $row['created_at']; ?></td>
            <td>
                <a href="book-edit.php?id=<?= $row['id_buku']; ?>">edit</a> | 
                <a href="book-hapus.php?id=<?= $row['id_buku']; ?>" onclick="return confirm('yakin ingin menghapus data ini?')">hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>