<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "portfolio_db");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_info";
$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link id="theme-stylesheet" rel="stylesheet" href="light.css">
    <link rel="stylesheet" href="style.css">
    <script src="theme-toggle.js" defer></script>
    <style>
        /* Additional Styling for the Admin Page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Button styling */
        button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #5c6bc0;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin: 10px;
        }

        button:hover {
            background-color: #3f51b5;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }

        /* User List Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5c6bc0;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        /* Admin Navigation */
        .admin-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .admin-buttons a button {
            font-size: 1.1rem;
            padding: 12px 25px;
        }

        /* Dark Mode Styling */
        body.dark-theme {
            background-color: #333;
            color: white;
        }

        body.dark-theme .container {
            background-color: #444;
        }

        body.dark-theme table {
            background-color: #444;
            color: white;
        }

        body.dark-theme table th {
            background-color: #333;
        }

        body.dark-theme button {
            background-color: #444;
            color: white;
        }

        body.dark-theme button:hover {
            background-color: #666;
        }
    </style>
</head>
<body class="light-theme">
    <button id="toggle-theme">Switch to Dark Mode</button>
    <div class="container">
        <h1>Manage Users</h1>

        <!-- Admin Navigation Buttons -->
        <div class="admin-buttons">
            <a href="create_user.php"><button>Create New User</button></a>
        </div>

        <!-- User List in a Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Profession</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['profession']); ?></td>
                            <td>
                                <a href="index.php?id=<?php echo urlencode($user['id']); ?>"><button>View</button></a>
                                <a href="edit_user.php?id=<?php echo urlencode($user['id']); ?>"><button>Edit</button></a>
                                <a href="delete_user.php?id=<?php echo urlencode($user['id']); ?>"><button>Delete</button></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeButton = document.getElementById("toggle-theme");
            const body = document.body;

            // Check local storage for th
