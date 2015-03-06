<?php // OBJECTS (MODEL)

  class Task{
    private $description;

    //CONSTRUCTOR
    function __construct($descrip){
        $this->description = $descrip;
      }

    // SET
    function setDescription($new_descrip){
      $this->description = $new_descrip;
    }

    // GET DESCRIP
    function getDescription(){
      return $this->description;
    }

    // SAVE, ARRAY PUSH TO COOKIE THE TASK LIST
    function save(){
      array_push ($_SESSION['task_list'], $this);
    }

    // CLASS GET, RETURN FROM COOKIE THE TASK LIST
    static function getAll(){
      return $_SESSION['task_list'];
    }

    // CLASS DELETE, OVERWRITE TASK LIST

    static function deletAll(){
      $_SESSION['task_list'] = array();
    }


  }











?>
