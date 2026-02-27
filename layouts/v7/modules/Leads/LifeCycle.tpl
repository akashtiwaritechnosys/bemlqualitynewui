{strip}
    <div style="padding: 40px">
        <style>
            .from-date {
                display: flex;
                flex-direction: column;
                width: 15%;
                margin-top: 5px;
            }

            .date-custom {
                display: flex;
                gap: 20px;
                margin-bottom: 20px;
            }

            .date-input {
                border-radius: 20px;
                padding: 5px 15px;
            }

            .dropdown-select {
                border-radius: 6px;
                padding: 5px 15px;
                margin-bottom: 20px;
            }

            .buttons-form {
                display: flex;
                gap: 20px;
                margin-top: 20px;
            }

            .btn-form {
                padding: 10px 20px;
                border-radius: 6px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
            }

            .label-date {
                padding-left: 15px;
            }

            .date-range {
                margin-bottom: 20px;
            }

            .date-option {
                margin-bottom: 5px;
            }

            .ticket-form {
                align-items: center;
            }

            .ticket-type-form label {
                display: inline-block;
                width: 140px;
            }

            .ticket-type-form select {
                width: 200px;
            }

            .choice-date {
                display: flex;
                gap: 20px;
            }

            .choice-date label {
                font-size: 16px;
            }

            input[type=checkbox]:checked::after,
            .checkbox input[type=checkbox]:checked::after,
            .checkbox-inline input[type=checkbox]:checked::after {
                top: -2px;
                left: -3px;
            }

            input[type=radio],
            .radio input[type=radio],
            .radio-inline input[type=radio],
            input[type=checkbox],
            .checkbox input[type=checkbox],
            .checkbox-inline input[type=checkbox] {
                width: 20px;
                height: 20px;
            }

            table {
                border-collapse: collapse;
                width: 95%;
                margin-top: 20px;
                margin-left: 20px;
                margin-bottom: 50px;
            }

            th,
            td {
                border: 1px solid #ccc;
                text-align: center;
                padding: 10px;
            }

            th {
                background-color: #f2f2f2;
            }

            .NoBackGround {
                background-color: #ffffff;
            }
        </style>
        {include file="exports.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
    </div>
    <div class="form-group date-range">
        <div class="date-option">
            <label>Date Range:</label>
        </div>
        <div class="choice-date">
            <label><input type="checkbox" name="dateRange[]" value="l MONTH"> Last Month</label>
            <label><input type="checkbox" name="dateRange[]" value="3 MONTH"> Last 3 Months</label>
            <label><input type="checkbox" name="dateRange[]" value="6 MONTH"> Last 6 Months</label>
            <label><input type="checkbox" name="dateRange[]" value="1 YEAR"> Last 1 Year</label>
        </div>
    </div>
    <label>Select Custom Date</label>
    <div class="date-custom">
        <div class="form-group from-date">
            <label class="label-date" for="startDate">From :</label>
            <input class="date-input" type="date" id="fromDate" name="fromDate" placeholder="dd/mm/yyyy">
        </div>
        <div class="form-group from-date">
            <label class="label-date" for="endDate">To :</label>
            <input class="date-input" type="date" id="toDate" name="toDate" placeholder="dd/mm/yyyy">
        </div>
    </div>
    <div class="ticket-type-form">
        <div class="form-group">
            <label for="ticketType">Ticket Type:</label>
            <select class="dropdown-select" id="ticketType" name="ticketType">
                <option value="">Select</option>
                {foreach from=$ticketTypRow item=data}
                    <option {if $ticketType eq trim($data.sr_ticket_type)} selected {/if} value="{$data.sr_ticket_type}">{$data.sr_ticket_type}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <label for="equipmentModel">Equipment Model:</label>
            <select style="min-width:200px" class="dropdown-select select2" multiple id="equipmentModel"
                name="equipmentModel">
                {foreach from=$eqipDataRow item=data}
                    <option {if in_array(Vtiger_Util_Helper::toSafeHTML($data.sr_equip_model), $equipmentModel)} selected {/if} value="{$data.sr_equip_model}">{$data.sr_equip_model}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <label for="warrantyStatus">Warranty Status:</label>
            <select class="dropdown-select" id="warrantyStatus" name="warrantyStatus">
                <option value="">Select</option>
                {foreach from=$warDataRow item=data}
                    <option {if $warrantyStatus eq trim($data.sr_war_status)} selected {/if} value="{$data.sr_war_status}">{$data.sr_war_status}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="form-group buttons-form">
        <button id="loadresults" class="btn-form btn-primary">View</button>
        <button type="button" class="btn-form btn-primary pdfgen">Download</button>
    </div>
    </div>
    <h2></h2>
    {if $typeCategory eq 'TicketType'}
        <table id="data_table" class="NoBackGround">
            <tr>
                <th class="NoBackGround">Total No of Tickets</th>
                <th class="NoBackGround">No. of Open Tickets</th>
                <th class="NoBackGround">No. of Closed Tickets</th>
                <th class="NoBackGround">Response Time</th>
                <th class="NoBackGround">MTTR</th>
            </tr>
            {foreach from=$resultData item=data}
                <tr>
                    <td>{$data.no_of_tickets}</td>
                    <td>{$data.open_tickets}</td>
                    <td>{$data.closed_tickets}</td>
                    <td>--</td>
                    <td>--</td>
                </tr>
            {/foreach}
        </table>
    {/if}
    {if $typeCategory eq 'EquipmentModel'}
        <table id="data_table" class="NoBackGround">
            <tr>
                <th class="NoBackGround">Equipment Model</th>
                <th class="NoBackGround">Total No of Tickets</th>
                <th class="NoBackGround">No.of Open Tickets</th>
                <th class="NoBackGround">No.of Closed Tickets</th>
                <th class="NoBackGround">Response Time</th>
                <th class="NoBackGround">MTTR</th>
            </tr>
            {foreach from=$resultData item=data}
                <tr>
                    <td>{$data.sr_equip_model}</td>
                    <td>{$data.no_of_tickets}</td>
                    <td>{$data.open_tickets}</td>
                    <td>{$data.closed_tickets}</td>
                    <td>--</td>
                    <td>--</td>
                </tr>
            {/foreach}
        </table>
    {/if}
    {if $typeCategory eq 'WarrantyStatus'}
        <table id="data_table" class="NoBackGround">
            <tr>
                <th class="NoBackGround">Equipment Warranty</th>
                <th class="NoBackGround">Total No of Tickets</th>
                <th class="NoBackGround">No.of Open Tickets</th>
                <th class="NoBackGround">No.of Closed Tickets</th>
                <th>Response Time</th>
                <th>MTTR</th>
            </tr>
            {foreach from=$resultData item=data}
                <tr>
                    <td>{$data.sr_war_status}</td>
                    <td>{$data.no_of_tickets}</td>
                    <td>{$data.open_tickets}</td>
                    <td>{$data.closed_tickets}</td>
                    <td>--</td>
                    <td>--</td>
                </tr>
            {/foreach}
        </table>
    {/if}
    {include file="foot.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
{/strip}