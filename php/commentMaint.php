<?php

/* 
 * Purpose: Service Request Comments 
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    05 March 2017
 */

session_start();

// to secure a page, include "loginCheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("./common/loginCheck.php");
require_once ("./common/siteCommon.php");
require_once ("./common/commentHtmlFnLibrary.php");
require_once ("./common/dto/Comment.php");
require_once ("./common/sql/CommentSql.php");

if(isset($_POST['comment'])) {
    $userID = $_SESSION['userInfo']['userid'];
    $requestID = $_POST['requestID'];
    $comments = str_replace('\'', '\'\'', trim($_POST['comments']));
        
    $commentsDTO = new Comment($requestID, $comments, $userID);

    addComments($commentsDTO);
    
    header("Location: ./requestViewDetails.php?reqid=$requestID"); /* Redirect browser */
    exit();
} else {
    if( isset($_GET["reqid"])) {
        $request_id = $_GET["reqid"];
    } else {
        header('Refresh: 2; URL=dashboard.php');
        displayPageHeader('Dashboard');
        displayTransitionMessage('Invalid Service Request. You will now be redirected to our dashboard page.');
        displayPageFooter();
        die();
    }

    displayPageHeader('Comments View Details');
    displayCommentsForm($request_id);
    displayPageFooter();
}
?>

