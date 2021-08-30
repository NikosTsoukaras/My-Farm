<?php

session_start();

 if (isset($_POST['user_email']) && isset($_POST['user_pwd']))    {
    include './includes/dbc.inc.php';

    $email = $_POST['user_email'];
    $pwd = $_POST['user_pwd'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0) {
        echo '<div class="alert alert-outline-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
        <div class="alert-text">Το E-mail που πληκτρολογήσατε δεν έχει καταχωρηθεί ήδη !<br> Παρακαλώ προσπαθήστε ξανά.</div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
        </div>';
        exit();
    } else {
        while($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name']; 
            $hash = $row['user_pwd'];
        }

        $pwdCheck = password_verify($pwd,$hash);
             
            if( $pwdCheck == false) {
                echo '<div class="alert alert-outline-danger fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                <div class="alert-text">Ο κωδικός που πληκτρολογήσατε είναι λάθος!<br> Παρακαλώ προσπαθήστε ξανά.</div>

                <div class="alert-close">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                 </button>
                </div>
                </div>';
                exit();
            } else {
                echo '1';
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;

                //Rewrite Datatables
                //Write animals.json
                $zero = 0;
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

                //Write milk_production.json
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

                //Write medical.json
                $data = file_get_contents('./json/medical.json');
                $json_array = json_decode($data, true);
                $stmt = $conn->prepare("SELECT * FROM medical WHERE user_id = ? ");
                $stmt->bind_param("d", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $json_array = array();
                while($row = $result->fetch_assoc()) {
                    $json_array[] = $row;
                }
                file_put_contents('./json/medical.json', json_encode($json_array));

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

                //Write income.json
                $type = 'income';
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

                //Write outgoings.json
                $type = 'outgoings';
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





                exit();
            }
        
    }
}