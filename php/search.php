<?php

/* 
 * Purpose: Search Service Request records by Status and Service Area
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    17 March 2017
 */

session_start();

require_once ("./common/siteCommon.php");
require_once ("./common/searchHtmlFnLibrary.php");


// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");

$role = $_SESSION['userInfo']['role'];

$searchType = (isset($_REQUEST['search-type'])) ? $_REQUEST['search-type'] : '';
$searchTerm = (isset($_REQUEST['search-term'])) ? $_REQUEST['search-term'] : '';


displayPageHeader('Dashboard');
displayDashHeader();
displayActionPanel($role);  
displaySearchPanel($searchType, $searchTerm);
displayDashTable($searchType, $searchTerm);
displayPageFooter();

?>
