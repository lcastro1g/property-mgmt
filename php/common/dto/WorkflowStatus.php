<?php

/* 
 * Purpose: WorkflowStatus DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     22 Feb 2017
 */
class WorkflowStatus {
   //Property
   
   private $_workflowStatusID;
   private $_workflowStatus;

   // Constructor
   
   public function __construct($workflowStatusID,
                               $workflowStatus)
   {
       $this->_workflowStatusID = $workflowStatusID;
       $this->_workflowStatus = $workflowStatus;
   }
   
   // Methods
   
   public function getWorkflowStatusID()
   {
       return $this->_workflowStatusID;
   }
   public function setWorkflowStatusID($workflowStatusID)
   {
       return $this->_workflowStatusID = $workflowStatusID;
   }

   public function getWorkflowStatus()
   {
       return $this->_workflowStatus;
   }
   public function setWorkflowStatus($workflowStatus)
   {
       return $this->_workflowStatus = $workflowStatus;
   }
}
