<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusPengeluaran($id_user) > 0) {
  echo "
  <script>
    alert('Pengeluaran berhasil dihapus');
    document.location.href = '../pengeluaran.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Pengeluaran gagal gihapus');
    document.location.href = '../pengeluaran.php'; 
  </script>
  ";
}
