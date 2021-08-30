<?php

if (isset($_POST['animal_un_number']) && isset($_POST['animal_sex']) && isset($_POST['animal_type']) && isset($_POST['animal_species']) && isset($_POST['animal_age_group'])) {
    session_start();
    include './includes/dbc.inc.php';
   
    $animal_un_number = $_POST['animal_un_number'];
    $animal_sex = $_POST['animal_sex'];
    $animal_type = $_POST['animal_type'];
    $animal_species = $_POST['animal_species'];
    $animal_age_group = $_POST['animal_age_group'];
    $animal_birth_date = $_POST['animal_birth_date'];
    $animal_vaccination = $_POST['animal_vaccination'];
    $animal_register_date = date("Y/m/d");
    $animal_deleted = 0;
    $user_id = $_SESSION['user_id'];


    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_un_number = ? AND user = ? ");
    $stmt->bind_param("sd", $animal_un_number,  $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO users_animals (animal_un_number, animal_sex, animal_type, animal_species,
         animal_age_group, animal_birth, animal_register_date, animal_vaccination, animal_deleted, user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssdd", $animal_un_number, $animal_sex, $animal_type, $animal_species, $animal_age_group, $animal_birth_date, $animal_register_date, $animal_vaccination, $animal_deleted, $user_id);
        $stmt->execute();
        $stmt->close();
        

        $zero = 0;
        //Write animals.json
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
        <div class="alert-text">Η καταχώρηση  ολοκληρώθηκε με επιτυχία !</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
    } else {
        echo '<div class="alert alert-outline-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
        <div class="alert-text">Ο αριθμός ενωτίου που πληκτρολογήσατε έχει καταχωρηθεί ήδη ! Παρακαλώ προσπαθήστε ξανά.</div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
        </div>';
    }


}
