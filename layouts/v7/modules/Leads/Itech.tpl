{strip}
	<script>
		$(document).ready(function() {
			jQuery('.app-menu').removeClass('hide');
			var toggleAppMenu = function(type) {
				var appMenu = jQuery('.app-menu');
				var appNav = jQuery('.app-nav');
				appMenu.appendTo('#page');
				appMenu.css({
					'top': appNav.offset().top + appNav.height(),
					'left': 0
				});
				if (typeof type === 'undefined') {
					type = appMenu.is(':hidden') ? 'show' : 'hide';
				}
				if (type == 'show') {
					appMenu.show(200, function() {});
				} else {
					appMenu.hide(200, function() {});
				}
			};

			jQuery('.app-trigger, .app-icon, .app-navigator').on('click', function(e) {
				e.stopPropagation();
				toggleAppMenu();
			});

			jQuery('html').on('click', function() {

			});
			jQuery(document).keyup(function(e) {
				if (e.keyCode == 27) {
					if (!jQuery('.app-menu').is(':hidden')) {
						toggleAppMenu('hide');
					}
				}
			});
			jQuery('.app-modules-dropdown-container').hover(function(e) {
				var dropdownContainer = jQuery(e.currentTarget);
				jQuery('.dropdown').removeClass('open');
				if (dropdownContainer.length) {
					if (dropdownContainer.hasClass('dropdown-compact')) {
						dropdownContainer.find('.app-modules-dropdown').css('top', dropdownContainer.position()
							.top - 8);
					} else {
						dropdownContainer.find('.app-modules-dropdown').css('top', '');
					}
					dropdownContainer.addClass('open').find('.app-item').addClass('active-app-item');
				}
			}, function(e) {
				var dropdownContainer = jQuery(e.currentTarget);
				dropdownContainer.find('.app-item').removeClass('active-app-item');
				setTimeout(function() {
					if (dropdownContainer.find('.app-modules-dropdown').length && !dropdownContainer
						.find('.app-modules-dropdown').is(':hover') && !dropdownContainer.is(':hover')
					) {
						dropdownContainer.removeClass('open');
					}
				}, 500);

			});
			jQuery('.app-item').on('click', function() {
				var url = jQuery(this).data('defaultUrl');
				if (url) {
					window.location.href = url;
				}
			});

			jQuery(window).resize(function() {
				jQuery(".app-modules-dropdown").mCustomScrollbar("destroy");
				app.helper.showVerticalScroll(jQuery(".app-modules-dropdown").not(
					'.dropdown-modules-compact'), {
					setHeight: $(window).height(),
					autoExpandScrollbar: true
				});
				jQuery('.dropdown-modules-compact').each(function() {
					var element = jQuery(this);
					var heightPer = parseFloat(element.data('height'));
					app.helper.showVerticalScroll(element, {
						setHeight: $(window).height() * heightPer - 3,
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
					setHeight: $(window).height() * heightPer - 3,
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
			<th class="NoBackGround" rowspan="2">Customer</th>
			<th class="NoBackGround" colspan="3">EQPT UNDER CONTRACT</th>
			<th class="NoBackGround" colspan="6">OFF ROAD ON ACCOUNT OF</th>
		</tr>
		<tr>
			<th class="NoBackGround">TOTAL</th>
			<th class="NoBackGround">ON</th>
			<th class="NoBackGround">OFF</th>
			<th class="NoBackGround">ENGINE</th>
			<th class="NoBackGround">TRUCK</th>
			<th class="NoBackGround">H&P</th>
			<th class="NoBackGround">EM</th>
			<th class="NoBackGround">Vendors</th>
			<th class="NoBackGround">CUST</th>
		</tr>
		{foreach item=NAME_FIELD key=KEY_FIELD from=$ResultArray}
			{foreach item=INNER_VALUE key=INNER_KEY from=$NAME_FIELD name=foo}
				<tr>
					{if $smarty.foreach.foo.first}
						<th rowspan="{$NAME_FIELD|@count}" class="NoBackGround">{$KEY_FIELD}</th>
					{/if}
					{foreach item=INNER_VALUE1 key=INNER_KEY1 from=$INNER_VALUE}
						{if $INNER_VALUE1 eq '0'}
							<th rowspan="1" class="NoBackGround"></th>
						{else}
							<th rowspan="1" class="NoBackGround">{$INNER_VALUE1}</th>
						{/if}
					{/foreach}
				</tr>
			{/foreach}
		{/foreach}
	</table>
	</div>
{/strip}
{include file="foot.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}