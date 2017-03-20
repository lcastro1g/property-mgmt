<?php

/* 
 * Purpose: User DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     19 Feb 2017
 */
class User {
 
   //Property
   
   private $_userID;
   private $_firstName;
   private $_lastName;
   private $_username;
   private $_password;
   private $_email;
   private $_userStatus;
   private $_createDate;
   private $_updateDate;
   private $_roleID;

   // Constructor

   public function __construct($firstName, 
                               $lastName, 
                               $username, 
                               $password,
                               $email,
                               $userStatus,
                               $roleID)
   {
       $this->_firstName = $firstName;
       $this->_lastName = $lastName;
       $this->_username = $username;
       $this->_password = $password;
       $this->_email = $email;
       $this->_userStatus = $userStatus;
       $this->_roleID = $roleID;
   }
   
   // Methods
   
   public function getUserID()
   {
       return $this->_userID;
   }
   public function setUserID($userID)
   {
       return $this->_userID = $userID;
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
   
   public function getUsername()
   {
       return $this->_username;
   }
   public function setUsername($userName)
   {
       return $this->_username = $userName;
   }
   
   public function getPassword()
   {
       return $this->_password;
   }
   public function setPassword($password)
   {
       return $this->_password = $password;
   }
   
   public function getEmail()
   {
       return $this->_email;
   }
   public function setEmail($email)
   {
       return $this->_email = $email;
   }
   
   public function getUserStatus()
   {
       return $this->_userStatus;
   }
   public function setUserStatus($userStatus)
   {
       return $this->_userStatus = $userStatus;
   }
   
   public function getCreateDate()
   {
       return $this->_createDate;
   }
   public function setCreateDate($createDate)
   {
       return $this->_createDate = $createDate;
   }

   public function getUpdateDate()
   {
       return $this->_updateDate;
   }
   public function setUpdateDate($updateDate)
   {
       return $this->_updateDate = $updateDate;
   }
   
   public function getRoleID()
   {
       return $this->_roleID;
   }
   public function setRoleID($roleID)
   {
       return $this->_roleID = $roleID;
   }   
}

