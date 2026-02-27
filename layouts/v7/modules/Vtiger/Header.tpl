{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{strip}
<!DOCTYPE html>
<html>
	<head>
		<title>{vtranslate($PAGETITLE, $QUALIFIED_MODULE)}</title>
        <link rel="SHORTCUT ICON" href="layouts/v7/skins/images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<link type='text/css' rel='stylesheet' href='layouts/v7/lib/todc/css/bootstrap.min.css'>
		<link type='text/css' rel='stylesheet' href='layouts/v7/lib/todc/css/docs.min.css'>
		<link type='text/css' rel='stylesheet' href='layouts/v7/lib/todc/css/todc-bootstrap.min.css'>
		<link type='text/css' rel='stylesheet' href='layouts/v7/lib/font-awesome/css/font-awesome.min.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/jquery/select2/select2.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/select2-bootstrap/select2-bootstrap.css'>
        <link type='text/css' rel='stylesheet' href='libraries/bootstrap/js/eternicode-bootstrap-datepicker/css/datepicker3.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/jquery/jquery-ui-1.11.3.custom/jquery-ui.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/vt-icons/style.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/animate/animate.min.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/jquery/malihu-custom-scrollbar/jquery.mCustomScrollbar.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/jquery/jquery.qtip.custom/jquery.qtip.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/lib/jquery/daterangepicker/daterangepicker.css'>
        <link type='text/css' rel='stylesheet' href='layouts/v7/uichanges.css'>
        <link rel="stylesheet" href="layouts/v7/modules/Chatbot/resources/crmchatbot.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <input type="hidden" id="inventoryModules" value={ZEND_JSON::encode($INVENTORY_MODULES)}>
        
        {assign var=V7_THEME_PATH value=Vtiger_Theme::getv7AppStylePath($SELECTED_MENU_CATEGORY)}
        {if strpos($V7_THEME_PATH,".less")!== false}
            <link type="text/css" rel="stylesheet/less" href="{vresource_url($V7_THEME_PATH)}" media="screen" />
        {else}
            <link type="text/css" rel="stylesheet" href="{vresource_url($V7_THEME_PATH)}" media="screen" />
        {/if}
        
        {foreach key=index item=cssModel from=$STYLES}
			<link type="text/css" rel="{$cssModel->getRel()}" href="{vresource_url($cssModel->getHref())}" media="{$cssModel->getMedia()}" />
		{/foreach}

		{* For making pages - print friendly *}
		<style type="text/css">
            @media print {
            .noprint { display:none; }
		}
		</style>
	    <script type="text/javascript">var __pageCreationTime = (new Date()).getTime();</script>
		<script src="{vresource_url('layouts/v7/lib/jquery/jquery.min.js')}"></script>
        <script src="{vresource_url('layouts/v7/lib/jquery/fp.min.js')}"></script>
		<script src="{vresource_url('layouts/v7/lib/jquery/jquery-migrate-1.0.0.js')}"></script>
		<script type="text/javascript">
			{*var _META = { 'module': "{$MODULE}", view: "{$VIEW}", 'parent': "{$PARENT_MODULE}", 'notifier':"{$NOTIFIER_URL}", 'app':"{if isset($SELECTED_MENU_CATEGORY)} {$SELECTED_MENU_CATEGORY}{/if}" };*}
            var _META = {
    'module': "{$MODULE}",
    'view': "{$VIEW}",
    'parent': "{$PARENT_MODULE}",
    'notifier': "{$NOTIFIER_URL}",
    'app': "{if isset($SELECTED_MENU_CATEGORY)}{$SELECTED_MENU_CATEGORY}{/if}"
};
            {if $EXTENSION_MODULE}
                var _EXTENSIONMETA = { 'module': "{$EXTENSION_MODULE}", view: "{$EXTENSION_VIEW}"};
            {/if}
            var _USERMETA;
            {if $CURRENT_USER_MODEL}
               _USERMETA =  { 'id' : "{$CURRENT_USER_MODEL->get('id')}", 'menustatus' : "{$CURRENT_USER_MODEL->get('leftpanelhide')}", 
                              'currency' : "{decode_html($USER_CURRENCY_SYMBOL)}", 'currencySymbolPlacement' : "{$CURRENT_USER_MODEL->get('currency_symbol_placement')}",
                          'currencyGroupingPattern' : "{$CURRENT_USER_MODEL->get('currency_grouping_pattern')}", 'truncateTrailingZeros' : "{$CURRENT_USER_MODEL->get('truncate_trailing_zeros')}",'userlabel':"{decode_html($CURRENT_USER_MODEL->get('userlabel'))}",};
            {/if}
		</script>
	</head>
	 {assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
	<body data-skinpath="{Vtiger_Theme::getBaseThemePath()}" data-language="{$LANGUAGE}" data-user-decimalseparator="{$CURRENT_USER_MODEL->get('currency_decimal_separator')}" data-user-dateformat="{$CURRENT_USER_MODEL->get('date_format')}"
          data-user-groupingseparator="{$CURRENT_USER_MODEL->get('currency_grouping_separator')}" data-user-numberofdecimals="{$CURRENT_USER_MODEL->get('no_of_currency_decimals')}" data-user-hourformat="{$CURRENT_USER_MODEL->get('hour_format')}"
          data-user-calendar-reminder-interval="{$CURRENT_USER_MODEL->getCurrentUserActivityReminderInSeconds()}">
            <input type="hidden" id="start_day" value="{$CURRENT_USER_MODEL->get('dayoftheweek')}" /> 
		<div id="page">
            <div id="pjaxContainer" class="hide noprint"></div>
            <div id="messageBar" class="hide"></div>
    {if $VIEW neq 'Login'}
        {include file="layouts/v7/modules/Chatbot/Chatbot.tpl"}
        <div id="crm-chatbot-icon">🤖</div>
    {/if}
    {literal}
    <script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {

    jQuery('.chat-shell').hide();

    jQuery('#crm-chatbot-icon').on('click', function () {
        jQuery('.chat-shell').toggle();
    });

    var input   = document.getElementById("chatInput");
    var sendBtn = document.getElementById("sendBtn");
    var chatBody = document.getElementById("chatBody");

    if (!input || !sendBtn || !chatBody) {
        console.warn("Chatbot DOM not found");
        return;
    }

    function appendUserMessage(text) {
        var div = document.createElement("div");
        div.className = "bubble msg-user";
        div.innerText = text;
        chatBody.appendChild(div);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function appendBotMessage(message) {
        var msgDiv = document.createElement('div');
        msgDiv.className = 'bot-message';
        msgDiv.innerHTML = message;
        chatBody.appendChild(msgDiv);
    }

    function appendLoading() {
        var div = document.createElement("div");
        div.className = "bubble msg-bot loading";
        div.id = "botLoading";
        div.innerText = "Typing...";
        chatBody.appendChild(div);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function removeLoading() {
        var loader = document.getElementById("botLoading");
        if (loader) loader.remove();
    }

    function playBotAudio(base64Audio) {
        var audio = new Audio('data:audio/mp3;base64,' + base64Audio);
        audio.play().catch(function (err) {
            console.warn('Audio play failed', err);
        });
    }

    /* Voice Input (Speech to Text) */
    var recognition;
    var isListening = false;

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();

        recognition.lang = 'en-US';
        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.onstart = function () {
            isListening = true;
            jQuery('#micBtn').addClass('listening');
        };

        recognition.onend = function () {
            isListening = false;
            jQuery('#micBtn').removeClass('listening');
        };

        recognition.onerror = function (event) {
            console.error('Speech recognition error:', event.error);
            jQuery('#micBtn').removeClass('listening');
        };

        recognition.onresult = function (event) {
            var transcript = event.results[0][0].transcript.trim();
            input.value = transcript;
            sendMessage();
        };

        jQuery('#micBtn').on('click', function () {
            if (isListening) {
                recognition.stop();
            } else {
                recognition.start();
            }
        });

    } else {
        console.warn('Speech recognition not supported in this browser');
        jQuery('#micBtn').hide();
    }

    function sendMessage() {
        var message = input.value.trim();
        if (!message) return;

        appendUserMessage(message);
        input.value = "";
        appendLoading();

        var params = new URLSearchParams({
            module: "Chatbot",
            action: "Ask",
            mode: "ajax",
            question: message
        });

        fetch("index.php?" + params.toString())
        .then(function(res) {
            return res.json();
        })
        .then(function(data) {
            removeLoading();
            if (!data.success) {
                appendBotMessage("Something went wrong.");
                return;
            }

            console.log(data.result);
            if (data.result.text) {
                appendBotMessage(data.result.text);
            }

            if (data.result.leads && data.result.leads.length > 0) {
                for (var i = 0; i < data.result.leads.length; i++) {
                    var lead = data.result.leads[i];
                    var name = ((lead.firstname || '') + ' ' + (lead.lastname || '')).trim();

                    appendBotMessage(
                        '<div class="chatbot-lead-card">' +
                            '<b>Lead ' + (i + 1) + ': ' + name + '</b><br>' +
                            '📞 Mobile: ' + (lead.mobile || '-') + '<br>' +
                            '📌 Status: ' + lead.lead_status + '<br>' +
                            '⚡ Priority: ' + lead.priority + '<br>' +
                            '👤 Assigned: ' + lead.assigned_to + '<br>' +
                            '🕒 Created: ' + lead.created_time +
                        '</div>'
                    );
                }
            }

            if (data.result.audio) {
                playBotAudio(data.result.audio);
            }
        })
        .catch(function(err) {
            removeLoading();
            console.error('Fetch error:', err);
            appendBotMessage("Connection error. Please try again.");
        });
    }

    sendBtn.addEventListener("click", sendMessage);

    input.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            sendMessage();
        }
    });

});
</script>
{/literal}
   