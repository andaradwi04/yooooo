<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>List Inventory</h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="index.php">Home</a>
            <a href="add_item.php">Tambah Item Baru</a>
        </nav>
    </header>
    <main>
        <div id="clock"></div> <!-- Clock display -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';

                // Query untuk mengambil data barang
                $sql = "SELECT * FROM items";
                $result = $conn->query($sql);

                // Menampilkan data barang
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Format tanggal dengan waktu sesuai dengan yang diinputkan
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['harga']}</td>
                            <td>" . date("Y-m-d H:i:s", strtotime($row['tanggal'])) . "</td>
                            <td>
                                <a href='edit_item.php?id={$row['id']}'>Edit</a> |
                                <a href='delete_item.php?id={$row['id']}'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No results</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; AndaraDwi Inventory App</p>
    </footer>
    <script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ':' + minutes + ':' + seconds;
        document.getElementById('clock').textContent = timeString;
    }

    setInterval(updateClock, 1000); // Update clock every second
    updateClock(); // Initial call to display clock immediately
    </script>
</body>
</html>
