<?php
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $sql = "UPDATE customer SET nama='$nama', alamat='$alamat', telepon='$telepon', email='$email' WHERE id_customer='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<form method="post" action="">
    ID: <input type="text" name="id"><br>
    Nama: <input type="text" name="nama"><br>
    Alamat: <input type="text" name="alamat"><br>
    Telepon: <input type="text" name="telepon"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" name="update" value="Update">
</form>
