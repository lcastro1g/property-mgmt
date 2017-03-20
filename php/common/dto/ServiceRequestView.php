<?php

/* 
 * Purpose: Service Request View DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     05 March 2017
 */
class ServiceRequestView {
    
   private $_serviceRequestID;
   private $_propertyName;
   private $_tenantFirstName;
   private $_tenantLastName;
   private $_landlordFirstName;
   private $_landlordLastName;
   private $_serviceStaffFirstName;
   private $_serviceStaffLastName;
   private $_workflowStatus;
   private $_serviceArea;
   private $_createdDate;
   private $_lastEditDate;
   private $_landlordID;
   private $_tenantID;
   private $_serviceStaffID;

   // Constructor
   
   public function __construct($serviceRequestID, 
                               $propertyName, 
                               $tenantFirstName, 
                               $tenantLastName, 
                               $landlordFirstName,
                               $landlordLastName,
                               $serviceStaffFirstName,
                               $serviceStaffLastName,
                               $workflowStatus,
                               $serviceArea,
                               $createdDate,
                               $lastEditDate,
                               $landlordID,
                               $tenantID,
                               $serviceStaffID)
   {
       $this->_serviceRequestID = $serviceRequestID;
       $this->_propertyName = $propertyName;
       $this->_tenantFirstName = $tenantFirstName;
       $this->_tenantLastName = $tenantLastName;
       $this->_landlordFirstName = $landlordFirstName;
       $this->_landlordLastName = $landlordLastName;
       $this->_serviceStaffFirstName = $serviceStaffFirstName;
       $this->_serviceStaffLastName = $serviceStaffLastName;
       $this->_workflowStatus = $workflowStatus;
       $this->_serviceArea = $serviceArea;
       $this->_createdDate = $createdDate;
       $this->_lastEditDate = $lastEditDate;
       $this->_landlordID = $landlordID;
       $this->_tenantID = $tenantID;
       $this->_serviceStaffID = $serviceStaffID;
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
   
   public function getPropertyName()
   {
       return $this->_propertyName;
   }
   public function setPropertyName($propertyName)
   {
       return $this->_propertyName = $propertyName;
   }
   
   public function getTenantFirstName()
   {
       return $this->_tenantFirstName;
   }
   public function setTenantFirstName($tenantFirstName)
   {
       return $this->_tenantFirstName = $tenantFirstName;
   }
   
   public function getTenantLastName()
   {
       return $this->_tenantLastName;
   }
   public function setTenantLastName($tenantLastName)
   {
       return $this->_tenantLastName = $tenantLastName;
   }
   
   public function getLandlordFirstName()
   {
       return $this->_landlordFirstName;
   }
   public function setLandlordFirstName($landlordFirstName)
   {
       return $this->_landlordFirstName = $landlordFirstName;
   }
   
   public function getLandlordLastName()
   {
       return $this->_landlordLastName;
   }
   public function setLandlordLastName($landlordLastName)
   {
       return $this->_landlordLastName = $landlordLastName;
   }
   
   public function getServiceStaffFirstName()
   {
       return $this->_serviceStaffFirstName;
   }
   public function setServiceStaffFirstName($serviceStaffFirstName)
   {
       return $this->_serviceStaffFirstName = $serviceStaffFirstName;
   }
   
   public function getServiceStaffLastName()
   {
       return $this->_serviceStaffLastName;
   }
   public function setServiceStaffLastName($serviceStaffLastName)
   {
       return $this->_serviceStaffLastName = $serviceStaffLastName;
   }   

   public function getWorkflowStatus()
   {
       return $this->_workflowStatus;
   }
   public function setWorkflowStatus($workflowStatus)
   {
       return $this->_workflowStatus = $workflowStatus;
   }

   public function getServiceArea()
   {
       return $this->_serviceArea;
   }
   public function setServiceArea($serviceArea)
   {
       return $this->_serviceArea = $serviceArea;
   }   

   public function getCreatedDate()
   {
       return $this->_createdDate;
   }
   public function setCreatedDate($createdDate)
   {
       return $this->_createdDate = $createdDate;
   }   
   
   public function getLastEditDate()
   {
       return $this->_lastEditDate;
   }
   public function setLastEditDate($lastEditDate)
   {
       return $this->_lastEditDate = $lastEditDate;
   }   

   public function getLandlordID()
   {
       return $this->_landlordID;
   }
   public function setLandlordID($landlordID)
   {
       return $this->_landlordID = $landlordID;
   }   

   public function getTenantID()
   {
       return $this->_tenantID;
   }
   public function setTenantID($tenantID)
   {
       return $this->_tenantID = $tenantID;
   }   

   public function getServiceStaffID()
   {
       return $this->_serviceStaffID;
   }
   public function setServiceStaffID($serviceStaffID)
   {
       return $this->_serviceStaffID = $serviceStaffID;
   }   
   
}
