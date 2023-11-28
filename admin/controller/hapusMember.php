<?php
require "../../functions.php";
$id_user = $_GET["id"];

if (hapusMember($id_user) > 0) {
  echo "
  <script>
    alert('User berhasil dihapus');
    document.location.href = '../member.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('User gagal untuk dihapus');
    document.location.href = '../member.php'; 
  </script>
  ";
}
