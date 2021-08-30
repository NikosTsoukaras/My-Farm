

$(document).on("click", ".js-edit-milk-production", function () {
    
    // Get values
    
    var milk_date = $(this).parent().parent().parent().find('span[class="milk_production_id"]').html();
    var milk_production_id = $(this).parent().parent().parent().find('span[class="milk_production_id"]').attr("id");


    var milk_type_field = $(this).parent().parent().parent().find('td[data-field="milk_type"]');
    var  milk_type = milk_type_field.children().html();

    var milk_quantity_field = $(this).parent().parent().parent().find('td[data-field="milk_quantity"]');
    var  milk_quantity = milk_quantity_field.children().html();
    milk_quantity = parseFloat(milk_quantity);

    var milk_cellulars_field = $(this).parent().parent().parent().find('td[data-field="milk_cellulars"]');
    var  milk_cellulars = milk_cellulars_field.children().html();

    var milk_protein_field = $(this).parent().parent().parent().find('td[data-field="milk_protein"]');
    var  milk_protein = milk_protein_field.children().html();
    milk_protein = parseFloat(milk_protein);

    var milk_fat_field = $(this).parent().parent().parent().find('td[data-field="milk_fat"]');
    var  milk_fat = milk_fat_field.children().html();
    milk_fat = parseFloat(milk_fat);

    var milk_sum_field = $(this).parent().parent().parent().find('td[data-field="milk_price"]');
    var  milk_sum = milk_sum_field.children().html();
    milk_sum = parseFloat(milk_sum);

    var milk_money_field = $(this).parent().parent().parent().find('td[data-field="milk_sum"]');
    var  milk_money = milk_money_field.children().html();
    milk_money = parseFloat(milk_money);
    
    

    // Append values
    $("input[name='up_milk_day_production']").val(milk_date);
    $("select[name='up_type']").val(milk_type);
    $("select[name='up_type']").attr("id",milk_production_id);
    $("input[name='up_total_milk_production']").val(milk_quantity);
    $("select[name='up_cellular']").val(milk_cellulars);
    $("input[name='up_protein']").val(milk_protein);
    $("input[name='up_fat']").val(milk_fat);
    $("input[name='up_price']").val(milk_sum);
    $("input[name='up_price']").attr("id",milk_money);

});


$(document).on("click", ".js-delete-milk-production", function () {
    var milk_production_id = $(this).parent().parent().parent().find('span[class="milk_production_id"]').attr("id");

    var milk_money_field = $(this).parent().parent().parent().find('td[data-field="milk_sum"]');
    var  milk_money = milk_money_field.children().html();
    money = parseFloat(milk_money);
    
    $(document).on("click", "#confirm_milk_delete", function () {

        
        $.ajax({
            type: "POST",
            url: "assets/php/delete_milk_production.php",
            data: {
                milk_production_id : milk_production_id,
                money : money 
            },
            success: function (response) {
                $("#delete_milk_status").html(response).fadeIn(300).delay(5000).fadeOut(300);
            }
        });
    });
});