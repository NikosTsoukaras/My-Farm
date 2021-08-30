<?php


if (isset($_POST['select_inspection']) && isset($_POST['update_date']) && isset($_POST['update_notes']) &&
isset($_POST['update_vet_contact']) && isset($_POST['update_vet_notes']) &&  isset($_POST['update_assessment']) ) {

    session_start();
    include './includes/dbc.inc.php';


    $select_inspection = $_POST['select_inspection'];
    $update_date = $_POST['update_date'];
    $update_notes = $_POST['update_notes'];
    $update_vet_contact = $_POST['update_vet_contact'];
    $update_vet_notes = $_POST['update_vet_notes'];
    $update_assessment = $_POST['update_assessment'];
    $user_id = $_SESSION['user_id'];

    $inspection = $select_inspection."%";

    $stmt = $conn->prepare("SELECT * FROM medical WHERE title LIKE ?  AND user_id = ?");
    $stmt->bind_param("sd", $inspection,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        $type = $row['type'];
        $species = $row['species']; 
        $inspection_details = $row['inspection_details'];
        $animal_id = $row['animal_id'];
        $animals_number = $row['animals_number'];
        $age_group = $row['age_group'];
    }

    $number_update = $result->num_rows;

    $number_update = $number_update + 1;

    $title = $select_inspection."_".$number_update;


    $stmt = $conn->prepare("INSERT INTO medical (title, type, species, date, notes, vet_contact, assessment, inspection_details, animal_id, 
    animals_number, vet_notes, age_group, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssd", $title, $type, $species, $update_date, $update_notes, $update_vet_contact, $update_assessment, $inspection_details, $animal_id, $animals_number, $update_vet_notes, $age_group, $user_id);
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



}