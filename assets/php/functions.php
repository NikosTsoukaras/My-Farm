<?php

//Set active item on  sidebar
function active($file, $subdirectories) {
    if (basename($_SERVER['PHP_SELF']) == $file && $subdirectories == 'yes') {
        echo 'kt-menu__item--open kt-menu__item--here';
    }

    if (basename($_SERVER['PHP_SELF']) == $file && $subdirectories == 'no') {
        echo 'kt-menu__item--open';
    }
}
function sub_title() {
    if (basename($_SERVER['PHP_SELF']) == 'animals-management.php') {
        echo 'Διαχείριση Ζώων';
    } elseif (basename($_SERVER['PHP_SELF']) == 'milk-production.php') {
        echo 'Γαλακτοπαραγωγή';
    } elseif (basename($_SERVER['PHP_SELF']) == 'meat-production.php') {
        echo 'Κρεατοπαραγωγή';
    } elseif (basename($_SERVER['PHP_SELF']) == 'medical.php') {
        echo 'Ιατρικές Παρατηρήσεις';
    } elseif (basename($_SERVER['PHP_SELF']) == 'reproduction.php') {
        echo 'Αναπαραγωγική Διαχείριση';
    } elseif (basename($_SERVER['PHP_SELF']) == 'reproduction_statics.php') {
        echo 'Στατιστικά Αναπαραγωγής';
    } elseif (basename($_SERVER['PHP_SELF']) == 'economics.php') {
        echo 'Οικονομικά';
    } elseif (basename($_SERVER['PHP_SELF']) == 'index.php') {
        echo 'Κεντρική Σελίδα';
    }  
}

function sub_icon() {
    if (basename($_SERVER['PHP_SELF']) == 'animals-management.php') {
        echo 'flaticon-interface-3';
    } elseif (basename($_SERVER['PHP_SELF']) == 'milk-production.php') {
        echo 'flaticon-clipboard';
    } elseif (basename($_SERVER['PHP_SELF']) == 'meat-production.php') {
        echo 'flaticon-clipboard';
    }elseif (basename($_SERVER['PHP_SELF']) == 'medical.php') {
        echo 'la la-stethoscope';
    } elseif (basename($_SERVER['PHP_SELF']) == 'reproduction.php' || basename($_SERVER['PHP_SELF']) == 'reproduction_statics.php') {
        echo 'la la-intersex';
    } elseif (basename($_SERVER['PHP_SELF']) == 'economics.php') {
        echo 'la la-dollar';
    }elseif (basename($_SERVER['PHP_SELF']) == 'index.php') {
        echo 'flaticon2-graphic';
    } 
}



function check_non_updated_infants() {
    include 'assets/php/includes/dbc.inc.php';

    $user_id = $_SESSION['user_id'];

    $zero = 0;

    $vaccination_state = "Εκκρεμεί";
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_vaccination = ? AND animal_deleted = ? AND  user = ?");
    $stmt->bind_param("sdd", $vaccination_state,$zero, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    
    if($result->num_rows === 0) {
        echo "display-none"; 
    } else {
        echo "";
    }
}



function print_mothers_id() {
    include 'assets/php/includes/dbc.inc.php';

    $user_id = $_SESSION['user_id'];
    $zero = 0;

    $vaccination_state = "Εκκρεμεί";
    //Select max un_number query
    $stmt = $conn->prepare("SELECT DISTINCT animal_mother FROM users_animals WHERE animal_vaccination = ? AND animal_deleted = ? AND  user = ?");
    $stmt->bind_param("sdd",$vaccination_state,$zero, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $mother="";

    while($row = $result->fetch_assoc()) {
        $mother .= $row['animal_mother']." ";
    }

    echo $mother;
}

function total_icome() {
    include 'assets/php/includes/dbc.inc.php';
    $type = 'income';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM economics WHERE type = ? AND  user_id = ?");
    $stmt->bind_param("sd",$type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['amount'];
        }
    }
    
    $sum =  number_format($sum,2);
    echo $sum;
}

function total_outgoings() {
    include 'assets/php/includes/dbc.inc.php';
    $type = 'outgoings';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM economics WHERE type = ? AND  user_id = ?");
    $stmt->bind_param("sd",$type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['amount'];
        }
    }
    
    $sum =  number_format($sum,2);
    echo $sum;
}

function total_profit() {
    include 'assets/php/includes/dbc.inc.php';
    $type = 'income';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM economics WHERE type = ? AND  user_id = ?");
    $stmt->bind_param("sd",$type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $income = 0;
    if($result->num_rows === 0) {
        $income = 0;
    } else {
        while($row = $result->fetch_assoc()) {
            $income = $income + $row['amount'];
        }
    }

    $type = 'outgoings';

    $stmt = $conn->prepare("SELECT * FROM economics WHERE type = ? AND  user_id = ?");
    $stmt->bind_param("sd",$type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $outgoings = 0;
    if($result->num_rows === 0) {
        $outgoings = 0;
    } else {
        while($row = $result->fetch_assoc()) {
            $outgoings = $outgoings + $row['amount'];
        }
    }

    $profit = $income - $outgoings;
    $profit =  number_format($profit,2);

    echo $profit;
}

function total_animals() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    
    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE user = ?");
    $stmt->bind_param("d", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_cows() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $animal_type="Αγελάδα";

    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_type = ? AND user = ?");
    $stmt->bind_param("sd",$animal_type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_ship() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $animal_type="Πρόβατο";

    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_type = ? AND user = ?");
    $stmt->bind_param("sd",$animal_type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_goats() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $animal_type="Αίγα";

    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_type = ? AND user = ?");
    $stmt->bind_param("sd",$animal_type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_pigs() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $animal_type="Χοίρος";

    $stmt = $conn->prepare("SELECT * FROM users_animals WHERE animal_type = ? AND user = ?");
    $stmt->bind_param("sd",$animal_type, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_births() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];


    $stmt = $conn->prepare("SELECT * FROM reproduction WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function total_milk_l() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['milk_quantity'];
        }
    }

    echo $sum;
}



function average_milk() {

    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
        $average = 0 ;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['milk_quantity'];
        }

        $number = $result->num_rows;

        $average =  $sum / $number;
    
        $average = number_format($average,2);
    }

   

    echo $average;


}

function total_milk_records() {
    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];


    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $number = $result->num_rows;

    echo $number;
}

function average_cellulars() {

    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
        $average = 0 ;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['milk_cellulars'];
        }

        $number = $result->num_rows;

    $average =  $sum / $number;

    $average = number_format($average,2);

    echo $average;
    }

    


}

function average_protein() {

    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
        $average = 0 ;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['milk_protein'];
        }

        $number = $result->num_rows;

        $average =  $sum / $number;
    
        $average = number_format($average,2);
    
        echo $average;
    }

  


}

function average_fat() {

    include 'assets/php/includes/dbc.inc.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM milk_production WHERE  user_id = ?");
    $stmt->bind_param("d",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sum = 0;
    if($result->num_rows === 0) {
        $sum = 0;
        $average = 0 ;
    } else {
        while($row = $result->fetch_assoc()) {
            $sum = $sum + $row['milk_fat'];
        }

        $number = $result->num_rows;

        $average =  $sum / $number;
    
        $average = number_format($average,2);
    
        echo $average;
    
    }

   

}