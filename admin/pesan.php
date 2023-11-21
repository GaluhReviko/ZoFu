<?php
session_start();
require "../session.php";
require "../functions.php";

if ($role !== 'Admin') {
  header("location:../login.php");
}

// Pagination
$jmlHalamanPerData = 1000;
$jumlahData = count(query("SELECT sewa.idsewa,user.nama_lengkap,sewa.tgl_pesan,sewa.jmulai,sewa.jhabis,sewa.lama,sewa.tot,bayar.bukti,bayar.konfirmasi
FROM sewa
JOIN user ON sewa.iduser = user.id_user
JOIN bayar ON sewa.idsewa = bayar.idsewa"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$pesan = query("SELECT sewa.idsewa,user.nama_lengkap,sewa.tgl_pesan,sewa.jmulai,sewa.jhabis,sewa.lama,sewa.tot,bayar.bukti,bayar.konfirmasi
FROM sewa
JOIN user ON sewa.iduser = user.id_user
JOIN bayar ON sewa.idsewa = bayar.idsewa LIMIT $awalData, $jmlHalamanPerData");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="/img/soccer-ground.ico">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <title>Data Pesanan</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      <div class="sidebar col-2">
        <!-- Sidebar -->
        <h5 class="mt-5 judul text-center"><?= $_SESSION["username"]; ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent"><a href="home.php">Home</a></li>
          <li class="list-group-item bg-transparent"><a href="member.php">Data Member</a></li>
          <li class="list-group-item bg-transparent"><a href="lapangan.php">Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a href="pesan.php">Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a href="admin.php">Data Admin</a></li>
          <li class="list-group-item bg-transparent"><a href="pengeluaran.php">Data Pengeluaran</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a href="../logout.php" class="mt-5 btn btn-inti text-dark">Logout</a>
      </div>
      <div class="col-10 p-5 mt-3">
        <!-- Konten -->
        <h3 class="judul">Data Pesanan</h3>
        <hr>
        <a href="" class="btn btn-inti" onclick="printTable()">Download</a>
        <div class="input-group rounded mt-2">
          <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <span class="input-group-text border-0" id="search-addon">
            <i class="bi bi-search"></i>
          </span>
        </div>
        <div style="overflow: auto; height:400px; margin-bottom:30px; margin-top:3px;">
        <table class="table table-striped mt-3">
          <thead class="table-inti" style="position: sticky; top:0; z-index:1; ">
            <tr>
            <th scope="col" style="text-align: center; vertical-align: middle;">No</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Nama Customer</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal Pesan</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal Main</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Jam Habis</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Lama Main</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Total</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Bukti</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Konfirmasi</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Aksi</th>
            </tr>
          </thead>
          <tbody class="text" id="searchResults">
            <?php $i = 1; ?>
            <?php foreach ($pesan as $row) : ?>
              <tr>
              <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["nama_lengkap"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["tgl_pesan"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["jmulai"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["jhabis"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["lama"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["tot"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><img src="../img/<?= $row["bukti"]; ?>" width="100" height="100"></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["konfirmasi"]; ?></td>
              <td style="text-align: center; vertical-align: middle;">
                <?php
                $idsewa = $row["idsewa"];
                if ($row["konfirmasi"] == "Terkonfirmasi") {
                  // tampilkan tombol Bayar dan Hapus
                  echo '';
                } else {
                  // tampilkan tombol Detail
                  echo ' <button type="button" class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#konfirmasiModal' . $idsewa . '">
                  Konfirmasi
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal' . $idsewa . '">
                  Hapus Pes
                </button>
                ';
                }
                ?>
              </td>
              </tr>
              <!-- Modal Konfirmasi -->
              <div class="modal fade" id="konfirmasiModal<?= $row["idsewa"]; ?>" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Pesanan <?= $row["nama_lengkap"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin mengkonfirmasi pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/konfirmasiPesan.php?id=<?= $row["idsewa"]; ?>" class="btn btn-primary">Konfirmasi</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->

              <!-- Modal Hapus -->
              <div class="modal fade" id="hapusModal<?= $row["idsewa"]; ?>" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="hapusModalLabel">Hapus Pesanan <?= $row["nama_lengkap"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda yakin ingin menghapus pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <a href="./controller/hapusPesan.php?id=<?= $row["idsewa"]; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Konfirmasi -->
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
          <table class="table table-striped mt-3" id="print">
          <thead class="table" style="background-color:#9cd203 ;">
            <tr>
            <th scope="col" style="text-align: center; vertical-align: middle;">No</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Nama Customer</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal Pesan</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal Main</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Jam Habis</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Lama Main</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Total</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Bukti</th>
            <th scope="col" style="text-align: center; vertical-align: middle;">Konfirmasi</th>
            <!-- <th scope="col" style="text-align: center; vertical-align: middle;">Aksi</th> -->
            </tr>
          </thead>
          <tbody class="" id="searchResults">
            <?php $i = 1; ?>
            <?php foreach ($pesan as $row) : ?>
              <tr>
              <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["nama_lengkap"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["tgl_pesan"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["jmulai"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["jhabis"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["lama"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["tot"]; ?></td>
              <td style="text-align: center; vertical-align: middle;"><img src="../img/<?= $row["bukti"]; ?>" width="100" height="100"></td>
              <td style="text-align: center; vertical-align: middle;"><?= $row["konfirmasi"]; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
        var printContents = document.getElementById("print").outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
}
      </script>
</body>

</html>