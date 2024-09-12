<?php
include_once '../koneksi/koneksi.php';

// Query untuk menampilkan semua data customer
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        *{
            text-decoration: none;
        }

        .color-primary{
            color: #4A7766;
        }

        .color-secondary{
            color: #FDF1F5;
        }

        .bg-primary {
            background-color: #4A7766;
        }
        .bg-secondary {
            background-color: #FDF1F5;
        }
        .hover-animate {
            transition: color 0.2s ease-in-out;
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-secondary text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-primary p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <button class="bg-white text-black px-4 py-2 rounded hover-animate hover:bg-secondary hover:text-primary">Logout</button>
            
            <!-- Form Pencarian -->
            <form class="flex">
                <input type="text" id="keyword" class="form-control bg-light border-0 small text-black px-4 py-2 rounded" autocomplete="off" placeholder="Cari customer...">
            </form>
            
            <a href="../tambah/tambah.php" class="bg-white text-black px-4 py-2 rounded hover-animate hover:bg-secondary hover:text-primary">Add+</a>
            <a href="../hapus/hapus.php" class="bg-white text-black px-4 py-2 rounded hover-animate hover:bg-secondary hover:text-primary">EDIT+</a>
        </header>
        
        <!-- Main Content -->
        <div class="flex flex-1 flex-col md:flex-row">
            <!-- Sidebar -->
            <aside id="sidebar" class="w-full md:w-64 bg-primary p-4 hidden md:block transition-all">
                <nav>
                    <ul>
                        <li class="mb-4"><a href="#" class="text-white hover-animate hover:text-primary">Dashboard</a></li>
                        <li class="mb-4"><a href="#" class="text-white hover-animate hover:text-primary">Users</a></li>
                        <li class="mb-4"><a href="#" class="text-white hover-animate hover:text-primary">Settings</a></li>
                    </ul>
                </nav>
            </aside>
            
            <!-- Main Section -->
            <main class="flex-1 p-4">
                <h2 class="text-xl color-primary font-semibold mb-4">Welcome to the Admin Dashboard</h2>
                
                <!-- Hasil Pencarian -->
                <div id="search-results">
                    <?php 
                    // Tampilkan data awal saat halaman pertama kali dibuka
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while($row = $result->fetch_assoc()) {
                            $bgColor = $i % 2 == 0 ? 'bg-primary color-secondary ' : 'bg-secondary  color-primary';
                            echo "<div class='$bgColor p-4 rounded shadow my-2'>"."ID: " . $row["id_customer"]. " | Nama: " . $row["nama_customer"]. " | Alamat: " . $row["alamat_customer"]. " | Nomor telepon: " . $row["nomor_telepon"] . " _|_ Tanggal Ditambahkan: " . $row["created_at"] ."_|"."<br>"."</div>";
                            $i++;
                        }
                    } else {
                        echo "<div class='bg-primary color-secondary p-4 rounded shadow my-2'>Tidak ada data customer ditemukan.</div>";
                    }
                    ?>
                </div>
            </main>
        </div>
        
        <!-- Footer -->
        <footer class=" bg-primary p-4 text-center">
            <p>© 2024 Your Company</p>
        </footer>
    </div>
    
    <!-- AJAX Live Search -->
    <script>
        document.getElementById('keyword').addEventListener('keyup', function() {
            const keyword = this.value;
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('search-results').innerHTML = xhr.responseText;
                }
            };
            xhr.open('POST', 'search_customer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('keyword=' + keyword);
        });
    </script>
</body>
</html>
