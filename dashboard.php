<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $sks = $_POST['sks'];
        $stmt = $conn->prepare("INSERT INTO matakuliah (nama, kode, sks) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nama, $kode, $sks);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $sks = $_POST['sks'];
        $stmt = $conn->prepare("UPDATE matakuliah SET nama=?, kode=?, sks=? WHERE id=?");
        $stmt->bind_param("ssii", $nama, $kode, $sks, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM matakuliah WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch mata kuliah
$result = $conn->query("SELECT * FROM matakuliah");
$matakuliah = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Mata Kuliah</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['user']; ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Daftar Mata Kuliah</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($matakuliah as $mk): ?>
        <tr>
            <td><?php echo $mk['id']; ?></td>
            <td><?php echo $mk['nama']; ?></td>
            <td><?php echo $mk['kode']; ?></td>
            <td><?php echo $mk['sks']; ?></td>
            <td>
                <a href="?edit=<?php echo $mk['id']; ?>">Edit</a> |
                <a href="?delete=<?php echo $mk['id']; ?>" onclick="return confirm('Yakin hapus?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah'; ?> Mata Kuliah</h3>
    <?php
    $edit_data = null;
    if (isset($_GET['edit'])) {
        include 'config.php';
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM matakuliah WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $edit_data = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();
    }
    ?>
    <form method="POST">
        <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
        <?php endif; ?>
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $edit_data['nama'] ?? ''; ?>" required><br>
        <label>Kode:</label><br>
        <input type="text" name="kode" value="<?php echo $edit_data['kode'] ?? ''; ?>" required><br>
        <label>SKS:</label><br>
        <input type="number" name="sks" value="<?php echo $edit_data['sks'] ?? ''; ?>" required><br>
        <button type="submit" name="<?php echo $edit_data ? 'update' : 'add'; ?>">
            <?php echo $edit_data ? 'Update' : 'Tambah'; ?>
        </button>
    </form>
</body>
</html>