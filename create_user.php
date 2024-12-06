<?php
// Handle form submission for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $profession = $_POST['profession'];
    $skills = $_POST['skills'];
    $bio = $_POST['bio'];
    $profile_picture = $_FILES['profile_picture']['name'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/' . $profile_picture);

    $conn = new mysqli("localhost", "root", "", "portfolio_db");
    $sql = "INSERT INTO user_info (name, profession, skills, bio, profile_picture) VALUES ('$name', '$profession', '$skills', '$bio', '$profile_picture')";
    $conn->query($sql);
    $conn->close();

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link id="theme-stylesheet" rel="stylesheet" href="light.css">
    <link rel="stylesheet" href="style.css">

    <script src="theme-toggle.js" defer></script>
</head>
<body>
    <button id="toggle-theme">Switch to Dark Mode</button>
    <div class="container">
        <h1>Create a New User</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="profession" placeholder="Profession" required>
            <input type="text" name="skills" placeholder="Skills (comma separated)" required>
            <textarea name="bio" placeholder="Bio" required></textarea>
            <input type="file" name="profile_picture" required>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
