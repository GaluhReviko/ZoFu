<?php
require "../../functions.php";
$id_sewa = $_GET["id"];

if (hapusPesan($id_sewa) > 0) {
  echo "
  <script>
    alert('Pesanan berhasil dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Pesanan gagal untuk dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
}
