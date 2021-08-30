<?php


    include '../includes/dbc.inc.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    

    $stmt = $conn->prepare("SELECT * FROM medical WHERE user_id = ?");
    $stmt->bind_param("d", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $block = "";


    while($row = $result->fetch_assoc()) {
        $block .= '<option value="'. $row['title'].'"> '.$row['title']."-".$row['inspection_details'].'</option>';
    }

    echo $block;
