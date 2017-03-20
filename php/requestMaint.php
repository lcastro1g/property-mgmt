<?php

/* 
 * Purpose: Service Request Maintenance
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
require_once ("./common/requestHtmlFnLibrary.php");
require_once ("./common/sql/CommentSql.php");

//hack for handling vacant properties
vacantPropertyHousekeeping();

//See if we are handling a DELETE request
if(isset($_GET['delete'])) {
    $requestToDelete = $_GET['delete'];
    
    // Delete the request. This will also delete linked comments
    deleteServiceRequest($requestToDelete);
    
    // redirect back to dashboard, deleted request should no longer be in list
    header("Location: ./dashboard.php");
    exit();
}

//See if we are handing a POST update/add event
if(isset($_POST['requestID'])) {
    //var_dump($_POST);
    
    $requestID = $_POST['requestID'];    
    if($requestID == 'New Request') {
        $requestID = -1;
    } 

    $requestStatus = $_POST['statusid'];
    $requestProperty = $_POST['property'];
    $requestServiceArea = $_POST['serviceArea'];
    $requestLandlord = $_POST['landlordid'];
    $requestTenant = $_POST['tenantid'];
    $requestServiceStaff = $_POST['servicestaffid'];
    $requestComment = str_replace('\'', '\'\'', trim($_POST['initialComment']));
    $requestDate = $_POST['requestDate'];
    $requestUser = $_SESSION['userInfo']['userid'];
    
    //echo("requestServiceArea = $requestServiceArea");
    
    $theRequest = new ServiceRequest($requestID, $requestStatus, $requestProperty, 
            $requestLandlord, $requestTenant, $requestServiceStaff, $requestServiceArea,
            $requestComment, $requestDate, $requestDate);
    
    if($requestID == -1) {
        //POST is for NEW service request
        addServiceRequest($theRequest);
        
        // If the user had initial comment, add it now.  Assuming the shortest 
        // legit comment is "OK" or something - i.e., 1 letter comment is 
        // meaningless.
        if( strlen($requestComment) > 1) {
            // So, this is hacky, but SQL Server does NOT play well with the 
            // normal OUTPUT clause on insert statements that have triggers.
            // get the most recent service request that is a complete match to
            // what was just added.
        
            $theNewRequest = getNewRequest($theRequest);
            //var_dump($theNewRequest);
         
            $theComment = new Comment($theNewRequest, $requestComment, $_SESSION['userInfo']['userid']);
            //var_dump($theComment);
            addComments($theComment);
        }
    } else {
        //POST is to UPDATE existing request
        updateServiceRequest($theRequest);
    }
    
    //redirect back to dashboard. The updated or added service request should
    //be apparent.
    header("Location: ./dashboard.php");
    exit();
}

$userid = 1;
if( isset($_GET["reqid"])) {
    $request_id = $_GET["reqid"];
} else {
    $request_id = NEW_REQUEST;
}
displayPageHeader('Service Request Maintenance');
echo("<script src=\"./common/javascript/servicerequest.js\"></script>");
displayServiceRequestForm($request_id);
displayPageFooter();

?>

