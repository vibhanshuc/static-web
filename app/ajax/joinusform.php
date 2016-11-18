<?php
header('Content-Type: application/json; charset=utf-8');
$arr = array();
foreach ($_POST["ct"] as $key => $value) {
  $arr[$key] =  $value;
}
 $arr['resume'] = $_FILES["ct"];


$attachment = '/tmp/'.str_replace(" ", "_", $arr['resume']['name']["resume"]);
$tmp= $arr['resume']['tmp_name']["resume"];
move_uploaded_file($tmp, $attachment);
// $attachment = 'tmp/'.$arr['resume']['name']["resume"];
$to1 = 'karan95raina@gmail.com';
$positions = implode(", ", $arr['position']);
$to2 = 'jobs@actiwate.in';
//$to3 = 'puneetkohli521@gmail.com';
$name = $arr['fname']." ".$arr['lname'];
$email = $arr['email'];
$phone = $arr['phone'];
$college = $arr['college'];
$city = $arr['city'];
$job_type = $arr['job_type'];
$email_subject = "Actiwate - Job application for $positions by $name";
$email_body = "You have received a new message job application.\n\n
Here are the details:
\nName: $name
\nEmail: $email
\nPhone: $phone
\nCollege : $college
\nCurrent City : $city
\nApplying for : $positions
\nJob Type : $job_type
";


$email_subject2 = "Actiwate - Job Application Received";
$email_body2 = "Hi $name\n\nThanks for showing interest to work with us.\nWe will review your application and get back to you shortly.\n\nTeam Actiwate";
//echo "line1 ";
$output = exec("curl -s --user 'api:key-41e68fb746227ec0ddaaa6040da54887'  https://api.mailgun.net/v3/actiwate.in/messages -F from='Actiwate <mailgun@actiwate.in>' -F to=$to1 -F to=$to2 -F to=$to3  -F subject='$email_subject'  -F text='$email_body' -F attachment=@$attachment");
$arr['output1']=$output ;
$output2 = exec("curl -s --user 'api:key-41e68fb746227ec0ddaaa6040da54887'  https://api.mailgun.net/v3/actiwate.in/messages -F from='Actiwate <mailgun@actiwate.in>' -F to=$email -F subject='$email_subject2'  -F text='$email_body2'");
$output3 = exec("rm $attachment");


echo json_encode($arr);
?>
