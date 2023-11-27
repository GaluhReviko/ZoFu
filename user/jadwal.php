<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'User') {
  header("location:../login.php");
};

$id_user = $_SESSION["id_user"];
$id_lpg = $_GET["id"];

$sewa = query("SELECT sewa.*, lapangan.nm, user.nama_lengkap
FROM sewa
JOIN lapangan ON sewa.idlap = lapangan.idlap
LEFT JOIN user ON sewa.iduser = user.id_user
WHERE lapangan.idlap = '$id_lpg'
");
$profil = query("SELECT * FROM user WHERE id_user = '$id_user'")[0];


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jadwal Lapangan</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="/img/soccer-ground.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <!-- Navbar -->
  <div class="container ">
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: rgba(255, 255, 255, 0.724);">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../img/soccer-ground.png" alt="Logo" width="45" height="45" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="lapangan.php">Lapangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="bayar.php">Pembayaran</a>
            </li>
          </ul>
          <?php
          if (isset($_SESSION['id_user'])) {
            // jika user telah login, tampilkan tombol profil dan sembunyikan tombol login
            echo '<a href="" data-bs-toggle="modal" data-bs-target="#profilModal" class="btn btn-inti"><i data-feather="user"></i></a>';
          } else {
            // jika user belum login, tampilkan tombol login dan sembunyikan tombol profil
            echo '<a href="login.php" class="btn btn-inti" type="submit">Login</a>';
          }
          ?>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->
  <!-- Modal Profil -->
  <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profilModalLabel">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-4 my-5">
                <img src="../img/user.png" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col-8">
                <h5 class="mb-3"><?= $profil["nama_lengkap"]; ?></h5>
                <p><?= $profil["jenis_kelamin"]; ?></p>
                <p><?= $profil["email"]; ?></p>
                <p><?= $profil["hp"]; ?></p>
                <p><?= $profil["alamat"]; ?></p>
                <a href="../logout.php" class="btn btn-danger">Logout</a>
                <a href="" data-bs-toggle="modal" data-bs-target="#editProfilModal" class="btn btn-inti">Edit Profil</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Profil -->

  <!-- Edit profil -->
  <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog edit modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row justify-content-center align-items-center">
              <div class="mb-3">
                <img src="../img/<?= $profil["foto"]; ?>" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="exampleInputPassword1" value="<?= $profil["nama_lengkap"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($profil['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($profil['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">No Telp</label>
                  <input type="number" name="hp" class="form-control" id="exampleInputPassword1" value="<?= $profil["hp"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $profil["email"]; ?>">
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">alamat</label>
                <input type="text" name="alamat" class="form-control" id="exampleInputPassword1" value="<?= $profil["alamat"]; ?>">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-inti" name="simpan" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Edit Profil -->

  <section class="lapangan mb-5" id="lapangan">
    <div class="container-fluid">
      <h2 class="text-head"><span>Jadwal</span> Lapangan </h2>
      <form action="" method="post" class="px-4">
      <div class="input-group rounded mt-2">
          <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <span class="input-group-text border-0" id="search-addon">
            <i class="bi bi-search"></i>
          </span>
        </div>
        <div style="overflow:auto; height:600px; margin-bottom:20px; margin-top:3px;">
        <table class="table my-3">
          <thead class="table table-light" style="position: sticky; top:0; z-index:1; ">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal Pesan</th>
              <th scope="col">Nama Pemesan</th>
              <th scope="col">Nama Lapangan</th>
              <th scope="col">Jam Main</th>
              <th scope="col">Lama Sewa</th>
              <th scope="col">jam Habis</th>
            </tr>
          </thead>
          <tbody id="searchResults">
            <?php $i = 1; ?>
            <?php foreach ($sewa as $row) : ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $row["tgl_pesan"] ?></td>
                <td><?= $row["nama_lengkap"] ?></td>
                <td><?= $row["nm"] ?></td>
                <td><?= $row["jmulai"] ?></td>
                <td><?= $row["lama"] ?></td>
                <td><?= $row["jhabis"] ?></td>
                <!-- Modal Bayar -->
                <div class="modal fade" id="bayarModal<?= $row["idsewa"] ?>" tabindex="-1" role="dialog" aria-labelledby="bayarModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Bayar Lapangan <?= $row["nm"]; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="" method="post">
                        <input type="hidden" name="idsewa" value="<?= $row["idsewa"]; ?>">
                        <div class="modal-body">
                          <!-- konten form modal -->
                          <div class="row justify-content-center align-items-center">
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jam Main</label>
                                <input type="datetime-local" name="tgl_main" class="form-control" id="exampleInputPassword1" value="<?= $row["jmulai"]; ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jam Habis</label>
                                <input type="datetime-local" name="jam_habis" class="form-control" id="exampleInputPassword1" value="<?= $row["jhabis"]; ?>" disabled>
                              </div>
                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Lama Main</label>
                                <input type="number" name="jam_mulai" class="form-control" id="exampleInputPassword1" value="<?= $row["lama"]; ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" id="exampleInputPassword1" value="<?= $row["harga"]; ?>" disabled>
                              </div>
                            </div>
                            <div class="input-group ">
                              <div class="input-group-prepend border border-danger">
                                <span class="input-group-text">Total</span>
                              </div>
                              <input type="number" name="total" class="form-control border border-danger" id="exampleInputPassword1" value="<?= $row["tot"]; ?>" disabled>
                            </div>
                            <div class="mt-3">
                              <label for="exampleInputPassword1" class="form-label">Upload Bukti</label>
                              <input type="file" name="bukti" class="form-control" id="exampleInputPassword1">
                            </div>
                          </div>
                        </div>
                        <div class="mt-3 mx-3">
                          <h6 class=" text-center border border-danger">Status : Belum Bayar</h6>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-inti" name="bayar" id="bayar">Bayar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal Bayar -->

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal<?= $row["idsewa"] ?>" tabindex="-1" role="dialog" aria-labelledby="bayarModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Pembayaran Lapangan <?= $row["nm"]; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="" method="post">
                        <div class="modal-body">
                          <!-- konten form modal -->
                          <div class="row justify-content-center align-items-center">
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jam Main</label>
                                <input type="datetime-local" name="tgl_main" class="form-control" id="exampleInputPassword1" value="<?= $row["jmulai"]; ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jam Habis</label>
                                <input type="datetime-local" name="jam_habis" class="form-control" id="exampleInputPassword1" value="<?= $row["jhabis"]; ?>" disabled>
                              </div>
                            </div>
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Lama Main</label>
                                <input type="number" name="jam_mulai" class="form-control" id="exampleInputPassword1" value="<?= $row["lama"]; ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" id="exampleInputPassword1" value="<?= $row["harga"]; ?>" disabled>
                              </div>
                            </div>
                            <div class="input-group ">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Total</span>
                              </div>
                              <input type="number" name="total" class="form-control " id="exampleInputPassword1" value="<?= $row["tot"]; ?>" disabled>
                            </div>
                            <div class="mt-3">
                              <label for="exampleInputPassword1" class="form-label">Upload Bukti</label>
                              <input type="file" name="bukti" class="form-control" id="exampleInputPassword1">
                            </div>
                          </div>
                        </div>
                        <div class="mt-3 mx-3">
                          <h6 class="text-center border border-danger">Status : <?= $row["konfirmasi"]; ?></h6>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal Detail -->

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal<?= $row["idsewa"]; ?>" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Data</h5>
                      </div>
                      <div class="modal-body">
                        <p>Anda yakin ingin menghapus data ini?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="./controller/hapus.php?id=<?= $row["idsewa"] ?>" class="btn btn-danger">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Hapus -->

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer_jadwal mt-5">
    <div class="bg-light py-4">
      <div class="container text-center">
      <p class="text-muted mb-0 py-2">© 2023 <b>Zona-Futsal</b> All rights reserved.</p>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script>
    feather.replace();

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
  <script src="/main2.js"></script>
</body>

</html>