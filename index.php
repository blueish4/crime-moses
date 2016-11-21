<!DOCTYPE html>
<html>
<head>
<title>MOSES - HOME</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKaKJuZ1ztn1tckA-FW331wxzsV1NQZA8&libraries=visualization"></script>
<script>
$(function() {
    // Google maps things here
    mapvalue = $("#mapval :selected").val();
    $('#mapval').change(loadMap);
});
var mapvalue = "";
function loadMap(){
    $.ajax({
        url: "datahandler.php",
        type: "POST",
        data: {mapby : mapvalue,
            rqtype: "mapbycrime"},
    }).done(function(msg){
        plotheatmap(msg);
    })
}

getviocode = function(vio, viodate){
    switch(vio){
	case "HOMICIDE":
	case "CRIM SEXUAL ASSAULT":
	    var severity = 2;
	    break;
	case "ROBBERY":
	case "BATTERY":
	case "RITUALISM":
	case "ASSAULT":
	case "WEAPONS VIOLATION":
	case "SEX OFFENCE":
	case "NARCOTICS":
	case "INTIMIDATION":
	case "KIDNAPPING":
	    var severity = 1;
	    break;
	case "PUBLIC PEACE VIOLATION":
	case "BURGLARY":
	case "THEFT":
	case "ARSON":
	case "DECEPTIVE PRACTICE":
	case "CRIMINAL DAMAGE":
	case "PROSTITUTION":
	case "GAMBLING":
	case "INTERFERENCE WITH PUBLIC OFFICER":
	    var severity = 0.5;
	    break;
	default:
	    var severity = 0;
    }
    //Time scaling
    if(viodate>(Date.now()-(86400*14*1000))){
	//Crime within last two weeks
	var severity = severity*1.5;
    }else if(viodate<(Date.now()-(86400*30*1000))){
	//Crimve after 30 days ago
	var severity = severity * 0.5;
    }
    return severity*5;
}
plotheatmap = function(resp){
    map = new google.maps.Map(
	document.getElementById('map_canvas'), {
	    zoom: 11, 
	    center: new google.maps.LatLng(41.8282702,-87.747339) 
	}
    );
    var resp_obj = JSON.parse(resp);
    var mapObjects = [];
    for(i=0;i<resp_obj.length;i++){
	var vioweight = getviocode(resp_obj[i].PrimaryType, resp_obj[i].Date);
	if(vioweight != 0){
	    mapObjects.push({location: new google.maps.LatLng(resp_obj[i].lat,resp_obj[i].long),weight: vioweight});
	}
    }
    var heatmap = new google.maps.visualization.HeatmapLayer({
	data: mapObjects,
	map: map,
	dissapating: true,
	radius: 40,
	opacity: 0.7
    });
    heatmap.setMap(heatmap.getMap());
} 
</script>
</head>
<body>
<a href="graphs.php"><p> Graphs this way!</p></a>
<select id="mapval">
    <option value="">All</option>
    <option value="HOMICIDE">Homicide</option>
    <option value="CRIM SEXUAL ASSAULT">Sexual Assault</option>
    <option value="ASSAULT">Assault</option>
    <option value="INTIMIDATION">Intimidation</option>
</select>
<div id = "map_canvas" style="width: 500px;height: 500px;"></div>
<p id=log></p>
</body>
</html>

