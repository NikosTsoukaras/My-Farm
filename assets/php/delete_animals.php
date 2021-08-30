<?php

if(isset($_POST['animal_id'])){

    session_start();
    include './includes/dbc.inc.php';
    $animal_id = $_POST['animal_id'];
    $user_id = $_SESSION['user_id'];
    $one = 1;

    $stmt = $conn->prepare("UPDATE users_animals SET animal_deleted = ? WHERE animal_un_number = ? AND user = ?");
    $stmt->bind_param("dsd", $one, $animal_id, $user_id);
    $stmt->execute();
    $stmt->close();

    //Rewrite animals.json
    $zero = 0;
    $data = file_get_contents('./json/animals.json');
    $json_array = json_decode($data, true);    
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE user = ? AND animal_deleted = ? ");
    $stmt->bind_param("dd", $user_id, $zero);
    $stmt->execute();
    $result = $stmt->get_result();
    $json_array = array();
    while($row = $result->fetch_assoc()) {
        $json_array[] = $row;
    }
    file_put_contents('./json/animals.json', json_encode($json_array));


    echo '<div class="alert alert-outline-success fade show" role="alert">
         <div class="alert-icon"><i class="flaticon-warning"></i></div>
         <div class="alert-text">Η διαγραφή ολοκληρώθηκε με επιτυχία !</div>
             <div class="alert-close">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true"><i class="la la-close"></i></span>
                 </button>
             </div>
         </div>';




}