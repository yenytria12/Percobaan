<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
include("connection.php");

if (isset($_GET["nim"])) {
    $nim = $_GET["nim"];
    $query = "SELECT * FROM student WHERE nim = '$nim'";
    $result = mysqli_query($connection, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        die("Mahasiswa tidak ditemukan.");
    }
    $data = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $birth_city = $_POST["birth_city"];
    $birth_date = $_POST["birth_date"];
    $faculty = $_POST["faculty"];
    $department = $_POST["department"];
    $gpa = $_POST["gpa"];

    $update_query = "UPDATE student SET 
                        name = '$name', 
                        birth_city = '$birth_city', 
                        birth_date = '$birth_date', 
                        faculty = '$faculty', 
                        department = '$department', 
                        gpa = '$gpa'
                     WHERE nim = '$nim'";

    if (mysqli_query($connection, $update_query)) {
        header("Location: student_view.php?message=Data berhasil diperbarui");
    } else {
        die("Error: " . mysqli_error($connection));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Data Mahasiswa</h1>
        <form action="" method="post">
            <label for="name">Nama:</label><br>
            <input type="text" name="name" value="<?= $data["name"] ?>" required><br>
            <label for="birth_city">Tempat Lahir:</label><br>
            <input type="text" name="birth_city" value="<?= $data["birth_city"] ?>" required><br>
            <label for="birth_date">Tanggal Lahir:</label><br>
            <input type="date" name="birth_date" value="<?= $data["birth_date"] ?>" required><br>
            <label for="faculty">Fakultas:</label><br>
            <input type="text" name="faculty" value="<?= $data["faculty"] ?>" required><br>
            <label for="department">Jurusan:</label><br>
            <input type="text" name="department" value="<?= $data["department"] ?>" required><br>
            <label for="gpa">IPK:</label><br>
            <input type="number" step="0.01" name="gpa" value="<?= $data["gpa"] ?>" required><br><br>
            <button type="submit">Simpan</button>
            <a href="student_view.php">Batal</a>
        </form>
    </div>
</body>
</html>
