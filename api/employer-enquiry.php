<?php
require_once __DIR__.'/config.php';cors_headers();
if(($_SERVER['REQUEST_METHOD']??'')!=='POST')send_json(405,['success'=>false,'message'=>'Method not allowed.']);
$d=request_data();$name=required_string($d,'name',150);$phone=required_string($d,'phone',30);$city=required_string($d,'city',120);$needs=required_string($d,'interest',190);$email=optional_string($d,'email',190);$message=optional_string($d,'message',5000);
if(empty($d['consent']))send_json(422,['success'=>false,'message'=>'Consent is required.']);
if(!preg_match('/^[0-9+() .-]{8,30}$/',$phone))send_json(422,['success'=>false,'message'=>'Please enter a valid phone number.']);
if($email!==null&&!filter_var($email,FILTER_VALIDATE_EMAIL))send_json(422,['success'=>false,'message'=>'Please enter a valid email.']);
$s=database()->prepare('INSERT INTO employer_enquiries(contact_name,phone,email,city,hiring_needs,message,consent) VALUES(?,?,?,?,?,?,1)');$s->execute([$name,$phone,$email,$city,$needs,$message]);
send_json(201,['success'=>true,'message'=>'Thank you. Your hiring enquiry has been recorded.']);
