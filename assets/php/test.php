<?php


include './includes/dbc.inc.php';

$u = 30;


    // $vaccination_state = "Εκκρεμεί";
    // //Select max un_number query
    // $stmt = $conn->prepare("SELECT DISTINCT animal_mother FROM users_animals WHERE animal_vaccination = ? AND  user = ?");
    // $stmt->bind_param("sd",$vaccination_state, $u);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // $mother="";

    // while($row = $result->fetch_assoc()) {
    //     $mother .= $row['animal_mother']." ";
    // }

    // echo $mother;




    
    $vaccination_state = "Εκκρεμεί";
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_vaccination = ? AND  user = ?");
    $stmt->bind_param("sd", $vaccination_state, $u);
    $stmt->execute();
    $result = $stmt->get_result();

    echo $result->num_rows; 
    

