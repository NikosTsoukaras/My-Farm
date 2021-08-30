<?php


if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['species']) &&
isset($_POST['date']) && isset($_POST['notes']) &&  isset($_POST['vet_contact']) && isset($_POST['assessment'])) {

    session_start();
    include './includes/dbc.inc.php';


    //Get values
    $title = $_POST['title'];
    $type = $_POST['type'];
    $species = $_POST['species'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];
    $vet_contact = $_POST['vet_contact'];
    $assessment = $_POST['assessment'];
    $radio = $_POST['radio'];
    $animal_id = $_POST['animal_id'];
    $animals_number = $_POST['animals_number'];
    $vet_notes = $_POST['vet_notes'];
    $age_group = $_POST['age_group'];
    $user_id = $_SESSION['user_id'];

    //Check if title is already used

    $stmt = $conn->prepare("SELECT * FROM medical WHERE title = ?  AND user_id = ?");
    $stmt->bind_param("sd", $title,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0) {
            $stmt = $conn->prepare("INSERT INTO medical (title, type, species, date, notes, vet_contact, assessment, inspection_details, animal_id, 
            animals_number, vet_notes, age_group, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssd", $title, $type, $species, $date, $notes, $vet_contact, $assessment, $radio, $animal_id, $animals_number, $vet_notes, $age_group, $user_id);
            $stmt->execute();
            $stmt->close();

             //Write medical.json
            $data = file_get_contents('./json/medical.json');
            $json_array = json_decode($data, true);
            $stmt = $conn->prepare("SELECT * FROM medical WHERE user_id = ? ");
            $stmt->bind_param("d", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $json_array = array();
            while($row = $result->fetch_assoc()) {
                $json_array[] = $row;
            }
            file_put_contents('./json/medical.json', json_encode($json_array));


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
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Η καταχώρηση  δεν μπορεί να ολοκληρωθεί καθώς o τίτλος έχει ήδη καταχωτηθεί ! Παρακαλώ προσπθήστε ξανά. </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
    }


















}