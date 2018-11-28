{block name="title" prepend}Server Stats{/block}
{block name="content"}


<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="border-bottom:0;">
    	Server Statistics
    </div>
	<div id="chart_div"></div>
	
	<div class="gray_stripe" style="border-bottom:0;">
    	Expedition Statistics
    </div>
	<div id="chart_div1"></div>
	
</div>
</div>
            <div class="clear"></div>            
        </div>
{/block}
{block name="script" append}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', { 'packages':['corechart'] });

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Attack', {$serverStats.attack}],
          ['Acs Attack', {$serverStats.attackAcs}],
          ['Transport', {$serverStats.transport}],
          ['Deploiement', {$serverStats.deployement}],
          ['Acs Defend', {$serverStats.defendAcs}],
          ['Spy', {$serverStats.spy}],
          ['Colonisation', {$serverStats.colonisation}],
          ['Recycle', {$serverStats.recycle}],
          ['Destroy', {$serverStats.destroy}],
          ['Missile', {$serverStats.missile}],
          ['DM investigation', {$serverStats.expeditionDm}],
          ['Expeditions', {$serverStats.expedition}],
          ['Hostile Expeditions', {$serverStats.hostile}],
          ['Asteroids', {$serverStats.asteroids}]
        ]);

        // Set chart options
        var options = { 'title':'Mission stats',
                       'width':400,
                       'height':300 };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  
	   // Load the Visualization API and the corechart package.
      google.charts.load('current', { 'packages':['corechart'] });

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart1() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Nothing', {$serverStats10}],
          ['Resource', {$serverStats1}],
          ['Find Fleets', {$serverStats2}],
          ['Darkmatter', {$serverStats3}],
          ['Arsenal', {$serverStats4}],
          ['Aliens/Pirates', {$serverStats5}],
          ['Black Hole', {$serverStats6}],
          ['Change Time', {$serverStats7}],
          ['Change Resource', {$serverStats8}],
          ['Cosmonaute', {$serverStats9}],
        ]);

        // Set chart options
        var options = { 'title':'Mission stats',
                       'width':400,
                       'height':300 };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
	  
	  
    </script>
{/block}