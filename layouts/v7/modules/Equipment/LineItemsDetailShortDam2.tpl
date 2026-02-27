<input type="hidden" class="isCustomFieldExists" value="false">
{assign var=FINAL_DETAILS value=$RELATED_PRODUCTS_OTHER1.1.final_details}
<div class="details block">
    <div class="lineItemTableDiv">
        <table class="table table-bordered lineItemsTable" style = "margin-top:15px">
            <thead>
                <th colspan="{$COL_SPAN1}" class="lineItemBlockHeader">
                    Aggregate Name
                </th>
                <th colspan="{$COL_SPAN1}" class="lineItemBlockHeader">
                    Aggregate Equipment Serial Number
                </th>
                <th colspan="{$COL_SPAN1}" class="lineItemBlockHeader">
                    Aggregate Warranty Details
                </th>
                <th colspan="{$COL_SPAN1}" class="lineItemBlockHeader">
                    Serial Number
                </th>
            </thead>
            <tbody>
                {foreach key=INDEX item=LINE_ITEM_DETAIL from=$AllAggregatesInfo}
                    <tr>
                        <td>
                            {{$LINE_ITEM_DETAIL['aggregateLabel']}} 
                        </td>
                        <td>
                            {{$LINE_ITEM_DETAIL['aggregateInfo']['equipment_sl_no']}}
                        </td>
                        <td>
                            {{$LINE_ITEM_DETAIL['aggregateInfo']['equip_war_terms']}} 
                        </td>
                        <td>
                            {{$LINE_ITEM_DETAIL['aggregateInfo']['equip_ag_serial_no']}}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>