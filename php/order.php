<?php

try {

	error_log("order.php call"); // remove this later

$servername = "batla.czatixbei6fh.us-west-2.rds.amazonaws.com";
$username = "batla";
$password = "bunny2772";
$dbname = "doorhelp";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$area = $_POST["area"];
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$category = $_POST["category"];
$subcategory = $_POST["subcategory"];
$address = $_POST["address"];
$postalCode = $_POST["postal-code"];
$date = $_POST["date"];
$time = $_POST["time"];
$comments = $_POST["comments"];

 //$sql = " INSERT INTO Orders (Area,Name,Email) VALUES ('$area','$name','$email');";
 $sql = " INSERT INTO Orders ( Area, Name, Email, Phone, Category, Subcategory, Address, PostalCode, Date, Time, Comments )
VALUES ( '$area', '$name', '$email', '$phone', '$category', '$subcategory', '$address', '$postalCode', '$date', '$time', '$comments');";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New order created successfully";

    $email_to = $email;
    $email_subject = "DoorHelp: Thanks for booking";
    $email_from = "team@doorhelp.in"; // required
    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message = "Hi ".$name.",\n\nThanks for your booking on DoorHelp. Relax now, our staff will be at your place on the mentioned date and time. You'll get a confirmation call before the visit.\n\nOur commitment is to provide you best of services. We have made that our mission.\n\n\nWith Regards\nTeam DoorHelp";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

$headers_admin = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
$adminMess = "booking request:\n Category:".$category."\nSubcategory:".$subcategory."\nComments:".$comments."\nPhone:".$phone."\nArea:".$area."\nAddress:".$address."\nPostalCode:".$postalCode."\nDate & time:".$date."  ".$time;
//send email to admin
@mail($email_from, "booking request: ".$name, $adminMess , $headers_admin);

  if(!empty($email)){// && preg_match($email_exp,$email) ) {
//send email to user that feedback is submitted
@mail($email_to, $email_subject, $email_message, $headers);
}


    }
catch(Exception $e)
    {
		error_log("Exception while logging feedback: " + $e->getMessage());
	}

$conn = null;
?>
