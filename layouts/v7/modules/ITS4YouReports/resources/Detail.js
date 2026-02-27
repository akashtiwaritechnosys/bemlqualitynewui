/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Detail_Js("ITS4YouReports_Detail_Js",{
},{
	advanceFilterInstance : false,
	detailViewContentHolder : false,
	HeaderContentsHolder : false,

	detailViewForm : false,

	getForm : function() {
		if(this.detailViewForm == false) {
			this.detailViewForm = jQuery('form#detailView');
		}
	},

	getRecordId : function(){
		return app.getRecordId();
	},

	getContentHolder : function() {
		if(this.detailViewContentHolder == false) {
			this.detailViewContentHolder = jQuery('div.editViewPageDiv');
		}
		return this.detailViewContentHolder;
	},

	getHeaderContentsHolder : function(){
		if(this.HeaderContentsHolder == false) {
			this.HeaderContentsHolder = jQuery('div.reportsDetailHeader ');
		}
		return this.HeaderContentsHolder;
	},

    calculateValues : function(){
        let return_filters = "";

        var escapedOptions = new Array('account_id', 'contactid', 'contact_id', 'product_id', 'parent_id', 'campaignid', 'potential_id', 'assigned_user_id1', 'quote_id', 'accountname', 'salesorder_id', 'vendor_id', 'time_start', 'time_end', 'lastname');

        var conditionColumns = vt_getElementsByName('div', "conditionColumn");
        var criteriaConditions = [];

        // ITS4YOU-CR SlOl 26. 3. 2014 13:26:01 SELECTBOX VALUES INTO FILTERS
        var sel_fields = JSON.parse(document.getElementById("sel_fields").value);
        for (var i = 0; i < conditionColumns.length; i++) {
            var columnRowId = conditionColumns[i].getAttribute("id");
            var columnRowInfo = columnRowId.split("_");
            var columnGroupId = columnRowInfo[1];
            var columnIndex = columnRowInfo[2];

            if (columnGroupId != "0")
                ctype = "f";
            else
                ctype = "g";

            var columnId = ctype + "col" + columnIndex;
            var columnObject = getObj(columnId);
            var selectedColumn = columnObject.value;
            var selectedColumnIndex = columnObject.selectedIndex;
            var selectedColumnLabel = columnObject.options[selectedColumnIndex].text;

            if (columnObject.options[selectedColumnIndex].value !== "none"
                && columnObject.options[selectedColumnIndex].value !== "") {
                var comparatorId = ctype + "op" + columnIndex;
                var comparatorObject = getObj(comparatorId);
                var comparatorValue = comparatorObject.value;

                var valueId = ctype + "val" + columnIndex;
                var valueObject = getObj(valueId);
                var specifiedValue = valueObject.value;

                var extValueId = ctype + "val_ext" + columnIndex;
                var extValueObject = getObj(extValueId);
                if (extValueObject) {
                    extendedValue = extValueObject.value;
                }

                var glueConditionId = ctype + "con" + columnIndex;
                var glueConditionObject = getObj(glueConditionId);
                var glueCondition = '';
                if (glueConditionObject) {
                    glueCondition = glueConditionObject.value;
                }

                if (conditionColumns.length > 0 && '' !== jQuery('.filterContainer select.select2-offscreen').first().val()) {
                    if (!emptyCheck4You(columnId, " Column ", "text")) {
                        return false;
                    }
                    if (!emptyCheck4You(comparatorId, selectedColumnLabel + " Option", "text")) {
                        return false;
                    }

                }

                var col = selectedColumn.split(":");

                var std_filter_columns = document.getElementById("std_filter_columns").value;
                if (typeof std_filter_columns != 'undefined' && std_filter_columns != "") {
                    var std_filter_columns_arr = std_filter_columns.split('<%jsstdjs%>');
                } else {
                    var std_filter_columns_arr = new Array();
                }

                var selected_value = html_entity_decode(selectedColumn,"UTF-8");
                if (std_filter_columns_arr.indexOf(selectedColumn) > -1
                    || -1 < selected_value.indexOf(':DT:')
                    || -1 < selected_value.indexOf(':DT')
                    || -1 < selected_value.indexOf(':D:')
                ) {
                    let dateErr = false;
                    if (comparatorValue === "custom" || comparatorValue === "a" || comparatorValue === "b") {
                        jQuery('#jscal_field_sdate' + columnIndex).val(jQuery('#jscal_field_sdate_val_' + columnIndex));
                        if (!emptyCheck4You("jscal_field_sdate_val_" + columnIndex, " Column ", "text")) {
                            dateErr = true;
                        }

                        if (comparatorValue !== "a" && comparatorValue !== "b") {
                            jQuery('#jscal_field_edate' + columnIndex).val(jQuery('#jscal_field_edate_val_' + columnIndex));
                            if (!emptyCheck4You("jscal_field_edate_val_" + columnIndex, " Column ", "text")) {
                                dateErr = true;
                            }
                            if (!r4youCompareDates('lt', jQuery('#jscal_field_sdate_val_' + columnIndex), jQuery('#jscal_field_edate_val_' + columnIndex))) {
                                dateErr = true;
                            }
                        }
                    }
                    if (dateErr) {
                        return false;
                    }
                    //var start_date = document.getElementById("jscal_field_sdate"+columnIndex).value;
                    //var end_date = document.getElementById("jscal_field_edate"+columnIndex).value;
                    if (comparatorValue.indexOf('Ndays') > -1
                        || comparatorValue.indexOf('daysago') > -1
                        || comparatorValue.indexOf('daysmore') > -1
                    ) {
                        var specifiedValue = jQuery("#nfval" + columnIndex).val();
                    } else {
                        if(comparatorValue=="custom" || comparatorValue=="a" || comparatorValue=="b"){
                            var start_date = this.getDbFormatedDateValue(jQuery('#jscal_field_sdate_val_'+columnIndex));
                            var end_date = this.getDbFormatedDateValue(jQuery('#jscal_field_edate_val_'+columnIndex));
                        }else{
                            if ('undefined' !== typeof jQuery('#jscal_field_sdate'+columnIndex).val()) {
                                var start_date = document.getElementById("jscal_field_sdate"+columnIndex).value;
                            }
                            if ('undefined' !== typeof jQuery('#jscal_field_edate'+columnIndex).val()) {
                                var end_date = document.getElementById("jscal_field_edate"+columnIndex).value;
                            }
                        }
						var specifiedValue = start_date + "<;@STDV@;>" + end_date;
                    }
                } else {
                    if (-1 === escapedOptions.indexOf(col[3])) {
                    	if('currency_id'===col[1] && 'I'===col[4]) {
							col[4] = 'V';
						}
                        if ('T' === col[4]) {
                            var datime = specifiedValue.split(" ");

                            if (!re_dateValidate(datime[0], selectedColumnLabel + " (Current User Date Time Format)", "OTH")) {
                                return false;
                            }

                            if (datime.length > 1) {
                                if (!re_patternValidate(datime[1], selectedColumnLabel + " (Time)", "TIMESECONDS")) {
                                    return false;
                                }
                            }
                        } else if ('D' === col[4]) {
                            if (!dateValidate(valueId, selectedColumnLabel + " (Current User Date Format)", "OTH")) {
                                return false;
                            }

                            if (extValueObject) {
                                if (!dateValidate(extValueId, selectedColumnLabel + " (Current User Date Format)", "OTH")) {
                                    return false;
                                }
                            }
                        } else if ('I' === col[4]) {
                            if ('isn' !== comparatorValue
                                && 'isnn' !== comparatorValue) {
                                if (!intValidate(valueId, selectedColumnLabel + " (Integer Criteria)" + i)) {
                                    return false;
                                }
                            }
                        } else if ('N' === col[4]) {
                            if ('isn' !== comparatorValue
                                && 'isnn' !== comparatorValue) {
                                if (!numValidate(valueId, selectedColumnLabel + " (Number) ", "any", true)) {
                                    return false;
                                }
                            }
                        } else if ('E' === col[4]) {
                            if (!patternValidate(valueId, selectedColumnLabel + " (Email Id)", "EMAIL")) {
                                return false;
                            }
                        }
                        // ITS4YOU-CR SlOl 28. 3. 2014 8:39:20
                        if (sel_fields[selectedColumn]) {
                            // fop0
                            // fval0_|_3
                            if ('e' === comparatorValue || 'n' === comparatorValue) {
                                let selectElement = jQuery('#s_fval' + columnIndex);
                                specifiedValue = selectElement.val();
                            } else {
                                let selectElement = jQuery('#fval' + columnIndex);
                                specifiedValue = selectElement.val();
                            }

                        }
                        // ITS4YOU-END 28. 3. 2014 8:39:13
                    }
                }
                //Added to handle yes or no for checkbox fields in reports advance filters.
                if (col[4] == "C") {
                    if (specifiedValue == "1")
                        specifiedValue = getObj(valueId).value = 'yes';
                    else if (specifiedValue == "0")
                        specifiedValue = getObj(valueId).value = 'no';
                }
                if (extValueObject && extendedValue != null && extendedValue != '')
                    specifiedValue = specifiedValue + ',' + extendedValue;

                var valuehdn = jQuery('#fvalhdn' + columnIndex).val();

                criteriaConditions[columnIndex] = {
                    "groupid": columnGroupId,
                    "columnname": selectedColumn,
                    "comparator": comparatorValue,
                    "value": specifiedValue,
                    "value_hdn": valuehdn,
                    "column_condition": glueCondition
                };
            }
        }

        var advft_criteria_value = JSON.stringify(criteriaConditions);
        for (var ri = 0; ri < criteriaConditions.length; ri++) {
            advft_criteria_value = advft_criteria_value.replace("&", "<@AMPKO@>");
        }
        return_filters += "advft_criteria=" + advft_criteria_value;

        var conditionGroups = vt_getElementsByName('div', "conditionGroup");
        var criteriaGroups = [];
        for (var i = 0; i < conditionGroups.length; i++) {
            var groupTableId = conditionGroups[i].getAttribute("id");
            var groupTableInfo = groupTableId.split("_");
            var groupIndex = groupTableInfo[1];

            var groupConditionId = "gpcon" + groupIndex;
            var groupConditionObject = getObj(groupConditionId);
            var groupCondition = '';
            if (groupConditionObject) {
                groupCondition = groupConditionObject.value;
            }
            criteriaGroups[groupIndex] = {"groupcondition": groupCondition};
        }
        return_filters += "&advft_criteria_groups=" + JSON.stringify(criteriaGroups);

        // groupconditioncolumn start
        var GroupconditionColumns = vt_getElementsByName('div', "groupconditionColumn");
        var GroupcriteriaConditions = [];
        // ITS4YOU-CR SlOl 26. 3. 2014 13:26:01 SELECTBOX VALUES INTO FILTERS
        for (var i = 0; i < GroupconditionColumns.length; i++) {

            var columnRowId = GroupconditionColumns[i].getAttribute("id");
            var columnRowInfo = columnRowId.split("_");
            var columnGroupId = columnRowInfo[1];
            var columnIndex = columnRowInfo[2];

            if (columnGroupId != "0")
                ctype = "f";
            else
                ctype = "g";

            var columnId = ctype + "groupcol" + columnIndex;
            var columnObject = getObj(columnId);
            var selectedColumn = columnObject.value;
            var selectedColumnIndex = columnObject.selectedIndex;
            var selectedColumnLabel = columnObject.options[selectedColumnIndex].text;
            if (columnObject.options[selectedColumnIndex].value != "none" && columnObject.options[selectedColumnIndex].value != "") {
                var comparatorId = ctype + "groupop" + columnIndex;
                var comparatorObject = getObj(comparatorId);
                var comparatorValue = comparatorObject.value;
                var valueId = ctype + "groupval" + columnIndex;
                var valueObject = getObj(valueId);
                var specifiedValue = valueObject.value;

                var glueConditionId = ctype + "groupcon" + columnIndex;
                var glueConditionObject = getObj(glueConditionId);
                var glueCondition = '';
                if (glueConditionObject) {
                    glueCondition = glueConditionObject.value;
                }
                if (GroupconditionColumns.length > 1) {
                    if (!emptyCheck4You(columnId, " Column ", "text")) {
                        // i < GroupconditionColumns.length
                        return false;
                    }
                    if (!emptyCheck4You(comparatorId, selectedColumnLabel + " Option", "text")) {
                        return false;
                    }
                }

                var col = selectedColumn.split(":");
                if (escapedOptions.indexOf(col[3]) == -1) {
                    if (col[4] == 'T') {
                        var datime = specifiedValue.split(" ");
                        if (!re_dateValidate(datime[0], selectedColumnLabel + " (Current User Date Time Format)", "OTH"))
                            return false
                        if (datime.length > 1)
                            if (!re_patternValidate(datime[1], selectedColumnLabel + " (Time)", "TIMESECONDS"))
                                return false
                    }
                    else if (col[4] == 'D') {
                        if (!dateValidate(valueId, selectedColumnLabel + " (Current User Date Format)", "OTH"))
                            return false
                        if (extValueObject) {
                            if (!dateValidate(extValueId, selectedColumnLabel + " (Current User Date Format)", "OTH"))
                                return false
                        }
                    } else if (col[4] == 'I') {
                        if (!intValidate(valueId, selectedColumnLabel + " (Integer Criteria)" + i))
                            return false
                    } else if (col[4] == 'N') {
                        if (!numValidate(valueId, selectedColumnLabel + " (Number) ", "any", true))
                            return false
                    } else if (col[4] == 'E') {
                        if (!patternValidate(valueId, selectedColumnLabel + " (Email Id)", "EMAIL"))
                            return false
                    }
                }
                //Added to handle yes or no for checkbox fields in reports advance filters.
                if (col[4] == "C") {
                    if (specifiedValue == "1")
                        specifiedValue = getObj(valueId).value = 'yes';
                    else if (specifiedValue == "0")
                        specifiedValue = getObj(valueId).value = 'no';
                }
                if (extValueObject && extendedValue != null && extendedValue != '')
                    specifiedValue = specifiedValue + ',' + extendedValue;

                GroupcriteriaConditions[columnIndex] = {
                    "groupid": columnGroupId,
                    "columnname": selectedColumn,
                    "comparator": comparatorValue,
                    "value": specifiedValue,
                    "column_condition": glueCondition
                };
            } else {
                if (!emptyCheck4You(columnId, " Column ", "text")) {
                    return false;
                }
            }
        }
        return_filters += "&groupft_criteria=" + JSON.stringify(GroupcriteriaConditions);

        return return_filters;
    },

    calculateQuickFilterConditions : function() {
        var criteriaConditions = new Array();

        var columnIndex = 0;
        jQuery('.quickFilter4You').each(function(){
            var quickFilterObj = jQuery(this);
            var value = quickFilterObj.val();
            if (value) {
                var qfId = quickFilterObj.attr('id');
                var radioValue = jQuery('input[name="radio_' + qfId + '"]:checked').val();
                criteriaConditions[columnIndex] = {"columnname": qfId,
                    "radio_value": radioValue,
                    "value": value
                };
                columnIndex++;
            }
        });
        return JSON.stringify(criteriaConditions);
    },

    addConditionsToForm: function (formId, element) {
        const thisInstance = this;
        let advFilterCondition = thisInstance.calculateValues();
        let dataType = $(element).data('type');
        let backgroundExport = $(element).data('background-export');

        if (advFilterCondition !== false) {
            let advFilterCondition_arr = advFilterCondition.split("&");
            let advft_criteria_tmp = advFilterCondition_arr[0].split("=");
            let advft_criteria = advft_criteria_tmp[1];
            let advft_criteria_groups_tmp = advFilterCondition_arr[1].split("=");
            let advft_criteria_groups = advft_criteria_groups_tmp[1];
            let groupft_criteria_tmp = advFilterCondition_arr[2].split("=");
            let groupft_criteria = groupft_criteria_tmp[1];

            let recordId = thisInstance.getRecordId();

            jQuery('#advft_criteria').val();
            jQuery('#advft_criteria_groups').val(advft_criteria_groups);
            jQuery('#groupft_criteria').val(groupft_criteria);
            let quickFilterCriteria = thisInstance.calculateQuickFilterConditions();
            jQuery('#quick_filter_criteria').val(quickFilterCriteria);

            let formElement = jQuery('#' + formId);

            formElement.append("<input type='hidden' name='advft_criteria' id='advft_criteria' value='" + advft_criteria + "' />");
            formElement.append("<input type='hidden' name='advft_criteria_groups' id='advft_criteria_groups' value='" + advft_criteria_groups + "' />");
            formElement.append("<input type='hidden' name='groupft_criteria' id='groupft_criteria' value='" + groupft_criteria + "' />");
            formElement.append("<input type='hidden' name='quick_filter_criteria' id='quick_filter_criteria' value='" + quickFilterCriteria + "' />");
            formElement.find('input[name="type"]').val(dataType);

            if (true === backgroundExport) {
                // register to generate by cronjob !!!
                formElement.find('input[name="backgroundExport"]').val(backgroundExport);

                var formData = formElement.serializeFormData();
                formData['action'] = 'CronExport';

                $('li.open').removeClass('open');

                // test submit save
                // formElement.find('input[name="action"]').val(formData['action']);
                // formElement.submit();

                app.helper.showProgress();
                app.request.post({'data': formData}).then(function (err, res) {
                    if (res.success) {
                        app.helper.showSuccessNotification({'message' : app.vtranslate('JS_SUCCESS')});
                    } else {
                        app.helper.showErrorNotification({'message' : res.message});
                    }
                    app.helper.hideProgress();
                });

                thisInstance.removeCriteria(formElement);
            } else if ('GeneratePDF' !== formId) {
                formElement.submit();
                thisInstance.removeCriteria(formElement);
            }
        }
    },

    removeCriteria: function (formElement) {
        formElement.find('#advft_criteria').remove();
        formElement.find('#advft_criteria_groups').remove();
        formElement.find('#groupft_criteria').remove();
    },

    registerEventsForActions: function () {
        const thisInstance = this;

        jQuery('.reportActions').click(function (e) {
            var element = jQuery(e.currentTarget);
            var id = element.data('id');
            var href = element.data('href');
            var type = element.attr('name');
            var dataType = element.data('type');
            //var advFilterCondition = thisInstance.calculateValues();
            //var headerContainer = thisInstance.getHeaderContentsHolder();
            if (href.indexOf('&view=BingMaps&') !== -1) {
                window.open(href);
            } else if (type.indexOf('Print') !== -1) {
                if ('base' === dataType
                    || 'all' === dataType) {
                    e.preventDefault();
                    jQuery('#PrintReport').find('#form_report_name').val(jQuery('.reportHeader h3').html());
                    thisInstance.addConditionsToForm('PrintReport', element);
                    return false;
                } else {
                    printDiv();
                }
            } else if (type.indexOf('Excel') !== -1) {
                if (jQuery('#reporttype').val() === 'custom_report') {
                    jQuery('#GenerateXLS').submit();
                } else {
                    e.preventDefault();
                    thisInstance.addConditionsToForm('GenerateXLS', element);
                    return false;
                }
            } else {
                let recordId = thisInstance.getRecordId();
                let pdfmaker_active = jQuery('#pdfmaker_active').val();
                let is_test_write_able = jQuery('#is_test_write_able').val();
                let div_id = jQuery('#div_id').val();
                let formElement = jQuery('#GeneratePDF');
                formElement.find('input[name="type"]').val(dataType);

                e.preventDefault();
                thisInstance.addConditionsToForm('GeneratePDF', element);

                generatePDF(recordId, pdfmaker_active, is_test_write_able, div_id);
                thisInstance.removeCriteria(formElement);
            }
            return false;
        })
    },

    registerSaveOrGenerateReportEvent : function(){
        var thisInstance = this;
        jQuery('.generateReport').on('click',function(e){
            if (jQuery("#reporttype").val() === "custom_report") {
                jQuery('#detailViewReport').submit();
            } else {
                var advFilterCondition = thisInstance.calculateValues();
                if(advFilterCondition!==false){
                    app.helper.showProgress();
                    var advFilterCondition_arr = advFilterCondition.split("&");
                    var advft_criteria_tmp = advFilterCondition_arr[0].split("=");
                    var advft_criteria = advft_criteria_tmp[1];
                    var advft_criteria_groups_tmp = advFilterCondition_arr[1].split("=");
                    var advft_criteria_groups = advft_criteria_groups_tmp[1];
                    var groupft_criteria_tmp = advFilterCondition_arr[2].split("=");
                    var groupft_criteria = groupft_criteria_tmp[1];

                    var recordId = thisInstance.getRecordId();
                    var currentMode = jQuery(e.currentTarget).data('mode');

                    jQuery('#advft_criteria').val(advft_criteria);
                    jQuery('#advft_criteria_groups').val(advft_criteria_groups);
                    jQuery('#groupft_criteria').val(groupft_criteria);

                    var quickFilterCriteria = thisInstance.calculateQuickFilterConditions();
                    jQuery('#quick_filter_criteria').val(quickFilterCriteria);

                    jQuery('#currentMode').val(currentMode);
                    jQuery('#detailViewReport').submit();
                }
                return false;
            }
        });

    },

    markReportAsChanged: function () {
        jQuery('#saveReportBtn').removeClass('hide');
        jQuery('#report_changed').val('1');
    },

    registerConditionBlockChangeEvent: function () {

	    let thisInstance = this;

        let filterConditionContainer = jQuery('.filterConditionContainer');

        filterConditionContainer.find('.dateField').on('change', function () {
            thisInstance.markReportAsChanged();
        });
        filterConditionContainer.find('.inputElement').on('change', function () {
            thisInstance.markReportAsChanged();
        });
        jQuery('.deleteCondition').on('click', function () {
            thisInstance.markReportAsChanged();
        });
        jQuery(document).on('btn', function () {
            thisInstance.markReportAsChanged();
        });
        if ('1' === jQuery('#report_changed').val()) {
            thisInstance.markReportAsChanged();
        }
    },

    registerEventForCollapseDataBlock: function () {
        const thisInstance = this;
        jQuery('button[name=data_info_block]').on('click', function(e) {
            let icon =  jQuery(e.currentTarget).find('i');
            let isClassExist = jQuery(icon).hasClass('fa-chevron-right');
            if(isClassExist) {
                jQuery(e.currentTarget).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
                jQuery('#rpt4youTable').removeClass('hide').show('slow');
                jQuery('#quickFilterArea').removeClass('hide').show('slow');
                jQuery('.listViewActionsDiv').removeClass('hide').show('slow');
            } else {
                jQuery(e.currentTarget).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
                jQuery('#rpt4youTable').addClass('hide').hide('slow');
                jQuery('#quickFilterArea').addClass('hide').hide('slow');
                jQuery('.listViewActionsDiv').addClass('hide').hide('slow');
            }
            return false;
        });
    },

	registerEventForModifyCondition : function() {
		const thisInstance = this;
	    jQuery('button[name=modify_condition]').on('click', function(e) {
			let icon =  jQuery(e.currentTarget).find('i');
            let isClassExist = jQuery(icon).hasClass('fa-chevron-right');
			if(isClassExist) {
				jQuery(e.currentTarget).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
				jQuery('#filterContainer').removeClass('hide').show('slow');
			} else {
				jQuery(e.currentTarget).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
				jQuery('#filterContainer').addClass('hide').hide('slow');
			}
			if('undefined' === typeof jQuery('.filterContainer select.select2-offscreen').first().val()) {
                addNewConditionGroup('adv_filter_div');
                thisInstance.registerConditionBlockChangeEvent();
            }
			return false;
		});
	},

    registerEventForReportHeaderInfoBlock : function() {
        jQuery('button[name=header_info_block]').on('click', function(e) {
            var icon =  jQuery(e.currentTarget).find('i');
            var isClassExist = jQuery(icon).hasClass('fa-chevron-right');
            if(isClassExist) {
                jQuery(e.currentTarget).find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
                jQuery('#reportHederInfoDesc').removeClass('hide').show('slow');
                jQuery('#reportHederInfo').removeClass('hide').show('slow');
            } else {
                jQuery(e.currentTarget).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
                jQuery('#reportHederInfoDesc').addClass('hide').hide('slow');
                jQuery('#reportHederInfo').addClass('hide').hide('slow');
            }
            return false;
        });
    },

    getDbFormatedDateValue : function(dateObj) {
		if(dateObj==""){
	        return dateObj;
	    }
	    if(typeof dateObj !='undefined'){

			var db_date_format = 'dd-mm-yyyy';
	        var from_date_format = dateObj.data('date-format');
	        var from_value = dateObj.val();

			var dateArray = from_value.split('-');
	        var dateArrayDots = from_value.split('.');

	        var formatedDate = "";
	        switch(from_date_format){
	            case 'dd-mm-yyyy':
	                formatedDate = dateArray[2]+'-'+dateArray[1]+'-'+dateArray[0];
	                break;
	            case 'mm-dd-yyyy':
	                formatedDate = dateArray[2]+'-'+dateArray[0]+'-'+dateArray[1];
	                break;
	            case 'yyyy-mm-dd':
	                formatedDate = dateArray[0]+'-'+dateArray[1]+'-'+dateArray[2];
	                break;
	            case 'dd.mm.yyyy':
	                formatedDate = dateArrayDots[2]+'-'+dateArrayDots[1]+'-'+dateArrayDots[0];
	                break;
	        }
	    }
	    return formatedDate;
	},

    registerEvents : function(){
        this.registerEventsForActions();
        this.registerSaveOrGenerateReportEvent();

        if (this.isSupportedPagination()) {
            this.registerEventsForPagination();
        }

        let container = this.getContentHolder();
        this.advanceFilterInstance = Vtiger_AdvanceFilter_Js.getInstance(jQuery('.filterContainer',container));

        this.registerConditionBlockChangeEvent();
        this.registerEventForCollapseDataBlock();
        this.registerEventForModifyCondition();
        this.registerEventForReportHeaderInfoBlock();
	},

    isSupportedPagination : function() {
        return 'tabular' === jQuery('#reporttype').val();
    },

    getDefaultParams: function () {
        var thisInstance = this;
        var pageNumber = jQuery('#pageNumber').val();
        var module = app.getModuleName();
        var parent = app.getParentModuleName();
        var orderBy = jQuery('#orderBy').val();
        var sortOrder = jQuery('#sortOrder').val();
        var recordId = thisInstance.getRecordId();
        var params = {
            'module': module,
            'parent': parent,
            'page': pageNumber,
            'action': 'Detail',
            'mode': 'ajax',
            'record': recordId,
            'orderby': orderBy,
            'sortorder': sortOrder
        }

        var advFilterCondition = thisInstance.calculateValues();
        if (advFilterCondition !== false) {
            var advFilterCondition_arr = advFilterCondition.split('&');
            var advft_criteria_tmp = advFilterCondition_arr[0].split('=');
            var advft_criteria = advft_criteria_tmp[1];
            var advft_criteria_groups_tmp = advFilterCondition_arr[1].split('=');
            var advft_criteria_groups = advft_criteria_groups_tmp[1];
            var groupft_criteria_tmp = advFilterCondition_arr[2].split('=');
            var groupft_criteria = groupft_criteria_tmp[1];

            params['advft_criteria'] = advft_criteria;
            params['advft_criteria_groups'] = advft_criteria_groups;
            params['groupft_criteria'] = groupft_criteria;
        }

        return params;
    },

    /*
     * Function which will give you all the list view params
     */
    getListViewRecords: function (urlParams) {

        var aDeferred = jQuery.Deferred();
        if ('undefined' === typeof urlParams) {
            urlParams = {};
        }

        var thisInstance = this;
        var loadingMessage = jQuery('.listViewLoadingMsg').text();
        var progressIndicatorElement = jQuery.progressIndicator({
            'message': loadingMessage,
            'position': 'html',
            'blockInfo': {
                'enabled': true
            }
        });

        var defaultParams = this.getDefaultParams();
        var urlParams = jQuery.extend(defaultParams, urlParams);

        if (!this.requestInProgress) {
            this.requestInProgress = true;

            AppConnector.request(urlParams).then(
                function (data) {
                    progressIndicatorElement.progressIndicator({
                        'mode': 'hide'
                    })
                    thisInstance.requestInProgress = false;
                    var listViewContentsContainer = jQuery('#reports4you_html')
                    listViewContentsContainer.html(data.result);
                    // REGISTER POST POPULATION ACTIONS
                    thisInstance.registerEventsForPagination();
                },

                function (textStatus, errorThrown) {
                    aDeferred.reject(textStatus, errorThrown);
                }
            );
            return aDeferred.promise();
        }
    },

    /**
     * Function to update Pagining status
     */
    updatePagination: function () {
        var previousPageExist = jQuery('#previousPageExist').val();
        var nextPageExist = jQuery('#nextPageExist').val();
        var previousPageButton = jQuery('#listViewPreviousPageButton');
        var nextPageButton = jQuery('#listViewNextPageButton');
        var pageJumpButton = jQuery('#listViewPageJump');
        var listViewEntriesCount = parseInt(jQuery('#noOfEntries').val());
        var pageStartRange = parseInt(jQuery('#pageStartRange').val());
        var pageEndRange = parseInt(jQuery('#pageEndRange').val());
        var pages = jQuery('#totalPageCount').text();
        var pageNumbersTextElem = jQuery('.pageNumbersText');

        if (pages > 1) {
            pageJumpButton.removeAttr('disabled');
        }
        if (previousPageExist != '') {
            previousPageButton.removeAttr('disabled');
        } else if (previousPageExist == '') {
            previousPageButton.attr('disabled', 'disabled');
        }

        if ((nextPageExist != '') && (pages > 1)) {
            nextPageButton.removeAttr('disabled');
        } else if ((nextPageExist == '') || (pages == 1)) {
            nextPageButton.attr('disabled', 'disabled');
        }

        if (listViewEntriesCount != 0) {
            var pageNumberText = pageStartRange + ' ' + app.vtranslate('to') + ' ' + pageEndRange;
            pageNumbersTextElem.html(pageNumberText);
            this.loadTotalRecordCount();
        } else {
            pageNumbersTextElem.html('<span>&nbsp;</span>');
        }

    },

    registerEventsForPagination: function () {
        var aDeferred = jQuery.Deferred();
        var thisInstance = this;
        jQuery('#listViewNextPageButton').on('click', function () {
            var pageLimit = jQuery('#pageLimit').val();
            var noOfEntries = jQuery('#noOfEntries').val();
            if (noOfEntries === pageLimit) {
                var orderBy = jQuery('#orderBy').val();
                var sortOrder = jQuery('#sortOrder').val();
                var urlParams = {
                    'orderby': orderBy,
                    'sortorder': sortOrder,
                }
                var pageNumberElm = jQuery('#pageNumber');
                var pageNumber = pageNumberElm.val();
                var nextPageNumber = eval(parseInt(parseFloat(pageNumber)) + 1);

                pageNumberElm.val(nextPageNumber);
                jQuery('#pageToJumpReports').val(nextPageNumber);
                thisInstance.getListViewRecords(urlParams)
            }
            return aDeferred.promise();
        });
        jQuery('#listViewPreviousPageButton').on('click', function () {
            var aDeferred = jQuery.Deferred();
            var pageNumberElm = jQuery('#pageNumber');
            var pageNumber = pageNumberElm.val();
            if (pageNumber > 1) {
                var orderBy = jQuery('#orderBy').val();
                var sortOrder = jQuery('#sortOrder').val();
                var urlParams = {
                    'orderby': orderBy,
                    'sortorder': sortOrder,
                }
                var previousPageNumber = parseInt(parseFloat(pageNumber)) - 1;
                jQuery('#pageNumber').val(previousPageNumber);
                jQuery('#pageToJumpReports').val(previousPageNumber);
                thisInstance.getListViewRecords(urlParams)
            }
        });

        jQuery('#listViewPageJump').on('click', function (e) {
            let pageToJumpReportsElm = jQuery('#pageToJumpReports');

            let pageNo = parseInt(jQuery('#pageNumber').val());
            pageToJumpReportsElm.val(pageNo);

            let element = jQuery('#totalPageCount');
            let totalPageNumber = element.text();
            if ('' === totalPageNumber) {
                let totalCountElem = jQuery('#totalCount');
                let totalRecordCount = totalCountElem.val();
                if (totalRecordCount !== '') {
                    let recordPerPage = parseInt(jQuery('#pageLimit').val());
                    if (recordPerPage === 0) recordPerPage = 1;
                    let pageCount = Math.ceil(totalRecordCount / recordPerPage);
                    if (pageCount === 0) {
                        pageCount = 1;
                    }
                    element.text(pageCount);
                    return;
                }
                element.progressIndicator({});
                thisInstance.getPageCount().then(function (data) {
                    let pageCount = parseInt(data['result']['page']);
                    totalCountElem.val(data['result']['numberOfRecords']);
                    if (pageCount === 0) {
                        pageCount = 1;
                    }
                    element.text(pageCount);
                    element.progressIndicator({'mode': 'hide'});
                });
            }
        })

        jQuery('#listViewPageJumpDropDown').on('click', 'li', function (e) {
            e.stopImmediatePropagation();
        }).on('keypress', '#pageToJumpReports', function (e) {
            if (e.which === 13) {
                e.stopImmediatePropagation();

                return thisInstance.changeResultPage(e.currentTarget);
            }
        });

        jQuery('#pageToJumpSubmit').on('click', function () {
            thisInstance.changeResultPage($('#pageToJumpReports'));
        });
    },

    changeResultPage : function (e) {
        const thisInstance = this;
        let element = jQuery(e);

        if (parseInt(element.val())) {
            let currentPageElement = jQuery('#pageNumber');
            let currentPageNumber = parseInt(currentPageElement.val());
            let newPageNumber = parseInt(jQuery(e).val());
            let totalPages = parseInt(jQuery('.totalPageCount').text());
            a = jQuery('.totalPageCount').text();

            if (newPageNumber > totalPages
                || 0 >= newPageNumber
            ) {
                Vtiger_Helper_Js.showMessage({
                    title: app.vtranslate('JS_PAGE_NOT_EXIST'),
                    type: 'error'
                });
                return;
            }

            if (newPageNumber === currentPageNumber) {
                Vtiger_Helper_Js.showMessage({
                    title: app.vtranslate('JS_YOU_ARE_IN_PAGE_NUMBER') + ' ' + newPageNumber,
                    type: 'info'
                });
                return;
            }
            currentPageElement.val(newPageNumber);
            thisInstance.getListViewRecords()
        }
        return false;
    }

});
