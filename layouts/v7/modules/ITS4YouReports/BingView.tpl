{if '' !== $API_KEY}
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key={$API_KEY}' async defer></script>
    <script type='text/javascript'>
        var map, infobox;
        {assign var=CENTERED_MAP value='0'}

        function GetMap() {
            console.log('map zoom: {$MAP_ZOOM}');
            console.log('map zoom: {$MAP_ZOOM}');
            map = new Microsoft.Maps.Map('#R4YouMap', {
                zoom: {$MAP_ZOOM},
                credentials: '{$API_KEY}'
            });

            //Create an infobox at the center of the map but don't show it.
            infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
                visible: false
            });

            //Assign the infobox to a map instance.
            infobox.setMap(map);

            //Create random locations in the map bounds.
            {foreach item=PIN_DATA key=PIN_I from=$FOUND_DATA}
            var lat = parseFloat({$PIN_DATA['0']});
            var long = parseFloat({$PIN_DATA['1']});
            var loc = new Microsoft.Maps.Location(lat, long);

            /** Center view */
                    {if '0' === $CENTERED_MAP}
                    {assign var=CENTER_MAP value="map.setView({ center: new Microsoft.Maps.Location(lat, long)});"}
                    {$CENTER_MAP}
                    {assign var=CENTERED_MAP value='1'}
                    {/if}

            var pin = new Microsoft.Maps.Pushpin(loc);
            if (0 < `{$PIN_DATA['3']|count_characters}` && 0 < `{$PIN_DATA['4']|count_characters}`) {
                pin.metadata = {
                    title: ``,
                    description: `{$PIN_DATA['3']}<br><br>{$PIN_DATA['4']}<br><i>{$PIN_DATA['2']}</i>`
                };
            } else if (0 < `{$PIN_DATA['3']|count_characters}`) {
                pin.metadata = {
                    title: ``,
                    description: `{$PIN_DATA['3']}<br><br><i>{$PIN_DATA['2']}</i>`
                };
            } else if (0 < `{$PIN_DATA['2']|count_characters}`) {
                pin.metadata = {
                    title: ``,
                    description: `<i>{$PIN_DATA['2']}</i>`
                };
            }
            //Add a click event handler to the pushpin.
            Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
            //Add pushpin to the map.
            map.entities.push(pin);
            {/foreach}
        }

        function get_html_translation_table(table, quote_style) {
            var entities = {},
                hash_map = {},
                decimal;
            var constMappingTable = {},
                constMappingQuoteStyle = {};
            var useTable = {},
                useQuoteStyle = {};

            // Translate arguments
            constMappingTable[0] = 'HTML_SPECIALCHARS';
            constMappingTable[1] = 'HTML_ENTITIES';
            constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
            constMappingQuoteStyle[2] = 'ENT_COMPAT';
            constMappingQuoteStyle[3] = 'ENT_QUOTES';

            useTable = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';
            useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() :
                'ENT_COMPAT';

            if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
                throw new Error('Table: ' + useTable + ' not supported');
                // return false;
            }

            entities['38'] = '&amp;';
            if (useTable === 'HTML_ENTITIES') {
                entities['160'] = '&nbsp;';
                entities['161'] = '&iexcl;';
                entities['162'] = '&cent;';
                entities['163'] = '&pound;';
                entities['164'] = '&curren;';
                entities['165'] = '&yen;';
                entities['166'] = '&brvbar;';
                entities['167'] = '&sect;';
                entities['168'] = '&uml;';
                entities['169'] = '&copy;';
                entities['170'] = '&ordf;';
                entities['171'] = '&laquo;';
                entities['172'] = '&not;';
                entities['173'] = '&shy;';
                entities['174'] = '&reg;';
                entities['175'] = '&macr;';
                entities['176'] = '&deg;';
                entities['177'] = '&plusmn;';
                entities['178'] = '&sup2;';
                entities['179'] = '&sup3;';
                entities['180'] = '&acute;';
                entities['181'] = '&micro;';
                entities['182'] = '&para;';
                entities['183'] = '&middot;';
                entities['184'] = '&cedil;';
                entities['185'] = '&sup1;';
                entities['186'] = '&ordm;';
                entities['187'] = '&raquo;';
                entities['188'] = '&frac14;';
                entities['189'] = '&frac12;';
                entities['190'] = '&frac34;';
                entities['191'] = '&iquest;';
                entities['192'] = '&Agrave;';
                entities['193'] = '&Aacute;';
                entities['194'] = '&Acirc;';
                entities['195'] = '&Atilde;';
                entities['196'] = '&Auml;';
                entities['197'] = '&Aring;';
                entities['198'] = '&AElig;';
                entities['199'] = '&Ccedil;';
                entities['200'] = '&Egrave;';
                entities['201'] = '&Eacute;';
                entities['202'] = '&Ecirc;';
                entities['203'] = '&Euml;';
                entities['204'] = '&Igrave;';
                entities['205'] = '&Iacute;';
                entities['206'] = '&Icirc;';
                entities['207'] = '&Iuml;';
                entities['208'] = '&ETH;';
                entities['209'] = '&Ntilde;';
                entities['210'] = '&Ograve;';
                entities['211'] = '&Oacute;';
                entities['212'] = '&Ocirc;';
                entities['213'] = '&Otilde;';
                entities['214'] = '&Ouml;';
                entities['215'] = '&times;';
                entities['216'] = '&Oslash;';
                entities['217'] = '&Ugrave;';
                entities['218'] = '&Uacute;';
                entities['219'] = '&Ucirc;';
                entities['220'] = '&Uuml;';
                entities['221'] = '&Yacute;';
                entities['222'] = '&THORN;';
                entities['223'] = '&szlig;';
                entities['224'] = '&agrave;';
                entities['225'] = '&aacute;';
                entities['226'] = '&acirc;';
                entities['227'] = '&atilde;';
                entities['228'] = '&auml;';
                entities['229'] = '&aring;';
                entities['230'] = '&aelig;';
                entities['231'] = '&ccedil;';
                entities['232'] = '&egrave;';
                entities['233'] = '&eacute;';
                entities['234'] = '&ecirc;';
                entities['235'] = '&euml;';
                entities['236'] = '&igrave;';
                entities['237'] = '&iacute;';
                entities['238'] = '&icirc;';
                entities['239'] = '&iuml;';
                entities['240'] = '&eth;';
                entities['241'] = '&ntilde;';
                entities['242'] = '&ograve;';
                entities['243'] = '&oacute;';
                entities['244'] = '&ocirc;';
                entities['245'] = '&otilde;';
                entities['246'] = '&ouml;';
                entities['247'] = '&divide;';
                entities['248'] = '&oslash;';
                entities['249'] = '&ugrave;';
                entities['250'] = '&uacute;';
                entities['251'] = '&ucirc;';
                entities['252'] = '&uuml;';
                entities['253'] = '&yacute;';
                entities['254'] = '&thorn;';
                entities['255'] = '&yuml;';
            }

            if (useQuoteStyle !== 'ENT_NOQUOTES') {
                entities['34'] = '&quot;';
            }
            if (useQuoteStyle === 'ENT_QUOTES') {
                entities['39'] = '&#39;';
            }
            entities['60'] = '&lt;';
            entities['62'] = '&gt;';

            // ascii decimals to real symbols
            for (decimal in entities) {
                if (entities.hasOwnProperty(decimal)) {
                    hash_map[String.fromCharCode(decimal)] = entities[decimal];
                }
            }

            return hash_map;
        }

        function html_entity_decode(string, quote_style) {
            var hash_map = {},
                symbol = '',
                tmp_str = '',
                entity = '';
            tmp_str = string.toString();

            if (false === (hash_map = get_html_translation_table('HTML_ENTITIES', quote_style))) {
                return false;
            }

            // fix &amp; problem
            // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
            delete(hash_map['&']);
            hash_map['&'] = '&amp;';

            for (symbol in hash_map) {
                entity = hash_map[symbol];
                tmp_str = tmp_str.split(entity)
                    .join(symbol);
            }
            tmp_str = tmp_str.split('&#039;')
                .join("'");

            return tmp_str;
        }

        function pushpinClicked(e) {
            //Make sure the infobox has metadata to display.
            if (e.target.metadata) {
                //Set the infobox options with the metadata of the pushpin.
                infobox.setOptions({
                    location: e.target.getLocation(),
                    title: e.target.metadata.title,
                    description: e.target.metadata.description,
                    visible: true
                });
                var htmlElement = html_entity_decode(document.getElementsByClassName('infobox-title')[0].innerHTML);
                document.getElementsByClassName('infobox-title')[0].innerHTML = htmlElement;
            }
        }
    </script>
    {if '1' eq $DEV_MODE}
        <div id="R4YouMap" style='position: absolute; bottom: 0; right: 0; width: 50%;height: 50%;'></div>
    {else}
        <div id="R4YouMap" style='position: absolute; bottom: 0; right: 0; width: 100%;height: 100%;'></div>
    {/if}
{else}
    API Key can not be empty!
{/if}
