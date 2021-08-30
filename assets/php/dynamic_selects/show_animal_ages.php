<?php

if (isset($_POST['animal_type_id'])) {
    include '../includes/dbc.inc.php';

    $animal_type_id = $_POST['animal_type_id'];

    $stmt = $conn->prepare("SELECT * FROM animals_group_ages WHERE animal_type_id = ?");
    $stmt->bind_param("d", $animal_type_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $block = "";


    while($row = $result->fetch_assoc()) {
        $block .= '<option value="'. $row['animal_age_range'].'"> '.$row['animal_age_range'].'</option>';
    }

    echo $block;
}