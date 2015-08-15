<?php
/*
jQuery Fancy Captcha
www.webdesignbeach.com
Created by Web Design Beach.
Copyright 2009 Web Design Beach. All rights reserved.
$LastChangedDate: 2013-02-17 11:59:36 -0800 (Sun, 17 Feb 2013) $
$Rev: 9855 $
*/
session_start(); /* starts session to save generated random number */

$rand = rand(0,4);
$_SESSION['captcha'] = $rand;
echo $rand;
?>