Vtiger_Edit_Js("CallAssistance_Edit_Js", {}, {
    registerBasicEvents: function (container) {
		this._super(container);
		this.phoneCountryCode();
	},
    phoneCountryCode: function(){
		var input = document.querySelector("#CallAssistance_editView_fieldName_phone"),
		errorMsg = document.querySelector("#phone_error-msg"),
		validMsg = document.querySelector("#phone_valid-msg");
	$(document).ready(function () {
		$('#CallAssistance_editView_fieldName_phone').attr('type', 'tel');
	});
	let isVaildMobilenumber = false;
	// Error messages based on the code returned from getValidationError
	var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
	
	// Initialise plugin
	var intl = window.intlTelInput(input, {
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
		let num=intl.getNumber(intlTelInputUtils.numberFormat.E164);
		if (input.value.trim()) {
			if (intl.isValidNumber()) {
				isVaildMobilenumber = true;
				$('#HelpDesk_editView_fieldName_phone').val(num);
				validMsg.classList.remove("hide");
			} else {
				input.classList.add("error");
				var errorCode = intl.getValidationError();
				errorMsg.innerHTML = errorMap[errorCode];
				errorMsg.classList.remove("hide");
				isVaildMobilenumber = false;
			}
		}
	});
	
	},
});