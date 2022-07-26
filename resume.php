<!DOCTYPE html>
<html>
	<head>
		<title>Resume For Kyle Bredenkamp</title>
		<link rel="stylesheet" href="style.css"> 
	</head>
	<body>
		<?php 
	      $bulletpoint="‣ ";	
          $personalinfo="
            <div class=element>
            <h1>%NAME%</h1>
                <div><p>%ADDRESS% | %PHONE% | %EMAIL%</p></div>
            </div>
            ";
		  $objective="
            <div class=element>
                <h2>Objective</h2>
                <div>%BODY%</div>
            </div>
            ";
          
		  $education="
            <div class=element>
                <h2>Education</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <div>%BODY1%</div>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <div>%BODY2%</div>
                </div>
            </div>
            ";
		  
		  $experience = "
            <div class=element>
                <h2>Experience</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <div>%BODY1%</div>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <div>%BODY2%</div>
                </div>
            </div>";
		  $achievements = "
                <div class=element>
                <h2>Achievements/Misc</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <div>%BODY1%</div>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <div>%BODY2%</div>
                </div>
            </div>";
		  
		  $footer = "<div><p>References available upon request. Contact is freely available at %EMAIL%. Phone calls are discouraged for first contact.</p></div>";
		  $servername = "localhost";
		  $username = "anon";
		  $password = "anonymous";
		  
		  try{
		      
		      $conn = new PDO("mysql:host=$servername;dbname=resume",$username,$password);
		      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		      
		      $stmt = $conn->prepare("SELECT * FROM personal_info ORDER BY id DESC LIMIT 1");
		      $stmt->execute();
		      $arr = $stmt->fetchAll();
		      $pid = str_replace("%NAME%",$arr[0]["Name"], $personalinfo);
		      $pid = str_replace("%ADDRESS%",$arr[0]["Address"], $pid);
		      $pid = str_replace("%PHONE%",$arr[0]["Phone"], $pid);
		      $pid = str_replace("%EMAIL%",$arr[0]["Email"], $pid);
		      $fd = str_replace("%EMAIL%", $arr[0]["Email"], $footer);
		      
		      $stmt = $conn->prepare("SELECT * FROM objective ORDER BY date DESC LIMIT 1");
		      $stmt->execute();
		      $arr = $stmt->fetchAll();
		      $od = str_replace("%BODY%", $arr[0]["body"], $objective);
		      
		      $stmt = $conn->prepare("SELECT * FROM education ORDER BY date DESC LIMIT 2");
		      $stmt->execute();
		      $arr = $stmt->fetchAll();
		      $ed = str_replace("%TITLE1%", $arr[0]["title"] + " | ", $education);
		      $ed = str_replace("%DATE1%", $arr[0]["date"], $ed);
		      $ed = str_replace("%BODY1%", $arr[0]["body"], $ed);
		      $ed = str_replace("%TITLE2%", $arr[1]["title"], $ed);
		      $ed = str_replace("%DATE2%", $arr[1]["date"], $ed);
		      $ed = str_replace("%BODY2%", $arr[1]["body"], $ed);
		      
		      $stmt = $conn->prepare("SELECT * FROM experience ORDER BY startdate DESC LIMIT 2");
		      $stmt->execute();
		      $arr = $stmt->fetchAll();
		      $exd = str_replace("%TITLE1%", $arr[0]["title"], $experience);
		      $exd = str_replace("%DATE1%", $arr[0]["startdate"], $exd);
		      $exd = str_replace("%BODY1%", $arr[0]["body"], $exd);
		      $exd = str_replace("%TITLE2%", $arr[1]["title"], $exd);
		      $exd = str_replace("%DATE2%", $arr[1]["startdate"], $exd);
		      $exd = str_replace("%BODY2%", $arr[1]["body"], $exd);
		      
		      $stmt = $conn->prepare("SELECT * FROM achievements ORDER BY date DESC LIMIT 2");
		      $stmt->execute();
		      $arr = $stmt->fetchAll();
		      $ad = str_replace("%TITLE1%", $arr[0]["title"], $achievements);
		      $ad = str_replace("%DATE1%", $arr[0]["date"], $ad);
		      $ad = str_replace("%BODY1%", $arr[0]["body"], $ad);
		      $ad = str_replace("%TITLE2%", $arr[1]["title"], $ad);
		      $ad = str_replace("%DATE2%", $arr[1]["date"], $ad);
		      $ad = str_replace("%BODY2%", $arr[1]["body"], $ad);
              
              $pid = str_replace("%BP%", $bulletpoint, $pid); 
              echo($pid);
              $od = str_replace("%BP%", $bulletpoint, $od);
              echo($od);
              $ed = str_replace("%BP%", $bulletpoint, $ed);
              echo($ed);
              $exd = str_replace("%BP%", $bulletpoint, $exd);
              echo($exd);
              $ad = str_replace("%BP%", $bulletpoint, $ad);
              echo($ad);
              $fd = str_replace("%BP%", $bulletpoint, $fd);
		      echo($fd);
		      
		      $conn=null;
		  } catch (PDOException $e)
		  {
		      echo "Error: " . $e->getMessage();
		
		  }
		      ?>
	</body>
</html>
