Vtiger_Detail_Js("Contacts_Detail_Js", {
	approveOrReject: function (url, acpStatus) {

		if (acpStatus == 'Rejected') {
			let confMsg = "Do You Really Want To Reject this User ? ";
			app.helper.showConfirmationBox({ 'message': confMsg }).then(function (e) {
				var data = {
					'module': 'Contacts',
					'view': 'RejectionReason',
					'mode': 'showRejectionReasonForm'
				};
				app.request.post({ "data": data }).then(function (err, res) {
					if (err === null) {
						var cb = function (data) {
							var form = jQuery(data).find('#AddRejectionReason');
							var params = {
								submitHandler: function (form) {
									var params = jQuery(form).serializeFormData();
									url = url + '&RejectionReason=' + params.rejectionReason;
									url = url + '&apStatus=' + acpStatus;
									app.request.post({ url: url }).then(
										function (error, data) {
											if (!error) {
												app.helper.hideModal();
												app.helper.showSuccessNotification({ message: data.message });
												location.reload();
											} else {
												app.helper.showErrorNotification({ message: error.message });
											}
										},
										function (error, err) {
										}
									);
								}
							}
							form.vtValidate(params);
						}
						app.helper.showModal(res, { "cb": cb });
					}
				})
			});
		} else {
			var data = {
				'module': 'Contacts',
				'action': 'HasLinkedFnAndMob',
				'record': this.getRecordId()
			};
			app.request.post({ "data": data }).then(
				function (error, data) {
					if (!error) {
						let confMsg = "Do You Really Want To Accept this User ? </br>" +
							" * Please Make Sure User Has Correct Login PlatForms </br>" +
							" * Please Make Sure User Has Linked With Correct Functional Loaction ";
						app.helper.showConfirmationBox({ 'message': confMsg }).then(function (e) {
							url = url + '&apStatus=' + acpStatus;
							app.helper.showProgress();
							app.request.post({ url: url }).then(
								function (error, data) {
									if (!error) {
										app.helper.showSuccessNotification({ message: data.message });
										location.reload();
									} else {
										app.helper.showErrorNotification({ message: error.message });
									}
									app.helper.hideProgress();
								},
								function (error, err) {
								}
							);
						});
					} else {
						app.helper.showErrorNotification({ message: error.message });
					}
				},
				function (error, err) {
				}
			);
		}
	},
	getRecordId: function () {
		return app.getRecordId();
	},
}, {
	registerAjaxPreSaveEvents: function (container) {
		var thisInstance = this;
		app.event.on(Vtiger_Detail_Js.PreAjaxSaveEvent, function (e) {
			if (!thisInstance.checkForPortalUser(container)) {
				e.preventDefault();
			}
		});
	},
	/**
	 * Function to check for Portal User
	 */
	checkForPortalUser: function (form) {
		var element = jQuery('[name="portal"]', form);
		var response = element.is(':checked');
		
		if (response) {
			var primaryEmailField = jQuery('[data-name="email"]');

			if (primaryEmailField.length == 0) {
				app.helper.showErrorNotification({message: app.vtranslate('JS_PRIMARY_EMAIL_FIELD_DOES_NOT_EXISTS')});
				return false;
			}

			var primaryEmailValue = primaryEmailField["0"].data("value");
			if (primaryEmailValue == "") {
				app.helper.showErrorNotification({message: app.vtranslate('JS_PLEASE_ENTER_PRIMARY_EMAIL_VALUE_TO_ENABLE_PORTAL_USER')});
				return false;
			}
		}
		return true;
	},
	/**
	 * Function which will register all the events
	 */
	registerEvents: function () {
		var form = this.getForm();
		this._super();
		this.registerAjaxPreSaveEvents(form);
	}
})