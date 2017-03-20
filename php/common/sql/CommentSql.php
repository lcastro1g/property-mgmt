<?php

/* 
 * Purpose: Comment SQL functions
 * Author:  Team 116
 *          Luis Castro
 *          Matt Karn
 *          Vaughan Schmidt
 * Course:  CIS665 - Spring 2017
 * Date:    24 Feb 2017
 */

require_once 'dbConnExec.php';
require_once ("./common/dto/Comment.php");
require_once ("./common/dto/CommentView.php");

function getCommentList()
{
       
}
   
function getCommentListByRequestID($serviceRequestID)
{
 $query = <<<STR
Select *
From CommentsView
where ServiceRequestID = $serviceRequestID
STR;

 return executeQuery($query);

}

function getComment($commentID)
{
       
}

function getInitialCommentForServiceRequest($serviceRequestID)
{
    $query = <<<STR
SELECT TOP 1 * FROM Comments WHERE ServiceRequestID = $serviceRequestID ORDER BY CreateDate DESC
STR;
    
    return executeQuery($query);
}
   
function addComments(Comment $commentsDTO)
{
    $requestID = $commentsDTO->getServiceRequestID();
    $comments = $commentsDTO->getComments();
    $userID = $commentsDTO->getUserID();
    
    return executeQuery("Exec SP_AddComments @ServiceRequestID = '$requestID', @Comments = '$comments', @UserID = '$userID'");    
}
   
function deleteComment($commentID)
{
       
}

function deleteCommentsByRequestID($requestID) {
    // Deletes ALL comments for a given requestID.
    // Should be called before removing a request record to avoid orphan
    // comment records.
    
    $query = <<<STR
DELETE FROM Comments WHERE ServiceRequestID = $requestID
STR;
    
    return executeQuery($query);
}
   
function updateComment($commentDTO)
{
       
}
