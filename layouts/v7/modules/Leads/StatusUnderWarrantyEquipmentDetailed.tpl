{strip}
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
        <table id="data_table">
            <tr>
                <th class="NoBackGround" colspan="{$PickListValues|@count + 2}">
                    <h5>{$REPORT_LABEL}</h1>
                </th>
            </tr>
            <tr>
                {foreach item=INNER_VALUE1 key=INNER_KEY1 from=$headers}
                    <th rowspan="1" class="NoBackGround" class="NoBackGround">
                        <b style="font-weight: 900">
                            {vtranslate($INNER_VALUE1, 'Leads')}
                        </b>
                    </th>
                {/foreach}
            </tr>
            {foreach item=NAME_FIELD1 key=KEY_FIELD from=$ResultArray}
                <tr>{foreach item=INNER_VALUE key=INNER_KEY from=$NAME_FIELD1 name=foo}
                        {if $INNER_VALUE eq '0'}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround"></th>
                        {else}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround">
                                <a>
                                    {$INNER_VALUE}
                                </a>
                            </th>
                        {/if}
                    {/foreach}
                </tr>
            {/foreach}
            <tr>
                <th class="NoBackGround" colspan="{($headers|@count)}">
                    <b style="font-weight: 900">
                        DETAILS OF OFF ROAD EQUIPMENTS UNDER AGGREGATE WARRANTY
                    </b>
                </th>
            </tr>
            {foreach item=NAME_FIELD1 key=KEY_FIELD from=$AgResultArray}
                <tr>{foreach item=INNER_VALUE key=INNER_KEY from=$NAME_FIELD1 name=foo}
                        {if $INNER_VALUE eq '0'}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround"></th>
                        {else}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround">
                                <a>
                                    {$INNER_VALUE}
                                </a>
                            </th>
                        {/if}
                    {/foreach}
                </tr>
            {/foreach}

            <tr>
                <th class="NoBackGround" colspan="{($headers|@count)}">
                    <b style="font-weight: 900">
                        RECOMMISSIONING DETAILS 
                    </b>
                </th>
            </tr>
            {foreach item=NAME_FIELD1 key=KEY_FIELD from=$ResultArrayRemm}
                <tr>{foreach item=INNER_VALUE key=INNER_KEY from=$NAME_FIELD1 name=foo}
                        {if $INNER_VALUE eq '0'}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround"></th>
                        {else}
                            <th rowspan="1" class="NoBackGround" class="NoBackGround">
                                <a>
                                    {$INNER_VALUE}
                                </a>
                            </th>
                        {/if}
                    {/foreach}
                </tr>
            {/foreach}
        </table>
    </div>
    {include file="foot.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
{/strip}