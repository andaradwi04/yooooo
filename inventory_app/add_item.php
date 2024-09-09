<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tambah Item Baru</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="add_item.php">Tambah Item Baru</a>
        </nav>
    </header>
    <main>
        <form action="add_item.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" required>
            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" required>
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>
            <button type="submit">Tambah Item</button>
        </form>
        <a href="index.php">Kembali ke Inventory</a>

        <?php
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];

            // Siapkan query SQL dengan fungsi NOW() untuk mendapatkan timestamp saat ini
            $stmt = $conn->prepare("INSERT INTO items (name, jumlah, harga, tanggal) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sii", $name, $jumlah, $harga);

            if ($stmt->execute()) {
                echo "Item baru berhasil ditambahkan";
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </main>
    <footer>
        <p>&copy; AndaraDwi Inventory App</p>
    </footer>
</body>
</html>
