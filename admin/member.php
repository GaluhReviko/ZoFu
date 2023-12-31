<?php
session_start();
require "../session.php";
require "../functions.php";

if ($role !== 'Admin') {
  header("location:/login.php");
}

// Pagination
$jmlHalamanPerData = 5;
$jumlahData = count(query("SELECT * FROM user"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$member = query("SELECT * FROM user LIMIT $awalData, $jmlHalamanPerData");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="/img/soccer-ground.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <title>Data Member</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="sidebar col-2">
        <!-- Sidebar -->
        <h5 class="mt-5 judul text-center"><?= $_SESSION["username"]; ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent"><a href="home.php"><i class="bi bi-house-door-fill mx-2"></i> Home</a></li>
          <li class="list-group-item bg-transparent"><a href="member.php"><i class="bi bi-people-fill mx-2"></i>Data Member</a></li>
          <li class="list-group-item bg-transparent"><a href="lapangan.php"><i class="bi bi-globe2 mx-2"></i>Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a href="pesan.php"><i class="bi bi-clipboard2-fill mx-2"></i>Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a href="admin.php"><i class="bi bi-person-workspace mx-2"></i>Data Admin</a></li>
          <li class="list-group-item bg-transparent"><a href="pengeluaran.php"><i class="bi bi-piggy-bank-fill mx-2"></i>Pengeluaran</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a href="../logout.php" class="mt-5 btn btn-inti text-dark"><i class="bi bi-box-arrow-left"></i> Logout</a>
      </div>
      <div class="col-10 p-5 mt-3">
        <!-- Konten -->
        <h3 class="judul">Data Member</h3>
        <hr>
        <div class="input-group rounded mt-2">
          <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <span class="input-group-text border-0" id="search-addon">
            <i class="bi bi-search"></i>
          </span>
        </div>
        <table class="table table-hover mt-3">
          <thead class="table-inti">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Email</th>
              <th scope="col">No hp </th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <form action="" method="post">
            <tbody class="text" id="searchResults">
              <?php $i = 1; ?>
              <?php foreach ($member as $row) : ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $row["nama_lengkap"]; ?></td>
                  <td><?= $row["jenis_kelamin"]; ?></td>
                  <td><?= $row["email"]; ?></td>
                  <td><?= $row["hp"]; ?></td>
                  <td>
                    <a href="./controller/hapusMember.php?id=<?= $row["id_user"]; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</a>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </form>
        </table>

        <ul class="pagination">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Previous</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $jmlHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else : ?>
              <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $jmlHalaman) : ?>
            <li class="page-item">
              <a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const searchInput = document.getElementById("searchInput");
          const rows = document.querySelectorAll("#searchResults tr");

          searchInput.addEventListener("input", function() {
            const searchQuery = searchInput.value.toLowerCase();

            rows.forEach((row) => {
              const cells = row.getElementsByTagName("td");
              let rowContainsQuery = false;

              for (let i = 0; i < cells.length; i++) {
                const cellText = cells[i].textContent.toLowerCase();

                if (cellText.includes(searchQuery)) {
                  rowContainsQuery = true;
                  break;
                }
              }

              if (rowContainsQuery) {
                row.style.display = "";
              } else {
                row.style.display = "none";
              }
            });
          });
        });
      </script>
</body>

</html>