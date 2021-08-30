

$(document).on("click", ".js-edit-meat-production", function () {
    
    // Get values
    var animal_id_field = $(this).parent().parent().parent().find('td[data-field="animal_id"]');
    var animal_id = animal_id_field.children().html();

    var total_weight_field = $(this).parent().parent().parent().find('td[data-field="total_weight"]');
    var total_weight = total_weight_field.children().html();
    total_weight = parseFloat(total_weight);

    var net_weight_field = $(this).parent().parent().parent().find('td[data-field="net_weight"]');
    var net_weight = net_weight_field.children().html();
    net_weight = parseFloat(net_weight);

    var price_kilo_field = $(this).parent().parent().parent().find('td[data-field="price_kilo"]');
    var price_kilo = price_kilo_field.children().html();
    price_kilo = parseFloat(price_kilo);

    var inspection_field = $(this).parent().parent().parent().find('td[data-field="inspection"]');
    var inspection = inspection_field.children().html();

    var slaughterhouse_field = $(this).parent().parent().parent().find('td[data-field="slaughterhouse"]');
    var slaughterhouse = slaughterhouse_field.children().html();

    var total_price_field = $(this).parent().parent().parent().find('td[data-field="total_price"]');
    var total_price = total_price_field.children().html();
    total_price = parseFloat(total_price);


    
      // Append values
      $("input[name='up_total_weight']").val(total_weight);
      $("input[name='up_net_weight']").val(net_weight);
      $("input[name='up_price_kilo']").val(price_kilo);
      $("input[name='up_price_kilo']").attr("id",total_price);
      $("select[name='up_inspection']").val(inspection);
      $("select[name='up_inspection']").attr("id",animal_id);
      $("input[name='up_slaughterhouse']").val(slaughterhouse);
      
});

$(document).on("click", ".js-delete-meat-production", function () {
    var animal_id_field = $(this).parent().parent().parent().find('td[data-field="animal_id"]');
    var animal_id = animal_id_field.children().html();

    var total_price_field = $(this).parent().parent().parent().find('td[data-field="total_price"]');
    var total_price = total_price_field.children().html();
    money = parseFloat(total_price);

    $(document).on("click", "#confirm_meat_delete", function () {

        $.ajax({
            type: "POST",
            url: "assets/php/delete_meat_production.php",
            data: {
                animal_id : animal_id,
                money : money 
            },
            success: function (response) {
                $("#delete_meat_status").html(response).fadeIn(300).delay(5000).fadeOut(300);
            }
        });
    });

});