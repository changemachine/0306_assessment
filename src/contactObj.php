<?php

  class Contact{
    private $name;
    private $number;
    private $address;

    function __construct($name, $number, $address){
        $this->name = $name;
        $this->number = $number;
        $this->address = $address;
    }
//----- SETTERS
    function setName($new_name){
        $this->name = (string) $new_name;
    }

    function setNumber($new_number){
        $float_number = (float) $new_number;
        if ($float_number !=0){
            $this->number = $float_number;
        }
    }

    function setAddress($new_address){
        $this->address = (string) $new_address;
   }

//------ GETTERS
    function getName(){
        return $this->name;
    }

    function getNumber(){
        return $this->number;
    }
    function getAddress(){
        return $this->Address;
    }


    // SAVE. ARRAY PUSH TO COOKIE: CONTACT LIST
    function save(){
        array_push($_SESSION['contact_list'], $this);
    }

    // CLASS GET. RETURN FROM COOKIE: CONTACT LIST
    static function getAll(){
        return $_SESSION['contact_list'];
    }

    /*
    //CLASS DELETE, OVERWRITE CONTACT LIST
    static function deleteContact(){
      // DELETE ALL: $_SESSION['contact_list'] = array();
    }
    */

  }



?>
