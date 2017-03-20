<?php

/* 
 * Purpose: Request add/maintenance - common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     26 Feb 2017
 */

require_once ("./common/dto/ServiceRequest.php");
require_once ("./common/sql/ServiceRequestSql.php");
require_once ("./common/sql/ServiceAreaSql.php");
require_once ("./common/sql/WorkflowStatusSql.php");
require_once ("./common/sql/PropertySql.php");


/* -----------------------------------------------------------------------------
 * Builds a text string of all the Properties specific to the current user for 
 * dropdown menu.
 * ---------------------------------------------------------------------------*/
function buildPropertyListOptions() {
    $options = "";
    $userRole = $_SESSION['userInfo']['role'];
    $userID = $_SESSION['userInfo']['userid'];
    
    switch($userRole) {
        case "Landlord":
            //echo("In buildPropertyListOptions() Landlord Case<br>");
            $propList = getPropertyListForLandlord($userID);
            break;
        
        case "Tenant":
            $propList = getPropertyListForTenant($userID);
            break;
        
        case "Service Staff":
            $propList = getPropertyListForServiceStaff($userID);
            break;
    }
    
    //var_dump($propList);
    foreach ($propList as $aProperty)
    {
       extract($aProperty);
       $tenantName = $TenantFirstName . " " . $TenantLastName;
       $landlordName = $LandlordFirstName . " " . $LandlordLastName;
       $servicestaffName = $ServiceStaffFirstName . " " . $ServiceStaffLastName;       
       
       $options .= <<<HTML
       <option value="$PropertyID" data-landlordID="$LandlordID"
           data-landlordName="$landlordName" data-tenantID="$TenantID"
           data-tenantName="$tenantName" data-servicestaffID="$ServiceStaffID"
           data-servicestaffName="$servicestaffName">$Name</option>
HTML;
    }
    
    return $options;
}

/* -----------------------------------------------------------------------------
 * Builds a text string of all the service area options for dropdown menu.
 * ---------------------------------------------------------------------------*/
function buildServiceAreaOptions() {
    $options = "";
    $serviceAreas = getServiceAreaList();  // get the service areas to populate the dropdown
    foreach ($serviceAreas as $aServiceArea)
    {
       extract($aServiceArea);
       $options .= <<<HTML
       <option value="$ServiceAreaID">$ServiceArea</option>
HTML;
    }
    return $options;
}


/* -----------------------------------------------------------------------------
 * Builds a text string of all the status options for dropdown menu.
 * ---------------------------------------------------------------------------*/
function buildStatusOptions($currentStatus) {
    
    //if this is a tenant, they don't have ability to change status
    $is_tenant = ($_SESSION['userInfo']['role'] == "Tenant");
    $options = "";
    $statusList = getWorkflowStatusList();  // get the statuses to populate the dropdown
    //var_dump($statusList);
    //var_dump($currentStatus);
    //var_dump($is_tenant);
    foreach ($statusList as $aStatus)
    {
       //var_dump($aStatus);
       //var_dump($options);
       extract($aStatus);
       
       // If the user is a Tenant, the only status they should see is the current
       // status, and have no ability to edit.
       if( ($is_tenant == true) && ($currentStatus != $WorkflowStatus)) {
           //echo("hit continue");
           continue;
       }
       
       if($currentStatus == $WorkflowStatus) {
          $options .=  "<option value=\"$WorkflowStatusID\" selected>$WorkflowStatus</option>";  
       } else {
        $options .=  "<option value=\"$WorkflowStatusID\">$WorkflowStatus</option>";
       }
    }
    return $options;
}


function displayServiceRequestForm($requestID) {

    $action_text = "Add New ";
    $is_new = ( $requestID == NEW_REQUEST );
    
    if( !$is_new ) {
        // Need to edit / change an existing request - use the full view so we
        // have all the details.
        $theRequest = getServiceRequest($requestID);
        //var_dump($theRequest);
        extract($theRequest[0]);
        
        $action_text = "Edit Existing ";
        $requestID_text = $requestID;
        $commentLabel_text = "Initial Comment";
        $tenantName_text = "$TenantLastName, $TenantFirstName";
        $landlordName_text = "$LandlordLastName, $LandlordFirstName";
        $serviceStaff_text = "$ServiceStaffLastName, $ServiceStaffFirstName";
        $date = $SRCreateDate;
        
        $commentReadOnly = " readonly ";
        
        $firstComment = getInitialCommentForServiceRequest($requestID);
        //var_dump($firstComment);
        extract($firstComment[0]);
        //var_dump($Comments);
        $firstCommentText = "";
        if(strlen($Comments) > 1) {
            $firstCommentText = $Comments;
        }
        //die(var_dump($firstCommentText));
    } else {
        $action_text = "Add New ";
        $requestID_text = "New Request";
        $requestID = -1;
        $commentLabel_text = "Initial Comment";
        $WorkflowStatus = "Pending";  // all new requests start as Pending
        $date = date('m/d/y');
        $firstCommentText = "";
        $commentReadOnly = "";
    }
    
    $serviceAreaOptions = buildServiceAreaOptions($requestID, $is_new);
    $statusOptions = buildStatusOptions($WorkflowStatus);
    $propertyOptions = buildPropertyListOptions();
    

    $requestMaintForm = <<< REQ_MAINT_FORM
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">$action_text Service Request</div>
    <div class="panel-body">
        <form id="reqMaintForm" class="form-horizontal" role="form" action="requestMaint.php" method="post">
            
            <div class="form-group">
                <label for="requestID" class="col-md-3 control-label">Request ID</label>
                <div class="col-md-2">
                    <!-- request ID is non-editable, system assigned -->
                    <input type="text" class="form-control" name="requestID" readonly value="$requestID_text"> 
                </div>
                <label for="status" class="col-md-1 control-label">Status</label>
                <div class="col-md-2">
                    <select name="statusid" id="statusid" class="form-control">
                    $statusOptions
                    </select>
                </div>
                <label for="date" class="col-md-2 control-label">Date Entered</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="date" readonly value="$date">
                </div>
            </div>
        
            <div class="form-group">
                <label for="property" class="col-md-3 control-label">Property Name:</label>
                <div class="col-md-9">
                    <select name="property" id="property" class="form-control" onchange="loadPropertyData()">
                        $propertyOptions
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tenant" class="col-md-3 control-label">Tenant</label>
                <div class="col-md-9">
                    <input type="hidden" id="tenantid" name="tenantid" value="">
                    <input type="text" class="form-control" id="tenantname" name="tenant" readonly value="$tenantName_text">
                </div>
            </div>
            <div class="form-group">
                <label for="landlord" class="col-md-3 control-label">Landlord</label>
                <div class="col-md-9">
                    <input type="hidden" id="landlordid" name="landlordid" value="">
                    <input type="text" class="form-control" id="landlordname" name="landlord" readonly value="$landlordName_text">
                </div>
            </div>   
            <div class="form-group">
                <label for="serviceStaff" class="col-md-3 control-label">Service Staff Assigned</label>          
                <div class="col-md-9">
                    <input type="hidden" id="servicestaffid" name="servicestaffid" value="">
                    <input type="text" class="form-control" id="servicestaffname" name="serviceStaff" readonly value="$serviceStaff_text">
                </div>
            </div>  
            <div class="form-group">
                <label for="ServiceArea" class="col-md-3 control-label">Service Area</label>
                <div class="col-md-9">
                    <select name="serviceArea" id="serviceArea" class="form-control">
                        $serviceAreaOptions
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="initialComment" class="col-md-3 control-label">$commentLabel_text</label>
                <div class="col-md-9">
                    <textarea name="initialComment" class="form-control" rows="5" id="comment" $commentReadOnly>$firstCommentText</textarea>
                </div>
            </div>
            <div class="form-group">
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-submit" type="submit" name="submit" class="btn btn-success"><i class="icon-hand-right"></i>Submit</button>
                    <a href="./dashboard.php" class="btn btn-success" role="button"><i class="icon-hand-right"></i>Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
REQ_MAINT_FORM;
    
    echo $requestMaintForm;
    
}

function displayServiceRequestView(ServiceRequestView $serviceRequestView) {
    
    $serviceRequestID = $serviceRequestView->getServiceRequestID(); 
    $propertyName = $serviceRequestView->getPropertyName(); 
    $tenantName = $serviceRequestView->getTenantFirstName() . " " . $serviceRequestView->getTenantLastName();
    $landlordName = $serviceRequestView->getLandlordFirstName() . " " . $serviceRequestView->getLandlordLastName();
    $serviceStaffName = $serviceRequestView->getServiceStaffFirstName() . " " . $serviceRequestView->getServiceStaffLastName();
    $workflowStatus = $serviceRequestView->getWorkflowStatus();
    $serviceArea = $serviceRequestView->getServiceArea();
    $createdDate = $serviceRequestView->getCreatedDate();
    $lastEditDate = $serviceRequestView->getLastEditDate();
    
    $serviceRequestView = <<< SERVICEREQUESTVIEW
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Service Request Details</div>
    <div class="panel-body">
        <form id="reqViewForm" class="form-horizontal" role="form">
            
            <div class="form-group">
                <label for="requestID" class="col-md-3 control-label">Request ID</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="requestID" readonly value="$serviceRequestID"> 
                </div>
            </div> 
            <div class="form-group">
                <label for="property" class="col-md-3 control-label">Property Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="requestID" readonly value="$propertyName"> 
                </div>
            </div>
            <div class="form-group">
                <label for="tenant" class="col-md-3 control-label">Tenant</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="tenant" readonly value="$tenantName">
                </div>
                <label for="landlord" class="col-md-3 control-label">Landlord</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="landlord" readonly value="$landlordName">
                </div>
            </div>
            <div class="form-group">
                <label for="serviceStaff" class="col-md-3 control-label">Service Staff Assigned</label>
                <div class="col-md-2">           
                    <input type="text" class="form-control" name="servicestaff" readonly value="$serviceStaffName">
                </div>
                <label for="workflowStatus" class="col-md-3 control-label">Workflow Status</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="worflowstatus" readonly value="$workflowStatus">
                </div>
            </div>  
            <div class="form-group">
                <label for="serviceArea" class="col-md-3 control-label">Service Area</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="servicearea" readonly value="$serviceArea">
                </div>
            </div>
            <div class="form-group">
                <label for="createdDate" class="col-md-3 control-label">Created Date</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="createddate" readonly value="$createdDate">
                </div>
                <label for="lastEditDate" class="col-md-3 control-label">Last Updated Date</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="lasteditdate" readonly value="$lastEditDate">
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
SERVICEREQUESTVIEW;
    
    echo $serviceRequestView;
}

function displayCommentsTable($commentList, ServiceRequestView $serviceRequestView) {
    $requestID = $serviceRequestView->getServiceRequestID();
    $property = $serviceRequestView->getPropertyName();

    $tableHead = <<< TABLEHEAD
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Comments Details</div>
    <div class="panel-body">
        <form id="commentForm" class="form-horizontal" role="form">
            <div class="form-group">
                <table class = "table table-hover">
                  <thead>
                    <tr>
                      <th>Submitter</th>
                      <th>Submitter Role</th>
                      <th>Date Created</th>
                      <th>Comment Description</th>
                    </tr>
                  </thead>
                  <tbody>
TABLEHEAD;

    $tableRows = buildCommentsTableRows($commentList);

    $tableFoot = <<< TABLEFOOT
                </tbody>
              </table>
            <div class="form-group">
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                    <a href="./commentMaint.php?reqid=$requestID" class="btn btn-success" role="button"><i class="icon-hand-right"></i>Add Comment</a>
                    <a href="./dashboard.php" class="btn btn-success" role="button"><i class="icon-hand-right"></i>Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
TABLEFOOT;

    echo $tableHead;
    echo $tableRows;
    echo $tableFoot;  

    if(strlen($tableRows) == 0) {
        echo "No matching comments records for this service request.<br>";
    }
}

function buildCommentsTableRows($commentList) {
    
    $rows = "";
    
    foreach($commentList as $comment) {
        extract($comment);
        $rows .= <<< HTML
          <tr>
            <td>$FirstName, $LastName</td>
            <td>$Role</td>
            <td>$CommentDate</td>
            <td>$Comments</td>
          </tr>
HTML;
        
    }
    
    return $rows;
}

?>

