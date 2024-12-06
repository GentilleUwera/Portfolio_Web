<?php
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user_info WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link id="theme-stylesheet" rel="stylesheet" href="light.css">
    <link rel="stylesheet" href="style.css">
    <script src="theme-toggle.js" defer></script> <!-- Make sure this script is included -->
</head>
<body class="light-theme">
    <button id="toggle-theme">Switch to Dark Mode</button> <!-- Theme toggle button -->
    <div class="container">
        <!-- Profile Section -->
        <div class="profile-info">
            <div class="info-left">
                <h1><?php echo $user['name']; ?></h1>
                <h2><?php echo $user['profession']; ?></h2>
                <p><?php echo $user['bio']; ?></p>
            </div>
            <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="profile-img">
        </div>

        <!-- Skills Section -->
        <h3>Skills</h3>
        <div class="skill-list">
            <?php
            // Display skills as cards
            $skills = explode(',', $user['skills']);
            foreach ($skills as $skill) {
                echo "<div class='skill-card'>$skill</div>";
            }
            ?>
        </div>

        <!-- Navigation to Admin Page -->
        <div class="admin-navigation">
            <a href="admin.php"><button>Admin Dashboard</button></a>
        </div>
    </div>
</body>
</html>
