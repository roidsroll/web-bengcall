<?php
include_once '../koneksi/koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_customer'];
    $alamat = $_POST['alamat_customer'];
    $telepon = $_POST['nomor_telepon'];

    // Query untuk memasukkan data ke tabel customer dengan tanggal dan waktu saat ini
    $sql = "INSERT INTO customer (nama_customer, alamat_customer, nomor_telepon, created_at) VALUES ('$nama', '$alamat', '$telepon', CURRENT_TIMESTAMP)";

    // Jika berhasil, redirect dengan parameter response=success
    if ($conn->query($sql) === TRUE) {
        header("Location: ?response=success");
    } else {
        // Jika gagal, redirect dengan parameter response=error
        header("Location: ?response=error");
    }
    exit(); // Tambahkan exit untuk memastikan redirect bekerja
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FDF1F5;
            color: #4A7766;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #4A7766;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            color: #FDF1F5;
        }
        form input {
            width: calc(100% - 20px);
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form .submit {
            width: 100%;
            padding: 10px;
            background-color: #FDF1F5;
            color: #4A7766;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        form .submit:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label for="nama_customer">Nama:</label>
        <input type="text" id="nama_customer" name="nama_customer" required><br>
        <label for="alamat_customer">Alamat:</label>
        <input type="text" id="alamat_customer" name="alamat_customer" required><br>
        <label for="nomor_telepon">Telepon:</label>
        <input type="tel" id="nomor_telepon" name="nomor_telepon" required><br>
        <button type="submit" name="submit" value="Tambah" class="submit">Submit</button>
        <a href="../public/index.php" class="submit">Submit</a>
    </form>

    <!-- Script untuk SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Cek parameter 'response' di URL
        const urlParams = new URLSearchParams(window.location.search);
        const response = urlParams.get('response');

        // Tampilkan SweetAlert jika ada parameter response
        if (response === "success") {
            Swal.fire({
                title: 'Success!',
                text: 'Customer berhasil ditambahkan.',
                icon: 'success'
            });
        } else if (response === "error") {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan saat menambahkan customer.',
                icon: 'error'
            });
        }
    </script>
</body>
</html>