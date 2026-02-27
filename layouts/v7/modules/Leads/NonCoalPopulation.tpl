{strip}
    <script>
$( document ).ready(function() {
	jQuery('.app-menu').removeClass('hide');
	var toggleAppMenu = function(type) {
		var appMenu = jQuery('.app-menu');
		var appNav = jQuery('.app-nav');
		appMenu.appendTo('#page');
		appMenu.css({
			'top' : appNav.offset().top + appNav.height(),
			'left' : 0
		});
		if(typeof type === 'undefined') {
			type = appMenu.is(':hidden') ? 'show' : 'hide';
		}
		if(type == 'show') {
			appMenu.show(200, function() {});
		} else {
			appMenu.hide(200, function() {});
		}
	};

	jQuery('.app-trigger, .app-icon, .app-navigator').on('click',function(e){
		e.stopPropagation();
		toggleAppMenu();
	});

	jQuery('html').on('click', function() {
	
	});
    jQuery(document).keyup(function (e) {
		if (e.keyCode == 27) {
			if(!jQuery('.app-menu').is(':hidden')) {
				toggleAppMenu('hide');
			}
		}
	});
    jQuery('.app-modules-dropdown-container').hover(function(e) {
		var dropdownContainer = jQuery(e.currentTarget);
		jQuery('.dropdown').removeClass('open');
		if(dropdownContainer.length) {
			if(dropdownContainer.hasClass('dropdown-compact')) {
				dropdownContainer.find('.app-modules-dropdown').css('top', dropdownContainer.position().top - 8);
			} else {
				dropdownContainer.find('.app-modules-dropdown').css('top', '');
			}
			dropdownContainer.addClass('open').find('.app-item').addClass('active-app-item');
		}
	}, function(e) {
		var dropdownContainer = jQuery(e.currentTarget);
		dropdownContainer.find('.app-item').removeClass('active-app-item');
		setTimeout(function() {
			if(dropdownContainer.find('.app-modules-dropdown').length && !dropdownContainer.find('.app-modules-dropdown').is(':hover') && !dropdownContainer.is(':hover')) {
				dropdownContainer.removeClass('open');
			}
		}, 500);

	});
    jQuery('.app-item').on('click', function() {
		var url = jQuery(this).data('defaultUrl');
		if(url) {
			window.location.href = url;
		}
	});
    
	jQuery(window).resize(function() {
		jQuery(".app-modules-dropdown").mCustomScrollbar("destroy");
		app.helper.showVerticalScroll(jQuery(".app-modules-dropdown").not('.dropdown-modules-compact'), {
			setHeight: $(window).height(),
			autoExpandScrollbar: true
		});
		jQuery('.dropdown-modules-compact').each(function() {
			var element = jQuery(this);
			var heightPer = parseFloat(element.data('height'));
			app.helper.showVerticalScroll(element, {
				setHeight: $(window).height()*heightPer - 3,
				autoExpandScrollbar: true,
				scrollbarPosition: 'outside'
			});
		});
	});

    app.helper.showVerticalScroll(jQuery(".app-modules-dropdown").not('.dropdown-modules-compact'), {
		setHeight: $(window).height(),
		autoExpandScrollbar: true,
		scrollbarPosition: 'outside'
	});
	jQuery('.dropdown-modules-compact').each(function() {
		var element = jQuery(this);
		var heightPer = parseFloat(element.data('height'));
		app.helper.showVerticalScroll(element, {
			setHeight: $(window).height()*heightPer - 3,
			autoExpandScrollbar: true,
			scrollbarPosition: 'outside'
		});
	});
});
</script>
    <div style="padding: 40px;">
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            td,
            tr,
            th {
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #ffffff;
            }

            .NoBackGround {
                background-color: #ffffff;
            }

          	/* fixed header */
			.tableFixHead          { overflow: auto; height: 400px; }
			.tableFixHead table .first th { position: sticky; top: 0px; z-index: 1; }
			.tableFixHead table .second th { position: sticky; top: 35px; z-index: 1; }

			/* Just common table stuff. Really. */
			table  { border-collapse: collapse; width: 100%; }
			th, td { padding: 8px 16px; }
			th     { background:#eee; }
			/* fixed header */
        </style>
 {include file="exports.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
        </div>
        <div class="tableFixHead">
			<tr>
				<th class="NoBackGround" colspan="{$PickListValues|@count + 2}">
					<h5>{$REPORT_LABEL}</h1>
				</th>
			</tr>
	        <table id="data_table">
	            <tr class="first">
	                <th class="NoBackGround" rowspan="2" style="position: -webkit-sticky; /* for Safari */position: sticky;left: 0;background: #FFF;border-right: 1px solid #CCC;z-index: 2;">Model</th>
	                {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$PickListValues}
	                    <th rowspan="1" colspan="3" class="NoBackGround" class="NoBackGround"><b>{$INNER_VALUE1}</b></th>
	                {/foreach}
	                <th class="NoBackGround" rowspan="2" colspan="1"> <b> Grand Total </b> </th>
	            </tr>
	            <tr class="second">
	                {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$PickListValues}
	                    {foreach item=INNER_VALUE2 key=INNER_KEY2 from=$anotherColumnGroup}
	                        <th rowspan="1" colspan="1" class="NoBackGround" class="NoBackGround">
	                            <b>{vtranslate($INNER_VALUE2, 'Leads')}</b>
	                        </th>
	                    {/foreach}
	                {/foreach}
	            </tr>
	            {foreach item=NAME_FIELD key=KEY_FIELD from=$ResultArray}
	                {foreach item=INNER_VALUE key=INNER_KEY from=$NAME_FIELD name=foo}
	                    <tr>
	                        {if $smarty.foreach.foo.first}
	                            <td colspan="{(($PickListValues|@count) * 3)  + 2}" style="font-weight: 900" class="NoBackGround">
	                                {$KEY_FIELD}
	                            </td>
	                        {/if}
	                    </tr>
	                    <tr>
	                        <td class="NoBackGround" style="position: -webkit-sticky; /* for Safari */position: sticky;left: 0;background: #FFF;border-right: 1px solid #CCC;">{$INNER_KEY}</td>
	                        {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$INNER_VALUE}
	                            {foreach item=INNER_VALUE2 key=INNER_KEY2 from=$INNER_VALUE1}
	                                {foreach item=INNER_VALUE3 key=INNER_KEY3 from=$INNER_VALUE2}
	                                    <td rowspan="1" class="NoBackGround" class="NoBackGround">
	                                    	{if $INNER_KEY3 eq 0}
                                    			{assign var="eq_run_war_st" value="Under Warranty"}
                                    		{else if $INNER_KEY3 eq 1}
                                    			{assign var="eq_run_war_st" value="Contract"}
                                    		{else $INNER_KEY3 eq 2}
                                    			{assign var="eq_run_war_st" value="Outside Warranty"}
                                    		{/if}
	                                    	{if $INNER_KEY1 eq '12'}
	                                    		{if $INNER_KEY eq 'Sub Total'}
		                                    		<a target="_blank"
			                                            href='index.php?module=Equipment&parent=&page=1&view=List&viewname=59&orderby=&sortorder=&app=INVENTORY&search_params=[[["(plant_name+;+(MaintenancePlant)+region_code)","c","MA,MB,MC,MF,MG,MH,ML,MN,MR,MS,MV,MW"],["eq_division","e","{$KEY_FIELD}"],["eq_run_war_st","e","Under+Warranty,Contract,Outside+Warranty"],["equip_category","e","S"]]]&tag_params=[]&nolistcache=0&list_headers=["(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","eq_division","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]&tag='>
				                                            {$INNER_VALUE3}
				                                        </a>
				                                {else if $INNER_KEY eq 'Total'}
				                                	<a target="_blank"
		                                            	href='index.php?module=Equipment&parent=&page=1&view=List&viewname=59&orderby=&sortorder=&app=INVENTORY&search_params=[[["(plant_name+;+(MaintenancePlant)+region_code)","c","MA,MB,MC,MF,MG,MH,ML,MN,MR,MS,MV,MW"],["eq_run_war_st","e","Under+Warranty,Contract,Outside+Warranty"],["equip_category","e","S"]]]&tag_params=[]&nolistcache=0&list_headers=["(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","eq_division","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]&tag='>
			                                            {$INNER_VALUE3}
			                                            <a>
		                                    	{else}
	                                    		 	<a target="_blank"
		                                            	href='index.php?module=Equipment&parent=&page=1&view=List&viewname=59&orderby=&sortorder=&app=INVENTORY&search_params=[[["equip_model","e","{$INNER_KEY}"],["(plant_name+;+(MaintenancePlant)+region_code)","c","MA,MB,MC,MF,MG,MH,ML,MN,MR,MS,MV,MW"],["eq_run_war_st","e","Under+Warranty,Contract,Outside+Warranty"],["equip_category","e","S"]]]&tag_params=[]&nolistcache=0&list_headers=["(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","eq_division","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]&tag='>
			                                            {$INNER_VALUE3}
			                                            <a>
			                                   	{/if}
	                                    	{else}
		                                    	{if $INNER_KEY eq 'Sub Total'}
		                                    		<a target="_blank"
			                                            href='index.php?module=Equipment&parent=&page=1&view=List&viewname=59&orderby=&sortorder=&app=INVENTORY&search_params=[[["(plant_name+;+(MaintenancePlant)+region_code)","e","{$INNER_KEY2}"],["eq_run_war_st","e","{$eq_run_war_st}"],["eq_division","e","{$KEY_FIELD}"],["equip_category","e","S"]]]&tag_params=[]&nolistcache=0&list_headers=["eq_division","(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]&tag='>
				                                            {$INNER_VALUE3}
				                                        </a>
		                                    	{else if $INNER_KEY eq 'Total'}
		                                    		<a target="_blank"
			                                            href='index.php?module=Equipment&parent=&page=1&view=List&viewname=59&orderby=&sortorder=&app=INVENTORY&search_params=[[["(plant_name+;+(MaintenancePlant)+region_code)","e","{$INNER_KEY2}"],["eq_run_war_st","e","{$eq_run_war_st}"],["equip_category","e","S"]]]&tag_params=[]&nolistcache=0&list_headers=["eq_division","(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]&tag='>
				                                            {$INNER_VALUE3}
				                                        </a>
		                                    	{else}
			                                    	{if $INNER_KEY3 eq 0}	
			                                    		<a target="_blank"
				                                            href='index.php?module=Equipment&view=List&app=INVENTORY&search_params=[[["eq_division","e","{$KEY_FIELD}"],["equip_model","e","{$INNER_KEY}"],["(plant_name ; (MaintenancePlant) region_code)","e","{$INNER_KEY2}"],["eq_run_war_st","e","Under Warranty"],["equip_category","e","S"]]]&list_headers=["eq_division","(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]'>
				                                            {$INNER_VALUE3}
				                                        </a>
			                                    	{else if $INNER_KEY3 eq 1}
			                                    		<a target="_blank"
				                                            href='index.php?module=Equipment&view=List&app=INVENTORY&search_params=[[["eq_division","e","{$KEY_FIELD}"],["equip_model","e","{$INNER_KEY}"],["(plant_name ; (MaintenancePlant) region_code)","e","{$INNER_KEY2}"],["eq_run_war_st","e","Contract"],["equip_category","e","S"]]]&list_headers=["eq_division","(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]'>
				                                            {$INNER_VALUE3}
				                                        </a>
			                                    	{else if $INNER_KEY3 eq 2}
			                                    		<a target="_blank"
				                                            href='index.php?module=Equipment&view=List&app=INVENTORY&search_params=[[["eq_division","e","{$KEY_FIELD}"],["equip_model","e","{$INNER_KEY}"],["(plant_name ; (MaintenancePlant) region_code)","e","{$INNER_KEY2}"],["eq_run_war_st","e","Outside Warranty"],["equip_category","e","S"]]]&list_headers=["eq_division","(account_id+;+(Accounts)+org_code)","(plant_name+;+(MaintenancePlant)+region_code)","eq_type_of_conrt","equip_model","equipment_sl_no","eq_run_war_st","equip_category","maintain_plant","assigned_user_id","functional_loc","account_id","equi_desc"]'>
				                                            {$INNER_VALUE3}
				                                        </a>
			                                    	{/if}
		                                    	{/if}
		                                    {/if}
	                                    </td>
	                                {/foreach}
	                            {/foreach}
	                        {/foreach}
	                    </tr>
	                {/foreach}
	            {/foreach}
	        </table>
	    </div>
    </div>
    {include file="foot.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
{/strip}