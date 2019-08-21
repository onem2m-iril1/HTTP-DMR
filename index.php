<?php
	   $server="localhost";
	   $user="root";
	   $pass="";
	   $db="DMR";
	   $response = 0;
/*
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/x-www-form-urlencoded') != 0){
    throw new Exception('Content type must be: application/x-www-form-urlencoded');
}

$someJSON = file_get_contents("php://input");
*/

$someJSON =' {
   "fr" : "S",
   "op" : 1,
   "pc" : {
      "m2m:ae" : {
"api": "C01.com.farm.app01",
"rr" : true,
"poa": ["mqtt://gatewayapp.farm.com"],
"rn" : "gateway_ae"
      }
   },
   "rqi": "m_createAE3942104",
   "to" : "/CSE3409165/farm_gateway",
   "ty" : 2
}';

$someJSON2 = '{
   "rsc" : 2001,
   "rqi" : "m_createAE3942104",
   "pc"  : {
       "m2m:ae" : {
			"ty" : 2, 
			"ri" : "ae3394315272",
			"pi" : "mncse8301493",
			"ct" : "20170524T065938",
			"lt" : "20170524T065938",
			"et" : "20270523T065838",
			"api": "C01.com.farm.app01",
			"rr" : true,
			"aei": "S336593381621",
			"poa": ["mqtt://gatewayapp.farm.com"],
			"rn" : "gateway_ae"
      	}
   },   
   "to"   : "/CSE3409165/farm_gateway/gateway_ae",
   "fr"   : "/CSE3409165"
}';

$someJSON3 = ' {

   "fr" : "/S108653822141",
   "op" : 1,
   "pc" : {
    	"m2m:cnt" : {
			"rn": "cont_monitor01"
      	}
   },
   "rqi" : "m_createCont291286",
   "to" : "/CSE3409165/farm_gateway/sensor_ae01",
   "ty" : 3
} ';

$someJSON4 = ' {
   "fr" : "/S108653822141",
   "op" : 1,
   "pc" : {
      "m2m:cin" : {
"cnf": "text/plains:0",
"con": "25"
      }
   },
   "rqi" : "m_createCin642126",
   "to" : "/CSE3409165/farm_gateway/sensor_ae01/cont_monitor01",
   "ty" : 4
} ';

$data = json_decode($someJSON4);
$aeic = $data->fr;
$rsc = $data->rsc;
$op = $data->{'op'};
$api = $data->pc->{'m2m:ae'}->api;
$rn = $data->pc->{'m2m:ae'}->rn;  //reg resource name
$rr = $data->pc->{'m2m:ae'}->rr;
$tyy = $data->pc->{'m2m:ae'}->ty;
$raei = $data->pc->{'m2m:ae'}->aei;
$rnc = $data->pc->{'m2m:cnt'}->rn; //container rn (container ID)
$cnf = $data->pc->{'m2m:cin'}->cnf; //constant_Instance value type
$con = $data->pc->{'m2m:cin'}->con; //constant_Instance value
$rqi = $data->rqi;
$to_ = $data->to;
$ty = $data->ty;

$conn = new mysqli($server, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  	if ($rsc == 2001){
  		 
    	$sql = "UPDATE reg SET aei = '$raei' WHERE rn = '$rn'";
		//$sql .= "INSERT INTO cont (aei) VALUES ('$raei')";
    	
    	if ($conn->query($sql) === TRUE) {
			echo "Added AEI via Responce Packet";
  			$response = 3;
  		}
    }
	if ($ty == 2){
   		$sql = "INSERT INTO reg (api, rn, rr) VALUES ('$api', '$rn', '$rr')";
		if ($conn->query($sql) === TRUE) {
      		echo "Added in cont";
      		$response = 3;
      	}
	}
	if ($ty == 3){
		$sql = "INSERT INTO cont (aei, rn, rqi, to_) VALUES ('$aeic', '$rnc', '$rqi', '$to_')"; // this will be used as a reference to contentInstances 
  		//$sql = "UPDATE cont SET rn = '$rnc', rqi = '$rqi', to_ = '$to_' WHERE aei = '$aeic'";
      	//$sql2 = "UPDATE con_ins SET rn = '$rnc' WHERE aei = '$aeic'";
  		
	    if ($conn->query($sql) === TRUE) {
      		echo "Added continer";
      		$response = 3;
      	}
	}
	if ($ty == 4){
  		$sql = "INSERT INTO con_ins (con, cnf) VALUES ('$con', '$cnf')";
  		//$sql = "UPDATE con_ins SET con = '$con', conf = '$conf' WHERE aei = '$aeic'";
  		echo "Added Instance";
		if ($conn->query($sql) === TRUE) {
  			$response = 3;
  		}
    }
echo $response;
$conn->close();
?>