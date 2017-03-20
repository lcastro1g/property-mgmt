<?php

/* 
 * Purpose: Service Request DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     19 Feb 2017
 */
class ServiceRequest {
    
   private $_serviceRequestID;
   private $_statusID;
   private $_propertyID;
   private $_tenantID;
   private $_landlordID;
   private $_serviceStaffID;
   private $_serviceAreaID;
   private $_comment;
   private $_createDate;
   private $_editDate;

   // Constructor
   
   public function __construct($serviceRequestID,
                               $statusID,
                               $propertyID, 
                               $landlordID,
                               $tenantID,
                               $serviceStaffID,
                               $serviceAreaID, 
                               $comment,
                               $createDate,
                               $editDate)
   {
       $this->_serviceRequestID = $serviceRequestID;
       $this->_statusID = $statusID;
       $this->_propertyID = $propertyID;
       $this->_landlordID = $landlordID;
       $this->_tenantID = $tenantID;
       $this->_serviceStaffID = $serviceStaffID;
       $this->_serviceAreaID = $serviceAreaID;
       $this->_comment = $comment;
       $this->_createDate = $createDate;
       $this->_editDate = $editDate;
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
   
   public function getPropertyID()
   {
       return $this->_propertyID;
   }
   public function setPropertyID($propertyID)
   {
       return $this->_propertyID = $propertyID;
   }
   
   public function getStatusID()
   {
       return $this->_statusID;
   }
   public function setStatusID($statusID)
   {
       return $this->_statusID = $statusID;
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
   
   public function getServiceAreaID()
   {
       return $this->_serviceAreaID;
   }
   public function setServiceAreaID($serviceAreaID)
   {
       return $this->_serviceAreaID = $serviceAreaID;
   }  
   
   public function getComment()
   {
       return $this->_comment;
   }
   public function setComment($comment)
   {
       return $this->_comment = $comment;
   }
   
   public function getCreateDate()
   {
       return $this->_createDate;
   }
   public function setCreateDate($createDate)
   {
       return $this->_createDate = $createDate;
   }
   
   public function getEditDate()
   {
       return $this->_editDate;
   }
   public function setEditDate($editDate)
   {
       return $this->_editDate = $editDate;
   }
}
