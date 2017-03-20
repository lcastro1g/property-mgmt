<?php

/* 
 * Purpose: Request Type DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     19 Feb 2017
 */
class RequestType {
   //Property
   
   private $_typeID;
   private $_name;
   private $_description;

   // Constructor
   
   public function __construct($typeID,
                               $name, 
                               $description)
   {
       $this->_typeID = $typeID;
       $this->_name = $name;
       $this->_description = $description;
   }
   
   // Methods
   
   public function getTypeID()
   {
       return $this->_typeID;
   }
   public function setTypeID($typeID)
   {
       return $this->_typeID = $typeID;
   }
   public function getName()
   {
       return $this->_name;
   }
   public function setName($name)
   {
       return $this->_name = $name;
   }

   public function getDescription()
   {
       return $this->_description;
   }
   
   public function setDescription($description)
   {
       return $this->_description = $description;
   }
   
}
