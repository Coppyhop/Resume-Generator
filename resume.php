<!DOCTYPE html>
<html>
	<head>
		<title>Resume For Coppy Bredenkamp</title>
	</head>
	<body>
		<?php 
		
		  $personalinfo="
            <div>
                <h1>%NAME%</h1>
                <p>%ADDRESS% | %PHONE% | %EMAIL%</p>
            </div";
		  $objective="
            <div>
                <h2>Objective</h2>
                <p>%BODY%</p>
            </div>
            ";
          
		  $education="
            <div>
                <h2>Education</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <p>%BODY1%</p>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <p>%BODY2%</p>
                </div>
            </div>
            ";
		  
		  $experience = "
            <div>
                <h2>Experience</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <p>%BODY1%</p>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <p>%BODY2%</p>
                </div>
            </div>";
		  $achievements = "
                <div>
                <h2>Achievements/Misc</h2>
                <div>
                <h3>%TITLE1% | %DATE1%</h3>
                <p>%BODY1%</p>
                </div>
                <div>
                <h3>%TITLE2% | %DATE2%</h3>
                <p>%BODY2%</p>
                </div>
            </div>";
		  
		  $footer = "<p>References available upon request. Contact is freely available at %EMAIL%. Phone calls are discouraged for first contact.";
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
		      $ed = str_replace("%TITLE1%", $arr[0]["title"], $education);
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
		      echo($pid);
		      echo($od);
		      echo($ed);
		      echo($exd);
		      echo($ad);
		      echo($fd);
		      
		      $conn=null;
		  } catch (PDOException $e)
		  {
		      echo "Error: " . $e->getMessage();
		
		  }
		      ?>
	</body>
</html>