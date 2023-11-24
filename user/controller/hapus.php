<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusPesan($id_user) > 0) {
  echo "
  <script>
    alert('Pesanan berhasil dihapus');
    document.location.href = '../bayar.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Pesanan berhasil dihapus');
    document.location.href = '../bayar.php'; 
  </script>
  ";
}
