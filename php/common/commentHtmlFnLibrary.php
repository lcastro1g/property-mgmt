<?php

/* 
 * Purpose: Comment common page elements as PHP methods
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     05 March 2017
 */

require_once ("./common/dto/Comment.php");

function displayCommentsForm($requestID) {
    
    $commentMaintForm = <<< COMMENT_MAINT_FORM
<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Add Comment</div>
    <div class="panel-body">
        <form id="commentMaintForm" class="form-horizontal" role="form" action="commentMaint.php" method="post">
            <div class="form-group">
                <label for="requestID" class="col-md-3 control-label">Request ID</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="requestID" readonly value="$requestID">
                </div>
            </div>
            <div class="form-group">
                <label for="comments" class="col-md-3 control-label">Comments</label>
                <div class="col-md-9">
                    <textarea name="comments" class="form-control" rows="5" id="comments"></textarea>
                </div>
            </div>
            <div class="form-group">
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-submit" type="submit" name="comment" class="btn btn-success"><i class="icon-hand-right"></i>Save Comment</button>
                    <a href="./requestViewDetails.php?reqid=$requestID" class="btn btn-success" role="button"><i class="icon-hand-right"></i>Cancel</a>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
COMMENT_MAINT_FORM;
    
    echo $commentMaintForm;
    
}

