<?php
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $NIK = htmlspecialchars($_POST['NIK']);
    $Nama = htmlspecialchars($_POST['Nama']);
    $Tglahir = htmlspecialchars($_POST['Tglahir']);
    $Alamat = htmlspecialchars($_POST['Alamat']);
    $Gaji = htmlspecialchars($_POST['Gaji']);
    $Kelas = htmlspecialchars($_POST['Kelas']);

    if (empty($NIK)) {
        echo "NIK tidak boleh kosong.";
        exit;
    }

    $query = "SELECT * FROM guru WHERE NIK = '$NIK'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "NIK sudah ada, silakan gunakan NIK yang berbeda.";
        exit;
    }

    $sql = "INSERT INTO guru (NIK, Nama, Tglahir, Alamat, Gaji, Kelas) VALUES ('$NIK', '$Nama', '$Tglahir', '$Alamat', '$Gaji', '$Kelas')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data guru baru telah disimpan.');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Tambah Data Guru - Management System</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />
  <style>
    body, html {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      height: 100%;
    }

    .navbar {
      background-color: #2c3e50;
      min-height: 10vh;
    }
    .nav-link {
      font-size: 17px;
      margin-left: 20px;
    }

    .navbar-brand, .nav-link {
      color: white !important;
    }

    .container {
      margin-top: 80px;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .card-header {
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    .form-label {
      font-weight: 600;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: bold;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }

    .footer {
      background-color: #2c3e50;
      color: white;
      padding: 20px 0;
      text-align: center;
    }
    footer a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
    }
    footer a:hover {
      color: #dbeafe;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Data Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="Siswa.php">Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="Guru.php">Guru</a></li>
            <li class="nav-item"><a class="nav-link" href="Absensi.php">Absensi</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-center">Form Tambah Data Guru</div>
            <div class="card-body">
              <form action="" method="post" autocomplete="off">
                <div class="mb-3">
                  <label class="form-label">NIK</label>
                  <input type="text" class="form-control" name="NIK" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="Nama" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="Tglahir" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="Alamat" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Gaji</label>
                  <input type="text" class="form-control" name="Gaji" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Kelas</label>
                  <input type="text" class="form-control" name="Kelas" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>

    <footer class="footer">
      <p>&copy; 2024 <a href="#">Rafi Bakhtiar Cahyadi</a>. All Rights Reserved.</p>
    </footer>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>