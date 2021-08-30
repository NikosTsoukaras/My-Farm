<?php

if (isset($_POST['animal_id']) && isset($_POST['birth_day']) && isset($_POST['infants_number']) ) {

    session_start();
    include './includes/dbc.inc.php';

    //Get values
    $animal_id = $_POST['animal_id'];
    $birth_day = $_POST['birth_day'];
    $infants_number = $_POST['infants_number'];
    $user_id = $_SESSION['user_id'];
    $one = 1;

    //Check if animal exist query
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_un_number = ? AND user = ?");
    $stmt->bind_param("sd", $animal_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    //Check if animal exist
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
        //Get animal sex, type, species 
        while($row = $result->fetch_assoc()) {
            $animal_sex = $row['animal_sex'];
            $animal_type = $row['animal_type'];
            $animal_species = $row['animal_species'];
        }

        //Check if animal is female
        if ($animal_sex == 'Αρσενικό') {
            echo '<div class="alert alert-outline-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">O κωδικός ενωτίου που πληκτρολογήσατε αντιστοιχεί σε αρσενικό ζώο. Παρακαλώ προσπαθήστε ξανα.</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>';
        } else {
            //Insert infants into users_animals

            for ($i = 1; $i <= $infants_number; $i++) {

                //Select max un_number query
                $stmt = $conn->prepare("SELECT MAX(animal_un_number) AS MAX FROM users_animals WHERE  user = ?");
                $stmt->bind_param("d", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
            
            
                while($row = $result->fetch_assoc()) {
                    $number = $row['MAX'];
                }
                
                $new_un_number =  $number + 1 ;
            
                //Group Ages Query 
            
                $stmt = $conn->prepare("SELECT MIN(animals_group_ages.animal_age_id), animals_group_ages.animal_age_range
                FROM `animals_group_ages` INNER JOIN animals ON animals_group_ages.animal_type_id = animals.animal_type_id WHERE animals.animal_type = ?");
                $stmt->bind_param("s", $animal_type);
                $stmt->execute();
                $result = $stmt->get_result();
            
                 while($row = $result->fetch_assoc()) {
                    $age_group = $row['animal_age_range'];
                }
            
                //Insert Infant
                $animal_mother = $animal_id;
                $animal_vaccination = "Εκκρεμεί";
                $animal_deleted = 0;
                $stmt = $conn->prepare("INSERT INTO users_animals (animal_un_number, animal_type, animal_species,
                     animal_age_group, animal_birth, animal_register_date, animal_vaccination, animal_deleted,animal_mother, user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssdd", $new_un_number, $animal_type, $animal_species, $age_group, $birth_day, $birth_day, $animal_vaccination, $animal_deleted,$animal_mother, $user_id);
                $stmt->execute();
                $stmt->close();    
            }



            
            //Insert into reproduction table query
            $stmt = $conn->prepare("INSERT INTO reproduction (animal_id, birth_day, infants_number, user_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $animal_id, $birth_day, $infants_number, $user_id);
            $stmt->execute();
            $stmt->close();
            //Check if this animal has more than 1 births
            $stmt = $conn->prepare("SELECT * FROM reproduction WHERE animal_id = ? AND user_id = ?");
            $stmt->bind_param("sd", $animal_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();



            //First birth case
            if ($result->num_rows === 1) {
                $stmt = $conn->prepare("INSERT INTO reproduction_statics (animal_id, births_number, average_infants, user_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssd", $animal_id, $one, $infants_number, $user_id);
                $stmt->execute();
                $stmt->close();
            } else {
                //More than 1 births case
                $births_number = $result->num_rows;
               
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

            $zero = 0;
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

            //User msg
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


    }










}