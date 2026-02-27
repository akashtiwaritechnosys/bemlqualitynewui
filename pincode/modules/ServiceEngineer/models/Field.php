<?php

class ServiceEngineer_Field_Model extends Vtiger_Field_Model {

	function getValidator() {
		$validator = array();
		$fieldName = $this->getName();

		switch ($fieldName) {
			case 'phone':
				$funcName = array('name' => 'itivalidate');
				array_push($validator, $funcName);
				break;
			default:
				$validator = parent::getValidator();
				break;
		}
		return $validator;
	}
	public function isAjaxEditable() {
		return false;
	}
}
