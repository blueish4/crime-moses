<!DOCTYPE html>
<html>
<head>
    <title>MOSES- Graphs</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    var debug = [];
    var totals = [];
    $(function(){
        // Load Charts and the corechart package.
        google.charts.load('current', {'packages':['corechart']});
        updateRequest();
    });
    function updateRequest(){
        var query = $("#graphtype").val();
        var crime = $("#crime_type").val();
        $.ajax({
            url: "datahandler.php",
            type: "POST",
            data: {rqtype: "graph",
                period: query,
                crimes: crime},
            success: function(html){
                var resp = JSON.parse(html);
                for(ans in resp){
                    totals.push(resp[ans]);
                }
                google.charts.setOnLoadCallback(drawChart);
            },

        });
    }
    function drawChart(){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day Of Week');
        data.addColumn('number', 'Crimes');
        data.addRows(totals.length+1);
        totals.sort(function(a,b){
            return a.f0_ - b.f0_;
        })
        for(i=0;i<totals.length;i++){
            data.setCell(i, 0, totals[i].f0_);
            data.setCell(i, 1, totals[i].f1_);
        }
        var options = {'title':'Crimes over time',
            'width':600,
            'height':500};
        if($("#linetype").val()=="line") {
            var chart = new google.visualization.LineChart(document.getElementById('col_chart'));
        }else{
            var chart = new google.visualization.ColumnChart(document.getElementById('col_chart'));
        }
        chart.draw(data, options);
        totals = [];
    }
    </script>
</head>
<body>
<a href="/">&lt;Return to map</a>
<div id="selectors">
    <select id="graphtype">
	<option value=1>Day of the Week</option>
	<option value=2>Day of the Month</option>
	<option value=3>Week of the Year</option>
	<option value=4>Month of the Year</option>
	<option value=5>Year</option>
    </select>
    <select id="linetype">
	<option value="line">Line Graph</option>
	<option value="column">Column Graph</option>
    </select>
    <br>
    <select name="crime_type" id="crime_type" style="height:200px" multiple>
        <option value="01">STALKING</option>
        <option value="02">WEAPONS VIOLATION</option>
        <option value="03">OTHER OFFENSE</option>
        <option value="04">OFFENSE INVOLVING CHILDREN</option>
        <option value="05">ASSAULT</option>
        <option value="06">SEX OFFENSE</option>
        <option value="07">CRIM SEXUAL ASSAULT</option>
        <option value="08">HOMICIDE</option>
        <option value="09">OBSCENITY</option>
        <option value="10">BURGLARY</option>
        <option value="11">INTIMIDATION</option>
        <option value="12">ARSON</option>
        <option value="13">HUMAN TRAFFICKING</option>
        <option value="14">THEFT</option>
        <option value="15">CRIMINAL DAMAGE</option>
        <option value="16">LIQUOR LAW VIOLATION</option>
        <option value="17">KIDNAPPING</option>
        <option value="18">PUBLIC INDECENCY</option>
        <option value="19">OTHER NARCOTIC VIOLATION</option>
        <option value="20">ROBBERY</option>
        <option value="21">MOTOR VEHICLE THEFT</option>
        <option value="22">INTERFERENCE WITH PUBLIC OFFICER</option>
        <option value="23">RITUALISM</option>
        <option value="24">NON-CRIMINAL (SUBJECT SPECIFIED)</option>
        <option value="25">BATTERY</option>
        <option value="26">CRIMINAL TRESPASS</option>
        <option value="27">PUBLIC PEACE VIOLATION</option>
        <option value="28">PROSTITUTION</option>
        <option value="29">NON - CRIMINAL</option>
        <option value="30">CONCEALED CARRY LICENSE VIOLATION</option>
        <option value="31">DECEPTIVE PRACTICE</option>
        <option value="32">NARCOTICS</option>
        <option value="33">GAMBLING</option>
        <option value="34">NON-CRIMINAL</option>
        <option value="35">DOMESTIC VIOLENCE</option>
    </select>
    <button id="submit_button" name="submit" onclick="updateRequest()">Submit</button>
</div>
<div id="col_chart"></div>
</body>
</html>
