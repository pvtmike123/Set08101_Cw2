<?php
						if (!array_key_exists('u',$_REQUEST)) {
							die ("Who are you");
						}
            $con = new mysqli('localhost','40170242','pXRVjb65','40170242');
  					if ($con->connect_error){
  						die('Connection failure');
  					}
            $sql = "delete from INS_RES where SPR_CODE=? AND AYR_CODE='2016/7' AND PSL_CODE='TR1'";
            $stmt = $con->prepare($sql)
            or die ($con->error);
            $stmt->bind_param('s',$_REQUEST['u'])
              or die('Bind error');
              $stmt->execute()
               or die('failed to delete db entry');



            $sql ="insert into INS_RES VALUES (?,?,'2016/7','TR1',?,?)";
            $stmt = $con->prepare($sql)
            or die ($con->error);
          $stmt->bind_param('sssi',$_REQUEST['u'],$mc,$qn,$res)
            or die('Bind error');
            foreach ($_REQUEST as $k => $v) {
              if ($k == 'u'){
                continue;
              }
              $k = preg_replace('/d/','.',$k);
              Print"<li>".$k;
              Print"<li>".$v;

              $mc_qn = preg_split('/_Q/',$k);
              $mc = $mc_qn[0];
              $qn = $mc_qn[1];
              $res = $v;
              $stmt->execute()
     					 or die('execute error');
               print "<li>done and insert, $_REQUEST[u],$mc,$qn,$res";
              }
              print json_encode($_REQUEST);
              header('Location: http://40170242.set08101.napier.ac.uk/cw2/');
						?>
