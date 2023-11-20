<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusAdmin($id_user) > 0) {
  echo "
  <script>
    alert('Admin berhasil dihapus');
    document.location.href = '../admin.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Admin gagal untuk dihapus');
    document.location.href = '../admin.php'; 
  </script>
  ";
}
