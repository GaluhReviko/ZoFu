<?php
require "../../functions.php";
$idsewa = $_GET["id"];

if (konfirmasi($idsewa) > 0) {
  echo "
  <script>
    alert('Data pesanan berhasil dikonfirmasi');
    document.location.href = '../pesan.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Data pesanan gagal untuk dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
}
