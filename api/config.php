<?php
declare(strict_types=1);
// Fill these on Hostinger. Never commit production secrets to GitHub.
const DB_HOST='localhost';
const DB_NAME='CHANGE_ME_DATABASE_NAME';
const DB_USER='CHANGE_ME_DATABASE_USER';
const DB_PASS='CHANGE_ME_DATABASE_PASSWORD';
const ALLOWED_ORIGIN='https://mahayouth.in';
function send_json(int $status,array $payload):never{http_response_code($status);header('Content-Type: application/json; charset=utf-8');header('Cache-Control: no-store');echo json_encode($payload,JSON_UNESCAPED_UNICODE);exit;}
function cors_headers():void{$origin=$_SERVER['HTTP_ORIGIN']??'';if($origin===ALLOWED_ORIGIN||$origin==='https://www.mahayouth.in'){header('Access-Control-Allow-Origin: '.$origin);header('Vary: Origin');}header('Access-Control-Allow-Methods: POST, OPTIONS');header('Access-Control-Allow-Headers: Content-Type');if(($_SERVER['REQUEST_METHOD']??'')==='OPTIONS'){http_response_code(204);exit;}}
function request_data():array{$data=json_decode(file_get_contents('php://input')?:'',true);if(!is_array($data))send_json(400,['success'=>false,'message'=>'Invalid request body.']);return $data;}
function required_string(array $d,string $k,int $max):string{$v=trim((string)($d[$k]??''));if($v===''||mb_strlen($v)>$max)send_json(422,['success'=>false,'message'=>'Please check the required fields.']);return $v;}
function optional_string(array $d,string $k,int $max):?string{$v=trim((string)($d[$k]??''));if($v==='' )return null;if(mb_strlen($v)>$max)send_json(422,['success'=>false,'message'=>'A field is too long.']);return $v;}
function database():PDO{try{return new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);}catch(Throwable $e){error_log('MahaYouth DB error: '.$e->getMessage());send_json(500,['success'=>false,'message'=>'Service temporarily unavailable.']);}}
