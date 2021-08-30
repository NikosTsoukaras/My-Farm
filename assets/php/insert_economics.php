<?php

if (isset($_POST['income']) && isset($_POST['income_description'])) {
    session_start();
    include './includes/dbc.inc.php';

    $type = 'income';
    $amount = $_POST['income'];
    $description = $_POST['income_description'];
    $date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO economics (type, amount, description, date, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $type, $amount, $description, $date, $user_id);
    $stmt->execute();
    $stmt->close();


     //Write income.json
     $data = file_get_contents('./json/income.json');
     $json_array = json_decode($data, true);    
     $stmt = $conn->prepare("SELECT * FROM economics  WHERE type = ? AND user_id = ?");
     $stmt->bind_param("sd",$type,$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $json_array = array();
     while($row = $result->fetch_assoc()) {
         $json_array[] = $row;
     }
     file_put_contents('./json/income.json', json_encode($json_array));

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

if (isset($_POST['outgoings']) && isset($_POST['outgoings_description'])) {
    session_start();
    include './includes/dbc.inc.php';

    $type = 'outgoings';
    $amount = $_POST['outgoings'];
    $description = $_POST['outgoings_description'];
    $date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO economics (type, amount, description, date, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $type, $amount, $description, $date, $user_id);
    $stmt->execute();
    $stmt->close();

     //Write outgoings.json
     $data = file_get_contents('./json/outgoings.json');
     $json_array = json_decode($data, true);    
     $stmt = $conn->prepare("SELECT * FROM economics  WHERE type = ? AND user_id = ?");
     $stmt->bind_param("sd",$type,$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $json_array = array();
     while($row = $result->fetch_assoc()) {
         $json_array[] = $row;
     }
     file_put_contents('./json/outgoings.json', json_encode($json_array));

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
 
