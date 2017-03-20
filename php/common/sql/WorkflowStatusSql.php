<?php

/* 
 * Purpose: WorkflowStatus SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/WorkflowStatus.php");

function getWorkflowStatusList()
{
  $query = "Select * From workflowstatus";

  return executeQuery($query);
  //return executeQuery("Exec getUsersList");

}
   
function getWorkflowStatus($workflowStatusID)
{
 $query = <<<STR
Select *
From workflowstatus
where workflowStatusID = $workflowStatusID
STR;

 return executeQuery($query);

}
   
function addWorkflowStatus($workflowStatusDTO)
{

}
   
function deleteWorkflowStatus($workflowStatusID)
{
 $query = <<<STR
Delete 
From workflowstatus
where workflowStatusID = $workflowStatusID
STR;

 return executeQuery($query);

}
   
function updateWorkflowStatus($workflowStatusDTO)
{

}



