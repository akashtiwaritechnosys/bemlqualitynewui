<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class UIType101 extends UITypes {
    protected $id_cols_array = array('reports_to_id');
    protected $relModuleName = 'Users';
    protected $oth_as = '_101';

    public function getStJoinSQL(&$join_array, &$columns_array) {
    }

    public function getJoinSQL(&$join_array, &$columns_array) {
        if (!empty($this->params['fieldid'])) {
            $fieldid_alias = $old_oth_fieldid = $mif_as = '';
            if (!empty($this->params['fieldid'])) {
                $fieldid_alias = '_' . $this->params['fieldid'];
            }
            if (!empty($this->params['old_oth_as'])) {
                $old_oth_as = $this->params['old_oth_as'];
            }
            if (!empty($this->params['old_oth_fieldid'])) {
                if ('mif' === $this->params['old_oth_fieldid']) {
                    $mif_as = '_' . $this->params['fieldtabid'];
                }
                $old_oth_fieldid = '_' . $this->params['old_oth_fieldid'];
            }

            // ITS4YOU-CR SlOl | 25.8.2015 11:33 
            $fieldid = $this->params['fieldid'];
            $adb = PEARDatabase::getInstance();
            $stjoinRes = $adb->pquery('SELECT *  FROM vtiger_field WHERE fieldid = ? ', [$fieldid]);
            $stjoinRow = $adb->fetchByAssoc($stjoinRes, 0);
            $tablename = $stjoinRow['tablename'];
            $columnname = $stjoinRow['columnname'];

            if ($this->params['primary_table_name'] != $tablename && $tablename != 'vtiger_crmentity') {
                if (!array_key_exists(" $tablename AS $tablename" . $fieldid_alias . ' ', $join_array) && !in_array($this->params['old_oth_fieldid'], array('inv'))) {
                    $primary_index = $this->params['table_index'][$this->params['primary_table_name']];
                    $rel_index = $this->params['table_index'][$tablename];

                    if($this->params['primary_table_name']!=$this->params['report_primary_table']){
                        $primary_table_name = $this->params['primary_table_name']. $old_oth_as . $old_oth_fieldid. $mif_as;
                        $tablename_alias = $tablename . $old_oth_as . $old_oth_fieldid. $mif_as;
                    }else{
                        $primary_table_name = $this->params['primary_table_name'];
                        $tablename_alias = $tablename;
                    }
                    $join_array[" $tablename AS $tablename_alias" . ' ']['joincol'] = $primary_table_name.'.'.$primary_index;
                    $join_array[" $tablename AS $tablename_alias" . ' ']['using'] = $tablename_alias . '.' . $rel_index;
                }
            }
            // ITS4YOU-END
            // ITS4YOU-UP SlOl | 25.8.2015 11:33 
            if (in_array($this->params['columnname'], $this->id_cols_array) == true) {

                if (!array_key_exists(" vtiger_users AS vtiger_users$old_oth_as" . $old_oth_fieldid. $mif_as . ' ', $join_array)
                    && !in_array($this->params['old_oth_fieldid'], array('inv'))) {
                    $join_array[" vtiger_users AS vtiger_users$old_oth_as" . $old_oth_fieldid . $mif_as . ' ']['joincol'] = 'vtiger_crmentity.smownerid';
                    $join_array[" vtiger_users AS vtiger_users$old_oth_as" . $old_oth_fieldid . $mif_as . ' ']['using'] = "vtiger_users$old_oth_as" . $old_oth_fieldid . $mif_as . '.id';
                }

                $join_col = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.id';
                $using_col = " vtiger_users$old_oth_as" . $old_oth_fieldid. $mif_as . '.reports_to_id ';
            }else{
                $join_col = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.id';
                if($this->params['primary_table_name']!=$this->params['report_primary_table']){
                    $using_col = $this->params['tablename'].$old_oth_as . $old_oth_fieldid. $mif_as.'.'.$this->params['columnname'];
                }else{
                    $using_col = $this->params['tablename'].'.'.$this->params['columnname'];
                }
            }

            $userid_fld = $join_col;
            if (!array_key_exists(' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ', $join_array)) {
                $join_array[' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ']['joincol'] = $join_col;
                $join_array[' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ']['using'] = $using_col;
            }

            // ITS4YOU-END
        }

        $this->params['join_tablename_alias'] = 'vtiger_users' . $old_oth_as . $fieldid_alias;
        $uifactory = new UIFactory($this->params);
        $test_display = $uifactory->getDisplaySQL($this->relModuleName, $join_array, $columns_array);
        $columns_array_value = $test_display['display'];
        $fld_alias = $test_display['fld_string'];
        $fld_cond = $test_display['fld_cond'];

        $columns_array[] = $columns_array_value;
        $columns_array[$this->params['fld_string']]['userid_fld'] = $userid_fld;
        $columns_array[$this->params['fld_string']]['fld_alias'] = $fld_alias;

        $columns_array[$this->params['fld_string']]['fld_sql_str'] = $columns_array_value;
        $columns_array[$this->params['fld_string']]['fld_cond'] = $fld_cond;
        $columns_array['uitype_$fld_alias'] = $this->params['field_uitype'];
        $columns_array[$fld_alias] = $this->params['fld_string'];
        if ($fld_hrefid != '') {
            $columns_array[] = $fld_hrefid;
        }
    }

    public function getSelectedFieldCol($selectedfields) {
        $fieldid_alias = '';
        if (!empty($this->params['fieldid'])) {
            $fieldid_alias = '_' . $this->params['fieldid'];
        }
        if (!empty($this->params['old_oth_as'])) {
            $old_oth_as = $this->params['old_oth_as'];
        }

        if (in_array($selectedfields[1], $this->id_cols_array)) {
            $return = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.' . $selectedfields[1];
        } elseif ('vtiger_crmentity' === $selectedfields[0]) {
            $return = $selectedfields[0] . $this->oth_as . $fieldid_alias . '.' . $selectedfields[1];
        } else {
            $return = $selectedfields[0] . $fieldid_alias . '.' . $selectedfields[1];
        }

        return $return;
    }

}

?>