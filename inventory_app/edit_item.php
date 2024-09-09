<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Item</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="add_item.php">Tambah Item Baru</a>
        </nav>
    </header>
    <main>
        <?php
        include 'db.php';

        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM items WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if (!$item) {
            echo "Item not found";
        } else {
        ?>
        <form action="edit_item.php?id=<?php echo $id; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($item['jumlah']); ?>" required>
            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="<?php echo htmlspecialchars($item['harga']); ?>" required>
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($item['tanggal']); ?>" required>
            <button type="submit">Update Item</button>
        </form>
        <a href="index.php">Kembali ke Inventory</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];
            $tanggal = $_POST['tanggal'];

            $stmt = $conn->prepare("UPDATE items SET name=?, jumlah=?, harga=?, tanggal=? WHERE id=?");
            $stmt->bind_param("sissi", $name, $jumlah, $harga, $tanggal, $id);

            if ($stmt->execute()) {
                echo "Item updated successfully";
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        }
        ?>
    </main>
    <footer>
        <p>&copy; AndaraDwi Inventory App</p>
    </footer>
</body>
</html>
