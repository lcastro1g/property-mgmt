<?php

/* 
 * Purpose: Secures a page within the application
 * Description: This script checks whether the user has been authenticated
 * if the session array element, "userInfo" is not set,
 * the user is redirected to the login page (home.php)
 * 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     01 March 2017
 */

session_start();

if (!isset($_SESSION['userInfo']))
{
    header('location: home.php?redirect=' . $_SERVER['REQUEST_URI']); 
    die();
}
?>
