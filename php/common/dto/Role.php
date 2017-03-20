<?php

/* 
 * Purpose: Role DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     22 Feb 2017
 */
class Role {
   //Property
   
   private $_roleID;
   private $_role;

   // Constructor
   
   public function __construct($roleID,
                               $role)
   {
       $this->_roleID = $roleID;
       $this->_role = $role;
   }
   
   // Methods
   
   public function getRoleID()
   {
       return $this->_roleID;
   }
   public function setRoleID($roleID)
   {
       return $this->_roleID = $roleID;
   }

   public function getRole()
   {
       return $this->_role;
   }
   public function setRole($role)
   {
       return $this->_role = $role;
   }
}
