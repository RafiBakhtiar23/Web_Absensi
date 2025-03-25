<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// Cek apakah 'id' ada di URL
if (isset($_GET['id'])) {
    $ID = $_GET['id'];

    // Escape untuk keamanan terhadap SQL Injection
    $ID = mysqli_real_escape_string($koneksi, $ID);

    // Query untuk mengambil data presensi dan siswa berdasarkan ID
    $query = "SELECT presensi.*, siswa.Nama 
              FROM presensi 
              INNER JOIN siswa ON presensi.NISN = siswa.NISN 
              WHERE presensi.ID = '$ID'";
    
    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Debugging untuk melihat jika ada kesalahan query
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>
                alert('Data tidak ditemukan. Pastikan ID valid.');
                window.location.href='Absensi.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan di URL.');
            window.location.href='Absensi.php';
          </script>";
    exit;
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>View Data Absen - Management System</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7fa;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 50px auto;
      padding: 40px;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .navbar {
      background-color: #2c3e50;
      min-height: 10vh;
      top: -25;

    }
    .nav-link {
      font-size: 17px;
      margin-left: 20px;
    }

    .navbar-brand, .nav-link {
      color: white !important;
    }

    h2 {
      text-align: center;
      color: #5a67d8;
      font-weight: 700;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      margin-bottom: 30px;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 12px;
      background: linear-gradient(135deg, #eef2f3, #e3eaf1);
    }
    table th, table td {
      padding: 20px;
      text-align: left;
      font-size: 16px;
      border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    table th {
      background-color: #5a67d8;
      color: #fff;
      font-weight: 600;
    }
    table tr:last-child td {
      border-bottom: none;
    }
    .back-button {
      display: inline-block;
      padding: 14px 32px;
      font-size: 16px;
      color: #fff;
      background: linear-gradient(135deg, #5a67d8, #434190);
      border-radius: 8px;
      text-decoration: none;
      text-align: center;
      margin-top: 20px;
      transition: 0.3s ease;
    }
    .back-button:hover {
      background: linear-gradient(135deg, #434190, #2b2c84);
    }
    footer {
      background-color: #2c3e50;
      color: #fff;
      text-align: center;
      padding: 20px;
      margin-top: 50px;
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
          <li class="nav-item"><a class="nav-link active" href="Guru.php">Guru</a></li>
          <li class="nav-item"><a class="nav-link" href="Absensi.php">Absensi</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="index.php">Login</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->


    <div class="container">
      <h2>Detail Absen Siswa</h2>
      <table>
        <tr>
          <th>ID :</th>
          <td><?php echo $row['ID']; ?></td>
        </tr>
        <tr>
          <th>Tanggal : </th>
          <td><?php echo $row['tgl']; ?></td>
        </tr>
        <tr>
          <th>NISN :</th>
          <td><?php echo $row['NISN']; ?></td>
        </tr>
        <tr>
          <th>Nama :</th>
          <td><?php echo $row['Nama']; ?></td>
        </tr>
        <tr>
          <th>Status :</th>
          <td><?php echo $row['status']; ?></td>
        </tr>
        <tr>
          <th>guruID : </th>
          <td><?php echo $row['guruID']; ?></td>
        </tr>
        <tr>
          <th>TimeStamp :</th>
          <td><?php echo $row['TimeStamp']; ?></td>
        </tr>
      </table>

      <a href="Absensi.php" class="back-button">Kembali</a>
    </div>


    
  
  
  <!-- Footer -->
  <footer class="text-center mt-5">
    <p>&copy; 2024 <a href="#">Rafi Bakhtiar Cahyadi</a>. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>