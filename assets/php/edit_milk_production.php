<?php

if (isset($_POST['milk_day_production']) && isset($_POST['milk_type']) && isset($_POST['total_milk_production']) &&
 isset($_POST['milk_cellulars']) && isset($_POST['milk_protein']) &&  isset($_POST['milk_fat']) && isset($_POST['milk_price'])) {



    session_start();
    include './includes/dbc.inc.php';

    $production_id = $_POST['id']; 
    $milk_date = $_POST['milk_day_production'];
    $milk_type = $_POST['milk_type'];
    $milk_quantity = $_POST['total_milk_production'];
    $milk_cellulars = $_POST['milk_cellulars'];
    $milk_protein = $_POST['milk_protein'];
    $milk_fat = $_POST['milk_fat'];
    $milk_price = $_POST['milk_price'];
    $milk_sum = $_POST['milk_sum'];
    $money = $_POST['money'];
    $user_id = $_SESSION['user_id'];



     //Update Animal
    $stmt = $conn->prepare("UPDATE milk_production SET milk_date = ? , milk_type = ? , milk_quantity = ? , milk_cellulars = ?,
     milk_protein = ?, milk_fat = ?, milk_price = ?, milk_sum = ?  WHERE production_id = ?");
    $stmt->bind_param("ssssssssd",$milk_date, $milk_type, $milk_quantity, $milk_cellulars, $milk_protein, $milk_fat, $milk_price, $milk_sum,$production_id);
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
    $stmt = $conn->prepare("UPDATE economics SET  amount = ?  WHERE type = ? AND amount = ? AND description = ? AND user_id =?");
    $stmt->bind_param("ssssd",$milk_sum,$type,$money,$description,$user_id);
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