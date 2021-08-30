
<?php
if(isset($_POST['animal_id'])){

    session_start();
    include './includes/dbc.inc.php';
    $animal_id = $_POST['animal_id'];
    $birth_day = $_POST['birth_day'];
    $infants_number = $_POST['infants_number'];

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM reproduction WHERE animal_id = ? AND birth_day = ? AND infants_number = ? AND user_id = ?");
    $stmt->bind_param("sssd", $animal_id, $birth_day, $infants_number, $user_id);
    $stmt->execute();
    $stmt->close();



     //Check if this animal has more than 1 births
     $stmt = $conn->prepare("SELECT * FROM reproduction WHERE animal_id = ? AND user_id = ?");
     $stmt->bind_param("sd", $animal_id, $user_id);
     $stmt->execute();
     $result = $stmt->get_result();



     //First birth case
     if ($result->num_rows === 0) {
        $stmt = $conn->prepare("DELETE FROM reproduction_statics WHERE animal_id = ? AND user_id = ?");
        $stmt->bind_param("sd", $animal_id, $user_id);
        $stmt->execute();
        $stmt->close();
     } else {
         //More than 1 births case
         $births_number = $result->num_rows;

         $average_infants = "";
        
         $total_infants = 0;
         while($row = $result->fetch_assoc()) {
             $infants = $row['infants_number'];
             $total_infants = $total_infants + $infants;  
         }
         $average_infants = number_format($total_infants / $births_number,2);
         

         $stmt = $conn->prepare("UPDATE reproduction_statics SET births_number = ?, average_infants = ? WHERE animal_id = ? AND user_id = ?");
         $stmt->bind_param("sssd",  $births_number,$average_infants, $animal_id, $user_id);
         $stmt->execute();
         $stmt->close();
     }


     //Write reproduction.json
     $data = file_get_contents('./json/reproduction.json');
     $json_array = json_decode($data, true);    
     $stmt = $conn->prepare("SELECT reproduction.animal_id , reproduction.birth_day, reproduction.infants_number, users_animals.animal_type, users_animals.animal_species FROM reproduction 
     INNER JOIN users_animals ON reproduction.animal_id = users_animals.animal_un_number  WHERE reproduction.user_id = ?");
     $stmt->bind_param("d",$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $json_array = array();
     while($row = $result->fetch_assoc()) {
         $json_array[] = $row;
     }
     file_put_contents('./json/reproduction.json', json_encode($json_array));

     //Write reproduction_statics.json
     $data = file_get_contents('./json/reproduction_statics.json');
     $json_array = json_decode($data, true);    
     $stmt = $conn->prepare("SELECT reproduction_statics.animal_id , reproduction_statics.births_number, reproduction_statics.average_infants, users_animals.animal_type, users_animals.animal_species 
     FROM reproduction_statics INNER JOIN users_animals ON reproduction_statics.animal_id = users_animals.animal_un_number  WHERE reproduction_statics.user_id = ?");
     $stmt->bind_param("d",$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $json_array = array();
     while($row = $result->fetch_assoc()) {
         $json_array[] = $row;
     }
     file_put_contents('./json/reproduction_statics.json', json_encode($json_array));


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
