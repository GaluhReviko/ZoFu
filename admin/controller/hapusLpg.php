<?php
require "../../functions.php";
$id_lap = $_GET["id"];

if (hapusLpg($id_lap) > 0) {
  echo "
  <script>
    alert('Lapangan berhasil dihapus');
    document.location.href = '../lapangan.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Lapangan gagal untuk dihapus');
    document.location.href = '../lapangan.php'; 
  </script>
  ";
}
