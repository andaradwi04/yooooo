<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php
    session_start();

    // Jika sesi username sudah aktif, pengguna akan dialihkan ke halaman utama
    if (isset($_SESSION['username'])) {
        header("Location: index.php"); // Redirect ke halaman utama
        exit();
    }
    ?>

    <header>
        <h1>Login</h1>
    </header>
    <main>
        <div class="login-container">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
                <?php
                // Include database connection
                include 'db.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Simple user authentication
                    // In a real application, you would use hashed passwords and proper user validation
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $_SESSION['username'] = $username;
                        header("Location: index.php"); // Redirect to home page after login
                        exit();
                    } else {
                        echo "<p class='error'>Invalid username or password</p>";
                    }

                    $stmt->close();
                    $conn->close();
                }
                ?>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; AndaraDwi Inventory App</p>
    </footer>
</body>
</html>
