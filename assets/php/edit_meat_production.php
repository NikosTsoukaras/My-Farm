<?php

if (isset($_POST['animal_id']) && isset($_POST['total_weight']) && isset($_POST['net_weight']) &&
 isset($_POST['price_kilo']) && isset($_POST['inspection']) &&  isset($_POST['slaughterhouse']) && isset($_POST['total_price'])) {

    session_start();
    include './includes/dbc.inc.php';


    $animal_id = $_POST['animal_id'];
    $total_weight = $_POST['total_weight'];
    $net_weight = $_POST['net_weight'];
    $price_kilo = $_POST['price_kilo'];
    $inspection = $_POST['inspection'];
    $slaughterhouse = $_POST['slaughterhouse'];
    $total_price = $_POST['total_price'];
    $money = $_POST['money'];
    $user_id = $_SESSION['user_id'];


    $stmt = $conn->prepare("UPDATE meat_production SET total_weight = ? , net_weight = ? , price_kilo = ? , total_price = ?,
     inspection = ?, slaughterhouse = ? WHERE animal_id = ? AND user_id = ?");
    $stmt->bind_param("sssssssd",$total_weight, $net_weight, $price_kilo,$total_price, $inspection, $slaughterhouse, $animal_id,$user_id);
    $stmt->execute();
    $stmt->close();

   //Write meat_production.json
   $data = file_get_contents('./json/meat_production.json');
   $json_array = json_decode($data, true);    
   $stmt = $conn->prepare("SELECT meat_production.animal_id, meat_production.total_weight, meat_production.net_weight, meat_production.price_kilo, meat_production.total_price,
   meat_production.inspection, meat_production.slaughterhouse, meat_production.slaughter_date, users_animals.animal_type, users_animals.animal_species,  users_animals.animal_age_group,
   users_animals.animal_age_group FROM meat_production INNER JOIN users_animals ON meat_production.animal_id = users_animals.animal_un_number WHERE meat_production.user_id = ?");
   $stmt->bind_param("d",$user_id);
   $stmt->execute();
   $result = $stmt->get_result();
   $json_array = array();
   while($row = $result->fetch_assoc()) {
       $json_array[] = $row;
   }
   file_put_contents('./json/meat_production.json', json_encode($json_array));


    $type="income";
    $description ="Κρεατοπαραγωγή";
    $stmt = $conn->prepare("UPDATE economics SET  amount = ?  WHERE type = ? AND amount = ? AND description = ? AND user_id =?");
    $stmt->bind_param("ssssd",$total_price,$type,$money,$description,$user_id);
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