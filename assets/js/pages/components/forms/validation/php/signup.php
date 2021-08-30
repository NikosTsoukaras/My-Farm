<?php



// if (isset($_POST['signup-submit'])) {
    include './includes/dbc.inc.php';

    $email = $_POST['user_email'];
    $fullname = $_POST['user_name'];
    $pwd = $_POST['user_pwd'];

    $stmt = $conn->prepare("INSERT INTO users (user_email, user_name, user_pwd) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $fullname, $pwd);
    $stmt->execute();
    $stmt->close();
    $conn->close();


// }