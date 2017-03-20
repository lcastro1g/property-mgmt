<?php

/* 
 * Purpose: Registers a new user
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    18 Feb 2017
 */

session_start();

require_once ("./common/siteCommon.php");
require_once ("./common/dto/User.php");
require_once ("./common/sql/UserSql.php");
require_once ("./common/sql/RoleSql.php");
require_once ("./common/userHtmlFnLibrary.php");

if (isset($_POST['register']))
{
    $userDTO = new User($_POST['firstname'],
                        $_POST['lastname'],
                        $_POST['username'],
                        $_POST['password'],
                        $_POST['email'],
                        "Active",
                        $_POST['roleid']
                        );

        // check whether the username already exists

    $result = findDuplicateUser($userDTO->getUsername());
    if (count($result) > 0)
    {
        $error = 'Please choose a different Username';
        displayHomePageHeader('Register');
        displayRegisterUser($userDTO);
        displayRoles();
        displayRegisterUserSubmit($error,'');
        displayPageFooter();
    }
    else 
    {
        // Call the addUser method
        addUser($userDTO);
        
        //redirect user to login page
        header('Refresh: 2; URL=home.php');
        displayHomePageHeader('Register');
        displayTransitionMessage('Thank you for Registering.  You will now be redirected to the login page.');
        displayPageFooter();
        die();
    }
}
?>