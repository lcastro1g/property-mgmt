<?php

/* 
 * Purpose: User Login
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    20 Feb 2017
 */

session_start();

require_once ("./common/siteCommon.php");
require_once ("./common/sql/UserSql.php");
require_once ("./common/sql/RoleSql.php");
require_once ("./common/userHtmlFnLibrary.php");

$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';

if (isset($_REQUEST['redirect']))
{
    $redirect = $_REQUEST['redirect'];
    if (empty($redirect)) {
        $redirect = 'dashboard.php';
    }
}
else
{
    $redirect = 'dashboard.php';
}

if (isset($_POST['login']))
{
    // if the form was submitted
    //Call getUser method to check credentials
    $userList = getUser($username, $password);

    if (count($userList)==1) //If credentials check out
    {
        extract($userList[0]);

        // assign user info to an array

        $userInfo = array('userid'=>$UserID, 'firstname'=>$FirstName, 'role'=>$Role);

        // assign the array to a session array element

        $_SESSION['userInfo'] = $userInfo;
        session_write_close(); //typically not required; ensures that the session data is stored

        // redirect the user

        header('location:' . $redirect);
        die();
    }
    else 
    {
        //Invalid Authentication
        displayHomePageHeader('Welcome');
        displayLogin('Invalid credentials or user does not exist.', $redirect);
        displayRoles();
        displayLoginSubmit();
        displayHomePageFooter();
    }
}

?>