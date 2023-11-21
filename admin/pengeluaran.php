<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
};

// Pagination
$jmlHalamanPerData = 5;
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
          <li class="list-group-item bg-transparent"><a href="home.php">Home</a></li>
          <li class="list-group-item bg-transparent"><a href="member.php">Data Member</a></li>
          <li class="list-group-item bg-transparent"><a href="lapangan.php">Data Lapangan</a></li>
          <li class="list-group-item bg-transparent"><a href="pesan.php">Data Pesanan</a></li>
          <li class="list-group-item bg-transparent"><a href="admin.php">Data Admin</a></li>
          <li class="list-group-item bg-transparent"><a href="pengeluaran.php">Data Pengeluaran</a></li>
          <li class="list-group-item bg-transparent"><a href="settingadmin.php">Setting Admin</a></li>
          <li class="list-group-item bg-transparent"></li>
        </ul>
        <a href="../logout.php" class="mt-5 btn btn-inti text-dark">Logout</a>
      </div>
      <div class="col-10 p-5 mt-3">
        <!-- Konten -->
        <h3 class="judul">Data Pengeluaran</h3>
        <hr>
        <button class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
        <a href="" class="btn btn-inti" onclick="printTable()">Download</a>
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
                        <label for="exampleInputPassword1" class="form-label">Keterengan</label>
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
                    <a href="./controller/hapusPengeluaran.php?id=<?= $row["idpengeluaran"]; ?>" class="btn btn-danger">Hapus</a>
                  </td>
                  <!-- Edit Modal -->
                  <div class="modal fade" id="editModal<?= $row["id_user"]; ?>" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="tambahModalLabel">Edit Admin <?= $row["nama"]; ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id" class="form-control" id="exampleInputPassword1" value="<?= $row["id_user"]; ?>>">
                          <div class="modal-body">
                            <!-- konten form modal -->
                            <div class="row justify-content-center align-items-center">
                              <div class="mb-3">
                                <img src="../img/user.png" alt="gambar lapangan" class="img-fluid" width="70%" height="70%">
                              </div>
                              <div class="col">
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Username</label>
                                  <input type="text" name="username" class="form-control" id="exampleInputPassword1" value="<?= $row["username"]; ?>">
                                </div>
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Password</label>
                                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="<?= $row["password"]; ?>">
                                </div>
                              </div>
                              <div class="col">
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                                  <input type="nama" name="nama" class="form-control" id="exampleInputPassword1" value="<?= $row["nama"]; ?>">
                                </div>
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Email</label>
                                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $row["email"]; ?>">
                                </div>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">No Hp</label>
                                <input type="number" name="hp" class="form-control" id="exampleInputPassword1" value="<?= $row["phone"]; ?>">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary" name="edit" id="edit">Simpan</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal Tambah -->
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
  </script>
</body>

</html>