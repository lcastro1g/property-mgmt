<?php

/* 
 * Purpose: Dashboard common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     20 Feb 2017
 */

require_once("./common/dto/ServiceRequest.php");
require_once("./common/sql/ServiceRequestSql.php");

/*------------------------------------------------------------------------------
 * Builds up a text string for all the table rows.
 *----------------------------------------------------------------------------*/
function buildTableRows() {    
    $rows = "";
    $userRole = $_SESSION['userInfo']['role'];
    $userId = $_SESSION['userInfo']['userid'];
    
    $serviceRequests = getServiceRequestList();
    foreach($serviceRequests as $aServiceRequest) {
        extract($aServiceRequest);
        //var_dump($aServiceRequest);
        //var_dump($userRole);
        
        //Tenant and Landlord get the option of deleting a service request
        $btnDeleteHTML = "&nbsp<a href=\"./requestMaint.php?delete=$ServiceRequestID\" class=\"btn btn-danger\" role=\"button\">Delete</a>";   
        
        // Filter requests displayed on dasboard based on user role
        switch($userRole) {
            case "Landlord":
                // Landlord should only see rows where they are entered as the
                // landlord
                if($userId != $LandlordID) {
                    continue 2;
                }
                break;
            
            case "Tenant":
                // Tenant should only see rows where they are tenant
                if($userId != $TenantID ) {
                    continue 2;
                }
                break;
            
            case "Service Staff":
                // Service Staff should only see rows where they are assigned.
                // Service staff don't get the delete button option
                $btnDeleteHTML="";
                if($userId != $ServiceStaffID) {
                    continue 2;
                }
                break;
        }

        $rows .= <<< HTML
          <tr>
            <td>$ServiceRequestID</td>
            <td>$PropertyName</td>
            <td>$ServiceArea</td>
            <td>$TenantLastName, $TenantFirstName</td>
            <td>$WorkflowStatus</td>
            <td>$ServiceStaffLastName, $ServiceStaffFirstName</td>
            <td><a href="./requestViewDetails.php?reqid=$ServiceRequestID" class="btn btn-success" role="button">Details</a>&nbsp
                <a href="./requestMaint.php?reqid=$ServiceRequestID" class="btn btn-success" role="button">Edit</a>&nbsp$btnDeleteHTML</td>&nbsp             
          </tr>
HTML;
        
    }
    
    return $rows;
}

/*------------------------------------------------------------------------------
 * Displays the dashboard header paragraph
 *----------------------------------------------------------------------------*/
function displayDashHeader() {
    $dashHeader = <<< DASH_HEADER
<h5>User Dashboard</h5>
<p>Welcome to your user dashboard. From here you can access all the site functionality
you may need based on your role as a Tenant, Landlord, or Service Staff using the controls
below.
DASH_HEADER;
    
echo $dashHeader;
    
}


/*------------------------------------------------------------------------------
 * Displays the dashboard action panel
 *----------------------------------------------------------------------------*/
function displayActionPanel($role) {
    
    $startActionPanel = <<< START_ACTION_PANEL
<div class="panel panel-success">
  <div class="panel-heading">$role Available Actions</div>
     <div class="panel-body">
START_ACTION_PANEL;
    
    $endActionPanel = <<< END_ACTION_PANEL
        <br><br>Or, use the below form, you may search and/or update any existing service request.
  </div> <!-- panel-body -->
</div> <!-- panel -->
END_ACTION_PANEL;

    /* VS: I don't really like this setup as it is inefficient, but leaving for now
     * may revisit later if time.  (i.e. declare 3 vars, only ever use 1 of them.)
     * probably just need to put it inside the switch, but I am trying to keep
     * HTML from intermingling with PHP logic.
     */
    $tenantActionChoices = <<< TENANT_ACTION_CHOICES
    <a href="requestMaint.php" class="btn btn-success" role="button">New Service Request</a>
TENANT_ACTION_CHOICES;
    
    $landlordActionChoices = <<< LANDLORD_ACTION_CHOICES
    <a href="propertyList.php" class="btn btn-success" role="button">Properties</a>
    <a href="requestMaint.php" class="btn btn-success" role="button">New Service Request</a>
LANDLORD_ACTION_CHOICES;
    
    $serviceActionChoices = <<< SERVICE_ACTION_CHOICES
    <a href="requestMaint.php" class="btn btn-success" role="button">New Service Request</a>
SERVICE_ACTION_CHOICES;
    
    /* Do the output */
    echo $startActionPanel;
    switch($role) {
        case "Tenant":
            echo $tenantActionChoices;
            break;
        case "Landlord":
            echo $landlordActionChoices;
            break;
        case "Service Staff":
            echo $serviceActionChoices;
            break;
        default:
            echo "Error: unrecognized role. No choices available";
    }

echo $endActionPanel;
}

/* Customized search */
function displaySearchPanel() {

    $searchPanel = <<< SEARCH_PANEL
    <br/>
    <form role="search" action="search.php" method="get">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <select name="search-type" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                <option value="all">All</option>
                                <option value="status" $searchStatus>Status</option>
                                <option value="service" $searchServiceArea>Service Area</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="search-term" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
     </form>
     <br/><br/>       
SEARCH_PANEL;
    //var_dump($activeSearchTerm);
    echo $searchPanel;
} /* displaySearchPanel() */

/* Filtered table view of service requests */
function displayDashTable() {
$tableHead = <<< TABLEHEAD
<table class = "table table-hover">
  <thead>
    <tr>
      <th>Date</th>
      <th>Property</th>
      <th>Service Area</th>
      <th>Tenant</th>
      <th>Status</th>
      <th>Assigned To</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
TABLEHEAD;

$tableRows = buildTableRows();

$tableFoot = <<< TABLEFOOT
  </tbody>
</table>
TABLEFOOT;

echo $tableHead;
echo $tableRows;
echo $tableFoot;  

if(strlen($tableRows) == 0) {
    echo "No matching service request records for this user in this role.<br>";
}
}
?>

            
            