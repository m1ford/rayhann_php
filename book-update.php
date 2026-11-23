<?php
require_once 'koneksi.php';

$id               = $_POST['id_buku'];
$id_kategori_buku = $_POST['id_kategori_buku'];
$judul_buku       = mysqli_real_escape_string($conn, $_POST['judul_buku']);
$penulis          = mysqli_real_escape_string($conn, $_POST['penulis']);
$penerbit         = mysqli_real_escape_string($conn, $_POST['penerbit']);

// Ambil foto lama
$sql_foto   = "SELECT Foto_cover FROM tb_buku WHERE id_buku = '$id'";
$query_foto = mysqli_query($conn, $sql_foto);
$data_foto  = mysqli_fetch_assoc($query_foto);
$foto_cover = $data_foto['Foto_cover'];

// Jika upload foto baru
if (!empty($_FILES['Foto_cover']['name'])) {
    $foto_cover = $_FILES['Foto_cover']['name'];
    $tmp        = $_FILES['Foto_cover']['tmp_name'];
    $folder     = "uploads/";

    move_uploaded_file($tmp, $folder . $foto_cover);

    // Hapus foto lama jika ada
    if (!empty($data_foto['Foto_cover']) && file_exists($folder . $data_foto['Foto_cover'])) {
        unlink($folder . $data_foto['Foto_cover']);
    }
}

$sql = "UPDATE tb_buku SET 
        id_kategori_buku = '$id_kategori_buku',
        judul_buku = '$judul_buku',
        penulis = '$penulis',
        penerbit = '$penerbit',
        Foto_cover = '$foto_cover'
        WHERE id_buku = '$id'";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Data buku berhasil diperbarui!');
            window.location='book.php';
          </script>";
} else {
    echo "<script>
            alert('Data buku gagal diperbarui!');
            window.location='book.php';
          </script>";
}
?>