{block name="title" prepend}{$LNG.lm_playercard}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner player_card" style="width:auto;">
    <div class="gray_stripe">
      	{if $HonourStatus != 'none'}<span class="honorRank {$HonourStatus}">&nbsp;</span>{/if} {$name} &nbsp;&nbsp;&nbsp;
        <span style="color:#999;">{$LNG.pl_homeplanet}:
        	<a href="#" onclick="parent.location = 'game.php?page=galaxy&amp;galaxy={$galaxy}&amp;system={$system}';return false;">{$homeplanet} [{$galaxy}:{$system}:{$planet}]</a>
        &nbsp;&nbsp;&nbsp;
        	 {$LNG.pl_ally}: {if $allyname}<a href="#" onclick="parent.location = 'game.php?page=alliance&amp;mode=info&amp;id={$allyid}';return false;">{$allyname}</a> {if $ally_fraction_id != 0}<img alt="" title="" class="fraction_ico_mini_t" src="styles/images/alliance/fraction_{$ally_fraction_id}.png">{/if}{else}{/if}        </span> 
   

   </div> 
    
	{if $id == $yourid}
    <form action="game.php?page=playerCard" method="post" id="form">
    <input name="save" value="true" type="hidden">
    <div class="left_part" style="width: 55%;">
        <div class="ally_contents" style="padding: 5px 10px 10px 10px;">
		<img title="" src="{$useravatar}" style="float:left;height:85px;width:85px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
        	            <p style="float: right;line-height: 22px;">{$LNG.op_username}: <input name="p_name" value="{$firstname}" maxlength="16" type="text" style="width: 150px;float: right;margin-left: 10px;"></p>
            <p style="float: right;line-height: 22px;">{$LNG.playerc_1}: <select name="p_country" style="width: 158px;float: right;margin-left: 10px;">
<option value="{if $country != ''}{$country}{else}{/if}">{if $country != ''}{$country}{else}Country...{/if}</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select></p>
            <p style="float: right;line-height: 22px;">{$LNG.playerc_2}: <input name="p_city" value="{$city}" maxlength="24" type="text" style="width: 150px;float: right;margin-left: 10px;"></p>
                   
        </div>
    </div> 
    
	<div class="right_part" style="width:45%;">
        <div class="ally_contents" style="padding: 5px 10px 10px 10px;margin-right:10px;">
        	            <p style="float: right;line-height: 22px;">{$LNG.playerc_3}: <input name="p_age" value="{$age}" min="0" max="999" type="number" style="width: 150px;float: right;margin-left: 10px;"></p>
            <p style="float: right;line-height: 22px;">{$LNG.playerc_4}: <input name="p_style_game" value="{$playstyle}" maxlength="24" type="text" style="width: 150px;float: right;margin-left: 10px;"></p>
            <p style="float: right;line-height: 22px;">{$LNG.playerc_5}: <input name="p_communication" value="{$skype}" maxlength="24" type="text" style="width: 150px;float: right;margin-left: 10px;"></p>            
                    
        </div>
    </div>  
	<div class="clear"></div>    
    
    <div class="gray_stripe build_band ticket_bottom_band" style="padding-left:6px;">
    	 {$LNG.playerc_10}
                	<input class="bottom_band_submit" value="{$LNG.playerc_7}" type="submit" style="-moz-border-radius: 0px 0px 0px;-webkit-border-radius: 0px 0px 0px 0px;border-radius: 0px 0px 0px;margin-right: 4px;">
    	    </div>    
    </form>
	{else}
    <div class="left_part" style="width: 55%;">
        <div class="ally_contents" style="padding: 5px 10px 10px 10px;">
		<img title="" src="{$useravatar1}" style="float:left;height:85px;width:85px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin-right: 20px;    margin-bottom: 6px;">
        	            <p style="margin-top: 10px;">{$LNG.op_username}: <font style="color:#5ca6aa">{$firstname}</font></p>
            <p>{$LNG.playerc_1}: <font style="color:#5ca6aa">{$country}</font></p>
            <p>{$LNG.playerc_2}: <font style="color:#5ca6aa">{$city}</font></p>
                   
        </div>
    </div> 
    
	<div class="right_part" style="width:45%;">
        <div class="ally_contents" style="padding: 5px 10px 10px 10px;margin-right:10px;">
        	            <p style="margin-top: 10px;">{$LNG.playerc_3}: <font style="color:#5ca6aa">{$age}</font></p>
            <p>{$LNG.playerc_4}: <font style="color:#5ca6aa">{$playstyle}</font></p>
            <p>{$LNG.playerc_5}: <font style="color:#5ca6aa">{$skype}</font></p>            
                    
        </div>
    </div>  
    <div class="clear"></div>    
     <div class="gray_stripe build_band ticket_bottom_band" style="padding-left:6px;    margin-bottom:4px;">
	 {$LNG.playerc_10}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <a style="color:#999;"class="tooltip" data-tooltip-content="{$LNG.op_block_pm}" target="_parent" href="/game.php?page=BlockList&amp;mode=Add&amp;id={$id}"><img src="../styles/images/iconav/banned-sign.png" style="    float: right;margin-top: 6px;margin-right: 4px;"></a> 
<a style="color:#999;" href="#" onclick="return Dialog.Buddy({$id})">{$LNG.playerc_8}</a> |
        <a style="color:#999;" target="_parent" href="/game.php?page=buddyList&amp;mode=addenemies&amp;id={$id}">{$LNG.playerc_9}</a> 
       	<a class="bd_dm_buy" href="#" onclick="return Dialog.PM({$id});" title="{$LNG.st_write_message}" style="-moz-border-radius: 0px 0px 0px;-webkit-border-radius: 0px 0px 0px 0px;border-radius: 0px 0px 0px;margin-right: 4px;">{$LNG.st_write_message}</a>
		

            </div>    
    </form>

    {/if}
	{if $displayadsmd == 1}
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>{/if}
           
        <div style="cursor:pointer;margin-top: 3px;padding: 2px 6px;" class="record_header0" onclick="$('#achive_general').stop(false, true).slideToggle();">
        	 {$LNG.achiev_3}
            <div class="record_header_top_lineo"></div>
            <div class="record_header_bottom_lineo"></div>
        </div> 
        <div id="achive_general" class="playercard_achive_block" style="display: block;margin-top:4px;">
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_common_1_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_level.png">
                <div class="playercard_achive_block_lvl">{$achievement_common_1}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_common_2_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_batle_level.png">
                <div class="playercard_achive_block_lvl">{$achievement_common_2}</div>
            </div>
                        <div class="clear"></div>
        </div>
           
        <div style="cursor:pointer;margin-top: 4px;padding: 2px 6px;" class="record_header0" onclick="$('#achive_build').stop(false, true).slideToggle();">
        	 {$LNG.achiev_5}
            <div class="record_header_top_lineo"></div>
            <div class="record_header_bottom_lineo"></div>
        </div> 
        <div id="achive_build" class="playercard_achive_block" style="display: block;margin-top:4px;">
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_1_title}">
                <img alt="Добытчик металла" src="styles/images/achiev/ach_mine_metal.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_1}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_2_title}">
                <img alt="Добытчик кристалла" src="styles/images/achiev/ach_crystal_mine.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_2}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_3_title}">
                <img alt="Добытчик дейтерия" src="styles/images/achiev/ach_deuterium_sintetizer.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_3}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_4_title}">
                <img alt="Легкий конвейер" src="styles/images/achiev/ach_conveyor1.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_4}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_5_title}">
                <img alt="Средний конвейер" src="styles/images/achiev/ach_conveyor2.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_5}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_6_title}">
                <img alt="Тяжёлый конвейер" src="styles/images/achiev/ach_conveyor3.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_6}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_7_title}">
                <img alt="Технополис" src="styles/images/achiev/ach_university.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_7}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_8_title}">
                <img alt="Лунная база" src="styles/images/achiev/ach_mondbasis.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_8}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_9_title}">
                <img alt="Сенсорная фаланга" src="styles/images/achiev/ach_phalanx.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_9}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_build_10_title}">
                <img alt="Терраформер" src="styles/images/achiev/ach_terraformer.png">
                <div class="playercard_achive_block_lvl">{$achievement_build_10}</div>
            </div>
                        <div class="clear"></div>
        </div>
		
		<div style="cursor:pointer;margin-top: 3px;padding: 2px 6px;" class="record_header0" onclick="$('#achive_tech').stop(false, true).slideToggle();">
        	 {$LNG.achiev_6}
            <div class="record_header_top_lineo"></div>
            <div class="record_header_bottom_lineo"></div>
        </div> 
        <div id="achive_tech" class="playercard_achive_block" style="display: block;margin-top:4px;">
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_1_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_spy_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_1}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_2_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_computer_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_2}</div>
            </div>
			
			<div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_3_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_war_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_3}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_4_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_expedition_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_4}</div>
            </div>
			
			<div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_5_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_gravity_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_5}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_6_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_gun_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_6}</div>
            </div>
			
			<div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_7_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_energy_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_7}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_8_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_bank_ally_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_8}</div>
            </div>
			
			<div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_9_title}">
                <img alt="Мирный" src="styles/images/achiev/ach_motor_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_9}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_tech_10_title}">
                <img alt="Ветеран" src="styles/images/achiev/ach_mining_tech.png">
                <div class="playercard_achive_block_lvl">{$achievement_tech_10}</div>
            </div>
                        <div class="clear"></div>
        </div>
           
       <!-- <div style="cursor:pointer;" class="record_header" onclick="$('#achive_fleet').stop(false, true).slideToggle();">
        	{$LNG.achiev_7}
            <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
        </div> 
        <div id="achive_fleet" class="playercard_achive_block">
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_1_title}">
                <img alt="Флот Истребителей" src="styles/images/achiev/ach_hunter_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_1}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_2_title}">
                <img alt="Флот Поддержки" src="styles/images/achiev/ach_support_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_2}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_3_title}">
                <img alt="Боевой флот" src="styles/images/achiev/ach_battle_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_3}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_4_title}">
                <img alt="Флот Разрушения" src="styles/images/achiev/ach_destruction_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_4}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_5_title}">
                <img alt="Флот Осады" src="styles/images/achiev/ach_siege_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_5}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_6_title}">
                <img alt="Тяжелый флот" src="styles/images/achiev/ach_heavy_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_6}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_fleet_7_title}">
                <img alt="Имперский флот" src="styles/images/achiev/ach_emperor_fleet.png">
                <div class="playercard_achive_block_lvl">{$achievement_fleet_7}</div>
            </div>
                        <div class="clear"></div>
        </div>-->
           
        <div style="cursor:pointer;margin-top: 4px;padding: 2px 6px;" class="record_header0" onclick="$('#achive_varia').stop(false, true).slideToggle();">
        	 {$LNG.achiev_9}
            <div class="record_header_top_lineo"></div>
            <div class="record_header_bottom_lineo"></div>
        </div> 
        <div id="achive_varia" class="playercard_achive_block" style="display: block;margin-top:4px;">
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_1_title}">
                <img alt="Боец" src="styles/images/achiev/ach_wons.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_1}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_2_title}">
                <img alt="Уничтожитель лун" src="styles/images/achiev/ach_destroyer_moons.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_2}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_3_title}">
                <img alt="Лунодел" src="styles/images/achiev/ach_creation_moons.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_3}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_5_title}">
                <img alt="Удачная экспедиция" src="styles/images/achiev/ach_expedition.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_5}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_6_title}">
                <img alt="Искатель материи" src="styles/images/achiev/ach_found_tm.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_6}</div>
            </div>
                 <!--       <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_7_title}">
                <img alt="Искатель апгрейдов" src="styles/images/achiev/ach_found_up.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_7}</div>
            </div>
                        <div class="playercard_achive_blocks tooltip" data-tooltip-content="{$achievement_varia_8_title}">
                <img alt="Интегратор апгрейдов" src="styles/images/achiev/ach_action_up.png">
                <div class="playercard_achive_block_lvl">{$achievement_varia_8}</div>
            </div>-->
                        <div class="clear" ></div>
        </div>
        <div class="clear" style="height:4px"></div>
    <div class="left_part" style="width:50%;">	        	
        <table class="tablesorter ally_ranks playercard_tables">
            <tbody><tr>
                <th class="gray_stripe">{$LNG.allian_2} </th>
                <th class="gray_stripe">{$LNG.gl_points}</th>
                <th class="gray_stripe">{$LNG.st_position}</th>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_builds}</td>
                <td>{$build_points}</td>
                <td>
                    {$build_rank} 
                    | {$rankInfo2}               </td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_tech}</td>
                <td>{$tech_points}</td>
                <td>
                    {$tech_rank}
                    | {$rankInfo1}                </td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_fleet}</td>
                <td>{$fleet_points}</td>
                <td>
                    {$fleet_rank}
                    | {$rankInfo4}               </td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_def}</td>
                <td>{$defs_points}</td>
                <td>
                    {$defs_rank}
                    | {$rankInfo3}                </td>
            </tr>

    	</tbody></table>
    </div>
    
<div class="right_part" style="width:50%;">	        	
        <table class="tablesorter ally_ranks playercard_tables">
            <tbody><tr>
                <th class="gray_stripe">{$LNG.allian_2} </th>
                <th class="gray_stripe">{$LNG.gl_points}</th>
                <th class="gray_stripe">{$LNG.st_position}</th>
            </tr>
          
            <tr>
                <td style="text-align:left;">{$LNG.playerc_6}</td>
                <td>{$ach_points}</td>
                <td>
                    {$ach_rank}
                    | {$rankInfo5}                </td>
            </tr>
             <tr>
                <td style="text-align:left;">{$LNG.fl_bonus_attack}</td>
                <td>{$wapeonry_points}</td>
                <td>
                    {$wapeonry_rank}
					| {$rankInfo6}
                                    </td>
            </tr>
			
			 <tr>
                <td style="text-align:left;">Honor</td>
                <td>{$honor_points}</td>
                <td>
                    {$honor_rank}
					| {$rankInfo7}
                                    </td>
            </tr>
			
            <tr>
                <td style="text-align:left;">{$LNG.pl_total}</td>
                <td>{$total_points}</td>
                <td>
                    {$total_rank}
                    | {$rankInfo}                </td>
            </tr>
    	</tbody></table>
    </div>
	
	   <div class="right_part" style="width: 100%;">
        <table class="tablesorter ally_ranks playercard_tables">
            <tbody><tr>
            	<th class="gray_stripe">{$LNG.pl_fightstats}</th>
                <th class="gray_stripe">{$LNG.pl_fights}</th>
                <th class="gray_stripe">{$LNG.pl_fprocent}</th>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_fightwon}</td>
                <td>{$wons}</td>
				<td>{$siegprozent} %</td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_fightdraw}</td>
                <td>{$draws}</td>
				<td>{$drawsprozent} %</td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_fightlose}</td>
                <td>{$loos}</td>
				<td>{$loosprozent} %</td>
            </tr>
            <tr>
                <td style="text-align:left;">{$LNG.pl_totalfight}</td>
                <td>{$totalfights}</td>
                <td>100 %</td>
            </tr> 
    	</tbody></table>  
    </div>
   	<div class="clear"></div>  
          
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
{/block}