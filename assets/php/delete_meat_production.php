<?php

if(isset($_POST['animal_id'])){

    session_start();
    include './includes/dbc.inc.php';
    $animal_id = $_POST['animal_id'];
    $money = $_POST['money'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM meat_production WHERE animal_id = ?");
    $stmt->bind_param("s", $animal_id);
    $stmt->execute();
    $stmt->close();

    $zero = 0;
    $stmt = $conn->prepare("UPDATE users_animals SET animal_deleted = ? WHERE animal_un_number = ? AND user = ?");
    $stmt->bind_param("dsd",$zero , $animal_id, $user_id );
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
       $total_price = $row['meat_production.total_price.total_price'];
   }
   file_put_contents('./json/meat_production.json', json_encode($json_array));



   $description = "Κρεατοπαραγωγή";
   $type = "income";
   $stmt = $conn->prepare("DELETE FROM economics WHERE description = ? AND type = ? AND amount = ? AND user_id = ?");
   $stmt->bind_param("sssd",$description,$type,$money,$user_id );
   $stmt->execute();
   $stmt->close();


   //Write income.json
   $type = "income";
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
   <div class="alert-text">Η διαγραφή ολοκληρώθηκε με επιτυχία !</div>
       <div class="alert-close">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true"><i class="la la-close"></i></span>
           </button>
       </div>
   </div>';




}