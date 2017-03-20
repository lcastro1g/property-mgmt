<?php

/* 
 * Purpose: Role SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';

function getRoleList()
{
    $query = <<<STR
Select RoleID, Role
From Role
Order by RoleID
STR;

    return executeQuery($query);
}
   
function getRole($roleID)
{
 $query = <<<STR
Select *
From role
where roleID = $roleID
STR;

 return executeQuery($query);

}
   
function addRole($roleDTO)
{

}
   
function deleteRole($roleID)
{
 $query = <<<STR
Delete 
From role
where roleID = $roleID
STR;

 return executeQuery($query);

}
   
function updateRole($roleDTO)
{

}

