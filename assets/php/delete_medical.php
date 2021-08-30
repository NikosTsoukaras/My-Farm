<?php

if (isset($_POST['medical_id']) ) {


    session_start();
    include './includes/dbc.inc.php';

    $medical_id = $_POST['medical_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM medical WHERE medical_id = ?");
    $stmt->bind_param("d", $medical_id);
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
      <div class="alert-text">Η διαγραφή  ολοκληρώθηκε με επιτυχία !</div>
          <div class="alert-close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true"><i class="la la-close"></i></span>
              </button>
          </div>
      </div>';



}