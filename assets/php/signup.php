<?php



if (isset($_POST['user_email']) && isset($_POST['user_name']) && isset($_POST['user_pwd']))    {
    include './includes/dbc.inc.php';

    $email = $_POST['user_email'];
    $fullname = $_POST['user_name'];
    $pwd = $_POST['user_pwd'];
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $_POST['user_email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO users (user_email, user_name, user_pwd) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $fullname, $hashedPwd);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo '<div class="alert alert-outline-success fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Η εγγραφή σας ολοκληρώθηκε με επιτυχία ! <a href="./custom/login/login-v2.html" class="kt-link kt-font-brand">Συνδεθείται τώρα!</a></div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
        exit();
    } else {
        echo '<div class="alert alert-outline-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
        <div class="alert-text">Το E-mail που πληκτρολογήσατε έχει καταχωρηθεί ήδη ! Παρακαλώ προσπαθήστε ξανά.</div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
        </div>';
        exit();
    }



    

    
    
}