<?php

/* 
 * Purpose: Dashboard common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     26 Feb 2017
 */

require_once ("./common/siteCommon.php");
require_once ("./common/dto/Property.php");
require_once ("./common/sql/PropertySql.php");
require_once ("./common/sql/UserSql.php");

function makePropertySelections($propertyList, $selectedProperty) {
    if($selectedProperty == -1) {
        $propSelectionHtml = "<option value=\"-1\" selected>Add New Property</option>";
    } else {
        $propSelectionHtml = "<option value=\"-1\">Add New Property</option>";
    }
    foreach($propertyList as $aProperty) {
        extract($aProperty);
        if($propertyId == $selectedProperty) {
            $propSelectionHtml .= "<option value=\"$PropertyID\" selected>$PropertyName</option>";
        } else {
            $propSelectionHtml .= "<option value=\"$PropertyID\">$PropertyName</option>";   
        }
    }
    return $propSelectionHtml;
}

//
// Builds the HTML options for all users of a specific role
function buildUserOptionsByRole($role, $selected) {
    $options = "";
    $roleUsers = getUsersByRole($role);
    foreach($roleUsers as $aUser) {
        extract($aUser);
        
        if($UserID == $selected) {
            $options .= "<option value=\"$UserID\" selected>$LastName, $FirstName</option>";
        } else {
            $options .= "<option value=\"$UserID\">$LastName, $FirstName</option>";
        }
    }
    return $options;
}


function displayPropertyForm($landlord, $selectedPropertyID) {
    //var_dump($landlord);
    
    //housekeeping hack for vacant properties
    vacantPropertyHousekeeping();

    $propertyList = getPropertyListForLandlord($landlord);
    //$propertySelections = makePropertySelections($propertyList, $selectedPropertyID);
    
    $propName = "";
    $propAddress = "";
    $propCity = "";
    $propState = "";
    $propZip = "";
    $propTenant = "";
    $propServiceStaff = "";
    $actionText = "Add a New Property";
    
    if($selectedPropertyID != -1) {
        $selectedProperty = getProperty($selectedPropertyID);
        extract($selectedProperty[0]);
        $propName = $Name;
        $propAddress = $Address;
        $propCity = $City;
        $propState = $State;
        $propZip = $ZipCode;
        $propTenant = $TenantID;
        $propServiceStaff = $ServiceStaffID;
        $actionText = "Edit Existing Property (Property ID = $selectedPropertyID)";
    }
    
    $tenantOptionsList = buildUserOptionsByRole(ROLE_TENANT, $propTenant);
    $serviceStaffOptionsList = buildUserOptionsByRole(ROLE_SERVICE, $propServiceStaff);
    
    $propertyMaintForm = <<< PROP_MAINT_FORM
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Landlord Activity: $actionText</div>
    <div class="panel-body">
        <form id="propMaintForm" class="form-horizontal" role="form" action="propertyMaint.php" method="post">
            
            <input type="hidden" name="propertyID" value="$selectedPropertyID">
            <input type="hidden" name="landlordID" value="$landlord">
            <div class="form-group">
                <label for="propertyName" class="col-md-3 control-label">Property Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="propertyName" value="$propName" pattern="[A-Za-z0-9\s]{5,40}" title="Characters, digits, or spaces, no symbols, at least 5 chars long, max 40 characters" required>
                </div>
            </div>
        
            <div class="form-group">
                <label for="address" class="col-md-3 control-label">Street Address</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="address" value="$propAddress" pattern="[A-Za-z0-9\s]{5,40}" title="Characters, digits, or spaces, no symbols, at least 5 chars long, max 40 characters" required>
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-md-3 control-label">City</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="city" value="$propCity" pattern="[A-Za-z\s]{2,40}" title="Characters or spaces, no symbols, at least 2 chars long" required>
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-md-3 control-label">State</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="state" value="$propState" pattern="[A-Z][A-Z]" title="Example: CO, AZ, SC" required>
                </div>
                <label for="zip" class="col-md-2 control-label">Zip</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="zip" value="$propZip" pattern="(\d{5}([\-]\d{4})?)" title="5 digit zip code" required>
                </div>
            </div>    
            <div class="form-group">
                <label for="propertyTenant" class="col-md-3 control-label">Assign Tenant</label>
                <div class="col-md-9">
                    <select name="propertyTenant" id="propertTenant" class="form-control">
                        $tenantOptionsList
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="propertyService" class="col-md-3 control-label">Assign Service Staff</label>
                <div class="col-md-9">
                    <select name="propertyService" id="propertService" class="form-control">
                        $serviceStaffOptionsList
                    </select>
                </div>
            </div>
            <div class="form-group">
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-submit" type="submit" name="submit" class="btn btn-success"><i class="icon-hand-right"></i>Submit</button>
                    <a href="./propertyList.php" class="btn btn-success" role="button"><i class="icon-hand-right"></i>Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
PROP_MAINT_FORM;
    
    echo $propertyMaintForm;
    
}


/*------------------------------------------------------------------------------
 * Displays the dashboard header paragraph
 *----------------------------------------------------------------------------*/
function displayPropListHeader() {
    $header = <<< PROP_HEADER
<h5>Landlord Property Management</h5>
<p>From here, landlord users can add or edit their properties.
PROP_HEADER;
    
echo $header;
    
}

/*------------------------------------------------------------------------------
 * Displays the landlord properties action panel
 *----------------------------------------------------------------------------*/
function displayPropListActionPanel() {
    
    $startActionPanel = <<< START_ACTION_PANEL
<div class="panel panel-success">
  <div class="panel-heading">Landlord-Properties Available Actions</div>
     <div class="panel-body">
START_ACTION_PANEL;
    
    $endActionPanel = <<< END_ACTION_PANEL
        <br><br>Or, use the below form below to edit one of your existing properties.
  </div> <!-- panel-body -->
</div> <!-- panel -->
END_ACTION_PANEL;

    $actionChoices = <<< ACTION_CHOICES
    <a href="propertyMaint.php" class="btn btn-success" role="button">Add New Property</a>
ACTION_CHOICES;

    
    /* Do the output */
    echo $startActionPanel;
    echo $actionChoices;
    echo $endActionPanel;
}

/* Filtered table view of properties */
function displayPropListTable() {
$tableHead = <<< TABLEHEAD
<table class = "table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Property Name</th>
      <th>Address</th>
      <th>City</th>
      <th>State</th>
      <th>Zip</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
TABLEHEAD;

$tableRows = buildPropListTableRows();

$tableFoot = <<< TABLEFOOT
  </tbody>
</table>
TABLEFOOT;

echo $tableHead;
echo $tableRows;
echo $tableFoot;  

if(strlen($tableRows) == 0) {
    echo "No properties current exist for current user.<br>";
}


}

/*------------------------------------------------------------------------------
 * Builds up a text string for all the table rows.
 *----------------------------------------------------------------------------*/
function buildPropListTableRows() {    
    $rows = "";
    $userID = $_SESSION['userInfo']['userid'];
    
    $properties = getPropertyList();
    //var_dump($userId);
    //var_dump($properties);
    foreach($properties as $aProperty) {
        extract($aProperty);
        //var_dump($aProperty);
        // Filter properties for only current user
        if($LandlordID != $userID) {
            continue;
        }

        $rows .= <<< HTML
          <tr>
            <td>$PropertyID</td>
            <td>$Name</td>
            <td>$Address</td>
            <td>$City</td>
            <td>$State</td>
            <td>$ZipCode</td>
            <td><a href="./propertyMaint.php?prop=$PropertyID" class="btn btn-success" role="button">Edit</a></td>
          </tr>
HTML;
        
    }
    
    return $rows;
}
?>

