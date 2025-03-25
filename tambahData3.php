<?php
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // $ID = htmlspecialchars($_POST['ID']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $NISN = htmlspecialchars($_POST['NISN']);
    $status = htmlspecialchars($_POST['status']);
    $guruID = htmlspecialchars($_POST['guruID']);

    if (empty($NISN)) {
        echo "NISN tidak boleh kosong.";
        exit;
    }

    $query = "SELECT * FROM presensi WHERE NISN = '$NISN'";
    $result = mysqli_query($koneksi, $query);
    
    

    $sql = "INSERT INTO presensi (tgl, NISN, status, guruID, TimeStamp) VALUES ('$tgl', '$NISN', '$status', '$guruID', CURRENT_TIMESTAMP)";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data absen baru telah disimpan.');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}

$nama_query = "SELECT Nama FROM siswa"; 
$nama_result = mysqli_query($koneksi, $nama_query);

if (!$nama_result) {
    die("Query failed: " . mysqli_error($koneksi));
}
$nama_query = "SELECT Nama FROM guru"; 
$nama_result = mysqli_query($koneksi, $nama_query);

if (!$nama_result) {
    die("Query failed: " . mysqli_error($koneksi));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Tambah Data Absen - Management System</title>
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
            <div class="card-header text-center">Form Tambah Data Siswa</div>
            <div class="card-body">
              <form action="" method="post" autocomplete="off">
              <!-- <div class="mb-3">
              <label for="ID">ID</label>
              <input type="text" class="form-control" name="ID" required>
              </div> -->
              <div class="mb-3">
                  <label for="NISN">NISN</label>
                  <select class="form-control" name="NISN" required>
                      <option selected value="">Pilih nisn</option>
                      <?php 
            include 'koneksi.php';
            $sql= "select NISN,Nama from siswa order by Nama";
            $ambildata = mysqli_query($koneksi, $sql);
            while ($tampil = mysqli_fetch_array($ambildata)){
                
                echo "<option value='$tampil[NISN]'>$tampil[NISN] | $tampil[Nama]</option>";
            }
            
            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label><br />
                            <input type="radio" id="hadir" name="status" value="hadir" required />
                            <label for="hadir">hadir</label><br />
                            <input type="radio" id="izin" name="status" value="izin" required />
                            <label for="izin">izin</label><br />
                            <input type="radio" id="sakit" name="status" value="sakit" required />
                            <label for="sakit">sakit</label><br />
                            <input type="radio" id="alpa" name="status" value="alpa" required />
                            <label for="alpa">alpa</label><br />
                        </div>
                        <div class="mb-3">
                        <label for="tgl">tgl</label>
                        <input type="date" class="form-control" name="tgl" required>
                        </div>
                            
                            <div class="mb-3">
                            <label for="guruID">guruID</label>
                            <select class="form-control" name="guruID" required>
                            <option selected value="">Pilih Guru</option>
                
                <?php
                $sql= "select NIK,Nama from guru order by Nama";
                $ambildata = mysqli_query($koneksi, $sql);
                while ($tampil = mysqli_fetch_array($ambildata)){
                
                    echo "<option value='$tampil[NIK]'>$tampil[NIK] | $tampil[Nama]</option>";
            }

                ?>
                            </select>
                            </div>
                            
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