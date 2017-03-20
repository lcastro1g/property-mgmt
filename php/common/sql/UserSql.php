<?php

/* 
 * Purpose: User SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/User.php");

function getUserList()
{

    
}
   
function getUser($username, $password)
{
    return executeQuery("Exec SP_GetUser @UserName = '$username', @Password = '$password'");
}

function findDuplicateUser($username)
{
    return executeQuery("Exec SP_FindDuplicateUser @UserName = '$username'");
}
   
function addUser(User $userDTO)
{
    $firstName = $userDTO->getFirstName();
    $lastName = $userDTO->getLastName();
    $userName = $userDTO->getUsername();
    $password = $userDTO->getPassword();
    $email = $userDTO->getEmail();
    $userStatus = $userDTO->getUserStatus();
    $roleid = $userDTO->getRoleID();
    
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
    $firstName = str_replace('\'', '\'\'', trim($firstName));
    $lastName = str_replace('\'', '\'\'', trim($lastName));
    $userName = str_replace('\'', '\'\'',trim($userName));
    $password = str_replace('\'', '\'\'',trim($password));
    $email = str_replace('\'', '\'\'',trim($email));
    $userStatus = str_replace('\'', '\'\'',trim($userStatus));
    
    //die(var_dump($userStatus));
    return executeQuery("Exec SP_AddUsers @FirstName = '$firstName', @LastName = '$lastName', @UserName = '$userName', @Password = '$password', @Email = '$email', @RoleID = '$roleid', @UserStatus = '$userStatus'");
}
   
function deleteUser($userID)
{

}
   
function updateUser(User $userDTO)
{

}

function validateUserCredentials($username, $password) 
{
    return executeQuery("Exec SP_VerifyUserCredentials @UserName = '$username', @Password = '$password'");
}


function getUsersByRole($role) {
    
    return executeQuery("Exec SP_GetUserByRoleID @RoleID = '$role'");
}