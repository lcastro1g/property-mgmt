<?php

/* 
 * Purpose: "Dashboard" view into service requests
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    18 Feb 2017
 */

session_start();

require_once ("./common/siteCommon.php");
require_once ("./common/dashboardHtmlFnLibrary.php");


// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");

$role = $_SESSION['userInfo']['role'];

displayPageHeader('Dashboard');
displayDashHeader();
displayActionPanel($role);  
displaySearchPanel();
displayDashTable();
displayPageFooter();

?>
