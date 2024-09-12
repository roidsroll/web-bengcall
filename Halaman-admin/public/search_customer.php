<?php
include_once '../koneksi/koneksi.php';

if (isset($_POST['keyword'])) {
    $keyword = $conn->real_escape_string($_POST['keyword']);
    
    // Query pencarian berdasarkan nama, alamat, atau nomor telepon
    $sql = "SELECT * FROM customer WHERE nama_customer LIKE '%$keyword%' OR alamat_customer LIKE '%$keyword%' OR nomor_telepon LIKE '%$keyword%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $bgColor = $i % 2 == 0 ? 'bg-primary color-secondary ' : 'bg-secondary  color-primary';
            echo "<div class='$bgColor p-4 rounded shadow my-2'>"."ID: " . $row["id_customer"]. " | Nama: " . $row["nama_customer"]. " | Alamat: " . $row["alamat_customer"]. " | Nomor telepon: " . $row["nomor_telepon"] . " _|_ Tanggal Ditambahkan: " . $row["created_at"] ."_|"."<br>"."</div>";
            $i++;
        }
    } else {
        echo "<div class='bg-primary color-secondary p-4 rounded shadow my-2'>Mohon maaf tidak ada hasil yang ditemukan untuk: <strong>" . htmlspecialchars($keyword) . "</strong></div>";
    }
}
?>
