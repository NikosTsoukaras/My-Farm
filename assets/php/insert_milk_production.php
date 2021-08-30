<?php

if (isset($_POST['milk_day_production']) && isset($_POST['milk_type']) && isset($_POST['total_milk_production']) &&
 isset($_POST['milk_cellulars']) && isset($_POST['milk_protein']) &&  isset($_POST['milk_fat']) && isset($_POST['milk_price'])) {

    session_start();
    include './includes/dbc.inc.php';


    $milk_date = $_POST['milk_day_production'];
    $milk_type = $_POST['milk_type'];
    $milk_quantity = $_POST['total_milk_production'];
    $milk_cellulars = $_POST['milk_cellulars'];
    $milk_protein = $_POST['milk_protein'];
    $milk_fat = $_POST['milk_fat'];
    $milk_price = $_POST['milk_price'];
    $milk_sum = $_POST['milk_sum'];
    $user_id = $_SESSION['user_id'];
    $no = "Όχι";

    //Check if animals are vaccinated

    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_vaccination = ? AND animal_type =? AND user = ?");
    $stmt->bind_param("ssd", $no,$milk_type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0) {

            $stmt = $conn->prepare("INSERT INTO milk_production (milk_date, milk_type, milk_quantity, milk_cellulars,
            milk_protein, milk_fat, milk_price, milk_sum, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssd", $milk_date, $milk_type, $milk_quantity, $milk_cellulars, $milk_protein, $milk_fat, $milk_price, $milk_sum, $user_id);
            $stmt->execute();
            $stmt->close();

            $type = "income";
            $description = "Γαλακτοπαραγωγή";
            //Insert record in economics table
            $stmt = $conn->prepare("INSERT INTO economics (type, amount, description, date, user_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssd", $type, $milk_sum, $description, $milk_date, $user_id);
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


            echo '<div class="alert alert-outline-success fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Η καταχώρηση  ολοκληρώθηκε με επιτυχία !</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>';

    } else {
        echo '<div class="alert alert-outline-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">Η καταχώρηση  δεν μπορεί να ολοκληρωθεί καθώς κάποιο ή κάποια απο τα ζώα της συγκεκριμένης φυλής δεν έχουν εμβολιαστεί ! </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
    }

 }