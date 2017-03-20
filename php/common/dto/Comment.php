<?php

/* 
 * Purpose: Comment DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     19 Feb 2017
 */
class Comment {
   //Property
   private $_serviceRequestID;
   private $_comments;
   private $_userID;

   // Constructor
   
   public function __construct($serviceRequestID,
                               $comments,
                               $userID)
   {
       $this->_serviceRequestID = $serviceRequestID;
       $this->_comments = $comments;
       $this->_userID = $userID;
   }
   
   // Methods
   
   public function getServiceRequestID()
   {
       return $this->_serviceRequestID;
   }
   public function setServiceRequestID($serviceRequestID)
   {
       return $this->_serviceRequestID = $serviceRequestID;
   }

   public function getComments()
   {
       return $this->_comments;
   }
   public function setComments($comments)
   {
       return $this->_comments = $comments;
   }

   public function getUserID()
   {
       return $this->_userID;
   }
   
   public function setUserID($userID)
   {
       return $this->_userID = $userID;
   }
}
