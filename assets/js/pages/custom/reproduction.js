

$(document).on("click", ".js-delete-reproduction", function () {
    var animal_id_field = $(this).parent().parent().parent().find('td[data-field="animal_id"]');
    var  animal_id = animal_id_field.children().html();

    var birth_day_field = $(this).parent().parent().parent().find('td[data-field="birth_day"]');
    var  birth_day = birth_day_field.children().html();

    var infants_number_field = $(this).parent().parent().parent().find('td[data-field="infants_number"]');
    var  infants_number = infants_number_field.children().html();


    

    $(document).on("click", "#confirm_reproduction_delete", function () {
        $.ajax({
            type: "POST",
            url: "assets/php/delete_reproduction.php",
            data: {
                animal_id : animal_id,
                birth_day : birth_day,
                infants_number: infants_number
            },
            success: function (response) {
                $("#delete_reproduction_status").html(response).fadeIn(300).delay(5000).fadeOut(300);
            }
        });
 
    });
    
});