<?php
	   $server="localhost";
	   $user="root";
	   $pass="566566";
	   $db="DMR";
	   $response = 0;

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/x-www-form-urlencoded') != 0){
    throw new Exception('Content type must be: application/x-www-form-urlencoded');
}

$someJSON = file_get_contents("php://input");
/*
$someJSON =' ';
*/
$data = json_decode($someJSON);
$aeic = $data->fr;
$rsc = $data->rsc;
$op = $data->op;
$aei = $data->aei;
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

  	if ($tyy == 2 && $rsc == 2001){
    	$sql = "UPDATE reg SET aei = '$raei' WHERE rn = '$rn'";
    	$sql1 = "INSERT INTO cont (aei) VALUES ('$raei')"; 
    	$sql2 = "INSERT INTO con_ins (aei) VALUES ('$raei') ";
		echo "Added AEI in RCCI";

		if ($conn->query($sql2) === TRUE) {
  		$response = 3;
  		}
    }

	if ($ty == 2 && $rsc != 2001){
   		$sql = "INSERT INTO reg (api, rn, rr) VALUES ('$api', '$rn', '$rr')";
		echo "Added reg";
		}

	if ($ty == 3){
  		$sql = "UPDATE cont SET rn = '$rnc', rqi = '$rqi', to_ = '$to_' WHERE aei = '$aeic'";
      //$sql2 = "UPDATE con_ins SET rn = '$rnc' WHERE aei = '$aeic'";
  		echo "Added continer";

    if ($conn->query($sql2) === TRUE) {
      $response = 3;
      }
		}

	if ($ty == 4){
  		$sql = "UPDATE con_ins SET con = '$con', cnf = '$cnf' WHERE aei = '$aeic'";
  		echo "Added Instance";
		
	if ($conn->query($sql) === TRUE) {
  		$response = 3;
  		}
    }

echo $response;
$conn->close();
?>
