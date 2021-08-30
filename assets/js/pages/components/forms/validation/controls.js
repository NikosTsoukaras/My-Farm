"use strict";
// Class definition

var KTFormControls = function () {
    // Private functions
    
    var demo1 = function () {
        $( "#kt_form_1" ).validate({
            // define validation rules
            rules: {
                email: {
                    required: true,
                    email: true 
                },
                url: {
                    required: true 
                },
                digits: {
                    required: true,
                    digits: true
                },
                creditcard: {
                    required: true,
                    creditcard: true 
                },
                phone: {
                    required: true,
                    phoneUS: true 
                },
                option: {
                    required: true
                },
                options: {
                    required: true,
                    minlength: 2,
                    maxlength: 4
                },
                memo: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },

                checkbox: {
                    required: true
                },
                checkboxes: {
                    required: true,
                    minlength: 1,
                    maxlength: 2
                },
                fullname: {
                    required: true
                },
                password : {
                    required: true,
                    minlength : 6
                },
                password_confirm : {
                    required: true,
                    minlength : 6,
                    equalTo : "#password"
                },
                radio: {
                    required: true
                }
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {
                var alert = $('#kt_form_1_msg');
                alert.parent().removeClass('kt-hidden');
                KTUtil.scrollTo("kt_form_1", -200);
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
            }
        });       
    }

    var demo2 = function () {
        $( "#kt_form_2" ).validate({
            // define validation rules
            rules: {
                //= Client Information(step 3)
                // Billing Information
                billing_card_name: {
                    required: true
                },
                billing_card_number: {
                    required: true,
                    creditcard: true
                },
                billing_card_exp_month: {
                    required: true
                },
                billing_card_exp_year: {
                    required: true
                },
                billing_card_cvv: {
                    required: true,
                    minlength: 2,
                    maxlength: 3
                },

                // Billing Address
                billing_address_1: {
                    required: true
                },
                billing_address_2: {
                    
                },
                billing_city: {
                    required: true
                },
                billing_state: {
                    required: true
                },
                billing_zip: {
                    required: true,
                    number: true
                },

                billing_delivery: {
                    required: true
                }
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {
                swal.fire({
                    "title": "", 
                    "text": "There are some errors in your submission. Please correct them.", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary kt-btn kt-btn--wide",
                    "onClose": function(e) {
                        console.log('on close event fired!');
                    }
                });

                event.preventDefault();
            },

            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                swal.fire({
                    "title": "", 
                    "text": "Form validation passed. All good!", 
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary"
                });

                return false;
            }
        });       
    }

    var signup = function () {
        $( "#signup_form" ).validate({
            // define validation rules
            rules: {
                email: {
                    required: true,
                    email: true 
                },
                digits: {
                    required: true,
                    digits: true
                },
                phone: {
                    required: true,
                    phoneUS: true 
                },
                checkbox: {
                    required: true
                },
                fullname: {
                    required: true
                },
                password : {
                    required: true,
                    minlength : 6
                },
                password_confirm : {
                    required: true,
                    minlength : 6,
                    equalTo : "#password"
                }
            },
            

            submitHandler: function (form) {
                var user_email = $( "input[name='email']" ).val();
                var user_name = $( "input[name='fullname']" ).val();
                var user_pwd = $( "input[name='password']" ).val();
                
                $.ajax({
                    type: "POST",
                    url: "assets/php/signup.php",
                    data: {
                        user_email : user_email,
                        user_name : user_name,
                        user_pwd : user_pwd
                    },
                     success: function (response) {
                         $('#status').html(response);
                    }
                });

                return false;
            }
        });       
    }
  
   // Insert Animal

    var insert_animal = function () {
        $( "#insert_animal_form" ).validate({
            // define validation rules
            rules: {
                animal_id: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                sex: {
                    required: true
                },
                type: {
                    required: true
                },
                species: {
                    required: true
                },
                age_group: {
                    required: true
                },
                vaccination: {
                    required: true
                },
                birth_date : {
                    required: false
                }

            }, 
            
            
            submitHandler: function (form) {
                var animal_un_number = $( "input[name='animal_id']" ).val();
                var animal_sex = $( "select[name='sex']" ).val();
                var animal_type = $( "select[name='type']" ).val();
                var animal_species = $( "select[name='species']" ).val();
                var animal_age_group = $( "select[name='age_group']" ).val();
                var animal_birth_date = $( "input[name='birth_date']" ).val();
                var animal_vaccination = $( "select[name='vaccination']" ).val();

                
                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_animals.php",
                    data: {
                        animal_un_number : animal_un_number,
                        animal_sex : animal_sex,
                        animal_type : animal_type,
                        animal_species : animal_species,
                        animal_age_group : animal_age_group,
                        animal_birth_date : animal_birth_date,
                        animal_vaccination: animal_vaccination
                    },
                     success: function (response) {
                        $('#status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    // Update Animal
    var update_animal = function () {
        $( "#edit_animal_form" ).validate({
            // define validation rules
            rules: {
                up_animal_id: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                up_birth_date: {
                    required: true
                }
            }, 
            
            
            submitHandler: function (form) {
                var old_animal_un_number = $( "input[name='up_animal_id']" ).attr("id"); 
                var animal_un_number = $( "input[name='up_animal_id']" ).val();
                var animal_sex = $( "select[name='up_sex']" ).val();
                var animal_type = $( "select[name='up_type']" ).val();
                var animal_species = $( "select[name='up_species']" ).val();
                var animal_age_group = $( "select[name='up_group_ages']" ).val();
                var animal_birth_date = $( "input[name='up_birth_date']" ).val();
                var animal_vaccination = $( "select[name='up_vaccination']" ).val();

                $.ajax({
                    type: "POST",
                    url: "assets/php/edit_animals_submit.php",
                    data: {
                        old_animal_un_number, old_animal_un_number,
                        animal_un_number : animal_un_number,
                        animal_sex : animal_sex,
                        animal_type : animal_type,
                        animal_species : animal_species,
                        animal_age_group : animal_age_group,
                        animal_birth_date : animal_birth_date,
                        animal_vaccination: animal_vaccination
                    },
                     success: function (response) {
                        $('#update_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    	KTDatatableJsonRemoteDemo.init();
                			
                    }
                });

                return false;
            }
        });       
    }

    var milk_production = function () {
        $( "#milk_production" ).validate({
            // define validation rules
            rules: {
                milk_day_production: {
                    required: true,
                },
                type: {
                    required: true,
                },
                total_milk_production: {
                    required: true
                },
                cellular: {
                    required: true
                },
                protein: {
                    required: true
                },
                fat: {
                    required: true
                },
                price: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var milk_day_production = $( "input[name='milk_day_production']" ).val();
                var milk_type = $( "select[name='type']" ).val();
                var total_milk_production = $( "input[name='total_milk_production']" ).val();
                var milk_cellulars = $( "select[name='cellular']" ).val();
                var milk_protein = $( "input[name='protein']" ).val();
                var milk_fat = $( "input[name='fat']" ).val();
                var milk_price = $( "input[name='price']" ).val();
                var milk_sum = milk_price * total_milk_production;
                
                

                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_milk_production.php",
                    data: {
                        milk_day_production : milk_day_production,
                        milk_type : milk_type,
                        total_milk_production : total_milk_production,
                        milk_cellulars : milk_cellulars,
                        milk_protein : milk_protein,
                        milk_fat : milk_fat,
                        milk_price : milk_price,
                        milk_sum : milk_sum,
                    },
                    success: function (response) {
                        $('#status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var update_milk_production = function () {
        $( "#update_milk_production" ).validate({
            // define validation rules
            rules: {
                up_milk_day_production: {
                    required: true,
                },
                up_type: {
                    required: true,
                },
                up_total_milk_production: {
                    required: true
                },
                up_cellular: {
                    required: true
                },
                up_protein: {
                    required: true
                },
                up_fat: {
                    required: true
                },
                up_price: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {

                var id = $("select[name='up_type']").attr("id");
                var milk_day_production = $( "input[name='up_milk_day_production']" ).val();
                var milk_type = $( "select[name='up_type']" ).val();
                var total_milk_production = $( "input[name='up_total_milk_production']" ).val();
                var milk_cellulars = $( "select[name='up_cellular']" ).val();
                var milk_protein = $( "input[name='up_protein']" ).val();
                var milk_fat = $( "input[name='up_fat']" ).val();
                var milk_price = $( "input[name='up_price']" ).val();
                var money = $("input[name='up_price']").attr("id");
                var milk_sum = milk_price * total_milk_production;
                
                console.log(money);

                $.ajax({
                    type: "POST",
                    url: "assets/php/edit_milk_production.php",
                    data: {
                        id: id,
                        milk_day_production : milk_day_production,
                        milk_type : milk_type,
                        total_milk_production : total_milk_production,
                        milk_cellulars : milk_cellulars,
                        milk_protein : milk_protein,
                        milk_fat : milk_fat,
                        milk_price : milk_price,
                        milk_sum : milk_sum,
                        money : money,
                    },
                    success: function (response) {
                        $('#milk_update_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var meat_production = function () {
        $( "#meat_production" ).validate({
            // define validation rules
            rules: {
                animal_id: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                total_weight: {
                    required: true,
                },
                net_weight: {
                    required: true
                },
                price_kilo: {
                    required: true
                },
                inspection: {
                    required: true
                },
                slaughterhouse: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var animal_id = $( "input[name='animal_id']" ).val();
                var total_weight = $( "input[name='total_weight']" ).val();
                var net_weight = $( "input[name='net_weight']" ).val();
                var price_kilo = $( "input[name='price_kilo']" ).val();
                var inspection = $( "select[name='inspection']" ).val();
                var slaughterhouse = $( "input[name='slaughterhouse']" ).val();
                var total_price = net_weight * price_kilo;
                
                

                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_meat_production.php",
                    data: {
                        animal_id : animal_id,
                        total_weight : total_weight,
                        net_weight : net_weight,
                        price_kilo : price_kilo,
                        inspection : inspection,
                        slaughterhouse : slaughterhouse,
                        total_price : total_price
                    },
                    success: function (response) {
                        $('#status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var update_meat_production = function () {
        $( "#update_meat_form" ).validate({
            // define validation rules
            rules: {
                up_total_weight: {
                    required: true,
                },
                up_net_weight: {
                    required: true
                },
                up_price_kilo: {
                    required: true
                },
                up_inspection: {
                    required: true
                },
                up_slaughterhouse: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var animal_id = $("select[name='up_inspection']").attr("id");
                var total_weight = $( "input[name='up_total_weight']" ).val();
                var net_weight = $( "input[name='up_net_weight']" ).val();
                var price_kilo = $( "input[name='up_price_kilo']" ).val();
                var inspection = $( "select[name='up_inspection']" ).val();
                var slaughterhouse = $( "input[name='up_slaughterhouse']" ).val();
                var total_price = net_weight * price_kilo;
                var money = $("input[name='up_price_kilo']").attr("id");

                
                $.ajax({
                    type: "POST",
                    url: "assets/php/edit_meat_production.php",
                    data: {
                        animal_id : animal_id,
                        total_weight : total_weight,
                        net_weight : net_weight,
                        price_kilo : price_kilo,
                        inspection : inspection,
                        slaughterhouse : slaughterhouse,
                        total_price : total_price,
                        money : money
                    },
                    success: function (response) {
                        $('#update_meat_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var reproduction = function () {
        $( "#reproduction_form" ).validate({
            // define validation rules
            rules: {
                animal_id: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                birth_day: {
                    required: true
                },
                infants_number: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var animal_id = $( "input[name='animal_id']" ).val();
                var birth_day = $( "input[name='birth_day']" ).val();
                var infants_number = $( "input[name='infants_number']" ).val();
                
                console.log(animal_id + " " + birth_day + " " + infants_number);

                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_reproduction.php",
                    data: {
                        animal_id : animal_id,
                        birth_day : birth_day,
                        infants_number : infants_number
                    },
                    success: function (response) {
                        $('#status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                        $('#insert_animals_notification').removeClass('display-none');
                    }
                });

                return false;
            }
        });       
    }

    var income = function () {
        $( "#insert_income_form" ).validate({
            // define validation rules
            rules: {
                income: {
                    required: true,
                },
                income_description: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var income = $( "input[name='income']" ).val();
                var income_description = $( "input[name='income_description']" ).val();
                
                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_economics.php",
                    data: {
                        income : income,
                        income_description : income_description
                    },
                    success: function (response) {
                        $('#in_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var update_income = function () {
        $( "#update_income" ).validate({
            // define validation rules
            rules: {
                up_incomes_description: {
                    required: true,
                },
                up_incomes_price: {
                    required: true
                },
                up_incomes_date: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var type = 'income';
                var description = $( "input[name='up_incomes_description']" ).val();
                var amount = $( "input[name='up_incomes_price']" ).val();
                var date = $( "input[name='up_incomes_date']" ).val();
                var id = $( "input[name='up_incomes_description']").attr("id");
                
                
                $.ajax({
                    type: "POST",
                    url: "assets/php/edit_economics.php",
                    data: {
                        type : type,
                        description : description,
                        amount : amount,
                        date : date,
                        id : id
                    },
                    success: function (response) {
                        $('#update_income_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var outgoings = function () {
        $( "#insert_outgoings_form" ).validate({
            // define validation rules
            rules: {
                outgoings: {
                    required: true,
                },
                outgoings_description: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var outgoings = $( "input[name='outgoings']" ).val();
                var outgoings_description = $( "input[name='outgoings_description']" ).val();
               

                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_economics.php",
                    data: {
                        outgoings : outgoings,
                        outgoings_description : outgoings_description
                    },
                    success: function (response) {
                        $('#out_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var update_outgoings = function () {
        $( "#update_outgoings_form" ).validate({
            // define validation rules
            rules: {
                up_outgoings_description: {
                    required: true,
                },
                up_outgoings_price: {
                    required: true
                },
                up_outgoings_date: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {
                
                var type = 'outgoings';
                var description = $( "input[name='up_outgoings_description']" ).val();
                var amount = $( "input[name='up_outgoings_price']" ).val();
                var date = $( "input[name='up_outgoings_date']" ).val();
                var id = $( "input[name='up_outgoings_description']").attr("id");
                
               
                $.ajax({
                    type: "POST",
                    url: "assets/php/edit_economics.php",
                    data: {
                        type : type,
                        description : description,
                        amount : amount,
                        date : date,
                        id : id
                    },
                    success: function (response) {
                        $('#update_outgoings_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var medicals = function () {
        $( "#insert_inspection_form" ).validate({
            // define validation rules
            rules: {
                title: {
                    required: true,
                },
                type: {
                    required: true
                },
                species: {
                    required: true
                },
                date: {
                    required: true
                },
                notes: {
                    required: true
                },
                vet_contact: {
                    required: true
                },
                assessment: {
                    required: true
                },
                radio: {
                    required: true
                },
                animal_id: {
                    required: true
                },
                animals_number: {
                    required: true
                },
                vet_notes: {
                    required: true
                },
                age_group: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {

                var title = $( "input[name='title']" ).val();
                var type = $( "select[name='type']" ).val();
                var species = $( "select[name='species']" ).val();
                var date = $( "input[name='date']" ).val();
                var notes = $( "textarea[name='notes']" ).val();
                var vet_contact = $( "select[name='vet_contact']" ).val();
                var assessment = $( "select[name='assessment']" ).val();
                var radio = $( "input[name='radio']:checked" ).val();
                var animal_id = $( "input[name='animal_id']" ).val();
                var animals_number = $( "input[name='animals_number']" ).val();
                var vet_notes = $( "textarea[name='vet_notes']" ).val();
                var age_group = $( "input[name='age_group']" ).val();


                if (typeof  animal_id === "undefined") {
                    animal_id ="-";
                }
                
                if (typeof  animals_number === "undefined") {
                    animals_number ="-";
                }
            
                if (typeof  vet_notes === "undefined") {
                    vet_notes ="-";
                }

                if (typeof  age_group === "undefined") {
                    age_group ="-";
                }
               
               
                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_medical.php",
                    data: {
                        title : title,
                        type : type,
                        species : species,
                        date : date,
                        notes : notes,
                        vet_contact : vet_contact,
                        assessment : assessment,
                        radio : radio,
                        animal_id : animal_id,
                        animals_number : animals_number,
                        vet_notes : vet_notes,
                        age_group : age_group
                    },
                    success: function (response) {
                        $('#first_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var medicals = function () {
        $( "#insert_inspection_form" ).validate({
            // define validation rules
            rules: {
                title: {
                    required: true,
                },
                type: {
                    required: true
                },
                species: {
                    required: true
                },
                date: {
                    required: true
                },
                notes: {
                    required: true
                },
                vet_contact: {
                    required: true
                },
                assessment: {
                    required: true
                },
                radio: {
                    required: true
                },
                animal_id: {
                    required: true
                },
                animals_number: {
                    required: true
                },
                vet_notes: {
                    required: true
                },
                age_group: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {

                var title = $( "input[name='title']" ).val();
                var type = $( "select[name='type']" ).val();
                var species = $( "select[name='species']" ).val();
                var date = $( "input[name='date']" ).val();
                var notes = $( "textarea[name='notes']" ).val();
                var vet_contact = $( "select[name='vet_contact']" ).val();
                var assessment = $( "select[name='assessment']" ).val();
                var radio = $( "input[name='radio']:checked" ).val();
                var animal_id = $( "input[name='animal_id']" ).val();
                var animals_number = $( "input[name='animals_number']" ).val();
                var vet_notes = $( "textarea[name='vet_notes']" ).val();
                var age_group = $( "input[name='age_group']" ).val();


                if (typeof  animal_id === "undefined") {
                    animal_id ="-";
                }
                
                if (typeof  animals_number === "undefined") {
                    animals_number ="-";
                }
            
                if (typeof  vet_notes === "undefined") {
                    vet_notes ="-";
                }

                if (typeof  age_group === "undefined") {
                    age_group ="-";
                }
               
               
                $.ajax({
                    type: "POST",
                    url: "assets/php/insert_medical.php",
                    data: {
                        title : title,
                        type : type,
                        species : species,
                        date : date,
                        notes : notes,
                        vet_contact : vet_contact,
                        assessment : assessment,
                        radio : radio,
                        animal_id : animal_id,
                        animals_number : animals_number,
                        vet_notes : vet_notes,
                        age_group : age_group
                    },
                    success: function (response) {
                        $('#first_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    var update_medicals = function () {
        $( "#update_form" ).validate({
            // define validation rules
            rules: {
                select_inspection: {
                    required: true,
                },
                update_date: {
                    required: true
                },
                update_date: {
                    required: true
                },
                update_notes: {
                    required: true
                },
                update_vet_contact: {
                    required: true
                },
                update_assessment: {
                    required: true
                },
                update_vet_notes: {
                    required: true
                }
            }, 
            

            submitHandler: function (form) {

                
                var select_inspection = $( "select[name='select_inspection']" ).val();
                var update_date = $( "input[name='update_date']" ).val();
                var update_notes = $( "textarea[name='update_notes']" ).val();
                var update_vet_contact = $( "select[name='update_vet_contact']" ).val();
                var update_vet_notes = $( "textarea[name='update_vet_notes']" ).val();
                var update_assessment = $( "select[name='update_assessment']" ).val();
      


                if (typeof  update_vet_notes === "undefined") {
                    update_vet_notes ="-";
                }
                
                
                
                $.ajax({
                    type: "POST",
                    url: "assets/php/update_medical.php",
                    data: {
                        select_inspection : select_inspection,
                        update_date : update_date,
                        update_notes : update_notes,
                        update_vet_contact : update_vet_contact,
                        update_vet_notes : update_vet_notes,
                        update_assessment : update_assessment
                    },
                    success: function (response) {
                        $('#update_medical_status').html(response).fadeIn(300).delay(5000).fadeOut(300);
                    }
                });

                return false;
            }
        });       
    }

    return {
        // public functions
        init: function() {
            demo1(); 
            demo2(); 
            signup();
            insert_animal();
            update_animal();
            milk_production();
            update_milk_production();
            meat_production();
            update_meat_production();
            reproduction();
            income();
            update_income();
            outgoings();
            update_outgoings();
            medicals();
            update_medicals();
        }
    };
}();

jQuery(document).ready(function() {    
    KTFormControls.init();
});