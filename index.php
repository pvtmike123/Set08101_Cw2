<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Module Feedback</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<nav class="navbar navbar-default">
					 <div class="container">
							 <!-- Brand and toggle get grouped for better mobile display -->
							 <div class="navbar-header">
									 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
											 <span class="sr-only">Toggle navigation</span>
											 <span class="icon-bar"></span>
											 <span class="icon-bar"></span>
											 <span class="icon-bar"></span>
									 </button>
									 <a class="navbar-brand" href="index.php">Moodle</a>
							 </div>

							 <!-- Collect the nav links, forms, and other content for toggling -->
							 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									 <ul class="nav navbar-nav navbar-right">
											 <li><a href="index.php">Home</a></li>
											 <li><a href="#">Student Links</a></li>
											 <li><a href="#">Staff Links</a></li>
											 <li><a href="#">Libary</a></li>
											 <li><a href="#">Turnitin</a></li>
									 </ul>
							 </div>
							 <!-- /.navbar-collapse -->
					 </div>
					 <!-- /.container-fluid -->
</nav>

		<div class="container">



        <h1 class="projTitle">Module Feedback</h1>


        <div class="alert alert-success alert-dismissible" style="width:100%;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Welcome!</strong><?php
						if (!array_key_exists('u',$_REQUEST)) {
							print "Who are you <form class=form-inline><input name=u value='50200036'><submit><form>";
							exit();
						}

						$con = new mysqli('localhost','40170242','pXRVjb65','40170242');
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
						print " ".$row[0].''.$row[1];
						?>
        </div>

					<?php
					$con = new mysqli('localhost','40170242','pXRVjb65','40170242');
					if ($con->connect_error){
						die('Connection failure');
					}


					$sql ="SELECT CAM_SMO.MOD_CODE,MOD_NAME,INS_MOD.PRS_CODE,PRS_FNM1,PRS_SURN
				 FROM CAM_SMO JOIN INS_MOD ON (CAM_SMO.MOD_CODE=INS_MOD.MOD_CODE)
											JOIN INS_PRS ON (INS_MOD.PRS_CODE=INS_PRS.PRS_CODE)
				 WHERE SPR_CODE=? AND AYR_CODE='2016/7' AND PSL_CODE='TR1' LIMIT 3";



				 $stmt = $con->prepare($sql)
					 or die ($con->error);
				 $stmt->bind_param('s',$_REQUEST['u'])
					 or die('Bind error');
				 $stmt->execute()
					 or die('execute error');
				 $cur = $stmt->get_result();
         print "<form action=php/feedback.php>";



 // output data of each row

    while ($row = $cur->fetch_assoc()){
      $sql1 = "SELECT * FROM INS_QUE ";
      $stmt1 = $con->prepare($sql1);
      $stmt1->execute();
      $result1 = $stmt1->get_result();
      if ($result1->num_rows > 0) {
      print "<h2>Module ".$row['MOD_NAME']."</h2>
      <div class=jumbotron>
      <table class=table>";
      while($row1 = $result1->fetch_assoc()) {
      echo "<tr><td>".$row1["QUE_CODE"]."</td><td>".$row1["QUE_TEXT"]."</td> <td>
           <input type='radio' name='".$row['MOD_CODE'] ."_Q" .$row1['QUE_CODE']."' value='5'>DA
           <input type='radio' name='".$row['MOD_CODE'] ."_Q".$row1['QUE_CODE']."' value='4'>MA
           <input type='radio' name='".$row['MOD_CODE'] ."_Q".$row1['QUE_CODE']."' value='3'>N
           <input type='radio' name='".$row['MOD_CODE'] ."_Q".$row1['QUE_CODE']."' value='2'>MD
           <input type='radio' name='".$row['MOD_CODE'] ."_Q".$row1['QUE_CODE']."' value='1'>SD</td></tr>";
 }
 echo "</table></div>";
}
}
            print "<input type=hidden name=u value=$_REQUEST[u]>";
            print "<input type=submit class=btn btn-warning btn-lg active>";
            print "</form>";
           ?>
  			</div>


    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
