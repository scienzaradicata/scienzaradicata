<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "errore; devi sottoscriverti!";
}
$name = $_POST['nome'];
$visitor_email = $_POST['email'];
$surname = $_POST['cognome'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Nome e email sono obbligatori!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Spam!";
    exit;
}

$email_from = 'ale.24m@gmail.com';//<== update the email address
$email_subject = "Nuova sottoscrizione";
$email_body = "$name $surname vuole iscriversi alla newsletter.\n".
    
$to = "ale.24m@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: index.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 