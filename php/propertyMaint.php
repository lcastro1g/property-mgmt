<?php

/* 
 * Purpose: Property Maintenance page
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    26 Feb 2017
 */

session_start();

// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");
require_once ("./common/siteCommon.php");
require_once ("./common/propertyHtmlFnLibrary.php");
require_once ("./common/sql/PropertySql.php");

vacantPropertyHousekeeping;

//Nobody other than Landlord should have access to this page
if($_SESSION['userinfo']['role'] != "Landlord") {
    header("Location: ./dashboard.php");
    exit();
}

if(isset($_POST['propertyName'])) {
        $propID = $_POST['propertyID'];
        $propName = str_replace('\'', '\'\'', trim($_POST['propertyName']));
        $propAddr = str_replace('\'', '\'\'', trim($_POST['address']));
        $propCity = str_replace('\'', '\'\'', trim($_POST['city']));
        $propState = $_POST['state'];
        $propZip = $_POST['zip'];
        $propTenant = $_POST['propertyTenant'];
        $propServiceStaff = $_POST['propertyService'];
        $propLandlord = $_POST['landlordID'];
        
        $theProperty = new Property($propID, NULL, $propName, $propAddr, $propCity,
                $propState, $propZip, $propTenant, $propServiceStaff, $propLandlord, NULL);

    // is a POST request to add or update a new property
    if($_POST['propertyID'] ==  '-1') {
        // POST is for a NEW property
        addProperty($theProperty);
    } else {
        // Property ID is set so we are doing an update to existing record
        updateProperty($theProperty);
    }
    
    // redirect back to property list.  The updated or added property should
    // be apparent.
    header("Location: ./propertyList.php"); /* Redirect browser */
    exit();
}

$landlordId = $_SESSION['userInfo']['userid'];
if(isset($_GET['prop'])) {
    $propertyId = $_GET['prop'];
} else {
    $propertyId = -1;
}

displayPageHeader('Landlord Property Maintenance');
displayPropertyForm($landlordId, $propertyId);
displayPageFooter();

?>

