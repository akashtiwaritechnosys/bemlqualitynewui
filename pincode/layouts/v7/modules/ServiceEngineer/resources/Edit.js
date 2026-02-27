Vtiger_Edit_Js("ServiceEngineer_Edit_Js", {}, {

    registerBasicEvents: function (container) {
        this._super(container);
        this.hide();
        this.phoneCountryCode();
    },
    hide: function () {
        $("#ServiceEngineer_editView_fieldName_rejection_reason").parent().parent().parent().parent().addClass("hide");
       
        $('select').on('change', function () {
            var name = this.value;
            if (name == "Rejected") {
                $("#ServiceEngineer_editView_fieldName_rejection_reason").parent().parent().parent().parent().removeClass("hide");
              
            }
            if (name == "Accepted") {
                $("#ServiceEngineer_editView_fieldName_rejection_reason").parent().parent().parent().parent().addClass("hide");
              
            }
            if (name == "Pending") {
                $("#ServiceEngineer_editView_fieldName_rejection_reason").parent().parent().parent().parent().addClass("hide");
               
            }
        })
    },
    phoneCountryCode: function(){
		var input = document.querySelector("#ServiceEngineer_editView_fieldName_phone"),
		errorMsg = document.querySelector("#phone_error-msg"),
		validMsg = document.querySelector("#phone_valid-msg");
	$(document).ready(function () {
		$('#ServiceEngineer_editView_fieldName_phone').attr('type', 'tel');
	});
	let isVaildMobilenumber = false;
	// Error messages based on the code returned from getValidationError
	var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
	
	// Initialise plugin
	window.igiti = window.intlTelInput(input, {
		autoPlaceholder: "off",
		initialCountry: "",
		preferredCountries: ['in'],
		hiddenInput: "phone",
		separateDialCode: true,
		utilsScript: "layouts/v7/modules/Users/build/js/utils.js",
	});
	var reset = function () {
		input.classList.remove("error");
		errorMsg.innerHTML = "";
		errorMsg.classList.add("hide");
		validMsg.classList.add("hide");
	};
	
	// Validate on blur event
	input.addEventListener('blur', function () {
		reset();
		let num=window.igiti.getNumber(intlTelInputUtils.numberFormat.E164);
		if (input.value.trim()) {
			if (window.igiti.isValidNumber()) {
				isVaildMobilenumber = true;
				$('#HelpDesk_editView_fieldName_phone').val(num);
				validMsg.classList.remove("hide");
			} else {
				input.classList.add("error");
				var errorCode = window.igiti.getValidationError();
				errorMsg.innerHTML = errorMap[errorCode];
				errorMsg.classList.remove("hide");
				isVaildMobilenumber = false;
			}
		}
	});
	
	},
});

