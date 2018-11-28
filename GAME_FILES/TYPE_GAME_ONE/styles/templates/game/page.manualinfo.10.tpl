{block name="title" prepend}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto;">
        <div class="gray_stripe">
		{$LNG.lm_arsenal}
    </div>
        <div class="ally_contents">
		
<font color="#B22222"><b>{$LNG.manual_5_2}:</font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_1}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_2}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_3}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_4}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_5}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_6}
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>	{$LNG.manual_10_7}
<br><br>	
{*
<span onclick="$('#id_2').slideToggle();return false" style="cursor: pointer;"><img alt="" src="/styles/images/Adm/GO.png" height="12"> Орудия</span>
<div style="display:  none; clear: both;" id="id_2">


<br><img alt="" src="/styles/theme/gow/gebaeude/up/laser.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Лазерное орудие</b> - устанавливается на Флот/Оборону 
<br>Пробивает Броню/щиты Легкие:  <font color="#87CEEB"><b>125%</b></font> <b> | </b> Средние:   <font color="#87CEFA"><b>100%</b></font>  <b> | </b> Тяжелые:  <font color="#4682B4"><b>50%</b> </font>
<br>Увеличивает урон Лазерного орудия на <font color="#32CD32"><b>2,6%</b></font> за успешную активацию.
<br>Используется в: <font color="#BC8F8F"><b>13 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>8 видах Обороны</b></font>

<br><br><font color="#3CB371"><b>Апгрейд Лазерного орудия можно найти: </b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Варваров</b> в сектор "Хостаил" шанс найти апгрейд 5%

	
	
<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/ion.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Ионное орудие</b> - устанавливается на Флот/Оборону
<br>Пробивает Броню/щиты Лёгкие:  <font color="#87CEEB"><b>115%</b></font> <b> | </b> Средние:   <font color="#87CEFA"><b>110%</b></font>  <b> | </b> Тяжелые:  <font color="#4682B4"><b>100%</b> </font>
<br>Увеличивает урон Ионного орудия <font color="#32CD32"><b>2,4%</b></font> за успешную активацию. </b>
<br>Используется в: <font color="#BC8F8F"><b>7 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>10 видах Обороны</b></font>

<br><br><font color="#3CB371"><b>Апгрейд Ионное орудие можно найти: </b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя) 
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Варваров</b> (шанс найти 5%) или <b>Пиратов</b> (шанс найти 8%) в сектор "Хостаил"
	
	
<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/gravity.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Гравитационное орудие</b> - устанавливается на Флот/Оборону 
<br>Пробивает  Броню/щиты Лёгкие:  <font color="#87CEEB"><b>50%</b></font> <b> | </b> Средние:   <font color="#87CEFA"><b>80%</b></font>  <b> | </b> Тяжелые:  <font color="#4682B4"><b>125% </b></font>
<br>Увеличивает урон Гравитационного орудия  <font color="#32CD32"><b>2,5%</b></font> за успешную активацию. </b>
<br>Используется в: <font color="#BC8F8F"><b>8 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>8 видах Обороны</b></font>

<br><br><font color="#3CB371"><b>Апгрейд Гравитационное орудие можно найти: </b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя) 
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Чужих</b> в сектор "Хостаил" шанс найти апгрейд 12%

	
	
<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/plasma.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Плазменное орудие</b> - устанавливается на Флот/Оборону 
<br>Пробивает  Броню/щиты Лёгкие:  <font color="#87CEEB"><b>80%</b></font> <b> | </b> Средние:   <font color="#87CEFA"><b>100%</b></font>  <b> | </b> Тяжелые:  <font color="#4682B4"><b>115%</b> </font>
<br>Увеличивает урон Плазменного орудия <font color="#32CD32"><b>2,3%</b></font> за успешную активацию.</b>
<br>Используется в: <font color="#BC8F8F"><b>6 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>9 видах Обороны</b></font>

<br><br><font color="#3CB371"><b>Апгрейд Плазменного орудия можно найти: </b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя) 
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Пиратов</b> (шанс найти 8%)  или <b>Чужих</b> (шанс найти 12%) в сектор "Хостаил"


<br></div><br>






<span onclick="$('#id_3').slideToggle();return false" style="cursor: pointer;"><img alt="" src="/styles/images/Adm/GO.png" height="12"> Броня</span>
<div style="display:  none; clear: both;" id="id_3">



<br><img alt="" src="/styles/theme/gow/gebaeude/up/d_light.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" > <b>Легкая броня </b>  - устанавливается на Флот/Оборону легкого класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>94%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>470%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Плазменного орудия <font color="#00CD66"><b>20%</b></font> <b> | </b> Гравитационного орудия  <font color="#00CD66"><b>50%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>9 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>4 видах Обороны</b></font>
<br> Увеличивает прочность Легкой брони на <font color="#32CD32"><b>2,5%</b></font> за успешную активацию.
<br><br><b>Пробиваемость:  </b>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>100%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>125%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>115%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>80%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>50%</b></font>
<br><br>
<font color="#3CB371"><b>Апгрейд Легкой брони можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Варваров</b> в сектор "Хостаил" шанс найти апгрейд 5%




	<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/d_medium.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" > <b>Средняя броня </b> -  устанавливается на Флот/Оборону среднего класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>93%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>465%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Стандартного орудия <font color="#00CD66"><b>25%</b></font> <b> | </b> Гравитационного орудия  <font color="#00CD66"><b>20%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>9 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>7 видах Обороны</b></font>
<br> Увеличивает прочность Средней брони на <font color="#32CD32"><b>2%</b></font> за успешную активацию.
<br><br><b>Пробиваемость:  </b>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>75%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>100%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>110%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>100%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>80%</b></font>
<br><br>
<font color="#3CB371"><b>Апгрейд Средней брони можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Пиратов</b> в сектор "Хостаил" шанс найти апгрейд 8%



<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/d_heavy.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" > <b>Тяжелая броня</b> - устанавливается на Флот/Оборону тяжелого класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>88%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>440%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Стандартного орудия <font color="#00CD66"><b>50%</b></font> <b> | </b> Лазерное орудие  <font color="#00CD66"><b>50%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>9 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>9 видах Обороны</b></font>
<br> Увеличивает прочность Тяжелой брони на <font color="#32CD32"><b>1,5%</b></font> за успешную активацию.
<br><br><b>Пробиваемость:  </b>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>50%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>50%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>100%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>115%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>125%</b></font>
<br><br>
<font color="#3CB371"><b>Апгрейд Тяжелой брони можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Чужие</b> в сектор "Хостаил" шанс найти апгрейд 12%

<br></div><br>


<span onclick="$('#id_4').slideToggle();return false" style="cursor: pointer;"><img alt="" src="/styles/images/Adm/GO.png" height="12"> щиты</span>
<div style="display:  none; clear: both;" id="id_4">

<br><img alt="" src="/styles/theme/gow/gebaeude/up/s_light.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Легкие щиты</b>  - устанавливается на Флот/Оборону легкого класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>94%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>470%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Плазменного орудия <font color="#00CD66"><b>20%</b></font> <b> | </b> Гравитационного орудия  <font color="#00CD66"><b>50%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>7 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>3 видах Обороны</b></font>
<br> Увеличивает прочность Легких щитов на <font color="#32CD32"><b>4%</b></font> за успешную активацию.
<br><br> Дополнительные бонусы: <font color="#CD5C5C"> <b>Нет</b></font>
<br><br><b>Пробиваемость:  </b>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>100%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>125%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>115%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>80%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>50%</b></font>
<br><br>
<font color="#3CB371"><b>Апгрейд Легких щитов можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Варваров</b> в сектор "Хостаил" шанс найти апгрейд 5%



<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/s_medium.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Средние щиты</b> -  устанавливается на Флот/Оборону среднего класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>93%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>465%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Стандартного орудия <font color="#00CD66"><b>25%</b></font> <b> | </b> Гравитационного орудия  <font color="#00CD66"><b>20%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>9 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>5 видах Обороны</b></font>
<br> Увеличивает прочность Средних щитов на <font color="#32CD32"><b>3%</b></font> за успешную активацию.
<br><br> Дополнительные бонусы:  <font color="#CD5C5C"><b>Увеличивает бонус От Академии, Офицеров и Технологий в 2 раза (не увеличивает бонус от Апгрейдов)</b></font> 
<br><br><b>Пробиваемость:  </b> 
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>75%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>100%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>110%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>100%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>80%</b></font>
<br><br>
<font color="#3CB371"><b>Апгрейд Средних щитов можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Пиратов</b> в сектор "Хостаил" шанс найти апгрейд 8%



	<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/s_heavy.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Тяжелые щиты</b>- устанавливается на Флот/Оборону тяжелого класса.
	<br>Средняя пробиваемость:  <font color="#FF4500"><b>88%</b></font> </b>  <b> | </b>Сумма пробития:  <font color="#4682B4"><b>440%</font>/<font color="#4682B4">500%</b></font>
<br>Бонус защиты против:  Стандартного орудия <font color="#00CD66"><b>50%</b></font> <b> | </b> Лазерное орудие  <font color="#00CD66"><b>50%</b></font>
<br>Используется в: <font color="#BC8F8F"><b>9 видах Флота</b></font> <b> | </b> <font color="#EEDC82"><b>12 видах Обороны</b></font>
<br> Увеличивает прочность Тяжелых щитов на <font color="#32CD32"><b>2%</b></font> за успешную активацию.
<br><br> Дополнительные бонусы:  <font color="#CD5C5C"><b>Увеличивает бонус От Академии, Офицеров и Технологий в 3 раза (не увеличивает бонус от Апгрейдов)</b> </font> 
<br><br><b>Пробиваемость:  </b>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Стандартное орудие:  <font color="#B8860B"><b>50%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Лазерное орудие:  <font color="#B8860B"><b>50%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Ионное орудие <font color="#B8860B"><b>100%</b></font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Плазменное орудие <font color="#B8860B"><b>115%</b> </font>
<span style=" margin-left: 9px; margin-right: 4px; cursor: default; ">•</span>Гравитационное орудие  <font color="#B8860B"><b>125%</b></font>
<br><br>

<font color="#3CB371"><b>Апгрейд Легкой брони можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Чужих</b> в сектор "Хостаил" шанс найти апгрейд 12%
<br></div><br>



<span onclick="$('#id_7').slideToggle();return false" style="cursor: pointer;"><img alt="" src="/styles/images/Adm/GO.png" height="12"> Двигатели</span>
<div style="display:  none; clear: both;" id="id_7">



	<br><img alt="" src="/styles/theme/gow/gebaeude/up/combustion.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Реактивный двигатель</b> - устанавливается на Флот легкого класса. 
	<br>Используется в: <font color="#BC8F8F"><b>6 видах Флота</b></font>
	
	<br> Увеличивает скорость двигателя на <font color="#32CD32"><b>5%</b></font> за успешную активацию.
	<br> <br><br><font color="#3CB371"><b>Апгрейд Реактивного двигателя можно найти:</b></font>
	<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
	<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Варваров</b> в сектор "Хостаил" шанс найти апгрейд 5%
	
	
	<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/impulse_motor.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Импульсный двигатель</b> - устанавливается на Флот легкого и среднего класса. 
	<br>Используется в: <font color="#BC8F8F"><b>5 видах Флота</b></font>
	
	<br>Увеличивает скорость двигателя на <font color="#32CD32"><b>4%</b></font> за успешную активацию.
	<br> <br><br><font color="#3CB371"><b>Апгрейд Импульсного двигателя можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Пиратов</b> в сектор "Хостаил" шанс найти апгрейд 8%

	
	
	<br><br><img alt="" src="/styles/theme/gow/gebaeude/up/hyperspace_motor.jpg" style="float: left; margin: 0 8px 8px 0;" height="65" ><b>Гиперпространственный двигатель</b> - устанавливается на Флот тяжелого класса. 
	<br>Используется в: <font color="#BC8F8F"><b>20 видах Флота</b></font> 
	
	<br>Увеличивает скорость двигателя на <font color="#32CD32"><b>3%</b></font> за успешную активацию.
	<br> <br><br><font color="#3CB371"><b>Апгрейд Гиперпространственного двигателя можно найти:</b></font>
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Экспедиции "Бесконечные дали" (13,3% на встречу пиратов, 10% найти апгрейд после боя)
<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>Полет на <b>Чужих</b> в сектор "Хостаил" шанс найти апгрейд 12%


<br></div><br>

<span onclick="$('#id_5').slideToggle();return false" style="cursor: pointer;"><img alt="" src="/styles/images/Adm/GO.png" height="12"> Поиск апгрейдов</span>
<div style="display:  none; clear: both;" id="id_5">
	<b>Экспедиция.</b><br>
	Вы можете найти любой Апгрейд, в Экспедиции "Бесконечные дали"
	<br>Минимальное количество очков флота для нахождения апгрейда в Экспедиции <font color="#B0C4DE"><b>75.000</b></font> <br><b>(1 очко = 1.000.000 ресурсов, не учитывая дейтерий)</b>
	<br><br>Вероятность встретить пиратов <font color="#32CD32"><b>13,3%</b></font>, шанс на то что при их победе вы найдете апгрейд <font color="#32CD32"><b>7%</b></font>
	
	<br><br>
	<b>Сектор хостаил.</b><br>
	Вы можете найти апгрейд слетав в Сектор "Хостаил":
	<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>При полете на <font color="#FF4500"><b>Варваров</b></font> с вероятностью <font color="#32CD32"><b>5%</b></font> вы сможете найти апгрейд: 
	Лазерное орудие <b> | </b> Ионное орудие <b> | </b> Реактивный двигатель <b> | </b>  Легкую броню <b> | </b> Легкие щиты
	<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>При полете на <font color="#FF4500"><b>Пиратов</b></font> с вероятностью <font color="#32CD32"><b>7%</b></font> вы сможете найти апгрейд: 
	Ионное орудие <b> | </b>  Плазменное орудие <b> | </b>  Импульсный двигатель  <b> | </b>  Среднюю броню  <b> | </b> Средние щиты
	<br><span style=" margin-left: 9px; margin-right: 4px; cursor: default; float: left;">•</span>При полете на <font color="#FF4500"><b>Чужих</b></font> с вероятностью <font color="#32CD32"><b>10%</b></font> вы сможете найти апгрейд:
	Плазменное орудие  <b> | </b> Гравитационное орудие <b> | </b>  Гиперпространственный двигатель <b> | </b> Тяжелую броню  <b> | </b> Тяжелые щиты
 
	<br><br>
	<font color="#B8860B"><b>Каждые 25 Боевых уровней вы получаете 1% к поиску апгрейдов в секторе "Хостаил"</b></font>


    </div>        
</div>
</div>
</div>
*}
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}