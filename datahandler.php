<?php
require_once('bigquery.php');
# I know this is sloppy, but I am time and resource constrained right now :(
session_start();
if($_POST['rqtype']==="mapbycrime"){
    if($_POST['mapby']===""){
	$query_result = query("SELECT lat, long,Date,PrimaryType FROM [crime-moses:crime.upto_now] ORDER BY Date DESC LIMIT 1000");
    }else{
    	$query_result = query("SELECT lat, long,Date,PrimaryType FROM [crime-moses:crime.upto_now] WHERE PrimaryType='".$_POST['mapby']."' ORDER BY Date DESC LIMIT 1000");

    }
}else if($_POST['rqtype']==="graph"){
    #TODO: SELECT DAYOFWEEK(Date), COUNT(Date) FROM [crime-moses:crime.upto_now] GROUP BY 1
    switch($_POST["period"]){
        case 1:
            $period = "DAYOFWEEK";
            break;
        case 2:
            $period = "DAY";
            break;
        case 3:
            $period = "WEEK";
            break;
        case 4:
            $period = "MONTH";
            break;
        case 5:
            $period = "YEAR";
            break;
        default:
            $period = "DAYOFWEEK";
    }

    $crime_arr=[];
    foreach ($_POST["crimes"] as $i){
        switch($i){
           case 1:
               $crime = "STALKING";
               break;
           case 2:
               $crime = "WEAPONS VIOLATION";
               break;
           case 3:
               $crime = "OTHER OFFENSE";
               break;
           case 4:
                $crime = "OFFENSE INVOLVING CHILDREN";
               break;
           case 5:
               $crime = "ASSAULT";
               break;
           case 6:
               $crime = "SEX OFFENSE";
               break;
           case 7:
               $crime = "CRIM SEXUAL ASSAULT";
               break;
           case 8:
               $crime = "HOMICIDE";
               break;
           case 9:
               $crime = "OBSCENITY";
               break;
           case 10:
               $crime = "BURGLARY";
               break;
           case 11:
               $crime = "INTIMIDATION";
               break;
           case 12:
               $crime = "ARSON";
               break;
           case 13:
               $crime = "HUMAN TRAFFICKING";
               break;
           case 14:
               $crime = "THEFT";
               break;
           case 15:
               $crime = "CRIMINAL DAMAGE";
               break;
           case 16:
               $crime = "LIQUOR LAW VIOLATION";
               break;
           case 17:
               $crime = "KIDNAPPING";
               break;
           case 18:
               $crime = "PUBLIC INDECENCY";
               break;
           case 19:
               $crime = "OTHER NARCOTIC VIOLATION";
               break;
           case 20:
               $crime = "ROBBERY";
               break;
           case 21:
               $crime = "MOTOR VEHICLE THEFT";
               break;
           case 22:
               $crime = "INTERFERENCE WITH PUBLIC OFFICER";
               break;
           case 23:
               $crime = "RITUALISM";
               break;
           case 24:
               $crime = "NON-CRIMINAL (SUBJECT SPECIFIED)";
               break;
           case 25:
               $crime = "BATTERY";
               break;
           case 26:
               $crime = "CRIMINAL TRESPASS";
               break;
           case 27:
               $crime = "PUBLIC PEACE VIOLATION";
               break;
           case 28:
               $crime = "PROSTITUTION";
               break;
           case 29:
               $crime = "NON - CRIMINAL";
               break;
           case 30:
               $crime = "CONCEALED CARRY LICENSE VIOLATION";
               break;
           case 31:
               $crime = "DECEPTIVE PRACTICE";
               break;
           case 32:
               $crime = "NARCOTICS";
               break;
           case 33:
               $crime = "GAMBLING";
               break;
           case 34:
               $crime = "NON-CRIMINAL";
               break;
           case 35:
               $crime = "DOMESTIC VIOLENCE";
               break;
           default:
               $crime = "";
               break;
        }
        $crime_arr[]=$crime;
	}
	if(count($crime_arr)!=0){
	    $condition = "WHERE PrimaryType = \"".implode("\" OR PrimaryType = \"",$crime_arr)."\"";
    }
    $query_result = query("SELECT ".$period."(Date), COUNT(Date) FROM [crime-moses:crime.upto_now] ".$condition." GROUP BY 1");
}
$jsoned = json_encode($query_result);
echo($jsoned);
