<?php

/* 
 * Purpose: "property" view for landlords
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:   4 Mar 2017
 */

session_start();

require_once ("./common/siteCommon.php");
require_once ("./common/dashboardHtmlFnLibrary.php");
require_once ("./common/propertyHtmlFnLibrary.php");

// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");

$role = $_SESSION['userInfo']['role'];

if($role != "Landlord") {
    // only landlords should have access to this page, if not a landlord
    // redirect to dashboard.

    header("Location: ./dashboard.php"); /* Redirect browser */
    exit();
}

displayPageHeader('Properties');
displayPropListHeader();
displayPropListActionPanel();  
displayPropListTable();
displayPageFooter();

?>
