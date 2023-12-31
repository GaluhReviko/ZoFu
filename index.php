<?php
session_start();
require "functions.php";

if (isset($_SESSION["id_user"])) {
  $id_user = $_SESSION["id_user"];

  // Make sure $id_user is not null and not an empty string before using it
  if (!empty($id_user)) {
      // Assuming query() is a function that performs a database query safely
      $profil = query("SELECT * FROM user WHERE id_user = '$id_user'");

      // Check if the query returned any results
      if (!empty($profil)) {
          $user_profile = $profil[0];
          // Process user profile data here
      } else {
          // Handle case when user profile is not found
          // You might want to redirect to a login page or show an error message
      }
  } else {
      // Handle case when $id_user is empty
      // You might want to redirect to a login page or show an error message
  }
} else {
  // Handle case when $_SESSION["id_user"] is not set
  // You might want to redirect to a login page or show an error message
}


if (isset($_POST["simpan"])) {
  if (edit($_POST) > 0) {
    echo "<script>
          alert('Ptofil berhasil Diubah');
          window.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
          alert('Profil gagal Diubah');
          </script>";
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sport Center</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
  <link rel="icon" href="/img/soccer-ground.ico">
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>
  <!-- Navbar -->
  <div class="container">
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: rgba(255, 255, 255, 0.724);">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="/img/soccer-ground.png" alt="Logo" width="45" height="45" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#bayar">Tata Cara</a>
            </li>
            <?php
            if (isset($_SESSION['id_user'])) {
              echo '
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user/lapangan.php">Lapangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user/bayar.php">Pembayaran</a>
            </li>
            ';
            }
            ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#contact">Kontak</a>
            </li>
          </ul>
          <?php
          if (isset($_SESSION['id_user'])) {
            // jika user telah login, tampilkan tombol profil dan sembunyikan tombol login
            echo '<a href="user/profil.php" data-bs-toggle="modal" data-bs-target="#profilModal" class="btn btn-inti"><i data-feather="user"></i></a>';
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
                <img src="/img/user.png" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col-8">
                <h5 class="mb-3"><?= $user_profile["nama_lengkap"]; ?></h5>
                <p><?= $user_profile["jenis_kelamin"]; ?></p>
                <p><?= $user_profile["email"]; ?></p>
                <p><?= $user_profile["hp"]; ?></p>
                <p><?= $user_profile["alamat"]; ?></p>
                <a href="logout.php" class="btn btn-danger">Logout</a>
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
                <img src="/img/user.png" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="exampleInputPassword1" value="<?= $user_profile["nama_lengkap"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($user_profile['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($user_profile['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">No Telp</label>
                  <input type="number" name="hp" class="form-control" id="exampleInputPassword1" value="<?= $user_profile["hp"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $user_profile["email"]; ?>">
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">alamat</label>
                <input type="text" name="alamat" class="form-control" id="exampleInputPassword1" value="<?= $user_profile["alamat"]; ?>">
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
  <!-- End Edit Modal -->

  <!-- Jumbotron -->
  <section class="jumbotron" id="home">
    <main class="contain" data-aos="fade-right" data-aos-duration="1000">
      <h1 class="text-light">Sehatkan Dirimu Dengan Berolahraga di <span>Zona</span> Futsal </h1>
      <p>
        Futsal: Energi di atas Lapangan!
      </p>
    </main>
  </section>
  <!-- End Jumbotron -->

  <!-- About -->
  <section class="about" id="about">
    <h2 data-aos="fade-down" data-aos-duration="1000">
      <span>Tentang</span> Kami
    </h2>
    <div class="row">
      <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
        <img src="img/futsal.jpg" alt="" />
      </div>
      <div class="contain" data-aos="fade-left" data-aos-duration="1000">
        <h4 class="text-center mb-3">Kenapa Memilih kami?</h4>
        <p>Pilihlah kami sebagai destinasi persewaan futsal Anda karena kami menawarkan pengalaman unik dan layanan berkualitas tinggi. Dengan fasilitas futsal yang modern, lokasi strategis, jadwal fleksibel, kebersihan, dan keamanan terjaga, serta harga yang terjangkau, kami siap memenuhi semua kebutuhan Anda</p>
      </div>
    </div>
  </section>
  <!-- End About -->

  <!-- Gallery -->
  <section class="gallery" id="gallery">
  <h2 data-aos="fade-down" data-aos-duration="1000">
      <span>Gallery</span> Kami
    </h2>
    <p class="text-center m-3">
      Kumpulan foto-foto yang ada di Zona futsal
    </p>  
  <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="d-flex justify-content-center">
          <div class="card">
            <img src="/img/lapanganfutsal.jpg" class="card-img-top" alt="..." />

          </div>
          <div class="card">
            <img src="/img/footbal.jpg" class="card-img-top" alt="..." />
          </div>
          <div class="card">
            <img src="/img/futsal.jpg" class="card-img-top" alt="..." />
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center">
          <div class="card">
            <img src="/img/futsal.jpg" class="card-img-top" alt="..." />
          </div>
          <div class="card">
            <img src="/img/lapanganfutsal.jpg" class="card-img-top" alt="..." />
          </div>
          <div class="card">
            <img src="/img/footbal.jpg" class="card-img-top" alt="..." />
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="d-flex justify-content-center">
          <div class="card">
            <img src="/img/footbal.jpg" class="card-img-top" alt="..." />
          </div>
          <div class="card">
            <img src="/img/futsal.jpg" class="card-img-top" alt="..." />
          </div>
          <div class="card">
            <img src="/img/lapanganfutsal.jpg" class="card-img-top" alt="..." />
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </div>
  </section>
  <!-- End Gallery -->

  <!-- Pembayaran -->
  <section class="pembayaran" id="bayar">
    <h2 data-aos="fade-down" data-aos-duration="1000">
      <span>Tata Cara</span> Pembayaran
    </h2>
    <p class="text-center">Berikut adalah tata cara pembayaran lapangan pada website Zona Futsal :</p>
    <ul class="border list-group list-group-flush mt-5">
      <li class="list-group-item">1. Pengguna harus membuat akun atau mendaftar terlebih dahulu sebagai pengguna pada website Zona Futsal.</li>
      <li class="list-group-item">2. Pengguna dapat memilih jenis lapangan dan waktu yang tersedia untuk dipesan, serta memilih tanggal dan waktu tertentu.</li>
      <li class="list-group-item">3. Pengguna harus memilih tanggal dan waktu, melihat harga sewa lapangan, mengisi jumlah jam atau durasi, serta melengkapi formulir pemesanan.</li>
      <li class="list-group-item">4. Jika sudah sesuai, pengguna dapat menekan tombol pesan.</li>
      <li class="list-group-item">5. Lalu pengguna akan diarahkan menuju ke menu pembayaran.</li>
      <li class="list-group-item">6. Kemudian lakukan pembayaran ke rekening yang sudah tertera dan upload bukti pembayaran.</li>
      <li class="list-group-item">7. Setelah di upload, tunggu admin menyetujui pembayaran Anda.</li>
      <li class="list-group-item">8. Apabila status sudah di setujui, silahkan datang ke Sport Center sesuai jadwal yang telah Anda pesan.</li>
    </ul>
  </section>
  <!-- End Pembayaran -->

  <!-- Contact -->
  <section id="contact" class="contact" data-aos="fade-down" data-aos-duration="1000">
    <h2><span>Kontak</span> Kami</h2>
    <p class="text-center m-5 mb-0">
      Hubungi kami jika ada saran yang ingin di sampaikan
    </p>
    <div class="row">
      <div class="row align-items-start text-start g-2 pt-4 pb-5">
        <div class="col-lg-7">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.326663873338!2d113.72363987491453!3d-8.16980748187607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695cfe9894601%3A0xc9639ab1c93a874a!2sZona%20Futsal!5e0!3m2!1sid!2sid!4v1697590001162!5m2!1sid!2sid" class="rounded-4 shadow-sm" width="100%" height="410" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-5">
          <div class="card h-100 border-0 rounded-4 shadow-sm">
            <div class="card-body p-4 pb-0">
              <div class="d-flex py-2">
                <div class="flex-shrink-0">
                  <i class="bi bi-geo-alt fs-4"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <a href="https://maps.app.goo.gl/HF2FSGG89Q4V9B4p6" target="_blank">
                    <h5 class="mb-1">Address</h5>
                    <p>Jember, Jawa Timur</p>
                  </a>
                </div>
              </div>
              <hr class="hr-dotted mt-0">
              <div class="d-flex py-2">
                <div class="flex-shrink-0">
                  <i class="bi bi-whatsapp fs-4"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <a href="" target="_blank">
                    <h5 class="mb-1">WhatsApp</h5>
                    <p>+62 812-3200-0991</p>
                  </a>
                </div>
              </div>
              <hr class="hr-dotted mt-0">
              <div class="d-flex py-2">
                <div class="flex-shrink-0">
                  <i class="bi bi-envelope fs-4"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <a href="mailto:pesonarembangan@gmail.com" target="_blank">
                    <h5 class="mb-1">Email</h5>
                    <p>zonafutsal@gmail.com</p>
                  </a>
                </div>
              </div>
              <hr class="hr-dotted mt-0">
              <div class="d-flex py-2">
                <div class="flex-shrink-0">
                  <i class="bi bi-instagram fs-4"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <a href="" target="_blank">
                    <h5 class="mb-1">Instagram</h5>
                    <p>@Zona Futsal 2</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <!-- Footer -->
  <footer class="footer mt-5">
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
  </script>
  <script src="/main2.js"></script>
</body>

</html>