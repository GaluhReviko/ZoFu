<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusPengeluaran($id_user) > 0) {
  echo "
  <script>
    alert('Data pengeluaran berhasil dihapus');
    document.location.href = '../pengeluaran.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Data pengeluaran gagal gihapus');
    document.location.href = '../pengeluaran.php'; 
  </script>
  ";
}
