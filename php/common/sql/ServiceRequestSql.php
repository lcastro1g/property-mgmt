<?php

/* 
 * Purpose: ServiceRequest SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/ServiceRequest.php");
require_once ("./common/sql/CommentSql.php");

function getServiceRequestList()
{
  $query = "Select * From ServiceRequestView";

  return executeQuery($query);
}

function getServiceRequest($serviceRequestID)
{
 $query = <<<STR
Select *
From ServiceRequestView
where serviceRequestID = $serviceRequestID
STR;

 return executeQuery($query);

}

function getServiceRequestByRequestStatus($searchTerm)
{
    $query = <<<STR
Select *
From ServiceRequestView
Where 0=0
STR;
    if ($searchTerm != '')
    {
    $query .= <<<STR
 And WorkflowStatus like '%$searchTerm%'
STR;
    }

return executeQuery($query);

}

function getServiceRequestByServiceArea($searchTerm)
{
    $query = <<<STR
Select *
From ServiceRequestView
Where 0=0
STR;
    if ($searchTerm != '')
    {
    $query .= <<<STR
 And ServiceArea like '%$searchTerm%'
STR;
    }

return executeQuery($query);

}



function addServiceRequest($serviceRequestDTO)
{
    //var_dump($serviceRequestDTO);
    $rPropID = $serviceRequestDTO->getPropertyID();
    $rLandlordID = $serviceRequestDTO->getLandlordID();
    $rTenantID = $serviceRequestDTO->getTenantID();
    $rServiceStaffID = $serviceRequestDTO->getServiceStaffID();
    $rWorkflowStatusID = $serviceRequestDTO->getStatusID();
    $rServiceAreaID = $serviceRequestDTO->getServiceAreaID();
    $rComment = $serviceRequestDTO->getComment();
    
    $query = <<<QUERY
INSERT INTO servicerequest(PropertyID, LandlordID, TenantID, ServiceStaffID,
WorkflowStatusID, ServiceAreaID) 
VALUES ($rPropID, $rLandlordID, $rTenantID, $rServiceStaffID, $rWorkflowStatusID, $rServiceAreaID);
QUERY;
    
    $result = executeQuery($query);
    //var_dump($result);
}

function getNewRequest($serviceRequestDTO)
{
    // Since OUTPUT clause won't work with triggers, this is a cludge to grab
    // the a specific request that we don't know the requestID of.
    $rPropID = $serviceRequestDTO->getPropertyID();
    $rLandlordID = $serviceRequestDTO->getLandlordID();
    $rTenantID = $serviceRequestDTO->getTenantID();
    $rServiceStaffID = $serviceRequestDTO->getServiceStaffID();
    $rWorkflowStatusID = $serviceRequestDTO->getStatusID();
    $rServiceAreaID = $serviceRequestDTO->getServiceAreaID();
    
    $query = <<<QUERY
SELECT TOP 1 * FROM servicerequest WHERE PropertyID = $rPropID AND LandlordID = $rLandlordID 
AND TenantID = $rTenantID AND ServiceStaffID = $rServiceStaffID AND WorkflowStatusID = $rWorkflowStatusID
AND ServiceAreaID = $rServiceAreaID ORDER BY ServiceRequestID DESC    
QUERY;
    
    $result = executeQuery($query);
    //var_dump($result);
    //var_dump($result[0]['ServiceRequestID']);
    return $result[0]['ServiceRequestID'];
}


function deleteServiceRequest($serviceRequestID) {
    $query = <<<STR
Delete 
From servicerequest
where serviceRequestID = $serviceRequestID
STR;
    
    // Delete any linked comments first
    deleteCommentsByRequestID($serviceRequestID);

    // Now safe to delete the service request record.
    return executeQuery($query);

}
   
function updateServiceRequest($serviceRequestDTO)
{
    //var_dump($serviceRequestDTO);
    $rPropID = $serviceRequestDTO->getPropertyID();
    $rLandlordID = $serviceRequestDTO->getLandlordID();
    $rTenantID = $serviceRequestDTO->getTenantID();
    $rServiceStaffID = $serviceRequestDTO->getServiceStaffID();
    $rWorkflowStatusID = $serviceRequestDTO->getStatusID();
    $rServiceAreaID = $serviceRequestDTO->getServiceAreaID();
    $rComment = $serviceRequestDTO->getComment();
    $rID = $serviceRequestDTO->getServiceRequestID();
    
    $query = <<<QUERY
UPDATE servicerequest SET WorkflowStatusID = $rWorkflowStatusID, ServiceAreaID = $rServiceAreaID
WHERE ServiceRequestID = $rID;
QUERY;
    
    $result = executeQuery($query);
    //die(var_dump($result));
}

