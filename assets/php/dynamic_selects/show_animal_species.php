<?php

if (isset($_POST['animal_type_id'])) {
    include '../includes/dbc.inc.php';

    $animal_type_id = $_POST['animal_type_id'];

    $stmt = $conn->prepare("SELECT * FROM animal_species WHERE animal_type_id = ?");
    $stmt->bind_param("d", $animal_type_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $block = "";


    while($row = $result->fetch_assoc()) {
        $block .= '<option value="'. $row['animal_species_name'].'"> '.$row['animal_species_name'].'</option>';
    }

    echo $block;
}