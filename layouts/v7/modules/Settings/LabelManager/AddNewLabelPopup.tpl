{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}<br>
	<div class="detailViewContainer" id="WooCommerceDetails">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="clearfix">
				<h3 style="margin-top: 0px;">{vtranslate('Add New Label', $QUALIFIED_MODULE)} - <a href="index.php?module={$sourceModule}&view=List" target="_blank">{vtranslate($sourceModule, $sourceModule)}</a></h3>
				<hr>
			</div>

	        <div class="modal-body">
		        <div class="fieldBlockContainer">
					<form class="form-horizontal recordEditView" id="EditView" name="edit" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="module" value="LabelManager" />
						<input type="hidden" name="parent" value="Settings" />
						<input type="hidden" name="action" value="SaveLanguage" />
						<input type="hidden" name="mode" value="saveNewLabel" />
						<input type="hidden" id="language" name="language" value="{$language}">
						<input type="hidden" id="sourceModule" name="sourceModule" value="{$sourceModule}">
			        	<table class="table table-borderless">
			        		<tr>
			        			<td>
			        				<input class="inputElement" type="text" name="labelKey" placeholder="{vtranslate('Enter Field Label', $MODULE)}">
			        			</td>
			        			<td>
			        				<input class="inputElement" type="text" name="labelValue" placeholder="{vtranslate('Enter Field Translate Label', $MODULE)}">
			        			</td>
			        		</tr>
			        	</table>

			        	<div class="modal-footer">
		                    <center>
		                        <button class="btn btn-success" id="saveNewLabel" type="submit"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
		                        <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
		                    </center>
		                </div>
		            </form>	
		        </div>
        	</div>

	    </div>
	</div>
{/strip}
