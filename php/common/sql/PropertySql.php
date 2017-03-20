<?php

/* 
 * Purpose: Property SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/Property.php");


function getPropertyList()
{
  $query = "Select * From property Order by name";

  return executeQuery($query);
  //return executeQuery("Exec getUsersList");

}

function getPropertyListForLandlord( $landlordID ) {
  //exit if we don't have a valid id
  if(!is_numeric($landlordID)) {
      return;
  }
  $query = "SELECT * FROM PropertyView WHERE PropertyView.LandlordID = $landlordID ORDER BY PropertyView.Name";
  
  return executeQuery($query);
}

function getPropertyListForTenant( $tenantID ) {
  //exit if we don't have a valid id
    //echo("In getPropertyListForTenant(), tenantID = $tenantID<br>");
  if(!is_numeric($tenantID)) {
      echo(is_int($tenant_ID));
      echo("returning early");
      return;
  }
  //Tenant should only be associated with 1 property
    //echo("in getPropertyListForTenant tenantID = $tenantID ");
  $query = "SELECT * FROM PropertyView WHERE PropertyView.TenantID = $tenantID";
  
  //var_dump($query);
  
  return executeQuery($query);
}
  
function getPropertyListForServiceStaff( $serviceStaffID ) {
  //exit if we don't have a valid id
  if(!is_numeric($serviceStaffID)) {
      return;
  }
  $query = "SELECT * FROM PropertyView WHERE PropertyView.ServiceStaffID = $serviceStaffID";
  //die(var_dump($query));
  return executeQuery($query);
}
  
function getProperty($propertyID)
{
$query = <<<STR
Select *
From property
where propertyID = $propertyID
STR;

 return executeQuery($query);

}
   
function addProperty(Property $propertyDTO)
{
    $pName = $propertyDTO->getName();
    $pAddr = $propertyDTO->getAddress();
    $pCity = $propertyDTO->getCity();
    $pState = $propertyDTO->getState();
    $pZip = $propertyDTO->getZipCode();
    $pTenant = $propertyDTO->getTenantID();
    $pService = $propertyDTO->getServiceStaffID();
    $pLandlord = $propertyDTO->getLandlordID();
    
    
    //Whatever tenant is assigned has to be removed from any other property they 
    //may be at.
    clearTenantFromProperties($pTenant);
    
    $query = <<<QUERY
INSERT INTO Property(Name, Address, City, State, ZipCode, TenantID,
            LandlordID, ServiceStaffID) VALUES ('$pName', '$pAddr',
            '$pCity', '$pState', $pZip, $pTenant, $pLandlord, $pService)
QUERY;
    
    var_dump($query);
    
    return( executeQuery($query));
}

/*------------------------------------------------------------------------------
Database enforces that a tenant can only be associated with a single property.
This function should be called before assigning a tenant to any property.  It
will clear then tenant from any existing property so that they can be added to
the new one.
------------------------------------------------------------------------------*/
function clearTenantFromProperties($tenant) {
    $tenantPropertyList = getPropertyListForTenant($tenant);
    //var_dump($tenantPropertyList);
    foreach($tenantPropertyList as $aProperty) {
        //This really should always be a 1-property list, but looping anyways to
        //clean up any bogus records we may have introduced early on.
        extract($aProperty);
        $query = <<<QUERY
UPDATE Property SET TenantID = NULL WHERE PropertyID = $PropertyID
QUERY;
        //var_dump($query);
        executeQuery($query);
    }
    return;
}
   
function deleteProperty($propertyID)
{
 $query = <<<STR
Delete 
From property
where propertyID = $propertyID
STR;

 return executeQuery($query);

}
   
function updateProperty($propertyDTO)
{   $pID = $propertyDTO->getPropertyID();
    $pName = $propertyDTO->getName();
    $pAddr = $propertyDTO->getAddress();
    $pCity = $propertyDTO->getCity();
    $pState = $propertyDTO->getState();
    $pZip = $propertyDTO->getZipCode();
    $pTenant = $propertyDTO->getTenantID();
    $pService = $propertyDTO->getServiceStaffID();
    $pLandlord = $propertyDTO->getLandlordID();
    
    //Have to clear tenant from any other property they may be associated with
    clearTenantFromProperties($pTenant);
    
    $query = <<<QUERY
UPDATE Property SET Name = '$pName', Address = '$pAddr', City = '$pCity',
    State = '$pState', ZipCode = '$pZip', TenantID = $pTenant, ServiceStaffID = $pService
    WHERE PropertyID = $pID
QUERY;
    
    //die(var_dump($query));
    
    executeQuery($query);
    
    //All service requests for this property get re-assigned to the new service staff
    //real application would not do this but it simplifies business logic for project
    $query2 = <<<QUERY2
UPDATE ServiceRequest SET ServiceStaffID = $pService WHERE PropertyID = $pID
QUERY2;
    
    executeQuery($query2);
    return;
}

function vacantPropertyHousekeeping() {
    // Work-around / hack on handling vacant properties.
    // We don't want properties with NULL tenant, and have special user
    // id (#19) for VACANT tenant.
    // This function will go through properties and put tenant 19 in
    // any property that has NULL for a tenant.
    $vacantTenantID = 19;  // magic number, but works for now
    $query = <<<QUERY
UPDATE Property SET TenantID = $vacantTenantID WHERE TenantID IS NULL
QUERY;
    
    return( executeQuery($query));
}
