<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $bio = $_POST['bio'];
    $image = $_FILES['image']['name'];
    $target = 'uploads/' . basename($_FILES['image']['name']);

    $query = "SELECT * FROM user WHERE username='$username'";
    $stmt2 = $connectingDb->query($query);
    $stmt2->execute();
    $result = $stmt2->rowCount();

    if ($result > 0) {
        echo '<script language="javascript">';
        echo 'alert("username already taken")';
        echo '</script>';
    } else if ($password !== $confirmPassword) {
        echo '<script language="javascript">';
        echo 'alert("passwords do not match")';
        echo '</script>';
    } else {
        global $connectingDb;
        $sql = "INSERT INTO user(firstname,lastname,email,username,password,bio,profilepic)";
        $sql .= "VALUES(:FirstName,:LastName,:Email,:UserName,PASSWORD(:Password),:Bio,:ProfilePic)";

        $stmt = $connectingDb->prepare($sql);
        $stmt->bindValue(':FirstName', $firstName);
        $stmt->bindValue(':LastName', $lastName);
        $stmt->bindValue(':Email', $email);
        $stmt->bindValue(':UserName', $username);
        $stmt->bindValue(':Password', $password);
        $stmt->bindValue(':Bio', $bio);
        $stmt->bindValue(':ProfilePic', $image);

        $execute = $stmt->execute();
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        if ($execute) {
            echo '<script language="javascript">';
            echo 'alert("Registration successfull")';
            echo '</script>';
            redirectTo("userProfile.php?username=$username");
        } else {
            echo '<script language="javascript">';
            echo 'alert("something went wrong")';
            echo '</script>';
        }
    }
}

?>



<!-- $dateTime = strftime("%Y-%m-%d %H:%M:%S", $currentTime); -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form {
            height: 35rem;
            width: 25rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border: 1px solid black;
            padding: 1.5rem 1.5rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
        }

        button {
            width: 100%;
            padding: 0.5rem;
        }

        textarea {
            width: 100%;
            padding: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Register with us</h1>
        <form action="registration.php" method="POST" class="form" enctype="multipart/form-data">
            <input type="text" name="firstName" placeholder="Enter first name" />
            <input type="text" name="lastName" placeholder="Enter last name" />
            <input type="email" name="email" placeholder="Enter email" />
            <input type="text" name="username" placeholder="Enter Username" />
            <input type="password" name="password" placeholder="Choose password" />
            <input type="password" name="confirmPassword" placeholder="Confirm password" />
            <textarea name="bio" id="" cols="30" rows="8" placeholder="Bio"></textarea>
            <div>
                &nbsp;<label for="profile"> Select pic:</label>
                <input id="profile" type="file" name="image" />
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>