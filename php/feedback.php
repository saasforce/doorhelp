<?php


try {
	error_log("feedback.php call"); // remove this later

$servername = "batla.czatixbei6fh.us-west-2.rds.amazonaws.com";
$username = "batla";
$password = "bunny2772";
$dbname = "doorhelp";
	
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$subject = $_POST["subject"];



 $sql = " INSERT INTO Feedback (   Name,Email,Subject,Message ) VALUES ( '$name', '$email' , '$subject' ,'$message' );";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";


    $email_to = $email;
    $email_subject = "DoorHelp: Thanks for your feedback"; 
    $email_from = "team@doorhelp.in"; // required
    $error_message = "";
	
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message = "Hi ".$name.",\n\nThanks for your valuable feedback.\n\nOur commitment is to provide you best of services. We have made that our mission. Try our services and let us know what else can we bring for you.\n\n\nWith Regards\nTeam DoorHelp";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

$headers_admin = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();

//send email to admin
@mail($email_from, "feedback from: ".$name." subject:".$subject, $message, $headers_admin);  

  if(!empty($email)){// && preg_match($email_exp,$email) ) {
//send email to user that feedback is submitted
@mail($email_to, $email_subject, $email_message, $headers);  
  }
    }
catch(Exception $e)
    {
		//ini_set("error_log", "/var/www/html/php/php-error.log");
		//ini_set('display_errors', '1');
		//error_reporting(E_ALL); 
		error_log("Exception while logging feedback: " + $e->getMessage());
    }

$conn = null;
?>
