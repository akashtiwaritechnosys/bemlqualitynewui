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
    <div style="padding: 40px">
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
        </style>
 {include file="exports.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
        </div>
        <table id="data_table">
            <tr>
                <th class="NoBackGround" rowspan="2">Model</th>
                {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$PickListValues}
                    <th rowspan="1" colspan="3" class="NoBackGround" class="NoBackGround"><b>{$INNER_VALUE1}</b></th>
                {/foreach}
                <th class="NoBackGround" rowspan="2" colspan="1"> <b> Grand Total </b> </th>
            </tr>
            <tr>
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
                            <th colspan="{(($PickListValues|@count) * 3)  + 2}" style="font-weight: 900" class="NoBackGround">
                                {$KEY_FIELD}
                            </th>
                        {/if}
                    </tr>
                    <tr>
                        {* {if $smarty.foreach.foo.first} *}
                            <th class="NoBackGround">{$INNER_KEY}</th>
                        {* {/if} *}
                        {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$INNER_VALUE}
                            {if $INNER_VALUE1 eq '0'}
                                <th rowspan="1" class="NoBackGround" class="NoBackGround"></th>
                            {else}
                                {foreach item=INNER_VALUE2 key=INNER_KEY2 from=$INNER_VALUE1}
                                    {foreach item=INNER_VALUE3 key=INNER_KEY3 from=$INNER_VALUE2}
                                        {foreach item=INNER_VALUE4 key=INNER_KEY4 from=$INNER_VALUE3}
                                            <th rowspan="1" class="NoBackGround" class="NoBackGround">
                                                <a target="_blank"
                                                    href='index.php?module=Equipment&view=List&app=INVENTORY&search_params=[[["{$RowColIgKey}","e","{$INNER_KEY}"],["{$ColColMainKey}","e","{$INNER_KEY2}"],["{$ColColSubKey}","e","{$INNER_KEY4}"],["equip_category","e","S"]]]'>
                                                    {$INNER_VALUE4}
                                                </a>
                                            </th>
                                        {/foreach}
                                    {/foreach}
                                {/foreach}
                            {/if}
                        {/foreach}
                    </tr>
                {/foreach}
            {/foreach}
        </table>
    </div>
    {include file="foot.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
{/strip}