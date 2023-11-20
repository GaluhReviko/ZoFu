<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
    header("location:../login.php");
};


if (isset($_POST["simpan"])) {
    if (tambahAdmin($_POST) > 0) {
      echo "<script>
    alert('Admin baru berhasil ditambahkan');
  </script>";
    } else {
      echo "<script>
    alert('Admin baru gagal ditambahkan');
  </script>";
    }
  }
  
  if (isset($_POST["edit"])) {
    if (editAdmin($_POST) > 0) {
      echo "<script>
    alert('Data admin berhasil di update');
  </script>";
    } else {
      echo "<script>
    alert('Data admin berhasil di update');
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

    <title>Data Admin</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="sidebar col-2 bg-secondary">
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
            <div class="col-10 p-5">
                <h3 class="judul">Edit Akun </h3>
                <hr>
                <div class="row">
                    <!-- edit form column -->
                    <div class="col-md-9 personal-info" id="editModal<?= ["id_user"]; ?>" tabindex="-1">
                        <form class="form-horizontal" method="post">
                        <input type="hidden" name="id" class="form-control" id="exampleInputPassword1" value="<?= $_SESSION["id_user"]; ?>>">
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-lg-3 control-label">Username:</label>
                                <div class="col-lg-8">
                                <input type="text" name="username" class="form-control" id="exampleInputPassword1" value="<?= $row["username"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-lg-3 control-label">Nama Lengkap</label>
                                <div class="col-lg-8">
                                <input type="text" name="nama" class="form-control" id="exampleInputPassword1"  value="<?= $row["nama"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-lg-3 control-label">Email</label>
                                <div class="col-lg-8">
                                <input type="email" name="email" class="form-control" id="exampleInputPassword1"  value="<?= $row["email"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-lg-3 control-label">Password</label>
                                <div class="col-lg-8">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"  value="<?= $row["password"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-lg-3 control-label">No HP</label>
                                <div class="col-lg-8">
                                <input type="number" name="hp" class="form-control" id="exampleInputPassword1"   value="<?= $row["phone"]; ?>">
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                            <button class="btn btn-inti" data-bs-toggle="modal" data-bs-target="#editModal<?= $row["id_user"]; ?>">Edit Akun</button>
                                <span></span>
                                <a href="./controller/hapusAdmin.php?id=<?= $row["id_user"]; ?>" class="btn btn-danger">Hapus Akun</a>
                                <span></span>
                                
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>