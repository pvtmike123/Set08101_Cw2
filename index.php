<?php
print "<h1>Module Feedback</h1>";
if (!array_key_exists('u',$_REQUEST)) {
	print "Who are you <form><input name=u value='50200036'><submit><form>";
	exit();
}

$con = new mysqli('localhost','scott','tiger','gisq');
if ($con->connect_error){
	die('Connection failure');
}
$sql = "SELECT SPR_FNM1, SPR_SURN from INS_SPR WHERE SPR_CODE=?";
$stmt = $con->prepare($sql)
	or die ($con->error);
$stmt->bind_param('s',$_REQUEST['u'])
	or die('Bind error');
$stmt->execute()
	or die('execute error');
$cur = $stmt->get_result();
if (!($row = $cur->fetch_array())){
	echo "Matriculation number not found";
	exit();
}
print "Welcome student: ".$row[0].''.$row[1];
?>
