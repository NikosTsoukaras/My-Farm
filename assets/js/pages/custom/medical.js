// INSERT INSPECTION

//Dynamic Form Content

var input_animal_id = '<label class="col-form-label col-lg-3 col-sm-12">Αριθμός Ενωτίου *</label>' +
'<div class="col-lg-5 col-md-5 col-sm-12">'+
    '<input type="text" class="form-control" name="animal_id" placeholder="">'+
    '<span class="form-text text-muted">Παρακαλώ πληκτρολογήστε αριθμό ενωτίου</span>'+
'</div>';

var input_animals_number = '<label class="col-form-label col-lg-3 col-sm-12">Αριθμός Ζώων *</label>' +
'<div class="col-lg-5 col-md-5 col-sm-12">'+
    '<input id="kt_touchspin_8" type="text" class="form-control" name="animals_number" placeholder="" type="text">'+
    '<span class="form-text text-muted">Παρακαλώ πληκτρολογήστε αριθμό ζώων</span>'+
'</div>';


var vet_textarea = '<label class="col-form-label col-lg-3 col-sm-12">Οδηγίες Κτηνιάτρου *</label>'+
                    '<div class="col-lg-5 col-md-5 col-sm-12">' +
                        '<textarea class="form-control" id="" name="vet_notes" rows="3"></textarea>'+
                    '</div>';

var update_vet_textarea = '<label class="col-form-label col-lg-3 col-sm-12">Οδηγίες Κτηνιάτρου *</label>'+
'<div class="col-lg-5 col-md-5 col-sm-12">' +
    '<textarea class="form-control" id="" name="update_vet_notes" rows="3"></textarea>'+
'</div>';                    

var select_age_group = '<label class="col-form-label col-lg-3 col-sm-12">Ηλικιακό Γρουπ *</label>'+
                        '<div class="col-lg-5 col-md-5 col-sm-12 form-group-sub">'+
                            '<select class="form-control" name="age_group">'+
                                '<option value=""></option>'+															
                            '</select>'+
                            '<span class="form-text text-muted">Παρακαλώ επιλέξτε ηλικιακό γρουπ</span>'
                        '</div>';
                       

// Ill animal case                     
$(document).on("change", "input[id='animal']:checked", function () {
    $("#dynamic_area_1").css("display","flex").html(input_animal_id);
    $("#dynamic_area_2").css("display","none").html("");

});


// Ill group age case , specific animals number
$(document).on("change", "input[id='animals_group_age_number']:checked", function () {
    $("#dynamic_area_1").css("display","flex").html(select_age_group);
    $("#dynamic_area_2").css("display","flex").html(input_animals_number);

});

// Ill group age case 
$(document).on("change", "input[id='animals_group_age']:checked", function () {
    $("#dynamic_area_1").css("display","flex").html(select_age_group);
    $("#dynamic_area_2").css("display","none").html("");
});

$(document).on("change", "input[id='all_animals_type']:checked,input[id='all_animals_species']:checked", function () {
    $("#dynamic_area_1").css("display","none").html("");
    $("#dynamic_area_2").css("display","none").html("");

});

//Vet contact case
$(document).on("change", "select[name='vet_contact']", function () {
    var choice = $("select[name='vet_contact']").val();

    if (choice == "Ναι") {
        $("#vet_instruction").css("display","flex").html(vet_textarea);
    } else if (choice == "Όχι") {
        $("#vet_instruction").css("display","none").html();
    }
});




//Dynamic Species Select 

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

//Dynamic Age Group Select 

$(document).on("change", "select[name='type']", function () {
    var animal_type_id = $("select[name='type'] option:selected").attr("id");
    
    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_ages_ins.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='age_group']").html(response);
        }
    });

});


$(document).on("change", "input[id='animals_group_age_number']:checked,input[id='animals_group_age']:checked", function () {
    var animal_type_id = $("select[name='type'] option:selected").attr("id");
    
    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_animal_ages_ins.php",
        data: {
            animal_type_id : animal_type_id 
        },
        success: function (response) {
            $("select[name='age_group']").html(response);
        }
    });

});



// UPDATE INSPECTION


$(document).on("click", "a[href='#update_inspection_form']", function () {

    
    $.ajax({
        type: "POST",
        url: "assets/php/dynamic_selects/show_user_medical_titles.php",
        success: function (response) {
            $("select[name='select_inspection']").html(response);
        }
    });
});


//Vet contact case
$(document).on("change", "select[name='update_vet_contact']", function () {
    var choice = $("select[name='update_vet_contact']").val();

    if (choice == "Ναι") {
        $("#update_vet_instruction").css("display","flex").html(update_vet_textarea);
    } else if (choice == "Όχι") {
        $("#update_vet_instruction").css("display","none").html();
    }
});


// Delete Datatable Field
$(document).on("click", ".js-delete-medical", function () {
    var medical_id = $(this).parent().parent().parent().find('span[class="economics_id"]').attr("id");

    console.log(medical_id);

    
    $(document).on("click", "#confirm_medical_delete", function () {
        $.ajax({
            type: "POST",
            url: "assets/php/delete_medical.php",
            data: {
                medical_id : medical_id 
            },
            success: function (response) {
                $("#delete_medical_status").html(response).fadeIn(300).delay(5000).fadeOut(300);
            }
        });
    });

});

