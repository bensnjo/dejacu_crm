<?php


function getmconn(){


// open IMAP connection
//$mail = imap_open('{gra104.truehost.cloud:993/novalidate-cert/imap/ssl}INBOX', 'test@wintec.co.ke', 'test@2021'); 
// or, open POP3 connection 
//$mail = imap_open('{10.150.11.10:995/novalidate-cert/pop3/ssl}', 'crm-beta@kra.go.ke', 'Cb?123456'); 
//$mail = imap_open('{192.168.4.1:995/novalidate-cert/pop3/ssl}', 'crm-beta@kra.go.ke', 'Cb?123456');
$mail = imap_open('{smtp.gmail.com/novalidate-cert/pop3/ssl}', 'bensnjo@gmail.com', 'kelvingitaukamau');
// grab a list of all the mail headers 
return $mail;

}

?>