<?php

/* 
 * Purpose: ServiceArea SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/ServiceArea.php");

function getServiceAreaList()
{
  $query = "Select * From servicearea";

  return executeQuery($query);
  //return executeQuery("Exec getUsersList");

}
   
function getServiceArea($serviceAreaID)
{
 $query = <<<STR
Select *
From servicearea
where serviceAreaID = $servicAreaID
STR;

 return executeQuery($query);

}
   
function addServiceArea($serviceAreaDTO)
{

}
   
function deleteServiceArea($serviceAreaID)
{
 $query = <<<STR
Delete 
From servicearea
where serviceAreaID = $serviceAreaID
STR;

 return executeQuery($query);

}
   
function updateServiceArea($serviceAreaDTO)
{

}


