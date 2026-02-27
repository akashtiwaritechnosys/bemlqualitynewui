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
        <table>
            <tr>
                <th class="NoBackGround"><b style="font-weight: 900">Report Label</b></th>
            </tr>
            {foreach item=NAME_FIELD key=KEY_FIELD from=$ResultArray}
                <tr>
                    <th class="NoBackGround"><a href="{$NAME_FIELD['url']}">{$NAME_FIELD['label']}</a></th>
                </tr>
            {/foreach}
        </table>
    </div>
{/strip}