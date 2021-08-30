<?php

if(isset($_POST['milk_production_id'])){

    session_start();
    include './includes/dbc.inc.php';
    $milk_production_id = $_POST['milk_production_id'];
    $money = $_POST['money'];
    $user_id = $_SESSION['user_id'];
    

    $stmt = $conn->prepare("DELETE FROM milk_production WHERE production_id = ?");
    $stmt->bind_param("s", $milk_production_id);
    $stmt->execute();
    $stmt->close();


    $data = file_get_contents('./json/milk_production.json');
    $json_array = json_decode($data, true);
    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE user_id = ? ");
    $stmt->bind_param("d", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $json_array = array();


    while($row = $result->fetch_assoc()) {
        $json_array[] = $row;
    }

    file_put_contents('./json/milk_production.json', json_encode($json_array));


    $type="income";
    $description ="Γαλακτοπαραγωγή";
    $stmt = $conn->prepare("DELETE FROM economics WHERE type = ? AND description = ? AND amount = ? AND user_id = ?");
    $stmt->bind_param("sssd", $type,$description,$money,$user_id );
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
    <div class="alert-text">Η διαγραφή ολοκληρώθηκε με επιτυχία !</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>';


}