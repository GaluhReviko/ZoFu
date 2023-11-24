<?php
require "../../functions.php";
$idsewa = $_GET["id"];

if (konfirmasi($idsewa) > 0) {
  echo "
  <script>
    alert('Pesanan berhasil dikonfirmasi');
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
