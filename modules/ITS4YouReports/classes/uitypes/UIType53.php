<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class UIType53 extends UITypes
{
    protected $id_cols_array = ['user_name', 'modifiedby', 'smownerid', 'smcreatorid'];
    protected $relModuleName = 'Users';
    protected $oth_as = '_53';

    public function getStJoinSQL(&$join_array, &$columns_array)
    {
    }

    public function getJoinSQL(&$join_array, &$columns_array)
    {
        if (!empty($this->params['fieldid'])) {
            $old_oth_fieldid = $mif_as = $old_oth_as = $fld_hrefid = '';
            $fieldid_alias = '_' . $this->params['fieldid'];

            if (!empty($this->params['old_oth_as'])) {
                $old_oth_as = $this->params['old_oth_as'];
            }

            if (!empty($this->params['old_oth_fieldid'])) {
                if ('mif' === $this->params['old_oth_fieldid']) {
                    $mif_as = '_' . $this->params['fieldtabid'];
                }
                $old_oth_fieldid = '_' . str_replace('_', '', $this->params['old_oth_fieldid']);
            }

            // ITS4YOU-CR SlOl | 25.8.2015 11:33
            $fieldid = $this->params['fieldid'];
            $adb = PEARDatabase::getInstance();
            $resRow = $adb->pquery('SELECT *  FROM vtiger_field WHERE fieldid = ? ', [$fieldid]);
            $stjoin_row = $adb->fetchByAssoc($resRow, 0);
            $tablename = $stjoin_row['tablename'];
            $columnname = $stjoin_row['columnname'];

            if ($this->params['primary_table_name'] !== $tablename
                && 'vtiger_crmentity' !== $tablename
            ) {
                if (!array_key_exists(" $tablename AS $tablename" . $fieldid_alias . ' ', $join_array)
                    && !in_array($this->params['old_oth_fieldid'], ['inv'])
                ) {
                    $primary_index = $this->params['table_index'][$this->params['primary_table_name']];
                    $rel_index = $this->params['table_index'][$tablename];

                    if ($this->params['primary_table_name'] !== $this->params['report_primary_table']) {
                        $primary_table_name = $this->params['primary_table_name'] . $old_oth_as . $old_oth_fieldid . $mif_as;
                        $tablename_alias = $tablename . $old_oth_as . $old_oth_fieldid . $mif_as;
                    } else {
                        $primary_table_name = $this->params['primary_table_name'];
                        $tablename_alias = $tablename;
                    }
                    $join_array[" $tablename AS $tablename_alias" . ' ']['joincol'] = $primary_table_name . '.' . $primary_index;
                    $join_array[" $tablename AS $tablename_alias" . ' ']['using'] = $tablename_alias . '.' . $rel_index;
                }
            }
            // ITS4YOU-END

            $join_alias = ' ' . substr($this->params['using_aliastablename'], 0, 0 - strlen($this->params['old_oth_as'])) . ' AS ' . $this->params['using_aliastablename'] . ' ';
            if (!array_key_exists($join_alias, $join_array) && in_array($this->params['tablename'], ['vtiger_crmentity'])) {
                $join_array[$join_alias]['joincol'] = $this->params['using_aliastablename'] . '.' . $this->params['using_columnname'];
                $join_array[$join_alias]['using'] = $this->params['primary_table_name'] . '.' . $this->params['primary_table_index'];
            }

            $join_alias = " vtiger_crmentity AS vtiger_crmentity$old_oth_as ";
            if (!array_key_exists($join_alias, $join_array) && in_array($this->params['tablename'], ['vtiger_crmentity'])) {
                $join_array[$join_alias]['joincol'] = $this->params['using_array']['join']['tablename'] . '.' . $this->params['using_array']['join']['columnname'];
                $join_array[$join_alias]['using'] = $this->params['using_aliastablename'] . '.' . $this->params['using_columnname'];
            }

            // ITS4YOU-UP SlOl | 25.8.2015 11:33
            if (in_array($this->params['columnname'], $this->id_cols_array) == true) {
                $join_col = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.id';
                $using_col = " vtiger_crmentity$old_oth_as" . $old_oth_fieldid . $mif_as . '.smownerid ';
            } else {
                $join_col = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.id';
                if ($this->params['primary_table_name'] !== $this->params['report_primary_table']) {
                    $using_col = $this->params['tablename'] . $old_oth_as . $old_oth_fieldid . $mif_as . '.' . $this->params['columnname'];
                } else {
                    $using_col = $this->params['tablename'] . '.' . $this->params['columnname'];
                }
            }

            $userid_fld = $join_col;
            if (!array_key_exists(' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ', $join_array)) {
                $join_array[' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ']['joincol'] = $join_col;
                $join_array[' vtiger_users AS vtiger_users' . $old_oth_as . $fieldid_alias . ' ']['using'] = $using_col;
            }

            if (in_array($this->params['columnname'], $this->id_cols_array)) {
                $join_col = 'vtiger_groups' . $old_oth_as . $fieldid_alias . '.groupid';
                $using_col = " vtiger_crmentity$old_oth_as" . $old_oth_fieldid . $mif_as . '.smownerid ';
            } else {
                $join_col = 'vtiger_groups' . $old_oth_as . $fieldid_alias . '.groupid';

                if ($this->params['primary_table_name'] !== $this->params['report_primary_table']) {
                    $using_col = $this->params['tablename'] . $old_oth_as . $old_oth_fieldid . $mif_as . '.' . $this->params['columnname'];
                } else {
                    $using_col = $this->params['tablename'] . '.' . $this->params['columnname'];
                }
            }

            if (!array_key_exists(' vtiger_groups AS vtiger_groups' . $old_oth_as . $fieldid_alias . ' ', $join_array)) {
                $join_array[' vtiger_groups AS vtiger_groups' . $old_oth_as . $fieldid_alias . ' ']['joincol'] = $join_col;
                $join_array[' vtiger_groups AS vtiger_groups' . $old_oth_as . $fieldid_alias . ' ']['using'] = $using_col;
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
        $columns_array["uitype_$fld_alias"] = $this->params['field_uitype'];
        $columns_array[$fld_alias] = $this->params['fld_string'];

        if (!empty($fld_hrefid)) {
            $columns_array[] = $fld_hrefid;
        }
//show("<font color='green'>fielduitypeJOJO53",$join_array,$this->params["field_uitype"],$columns_array,"</font>");
    }

    public function getSelectedFieldCol($selectedfields)
    {
        $fieldid_alias = '';

        if (!empty($this->params['fieldid'])) {
            $fieldid_alias = '_' . $this->params['fieldid'];
        }
        if (!empty($this->params['old_oth_as'])) {
            $old_oth_as = $this->params['old_oth_as'];
        }

        if (in_array($selectedfields[1], $this->id_cols_array)) {
            $return = 'vtiger_users' . $old_oth_as . $fieldid_alias . '.' . $selectedfields[1];
        } elseif ($selectedfields[0] === 'vtiger_crmentity') {
            $return = $selectedfields[0] . $this->oth_as . $fieldid_alias . '.' . $selectedfields[1];
        } else {
            $return = $selectedfields[0] . $fieldid_alias . '.' . $selectedfields[1];
        }

        return $return;
    }

}

?>
