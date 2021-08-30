
$(document).on("click", ".js-edit-incomes", function () {

    var description = $(this).parent().parent().parent().find('span[class="economics_id"]').html();
    var description_id = $(this).parent().parent().parent().find('span[class="economics_id"]').attr("id");
    

    var amount_field = $(this).parent().parent().parent().find('td[data-field="amount"]');
    var amount = amount_field.children().html();
    amount = parseFloat(amount);

    var date_field = $(this).parent().parent().parent().find('td[data-field="date"]');
    var date = date_field.children().html();

    $("input[name='up_incomes_description']").val(description);
    $("input[name='up_incomes_description']").attr("id",description_id);
    $("input[name='up_incomes_price']").val(amount);
    $("input[name='up_incomes_date']").val(date);

});

$(document).on("click", ".js-delete-incomes", function () {
    var id = $(this).parent().parent().parent().find('span[class="economics_id"]').attr("id");

    $(document).on("click", "#confirm_income_delete", function () {

            $.ajax({
                type: "POST",
                url: "assets/php/delete_economics.php",
                data: {
                    id : id
                },
                success: function (response) {
                    $('#delete_income_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                }
            });
    });
});


$(document).on("click", ".js-delete-outgoings", function () {
    var id = $(this).parent().parent().parent().find('span[class="economics_id"]').attr("id");
    $(document).on("click", "#confirm_outgoings_delete", function () {
            $.ajax({
                type: "POST",
                url: "assets/php/delete_economics.php",
                data: {
                    id : id
                },
                success: function (response) {
                    $('#delete_outgoings_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                }
            });
    });
    
});


$(document).on("click", ".js-edit-outgoings", function () {

    var description = $(this).parent().parent().parent().find('span[class="economics_id"]').html();
    var description_id = $(this).parent().parent().parent().find('span[class="economics_id"]').attr("id");

    var amount_field = $(this).parent().parent().parent().find('td[data-field="amount"]');
    var amount = amount_field.children().html();
    amount = parseFloat(amount);

    var date_field = $(this).parent().parent().parent().find('td[data-field="date"]');
    var date = date_field.children().html();
    

    $("input[name='up_outgoings_description']").val(description);
    $("input[name='up_outgoings_description']").attr("id",description_id);
    $("input[name='up_outgoings_price']").val(amount);
    $("input[name='up_outgoings_date']").val(date);
});