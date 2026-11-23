<?php
require_once 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_kategori_buku = $_POST['id_kategori_buku'];
    $judul_buku       = mysqli_real_escape_string($conn, $_POST['judul_buku']);
    $penulis          = mysqli_real_escape_string($conn, $_POST['penulis']);
    $penerbit         = mysqli_real_escape_string($conn, $_POST['penerbit']);

    $foto_cover       = $_FILES['Foto_cover']['name'];
    $tmp              = $_FILES['Foto_cover']['tmp_name'];
    $folder           = "uploads/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    move_uploaded_file($tmp, $folder . $foto_cover);

    $sql = "INSERT INTO tb_buku (id_kategori_buku, judul_buku, penulis, penerbit, Foto_cover) 
            VALUES ('$id_kategori_buku', '$judul_buku', '$penulis', '$penerbit', '$foto_cover')";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
                alert('Data buku berhasil disimpan!');
                window.location='book.php';
              </script>";
    } else {
        echo "<script>
                alert('Data buku gagal disimpan!');
                window.location='book-tambah.php';
              </script>";
    }
}
?>