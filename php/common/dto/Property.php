<?php

/* 
 * Purpose: Property DTO 
 * Team 116: Luis Castro
 *           Matt Karn
 *           Vaughan Schmidt
 * Course:   CIS665 - Spring 2017
 * Date:     19 Feb 2017
 */
class Property {
   //Property
   
   private $_propertyID;
   private $_user;
   private $_name;
   private $_address;
   private $_city;
   private $_state;
   private $_zipCode;
   private $_createDate;
   private $_updateDate;
   private $_tenantID;
   private $_landlordID;
   private $_serviceID;

   // Constructor
   
   public function __construct($propertyID,
                               $user,
                               $name, 
                               $address, 
                               $city, 
                               $state,
                               $zipCode,
                               $tenantID,
                               $serviceID,
                               $landlordID,
                               $createDate)
   {
       $this->_propertyID = $propertyID;
       $this->_user = $user;
       $this->_name = $name;
       $this->_address = $address;
       $this->_city = $city;
       $this->_state = $state;
       $this->_tenantID = $tenantID;
       $this->_serviceID = $serviceID;
       $this->_landlordID = $landlordID;
       $this->_zipCode = $zipCode;
       $this->_createDate = $createDate;
   }
   
   // Methods
   
   public function getPropertyID()
   {
       return $this->_propertyID;
   }
   public function setPropertyID($propertyID)
   {
       return $this->_propertyID = $propertyID;
   }

   public function getUser()
   {
       return $this->_user;
   }
   public function setUser($user)
   {
       return $this->_user = $user;
   }
   
   public function getName()
   {
       return $this->_name;
   }
   public function setName($name)
   {
       return $this->_name = $name;
   }

   public function getAddress()
   {
       return $this->_address;
   }
   public function setAddress($address)
   {
       return $this->_address = $address;
   }

   public function getCity()
   {
       return $this->_city;
   }
   public function setCity($city)
   {
       return $this->_city = $city;
   }

   public function getState()
   {
       return $this->_state;
   }
   public function setState($state)
   {
       return $this->_state = $state;
   }

   public function getZipCode()
   {
       return $this->_zipCode;
   }
   public function setZipCode($zipCode)
   {
       return $this->_zipCode = $zipCode;
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
       return $this->_serviceID;
   }
   public function setServiceStaffID($serviceID)
   {
       return $this->_serviceID = $serviceID;
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
}
