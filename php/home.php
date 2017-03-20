<?php

/* 
 * Purpose: Home Page
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    18 Feb 2017
 */

require_once ("./common/siteCommon.php");
require_once ("./common/userHtmlFnLibrary.php");
require_once ("./common/sql/RoleSql.php");

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : '';

displayHomePageHeader('Welcome');
displayLogin('',$redirect);
displayRoles();
displayLoginSubmit();
displayHomePageFooter();


?>