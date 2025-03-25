<?php
$koneksi = mysqli_connect("localhost", "root", "", "raficahyadi_presensi");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mendapatkan NIK dari URL
$NIK = isset($_GET['kode']) ? $_GET['kode'] : '';

if ($NIK) {
    // Query untuk mendapatkan data berdasarkan NIK
    $query = "SELECT * FROM guru WHERE NIK = '$NIK'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $Nama = $row['Nama'];
        $Tglahir = $row['Tglahir'];
        $Alamat = $row['Alamat'];
        $Gaji = $row['Gaji'];
        $Kelas = $row['Kelas'];
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $Nama = htmlspecialchars($_POST['Nama']);
    $Tglahir = htmlspecialchars($_POST['Tglahir']);
    $Alamat = htmlspecialchars($_POST['Alamat']);
    $Gaji = htmlspecialchars($_POST['Gaji']);
    $Kelas = htmlspecialchars($_POST['Kelas']);

    // Update data di database kecuali NIK
    $sql = "UPDATE guru SET Nama='$Nama', Tglahir='$Tglahir', Alamat='$Alamat', Gaji='$Gaji', Kelas='$Kelas' WHERE NIK='$NIK'";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data guru telah diupdate.";
        header("Location: guru.php");
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
  <title>Update Data Guru - Management System</title>
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
        <div class="edit-form-container">
            <h2>Edit Data Guru</h2>
            <form action="editData2.php?kode=<?php echo $NIK; ?>" method="post">
                <label for="new_NIK">NIK:</label>
                <input type="text" id="new_NIK" name="new_NIK" value="<?php echo $NIK; ?>" readonly>

                <label for="Nama">Nama:</label>
                <input type="text" id="Nama" name="Nama" value="<?php echo $Nama; ?>">

                <label for="Kelas">Tanggal Lahir:</label>
                <input type="text" id="Tglahir" name="Tglahir" value="<?php echo $Tglahir; ?>">

                <label for="Alamat">Alamat:</label>
                <input type="text" id="Alamat" name="Alamat" value="<?php echo $Alamat; ?>">
                <label for="Gaji">Gaji:</label>
                <input type="text" id="Gaji" name="Gaji" value="<?php echo $Gaji; ?>">
                <label for="Kelas">Kelas:</label>
                <input type="text" id="Kelas" name="Kelas" value="<?php echo $Kelas; ?>">

                <input type="submit" name="submit" value="Update">
            </form>
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