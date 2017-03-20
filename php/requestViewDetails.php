<?php

/* 
 * Purpose: Service Request View Details
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    05 March 2017
 */

session_start();

// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");
require_once ("./common/siteCommon.php");
require_once ("./common/requestHtmlFnLibrary.php");
require_once ("./common/dto/ServiceRequestView.php");
require_once ("./common/sql/ServiceRequestSql.php");
require_once ("./common/sql/CommentSql.php");


if( isset($_GET["reqid"])) {
    $request_id = $_GET["reqid"];
} else {
    header('Refresh: 2; URL=dashboard.php');
    displayPageHeader('Dasboard');
    displayTransitionMessage('Invalid Service Request. You will now be redirected to our dashboard page.');
    displayPageFooter();
    die();
}

$serviceRequestView = getServiceRequest($request_id);
extract($serviceRequestView[0]);

$serviceRequestViewDTO = new ServiceRequestView(
        $ServiceRequestID,
        $PropertyName,
        $TenantFirstName,
        $TenantLastName,
        $LandLordFirstName,
        $LandlordLastName,
        $ServiceStaffFirstName,
        $ServiceStaffLastName,
        $WorkflowStatus,
        $ServiceArea,
        $SRCreateDate,
        $SRLastEditDate,
        $LandlordID,
        $TenantID,
        $ServiceStaffID
        );


$commentList = getCommentListByRequestID($request_id);

displayPageHeader('Service Request View Details');
displayServiceRequestView($serviceRequestViewDTO);
displayCommentsTable($commentList,$serviceRequestViewDTO);
displayPageFooter();

?>

