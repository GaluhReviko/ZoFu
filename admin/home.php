<?php
session_start();
require "../functions.php";
require "../session.php";
if ($role !== 'Admin') {
  header("location:../login.php");
}

// $lapangan = query("SELECT COUNT(idlap) AS jml_lapangan FROM lapangan")[0];
// $pesanan = query("SELECT COUNT(idbayar) AS jml_sewa FROM bayar")[0];
// $user = query("SELECT COUNT(id_user) AS jml_user FROM user")[0];
// $admin = query("SELECT COUNT(id_user) AS jml_admin FROM admin")[0];

// $sqlBulan = "SELECT MONTHNAME(s.tgl_pesan) AS bulan 
//              FROM sewa s
//              INNER JOIN bayar b ON s.idsewa = b.idsewa
//              WHERE b.konfirmasi = 'Terkonfirmasi'
//              GROUP BY MONTH(s.tgl_pesan)
//              ORDER BY MONTH(s.tgl_pesan)";
// $resultBulan = $conn->query($sqlBulan);

// // Query untuk mendapatkan total sewa
// $sqlTotalSewa = "SELECT MONTHNAME(s.tgl_pesan) AS bulan, 
//                         SUM(s.tot) AS total_sewa 
//                  FROM sewa s
//                  INNER JOIN bayar b ON s.idsewa = b.idsewa
//                  WHERE b.konfirmasi = 'Terkonfirmasi'
//                  GROUP BY MONTH(s.tgl_pesan)
//                  ORDER BY MONTH(s.tgl_pesan)";
// $resultTotalSewa = $conn->query($sqlTotalSewa);

// $labels = [];
// $totalSewa = [];

// while ($rowBulan = $resultBulan->fetch_assoc()) {
//   $bulan = $rowBulan['bulan'];
//   $labels[] = $bulan;

//   $totalSewa[$bulan] = 0;
// }

// while ($rowTotalSewa = $resultTotalSewa->fetch_assoc()) {
//   $bulan = $rowTotalSewa['bulan'];
//   $totalSewa[$bulan] = $rowTotalSewa['total_sewa'];
// }


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

  <title>Home</title>
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
        <h3 class="judul">Home</h3>
        <hr>
        <div>
        <iframe title="Report Section" width="1200" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiNzEzNThhNzctMTcyYi00YTk3LWJlMjgtMjUxZTcxMWE0ZTJjIiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
        </div>
        <div>
          <hr>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const DATA_COUNT = 12;
      const NUMBER_CFG = {
        count: DATA_COUNT,
        min: -100,
        max: 100
      };

      const lineLabels = <?php echo json_encode($labels); ?>;
      const lineData = {
        labels: lineLabels,
        datasets: [{
          label: 'Lapangan',
          data: <?php echo json_encode(array_values($totalSewa)); ?>,
          borderColor: 'red',
          backgroundColor: 'rgba(255, 0, 0, 0.5)',
        }]
      };

      // Add the following code to create a new Chart instance using the provided data
      var lineCtx = document.getElementById('myLineChart').getContext('2d');

      var lineChart = new Chart(lineCtx, {
        type: 'line',
        data: lineData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'PENDAPATAN',
            },
          },
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    </script>
</body>

</html>