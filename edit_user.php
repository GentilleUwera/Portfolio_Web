<?php
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user_info WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $profession = $_POST['profession'];
    $skills = $_POST['skills'];
    $bio = $_POST['bio'];
    $profile_picture = $_FILES['profile_picture']['name'] ? $_FILES['profile_picture']['name'] : $user['profile_picture'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/' . $profile_picture);

    $sql = "UPDATE user_info SET name='$name', profession='$profession', skills='$skills', bio='$bio', profile_picture='$profile_picture' WHERE id='$id'";
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
    <title>Edit User</title>
    <link id="theme-stylesheet" rel="stylesheet" href="light.css">
    <link rel="stylesheet" href="style.css">

    <script src="theme-toggle.js" defer></script>
</head>
<body>
    <button id="toggle-theme">Switch to Dark Mode</button>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <input type="text" name="profession" value="<?php echo $user['profession']; ?>" required>
            <input type="text" name="skills" value="<?php echo $user['skills']; ?>" required>
            <textarea name="bio" required><?php echo $user['bio']; ?></textarea>
            <input type="file" name="profile_picture">
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
