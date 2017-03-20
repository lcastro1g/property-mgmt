<?php

/* 
 * Purpose: Logouts the user from the application
 * 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     01 March 2017
 */

require_once ("./common/siteCommon.php");
require_once ("./common/userHtmlFnLibrary.php");

session_start();

// the cookie that holds the session id is destroyed

if (isset($_COOKIE[session_name()]))
{
    setcookie(session_name(),"",time()-3600); //destroy the session cookie on the client
}

$_SESSION = array(); // unset or remove all data from the $_SESSION array
session_destroy(); //erase session data from the disk
session_write_close(); // make sure the changes are committed

header('Refresh: 2; URL=home.php');
displayHomePageHeader('Register');
displayTransitionMessage('Thank you for Logging out. You will now be redirected to our home page.');
displayPageFooter();

die();
?>
