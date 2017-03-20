<?php

/* 
 * Purpose: Comment View DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     05 March 2017
 */
class CommentView {
   //Property
   
   private $_serviceRequestID;
   private $_comments;
   private $_firstName;
   private $_lastName;
   private $_role;
   private $_commentDate;

   // Constructor
   
   public function __construct($serviceRequestID,
                               $comments,
                               $firstName, 
                               $lastName,
                               $role,
                               $commentDate)
   {
       $this->_serviceRequestID = $serviceRequestID;
       $this->_comments = $comments;
       $this->_firstName = $firstName;
       $this->_lastName = $lastName;
       $this->_role = $role;
       $this->_commentDate = $commentDate;
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

   public function getFirstName()
   {
       return $this->_firstName;
   }
   public function setFirstName($firstName)
   {
       return $this->_firstName = $firstName;
   }

   public function getLastName()
   {
       return $this->_lastName;
   }
   
   public function setLastName($lastName)
   {
       return $this->_lastName = $lastName;
   }
   
   public function getRole()
   {
       return $this->_role;
   }
   
   public function setRole($role)
   {
       return $this->_role = $role;
   }

   public function getCommentDate()
   {
       return $this->_commentDate;
   }
   
   public function setCommentDate($commentDate)
   {
       return $this->_commentDate = $commentDate;
   }
   
}
