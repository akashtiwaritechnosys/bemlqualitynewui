Inventory_Edit_Js("ServiceReports_Edit_Js", {}, {
	registerBasicEvents: function (container) {
		this._super(container);
		this.phoneCountryCode();
		this.aggregate_warranty_applicalple();
		this.handleOtherDependecy();
	},
	handleOtherDependecy: function () {
		let initDependentFields = Array('fd_sub_div','vendor_id','restoration_date',
		'off_on_account_of','restoration_time','remarks_for_offroad','GENERAL_CHECKS');
			initDependentFields.forEach(element => {
				$("#"+ element +'hideOrShowId').addClass("hide");
				$("#"+ element +'hideOrShowInputId').addClass("hide");
			});
		jQuery('.fail_de_part_pertains_to').on('change', function (event) {
			let value = event.target.value;
			// Initial Hiding
			// let name = event.target.name;
			let dependentValues = Array('Responsible Agency_._BEML - Bangalore','Responsible Agency_._BEML- Mysore',
			'Responsible Agency_._BEML - KGF');
			let dependentFieldName = 'fd_sub_div'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldName +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldName +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').addClass("hide");
			}
			let dependentValuesAnother = Array('Responsible Agency_._Vendor - MRF');
			let dependentFieldNameAnother = 'vendor_id'; 
			if(dependentValuesAnother.includes(value)){
				$("#"+ dependentFieldNameAnother +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldNameAnother +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').addClass("hide");
			}
		})
		jQuery('.eq_sta_aft_act_taken').on('change', function (event) {
			let value = event.target.value;
			// Initial Hiding
			// let name = event.target.name;
			let dependentValues = Array('On Road','Running with Problem','operational','in limited operation');
			let dependentFieldName = 'restoration_date'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldName +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldName +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').addClass("hide");
			}
			let dependentFieldNameAnother = 'restoration_time'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldNameAnother +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldNameAnother +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').addClass("hide");
			}
			dependentFieldNameAnother = 'GENERAL_CHECKS'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldNameAnother +'hideOrShowId').removeClass("hide");
			} else {
				$("#"+ dependentFieldNameAnother +'hideOrShowId').addClass("hide");
			}

			dependentValues = Array('Off Road','out of order');
			dependentFieldName = 'off_on_account_of'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldName +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldName +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldName +'hideOrShowInputId').addClass("hide");
			}
			dependentFieldNameAnother = 'remarks_for_offroad'; 
			if(dependentValues.includes(value)){
				$("#"+ dependentFieldNameAnother +'hideOrShowId').removeClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentFieldNameAnother +'hideOrShowId').addClass("hide");
				$("#"+ dependentFieldNameAnother +'hideOrShowInputId').addClass("hide");
			}
		})

	},
	phoneCountryCode: function () {
		var input = document.querySelector("#ServiceReports_editView_fieldName_phone"),
			errorMsg = document.querySelector("#phone_error-msg"),
			validMsg = document.querySelector("#phone_valid-msg");
		$(document).ready(function () {
			$('#ServiceReports_editView_fieldName_phone').attr('type', 'tel');
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
			let num = intl.getNumber(intlTelInputUtils.numberFormat.E164);
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
	aggregate_warranty_applicalple: function () {
		$('#ServiceReports_editView_fieldName_fd_ag_war_avl').click(function () {
			if (!$(this).is(':checked')) {
				$("select[name='fail_de_sap_noti_type']").prop('disabled', false);
				return;
			}
			let message = "You have marked Aggregate warranty applicable as YES, you can select only ZJ notification type, if you still want to select different notification type please mark Aggregate warranty applicable as 'NO'";
			let self = this;
			app.helper.showConfirmationBox({ 'message': message }).then(
				function (e) {
					$('.fail_de_sap_noti_type option[value="ZJ"]').attr("selected", "selected").trigger('change');
					$("select[name='fail_de_sap_noti_type']").prop('disabled', true);
				},
				function (error, err) {
					$(self).prop('checked', false);
				}
			);
		});
	},

});