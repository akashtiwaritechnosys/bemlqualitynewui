Vtiger_Edit_Js("HelpDesk_Edit_Js", {}, {
	allFieldsRaw: [],
	fieldDependency: [],
	picklistDependency: [],
	registerBasicEvents: function (container) {
		this._super(container);
		this.registerPicklistFieldChangeEvent();
		this.fetchAllFields();
		this.phoneCountryCode();
		this.registerReferenceSelectionEvent();
		this.registerClearReferenceSelectionEvent(container);
	},
	registerReferenceSelectionEvent: function (container) {
        var self = this;
        jQuery('input[name="equipment_id"]', container).on(Vtiger_Edit_Js.referenceSelectionEvent, function (e, data) {
			self.setFirstContactOfAccount();
        });
    },
    setFirstContactOfAccount: function () {
        var self = this;
        let dataOf = {};
        dataOf['record'] = $("input[name=equipment_id]").val();
        dataOf['source_module'] = 'Equipment';
        dataOf['module'] = 'HelpDesk';
        dataOf['action'] = 'GetAllInfo';
        app.helper.showProgress();
        app.request.get({data: dataOf}).then(function (err, response) {
            if (err == null) {
				let referenceFields = {'account_id' : 'parent_id', 'functional_loc':'func_loc_id'};
				for (var key in referenceFields) {
					let value = referenceFields[key];
					self.seletctTheMarkVendor(response['data'][key],response['data'][key+'_label'],value );
			   	}
            }
            app.helper.hideProgress();
        });
    },
    seletctTheMarkVendor: function (id, label, field) {
        let selectedNameOfAsset = label;
        let sourceField = field;
        var fieldElement = jQuery("#"+ app.getModuleName() +"_editView_fieldName_"+ field +"_select");
        var sourceFieldDisplay = field + "_display";
        var fieldDisplayElement = jQuery('input[name="' + sourceFieldDisplay + '"]');
        var popupReferenceModuleElement = jQuery('input[name="popupReferenceModule"]').length ? jQuery('input[name="popupReferenceModule"]') : jQuery('input.popupReferenceModule');
        var popupReferenceModule = popupReferenceModuleElement.val();
        var selectedName = selectedNameOfAsset;
        jQuery('input[name="' + sourceField + '"]').val(id);
        if (id && selectedName) {
            if (!fieldDisplayElement.length) {
                fieldElement.attr('value', id);
                fieldElement.data('value', id);
                fieldElement.val(selectedName);
            } else {
                fieldElement.val(id);
                fieldElement.data('value', id);
                fieldDisplayElement.val(selectedName);
                if (selectedName) {
                    fieldDisplayElement.attr('readonly', 'readonly');
                } else {
                    fieldDisplayElement.removeAttr("readonly");
                }
            }
            if (selectedName) {
                fieldElement.parent().parent().find('#'+sourceFieldDisplay).attr('disabled','disabled');
                fieldElement.parent().parent().find('.clearReferenceSelection').removeClass('hide');
                fieldElement.parent().parent().find('.referencefield-wrapper').addClass('selected');
            } else {
                fieldElement.parent().parent().find('.clearReferenceSelection').addClass('hide');
                fieldElement.parent().parent().find('.referencefield-wrapper').removeClass('selected');
            }
            fieldElement.trigger(Vtiger_Edit_Js.referenceSelectionEvent, {'source_module': popupReferenceModule, 'record': id, 'selectedName': selectedName});
        }
    },
	getParentElement : function(element) {
		var parent = element.closest('.parentTRDiv');
		return parent;
	},
	registerPicklistFieldChangeEvent: function () {
		let self = this;
		jQuery('.picklistfield').on('change', function (event) {
			let value = event.target.value;
			let name = event.target.name;
			if(value==""){
                 self.handledependencyOne(name,value);
			}else{
		         self.handledependency(name,value);
			}
		})
		jQuery('#HelpDesk_editView_fieldName_pincode').on('input', function (event) {
			let value = event.target.value;
			if(value.length > 5){
				app.helper.showProgress();
				self.getPincodeDetails(value).then(
					function (data) {
						let pincodeData = data.result.data;
						if (pincodeData && pincodeData.State != null && pincodeData.Block != null) {
							jQuery('input[name="city"]').val(pincodeData.Block);
							jQuery('input[name="state"]').val(pincodeData.State);
						}
						app.helper.hideProgress();
					},
					function (error, err) {
						app.helper.hideProgress();
					}
				);
			}
		})
		jQuery('#HelpDesk_editView_fieldName_chg_func_loc').on('change', function (event) {
			self.handleSecondLevelDependency(event.target.name,event.target.value);
		})
	},
	registerClearReferenceSelectionEvent : function(container) {
		container.find('.clearReferenceSelection').on('click', function(e){
			var element = jQuery(e.currentTarget);
			var parentTdElement = element.closest('.parentTRDiv');
			var fieldNameElement = parentTdElement.find('.sourceField');
			var fieldName = fieldNameElement.attr('name');
			fieldNameElement.val('');
			parentTdElement.find('#'+fieldName+'_display').removeAttr('readonly').val('');
			element.trigger(Vtiger_Edit_Js.referenceDeSelectionEvent);
			e.preventDefault();
		})
	},
	handleSecondLevelDependency : function(targetName, targetvalue){
		// let DependentFields = this.getSencondlevelDependentFields();
		let dependentFields = this.getDependentField(targetName);
		if(dependentFields){
			let allFieldsRawLength = dependentFields.length;
			let jquerVal = $("#HelpDesk_editView_fieldName_"+targetName).attr("checked") ? 1 : 0;
			if(jquerVal == 1){
				targetvalue = true;
			} else {
				targetvalue = false;
			}
			for(let i = 0; i < allFieldsRawLength; i++ ){
				if(targetvalue == dependentFields[i]['dependentOnOption']){
					$("#"+ dependentFields[i]['name']+'hideOrShowId').removeClass("hide");
					$("#"+ dependentFields[i]['name']+'hideOrShowInputId').removeClass("hide");
				} else {
					$("#"+ dependentFields[i]['name']+'hideOrShowId').addClass("hide");
					$("#"+ dependentFields[i]['name']+'hideOrShowInputId').addClass("hide");
				}
			}
		}
	},
	getSencondlevelDependentFields : function(){
		let allFieldsRawLength = Object.keys($scope.allFieldsRaw).length;
		for(let i = 0; i < allFieldsRawLength; i++ ){
			if($scope.allFieldsRaw[i]['dependentOnField'] == $fieldName ){
				return $scope.allFieldsRaw[i];
			}
		}
	},
	registerImageChangeEvent : function() {
	},
	getPincodeDetails: function (pincode) {
		var aDeferred = jQuery.Deferred();
		var url = "module=Vtiger&action=GetPincodeInfo&pincode="+pincode;
		AppConnector.request(url).then(
			function (data) {
				if (data['success']) {
					aDeferred.resolve(data);
				} else {
					aDeferred.reject(data['message']);
				}
			},
			function (error) {
				aDeferred.reject();
			}
		)
		return aDeferred.promise();
	},
    phoneCountryCode: function(){
		var input = document.querySelector("#HelpDesk_editView_fieldName_phone"),
		errorMsg = document.querySelector("#phone_error-msg"),
		validMsg = document.querySelector("#phone_valid-msg");
	$(document).ready(function () {
		$('#HelpDesk_editView_fieldName_phone').attr('type', 'tel');
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
	fetchAllFields: function () {
		app.helper.showProgress();
		let self = this;
		this.callAPI().then(
			function (data) {
				self.allFieldsRaw = data.result.fields;
				self.fieldDependency = data.result.FieldDependency;
				self.picklistDependency = data.result.picklistDependency;
				let selectedValue = $('[name="ticket_type"]').find('option:selected').val();
				if(selectedValue != '' && selectedValue != null){
					self.handledependency('ticket_type',selectedValue);
				}
				if(selectedValue == 'GENERAL INSPECTION'){
					self.handledependency('purpose',$('[name="purpose"]').find('option:selected').val());
				}
				app.helper.hideProgress();
			},
			function (error, err) {
				app.helper.hideProgress();
			}
		);
	},
	callAPI: function () {
		var aDeferred = jQuery.Deferred();
		var url = "module=HelpDesk&action=DescribeModuleForSR";
		AppConnector.request(url).then(
			function (data) {
				if (data['success']) {
					aDeferred.resolve(data);
				} else {
					aDeferred.reject(data['message']);
				}
			},
			function (error) {
				aDeferred.reject();
			}
		)
		return aDeferred.promise();
	},
	myFunc : function ($a, $b,$value) {
		let fieldName = 'equipment_id';
		let dependentField = this.getDependentField(fieldName);
		if(dependentField){
			if($value == dependentField['dependentOnOption']){
				$("#"+ dependentField['name']).removeClass("hide");
			} else {
				$("#"+ dependentField['name']).addClass("hide");
			}
		}
	},
	handledependency : function (e, value){
		let fieldName = e;
		let dependentField = this.getDependentField(fieldName);
		if(dependentField){
			if(value == dependentField['dependentOnOption']){
				$("#"+ dependentField['name']+'hideOrShowId').removeClass("hide");
				$("#"+ dependentField['name']+'hideOrShowInputId').removeClass("hide");
			} else {
				$("#"+ dependentField['name']+'hideOrShowId').addClass("hide");
				$("#"+ dependentField['name']+'hideOrShowInputId').addClass("hide");
			}
		}
		if(fieldName == 'ticket_type' || fieldName == 'purpose'){
			let dependentFields = this.getDependentFieldsOfType(fieldName,value);
			let allFieldsRawLength = Object.keys(this.allFieldsRaw).length;
			for(let i = 0; i < allFieldsRawLength; i++ ){
				if(dependentFields && dependentFields.indexOf(this.allFieldsRaw[i]['name']) == -1 || (this.allFieldsRaw[i]['dependentField'] == true && ($.inArray(value,this.allFieldsRaw[i]['dependentOnMasterValue']) != -1) && this.allFieldsRaw[i]['name']!= 'purpose')){
					$("#"+this.allFieldsRaw[i]['name']+'hideOrShowId').addClass("hide");
					$("#"+this.allFieldsRaw[i]['name']+'hideOrShowInputId').addClass("hide");
				} else {
					$("#"+this.allFieldsRaw[i]['name']+'hideOrShowId').removeClass("hide");
					$("#"+this.allFieldsRaw[i]['name']+'hideOrShowInputId').removeClass("hide");
				}
				// if(this.allFieldsRaw[i]['name'] == 'pre_address'){
				// 	console.log($.inArray(value,this.allFieldsRaw[i]['dependentOnMasterValue']) == -1);
				// }
			}
		}
	},
	handledependencyOne : function (e, value){
	
			let allFieldsRawLength = Object.keys(this.allFieldsRaw).length;
			for(let i = 0; i < allFieldsRawLength; i++ ){
				$("#"+this.allFieldsRaw[i]['name']+'hideOrShowId').addClass("hide");
				$("#"+this.allFieldsRaw[i]['name']+'hideOrShowInputId').addClass("hide");
			}
			$("#ticket_typehideOrShowId").removeClass("hide");
			$("#ticket_typehideOrShowInputId").removeClass("hide");
			
	},
	getDependentFieldsOfType : function($fieldName, $value) {
		let allFieldsRawLength =this.fieldDependency[$fieldName]['valuemapping'].length;
		let picklistDependencySourceValArr =this.fieldDependency[$fieldName]['valuemapping'];
		for(let i = 0; i < allFieldsRawLength; i++ ){
			if(picklistDependencySourceValArr[i]['sourcevalue'] == $value ){
				return picklistDependencySourceValArr[i]['targetvalues'];
			}
		}
	},
	getDependentOptions : function($fieldName, $value) {
		let allFieldsRawLength =this.picklistDependency[$fieldName]['valuemapping'].length;
		let dependentSourceValArr =this.picklistDependency[$fieldName]['valuemapping'];
		for(let i = 0; i < allFieldsRawLength; i++ ){
			if(dependentSourceValArr[i]['sourcevalue'] == $value ){
				return dependentSourceValArr[i]['targetvalues'];
			}
		}
	},
	getDependentField : function(fieldName) {
		let allFieldsRawLength = this.allFieldsRaw.length;
		let DependentFields = [];
		for(let i = 0; i < allFieldsRawLength; i++ ){
			if(this.allFieldsRaw[i]['dependentOnField'] == fieldName ){
				DependentFields.push(this.allFieldsRaw[i]);
			}
		}
		return DependentFields;
	}
});