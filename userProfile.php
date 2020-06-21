<?php require_once("includes/db.php"); ?>

<?php
global $connectingDb;
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM user WHERE username='$username'";
    $stmt = $connectingDb->query($sql);

    while ($dataRows = $stmt->fetch()) {
        $firstName = $dataRows['firstname'];
        $lastName = $dataRows['lastname'];
        $bio = $dataRows['bio'];
        $pic = $dataRows['profilepic'];
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("something went wrong")';
    echo '</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Virtual Journal</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav class="nav-bar">
        <div class="brand-title">Brand Title</div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="nav-links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Log In</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <main class="grid">
        <div class="left-container">
            <h1><?= $firstName; ?> <?= $lastName; ?></h1>
            <img src="uploads/<?= $pic ?>" alt="user" />
            <p>
                <?= $bio; ?>
            </p>
        </div>
        <div class="right-container">
            <a href="#" class="note-btn">Add new entry</a>
            <a href="#" class="note-btn">Check previous entry</a>
            <a href="#" class="note-btn">Delete previous entry</a>
            <a href="#" class="note-btn">Update previous entry</a>
            <a href="#" class="note-btn">Send</a>
        </div>
    </main>

    <footer>designed by Ashton Naidoo <sup>&reg;</sup></footer>
    <script src="index.js"></script>
</body>

</html>