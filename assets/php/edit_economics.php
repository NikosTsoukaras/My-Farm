<?php
if (isset($_POST['type']) && isset($_POST['description']) && isset($_POST['amount']) &&  isset($_POST['date'])) {
    
    
    session_start();
    include './includes/dbc.inc.php';

    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

   $stmt = $conn->prepare("UPDATE economics SET amount = ? , description = ? , date = ?  WHERE economics_id = ? AND  user_id = ?");
   $stmt->bind_param("sssdd",$amount, $description, $date, $id, $user_id);
   $stmt->execute();
   $stmt->close();

   $type = 'income';
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

    $type = 'outgoings';
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