<?php
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['kode'])) {
    $ID = $_GET['kode'];

    $query = "DELETE FROM presensi WHERE ID = '$ID'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil dihapus.');
                window.location.href = 'Absensi.php';
              </script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Data Absen - Management System</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
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
      margin-top: 40px;
    }

    table {
      border-radius: 8px;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    table th {
      background-color: #2980b9;
      color: white;
      text-align: center;
    }

    table td {
      vertical-align: middle;
      text-align: center;
    }

    .btn-action a {
      margin: 0 5px;
      border-radius: 20px;
    }
    

    .btn-primary {
      background-color: #3498db;
      border: none;
      border-radius: 20px;
    }
    .btn-action {
      display: inline-flex;
      gap: 10px;
      justify-content: center;
      border-radius: 15px;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }
    footer {
      background-color: #2c3e50;
      color: #fff;
      text-align: center;
      padding: 20px;
      margin-top: 90px;
      /* margin-bottom: 30px; */
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
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Data Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="Siswa.php">Siswa</a></li>
          <li class="nav-item"><a class="nav-link" href="Guru.php">Guru</a></li>
          <li class="nav-item"><a class="nav-link active" href="Absensi.php">Absensi</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <div class="container">
    <h2 class="text-center mb-4">Data Absensi</h2>
    <button onclick="window.location.href='tambahData3.php';" class="btn btn-primary mb-4">Tambah Data</button>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>NISN</th>
          <th>Status</th>
          <th>Guru ID</th>
          <th>TimeStamp</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $data = mysqli_query($koneksi, "SELECT presensi.*, CONCAT(presensi.NISN, ' | ', siswa.Nama) AS NISN_Nama FROM presensi 
                                          INNER JOIN siswa ON presensi.NISN = siswa.NISN");
          while ($row = mysqli_fetch_array($data)) {
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $row['tgl']; ?></td>
          <td><?php echo $row['NISN_Nama']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['guruID']; ?></td>
          <td><?php echo $row['TimeStamp']; ?></td>
          <td>
            <div class="btn-action">
              <a href="viewAbsen.php?id=<?php echo $row['ID']; ?>" class="btn btn-info">View</a>
              <a href="editData3.php?kode=<?php echo $row['ID']; ?>" class="btn btn-warning">Edit</a>
              <a href="?kode=<?php echo $row['ID']; ?>" class="btn btn-danger" onclick="return confirm('yakin?')">Hapus</a>
            </div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <footer class="text-center mt-5">
    <p>&copy; 2024 <a href="#">Rafi Bakhtiar Cahyadi</a>. All Rights Reserved.</p>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
