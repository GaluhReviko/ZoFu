<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
};

// Pagination
$jmlHalamanPerData = 31;
$jumlahData = count(query("SELECT * FROM pengeluaran"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$pengeluaran = query("SELECT * FROM pengeluaran LIMIT $awalData, $jmlHalamanPerData");


if (isset($_POST["simpan"])) {
  if (tambahPengeluaran($_POST) > 0) {
    echo "<script>
  alert('Pengeluaran berhasil ditambahkan');
  Location:'admin/pengeluaran.php';
</script>";
  } else {
    echo "<script>
  alert('Pengeluaran gagal ditambahkan');
  Location:'admin/pengeluaran.php';
</script>";
  }
}
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

  <title>Data Pengeluaran</title>
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
        <h3 class="judul">Data Pengeluaran</h3>
        <hr>
        <button class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="bi bi-plus-circle"></i> Tambah</button>
        <a href="" class="btn btn-danger" onclick="printTable()"><i class="bi bi-filetype-pdf"></i></a>
        <a href="" class="btn btn-success" onclick="exportToExcel()"><i class="bi bi-filetype-xls"></i></i></a>
        <div class="input-group rounded mt-2">
          <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <span class="input-group-text border-0" id="search-addon">
            <i class="bi bi-search"></i>
          </span>
        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body">
                  <!-- konten form modal -->
                  <div class="row justify-content-center align-items-center">
                    <div class="col">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Pengeluaran</label>
                        <input type="date" name="Tanggalpengeluaran" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                        <input type="text" name="Keterangan" class="form-control" id="exampleInputPassword1">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Harga</label>
                      <input type="text" name="Jumlah" class="form-control" id="exampleInputPassword1">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Modal Tambah -->

        <div style="overflow:auto; height:300px; margin-bottom:20px; margin-top:3px;">
          <table class="table table-hover mt-3">
            <thead class="table-inti" style="position: sticky; top:0; z-index:1; ">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pengeluaran</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody class="text" id="searchResults">
              <?php $i = 1; ?>
              <?php foreach ($pengeluaran as $row) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><?= $row["tanggalpengeluaran"]; ?></td>
                  <td><?= $row["keterangan"]; ?></td>
                  <td><?= $row["jumlah"]; ?></td>
                  <td>
                    <a href="./controller/hapusPengeluaran.php?id=<?= $row["idpengeluaran"]; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

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
      <div style="display: none;">
        <table class="table table-striped mt-3" id="cetak">
          <thead class="table">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal Pengeluaran</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Harga</th>
            </tr>
          </thead>
          <tbody class="" id="searchResults">
            <?php $i = 1; ?>
            <?php foreach ($pengeluaran as $row) : ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $row["tanggalpengeluaran"]; ?></td>
                <td><?= $row["keterangan"]; ?></td>
                <td><?= $row["jumlah"]; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
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

    function printTable() {
        var printContents = document.getElementById("cetak").outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function exportToExcel() {
          var table2excel = new Table2Excel();
          table2excel.export(document.querySelectorAll("table.table"));
        }
  </script>
  <script src="/admin/table2excel.js"></script>
</body>

</html>