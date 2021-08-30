"use strict";
// Class Definition
var KTLoginPage = (function () {
  var showErrorMsg = function (form, type, msg) {
    var alert = $(
      '<div class="alert alert-bold alert-solid-' +
        type +
        ' alert-dismissible" role="alert">\
			<div class="alert-text">' +
        msg +
        '</div>\
			<div class="alert-close">\
                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
            </div>\
		</div>'
    );
    form.find(".alert").remove();
    alert.prependTo(form);
    KTUtil.animateClass(alert[0], "fadeIn animated");
  };
  // Private Functions
  // var handleLoginFormSubmit = function () {
  // 	$('#kt_login_submit').click(function (e) {
  // 		e.preventDefault();
  // 		var btn = $(this);
  // 		var form = $('#kt_login_form');
  // 		form.validate({
  // 			rules: {
  // 				email: {
  // 					email: true ,
  // 					required: true
  // 				},
  // 				password: {
  // 					required: true
  // 				}
  // 			}
  // 		});
  // 		if (!form.valid()) {
  // 			return;
  // 		}
  // 		KTApp.progress(btn[0]);
  // 		setTimeout(function () {
  // 			KTApp.unprogress(btn[0]);
  // 		}, 2000);
  // 		// ajax form submit:  http://jquery.malsup.com/form/

  // 		form.ajaxSubmit({
  // 			url: '',
  // 			success: function (response, status, xhr, $form) {
  // 				// similate 2s delay
  // 				setTimeout(function () {
  // 					KTApp.unprogress(btn[0]);
  // 					showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
  // 				}, 2000);
  // 			}
  // 		});
  // 	});
  // }
  var handleLoginFormSubmit = function () {
    $("#kt_login_form").validate({
      // define validation rules
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 6,
        },
      },

      submitHandler: function (form) {
        var user_email = $("input[name='email']").val();
        var user_pwd = $("input[name='password']").val();

        $.ajax({
          type: "POST",
          url: "assets/php/login.php",
          data: {
            user_email: user_email,
            user_pwd: user_pwd,
          },
          success: function (response) {
            if (response === "1") {
              window.location.href = "./main-page.php";
            } else {
              $("#status").html(response);
            }
          },
        });

        // return false;
      },
    });
  };

  // Public Functions
  return {
    // public functions
    init: function () {
      handleLoginFormSubmit();
    },
  };
})();
// Class Initialization
jQuery(document).ready(function () {
  KTLoginPage.init();
});
