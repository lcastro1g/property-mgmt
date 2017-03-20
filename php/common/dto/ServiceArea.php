<?php

/* 
 * Purpose: ServiceArea DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     22 Feb 2017
 */
class ServiceArea {
   //Property
   
   private $_serviceAreaID;
   private $_serviceArea;

   // Constructor
   
   public function __construct($serviceAreaID,
                               $serviceArea)
   {
       $this->_serviceAreaID = $serviceAreaID;
       $this->_serviceArea = $serviceArea;
   }
   
   // Methods
   
   public function getServiceAreaID()
   {
       return $this->_serviceAreaID;
   }
   public function setServiceAreaID($serviceAreaID)
   {
       return $this->_serviceAreaID = $serviceAreaID;
   }

   public function getServiceArea()
   {
       return $this->_serviceArea;
   }
   public function setServiceArea($serviceArea)
   {
       return $this->_serviceArea = $serviceArea;
   }
}
