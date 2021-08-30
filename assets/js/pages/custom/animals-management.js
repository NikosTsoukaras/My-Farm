//Main Insert - Dynamic Species Select 

$(document).on("change", "select[name='type']", function () {
    var animal_type_id = $("select[name='type'] option:selected").attr("id");

    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_species.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='species']").html(response);
        }
    });

});

//Update Insert - Dynamic Species Select 
$(document).on("change", "select[name='up_type']", function () {
    var animal_type_id = $("select[name='up_type'] option:selected").attr("id");

    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_species.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='up_species']").html(response);
        }
    });

});
//Main Insert - Dynamic Age Group Select 

$(document).on("change", "select[name='type']", function () {
    var animal_type_id = $("select[name='type'] option:selected").attr("id");
    
    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_ages.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='age_group']").html(response);
        }
    });

});

//Update Insert - Dynamic Age Group Select 

$(document).on("change", "select[name='up_type']", function () {
    var animal_type_id = $("select[name='up_type'] option:selected").attr("id");
    
    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_ages.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='up_group_ages']").html(response);
        }
    });

});

//Main Insert - Dynamic Vaccination Select 

$(document).on("change", "select[name='type']", function () {
    var animal_type = $("select[name='type'] option:selected").attr("id");
          

    if (animal_type == 1) {
        $("input[name='disease']").attr("placeholder", "Εμβολιασμός για οζώδη δερματίτιδα");
        $("#vac_error").html("* Εάν το ζώο δεν είναι εμβολιασμένο για οζώδη δερματίτιδα τότε ολόκληρο το είδος δεν μπορεί να έχει καταχωρήσεις στην γαλακτοπαραγωγή και το συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");
    } else if (animal_type == 2 || animal_type == 3) {
        $("input[name='disease']").attr("placeholder", "Εμβολιασμός για βρουκέλλωση");
        $("#vac_error").html("* Εάν ένα ζώο δεν έχει εμβολιαστεί για βρουκέλλωση τότε ολόκληρη η μονάδα δεν μπορεί να έχει καταχωρήσεις στην γαλακτοπαραγωγή και το συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");

    }else if (animal_type == 4 ) {
        $("input[name='disease']").attr("placeholder", "Εμβολιασμός για γρίπη των χοίρων");
        $("#vac_error").html("* Εάν ένα ζώο δεν είναι εμβολιασμένος για την γρίπη των χοίρων δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");
    }     

    $("select[name='vaccination']").html("<option>Ναι</option><option>Όχι</option>");
    
});

//Update Insert - Dynamic Vaccination Select 

$(document).on("change", "select[name='up_type']", function () {
    var animal_type = $("select[name='up_type'] option:selected").attr("id");
          
    
    if (animal_type == 1) {
        $("label[id='up_vac_title']").html("Εμβολιασμός για οζώδη δερματίτιδα");
        $("#up_vac_error").html("* Εάν το ζώο δεν είναι εμβολιασμένο για οζώδη δερματίτιδα τότε ολόκληρο το είδος δεν μπορεί να έχει καταχωρήσεις στην γαλακτοπαραγωγή και το συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");
    } else if (animal_type == 2 || animal_type == 3) {
        $("label[id='up_vac_title']").html("Εμβολιασμός για βρουκέλλωση");
        $("#up_vac_error").html("* Εάν ένα ζώο δεν έχει εμβολιαστεί για βρουκέλλωση τότε ολόκληρο το είδος δεν μπορεί να έχει καταχωρήσεις στην γαλακτοπαραγωγή και το συγκεκριμένο ζώο δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");
    } else if (animal_type == 4 ) {
        $("label[id='up_vac_title']").html("Εμβολιασμός για γρίπη των χοίρων");
        $("#up_vac_error").html("* Εάν ένα ζώο δεν είναι εμβολιασμένος για την γρίπη των χοίρων δεν μπορεί να καταχωρηθεί στην κρεατοπαραγωγή.");
    }     
});

//Edit Animal
$(document).on("click", ".js-edit-animal", function () {
    var animal_id_field = $(this).parent().parent().parent().find('td[data-field="animal_un_number"]');
    var  animal_id = animal_id_field.children().html();

    $.ajax({
        type: "POST",
        url: "assets/php/edit_animals.php",
        data: {
            animal_id : animal_id 
        },
        success: function (response) {
            $("#edit_animal_form").html(response);
        }
    });
    
});
//Delete Animal

$(document).on("click", ".js-delete-animal", function () {
    var animal_id_field = $(this).parent().parent().parent().find('td[data-field="animal_un_number"]');
    var  animal_id = animal_id_field.children().html();
    

        $(document).on("click", "#confirm_animal_delete", function () {

            $.ajax({
                type: "POST",
                url: "assets/php/delete_animals.php",
                data: {
                    animal_id : animal_id 
                },
                success: function (response) {
                    $("#delete_status").html(response).fadeIn(300).delay(5000).fadeOut(300);
                }
            });
        });
});
