<?php
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$ID = isset($_GET['kode']) ? $_GET['kode'] : '';

if ($ID) {
    $query = "SELECT * FROM presensi WHERE ID = '$ID'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ID = $row['ID'];
        $tgl = $row['tgl'];
        $NISN = $row['NISN'];
        $status = $row['status'];
        $guruID = $row['guruID'];
        $TimeStamp = $row['TimeStamp'];
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $ID = htmlspecialchars($_POST['ID']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $new_NISN = htmlspecialchars($_POST['new_NISN']);
    $status = htmlspecialchars($_POST['status']);
    $guruID = htmlspecialchars($_POST['guruID']);

    
    // Update data di database tanpa mengubah kolom TimeStamp
    $sql = "UPDATE presensi SET tgl='$tgl', NISN='$new_NISN', status='$status', guruID='$guruID' WHERE ID='$ID'";
    

    if (mysqli_query($koneksi, $sql)) {
        echo "Data absen telah diupdate.";
        header("Location: Absensi.php");
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
  <title>Update Data Absen - Management System</title>
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

    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .container {
      flex: 1;
      margin-top: 90px;
    }

    .welcome-section {
      background-color: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .footer {
      background-color: #2c3e50;
      color: white;
      padding: 20px 0;
      text-align: center;
      margin-top: -45px;
    }
    footer a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
    }
    footer a:hover {
      color: #dbeafe;
    }
    .edit-form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            margin: 50px auto;
        }

        .edit-form-container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .edit-form-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .edit-form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .edit-form-container input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }

        .edit-form-container input[type="submit"]:hover {
            background-color: #218838;
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
            <!-- <li class="nav-item"><a class="nav-link" href="index.php">Login</a></li> -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->


<!-- <div class="container-fluid bg-primary mb-5"> -->
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <!-- <div class="container-fluid bg-primary mb-5"> -->
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <div class="edit-form-container">
                    <h2>Edit Data Absen</h2>
                    <form action="editData3.php?kode=<?php echo $ID; ?>" method="post">
                        <label for="ID">ID:</label>
                        <input type="text" id="ID" name="ID" value="<?php echo $ID; ?>" readonly>

                        <label for="tgl">Tanggal Absen:</label>
                        <input type="text" id="tgl" name="tgl" value="<?php echo $tgl; ?>" readonly>

                        <label for="new_NISN">NISN:</label>
                        <input type="text" id="new_NISN" name="new_NISN" value="<?php echo $NISN; ?>" readonly>
                        <label for="status">Status:</label>
                        <br>
                        <select id="status" name="status">
                            <option value="Hadir" <?php echo ($status == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
                            <option value="Sakit" <?php echo ($status == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
                            <option value="Izin" <?php echo ($status == 'Izin') ? 'selected' : ''; ?>>Izin</option>
                            <option value="Alfa" <?php echo ($status == 'Alfa') ? 'selected' : ''; ?>>Alfa</option>
                        </select>
                        <br>
                        <br>
                        <label for="guruID">Guru ID:</label>
                        <input type="text" id="guruID" name="guruID" value="<?php echo $guruID; ?>" readonly>

                        <input type="submit" name="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Footer -->
    <footer class="footer">
      <p>&copy; 2024 <a href="#">Rafi Bakhtiar Cahyadi</a>. All Rights Reserved.</p>
    </footer>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 