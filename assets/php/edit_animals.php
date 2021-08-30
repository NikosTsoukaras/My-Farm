<?php

if(isset($_POST['animal_id'])){
    
    session_start();
    include './includes/dbc.inc.php';

    $animal_un_number = $_POST['animal_id'];
    $user_id = $_SESSION['user_id'];
    $selected ="";


    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_un_number = ? AND user = ?");
    $stmt->bind_param("sd", $animal_un_number, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        $animal_sex = $row['animal_sex'];
        $animal_type = $row['animal_type'];
        $animal_species = $row['animal_species'];
        $animal_age_group = $row['animal_age_group'];
        $animal_birth = $row['animal_birth'];
        $animal_vaccination = $row['animal_vaccination'];
    }

    //Insert Update form - Animal ID 
    $form =' <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Aριθμό Eνωτίου *</label>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <input type="text" class="form-control" id="'.$animal_un_number.'" name="up_animal_id" value="'.$animal_un_number.'" placeholder="">
                    <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τον αριθμό ενωτίου</span>
                </div>
            </div>';
    //Insert Update form - Animal Sex
    $form .=' <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Φύλο *</label>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <select class="form-control" name="up_sex" >
                        <option'.($animal_sex ==  "Αρσενικό" ? $selected=" selected" : $selected="").' '.$selected.' >Αρσενικό</option>	
                        <option'.($animal_sex ==  "Θηλυκό" ? $selected=" selected" : $selected="").' '.$selected.' >Θηλυκό</option>															
                    </select>
                    <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τον αριθμό ενωτίου</span>
                </div>
            </div>';
    //Insert Update form - Animal Type
    $form .=' <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Τύπος *</label>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <select class="form-control" name="up_type" >
                    <option id="1" value="Αγελάδα" '.($animal_type ==  "Αγελάδα" ? $selected=" selected" : $selected="").' '.$selected.' >Αγελάδα</option>	
                    <option id="2" value="Πρόβατο" '.($animal_type ==  "Πρόβατο" ? $selected=" selected" : $selected="").' '.$selected.' >Πρόβατο</option>
                    <option id="3" value="Αίγια" '.($animal_type ==  "Αίγια" ? $selected=" selected" : $selected="").' '.$selected.' >Αίγια</option>															
                    <option id="4" value="Γουρούνι" '.($animal_type ==  "Γουρούνι" ? $selected=" selected" : $selected="").' '.$selected.' >Γουρούνι</option>															
                </select>
                <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τον αριθμό ενωτίου</span>
            </div>
        </div>';       
        
    // Find animal_type_id
    $stmt = $conn->prepare("SELECT * FROM animals WHERE animal_type = ?");
    $stmt->bind_param("s", $animal_type);
    $stmt->execute();
    $result = $stmt->get_result();    

    while($row = $result->fetch_assoc()) {
        $animal_type_id = $row['animal_type_id'];
    }



    $stmt = $conn->prepare("SELECT * FROM animal_species WHERE animal_type_id = ?");
    $stmt->bind_param("d", $animal_type_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $species_options = "";
    while($row = $result->fetch_assoc()) {
        $species_options .= '<option value="'.$row['animal_species_name'].'" '.($animal_species ==  $row['animal_species_name'] ? $selected=" selected" : $selected="").' '.$selected.' >'.$row['animal_species_name'].'</option>';
    }

    //Insert Update form - Animal Species
    $form .=' <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Τύπος *</label>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <select class="form-control" name="up_species" >'
                    .$species_options.'											
                    </select>
                    <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τον αριθμό ενωτίου</span>
                </div>
            </div>';      
    
    $stmt = $conn->prepare("SELECT * FROM animals_group_ages WHERE animal_type_id = ?");
    $stmt->bind_param("d", $animal_type_id);
    $stmt->execute();
    $result = $stmt->get_result();  
    
    $group_ages_options = "";
    while($row = $result->fetch_assoc()) {
        $group_ages_options .= '<option value="'.$row['animal_age_range'].'" '.($animal_species ==  $row['animal_age_range'] ? $selected=" selected" : $selected="").' '.$selected.' >'.$row['animal_age_range'].'</option>';
    }

    //Insert Update form - Animal Group Ages
    $form .=' <div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Ηλικιακο Γκρουπ *</label>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <select class="form-control" name="up_group_ages" >'
                    .$group_ages_options.'											
                    </select>
                    <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε τον αριθμό ενωτίου</span>
                </div>
            </div>';   


    //Insert Update form - Animal Birth Date
    $form .= '<div class="form-group row">
                <label class="col-form-label col-lg-3 col-sm-12">Ημερομηνία Γέννησης *</label>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <input type="text" class="form-control" name="up_birth_date" value="'.$animal_birth.'" placeholder="">
                    <span class="form-text text-muted">Παρακαλώ πληκτρολογήστε ημερομηνία γέννησης με τη μορφή : Έτος-Μήνας-Ημέρα</span>
                </div>
            </div>';

    $vaccination_name = ""; 
    $vaccination_msg = "";
    if ($animal_type == "Αγελάδα"){
        $vaccination_name = "οζώδη δερματίτιδα";
        $vaccination_msg = "* Εάν το ζώο δεν είναι εμβολιασμένο για οζώδη δερματίτιδα δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.";
    } elseif ($animal_type == "Πρόβατο" || $animal_type == "Αίγια") {
        $vaccination_name = "βρουκέλλωση";
        $vaccination_msg = "* Εάν ένα ζώο δεν έχει εμβολιαστεί για βρουκέλλωση τότε ολόκληρη η μονάδα δεν μπορεί να έχει καταχωρήσεις στην γαλακτοπαραγωγή και το συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.";
    } elseif ($animal_type == "Γουρούνι" ) {
        $vaccination_name = "γρίπη των χοίρων";
        $vaccination_msg = "* Εάν ένα ζώο δεν είναι εμβολιασμένος για την γρίπη των χοίρων δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.";
    }

    $form .= '<div class="form-group row">
            <label id="up_vac_title" class="col-form-label col-lg-3 col-sm-12">Εμβολιασμός για '.$vaccination_name.'*</label>
            <div class="col-lg-5 col-md-5 col-sm-12">
                <select class="form-control" name="up_vaccination" >
                    <option'.($animal_vaccination ==  "Ναι" ? $selected=" selected" : $selected="").' '.$selected.' >Ναι</option>	
                    <option'.($animal_vaccination ==  "Όχι" ? $selected=" selected" : $selected="").' '.$selected.' >Όχι</option>															
                </select>
                <span id="up_vac_error" class="form-text text-muted">'. $vaccination_msg.'</span>
            </div>
        </div>';   
        
        
        $form .= '<div class="modal-footer">
        <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Ακύρωση</button>
        <button type="submit" id="confirm_animal_update" class="btn btn-outline-brand" >Επιβεβαίωση</button>
    </div>';





echo $form;



}

