<?php

require_once('const.php');
require_once('classes/WriteLogs.php');
require_once('classes/simple_html_dom.php');
require_once('classes/NovaPosta.php');
require_once('classes/TelegramMessages.php');


$telegr = new TelegramMessages();
$log    = new WriteLogs();
$np     = new NovaPosta();

$telegr->get_msg();

$np_number  = $telegr->message;
// $np_number = $_GET['n'];
// echo $address    = $np->get_address($np_number);
$address    = $np->get_address($np_number);
// $status    = $np->get_status();
// echo $np->status;
$telegr->send_answer($np->status);
$telegr->send_answer($address);

$log->mlog(IS_WRITE_LOG, $telegr->data); 
