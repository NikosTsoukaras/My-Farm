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
    $slaughter_date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];
    $one = 1;
    $zero = 0;


    //Check if animal exists
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_un_number = ? AND user = ?");
    $stmt->bind_param("sd", $animal_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    //Check if animal exists
    if($result->num_rows === 0) {
        echo '<div class="alert alert-outline-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">O κωδικός ενωτίου που πληκτρολογήσατε δεν αντιστοιχεί σε κάποιο ζώο. Παρακαλώ προσπαθήστε ξανα.</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
    } else {
            //Check if animal is vaccinated
            $no = "Όχι";

            $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_un_number = ? AND animal_vaccination = ? AND user = ?");
            $stmt->bind_param("ssd", $animal_id, $no ,$user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows === 0) {


            $stmt = $conn->prepare("SELECT * FROM meat_production WHERE animal_id = ? AND user_id = ?");
            $stmt->bind_param("sd", $animal_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            //Check if animal already exists in meat production
            if($result->num_rows === 0) {
                //Update Animal delete state
                $stmt = $conn->prepare("UPDATE users_animals SET animal_deleted = ? WHERE animal_un_number = ? AND user = ?");
                $stmt->bind_param("dsd", $one, $animal_id, $user_id);
                $stmt->execute();
                $stmt->close();
                //Rewrite animals.json
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

                //Insert record in meat_production table
                if ($inspection == "Ναι") {
                    $stmt = $conn->prepare("INSERT INTO meat_production (animal_id, total_weight, net_weight, price_kilo,
                    total_price, inspection, slaughterhouse, slaughter_date, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssssd", $animal_id, $total_weight, $net_weight, $price_kilo, $total_price, $inspection, $slaughterhouse,  $slaughter_date, $user_id);
                    $stmt->execute();
                    $stmt->close();
                

                } elseif ($inspection == "Μερική απόρριψη") {
                    $total_price = $total_price / 2;
                    
                    $stmt = $conn->prepare("INSERT INTO meat_production (animal_id, total_weight, net_weight, price_kilo,
                    total_price, inspection, slaughterhouse, slaughter_date, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssssd", $animal_id, $total_weight, $net_weight, $price_kilo, $total_price, $inspection, $slaughterhouse,  $slaughter_date, $user_id);
                    $stmt->execute();
                    $stmt->close();
                } elseif ($inspection == "Ολική απόρριψη") {
                    $total_price = 0;
                
                    $stmt = $conn->prepare("INSERT INTO meat_production (animal_id, total_weight, net_weight, price_kilo,
                    total_price, inspection, slaughterhouse, slaughter_date, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssssd", $animal_id, $total_weight, $net_weight, $price_kilo, $total_price, $inspection, $slaughterhouse,  $slaughter_date, $user_id);
                    $stmt->execute();
                    $stmt->close();
                }

                $type = "income";
                $description = "Κρεατοπαραγωγή";
                //Insert record in economics table
                $stmt = $conn->prepare("INSERT INTO economics (type, amount, description, date, user_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssd", $type, $total_price, $description, $slaughter_date, $user_id);
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
                <div class="alert-text">To συγκεκριμένο ζώο έχει καταχωρηθεί ήδη στην κρεατοπαραγωγή.</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>';
            }
        }  else {
            echo '<div class="alert alert-outline-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">To συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή καθώς δεν είναι εμβολιασμένο.</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>';
        }  
    }

 }