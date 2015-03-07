<?php  /*  CONTROL OBJECTS, OPERATE ON STUFF  */

//DEPENDENCIES.  OBJECTS AND AUTOLOAD (VENDOR == COMPOSER?)
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contactObj.php";
//START SESSION, ADD ARRAY COOKIE IF NOT PRESENT
    session_start();
    if (empty($_SESSION['contact_list'])){
      $_SESSION['contact_list'] = array();
    }
// INSTANCIATE A NEW SILEX APP
    $app = new Silex\Application();
// APP, REGISTER TWIG AS A NEW TOOL FOR YOU (DON'T FORGET WHAT KIND OF APP IT IS)
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
  ));

// ----- LOGIC ----

// GET(), LOAD CLASS INTO NEW DISPLAY ARRAY, AND DISPLAY AT /contacts VIA TWIG
    $app->get("/", function() use ($app){
        return $app['twig']->render('contacts.twig', array('contacts_display' => Contact::getAll())
        //, array(... NOT IN CARS BECAUSE..?
        );
    });

// CREATE CONTACTS & POST  !!!CHECK THOSE POST VARIABLES!!!
    $app->post("/contacts", function(){
      $contact = new Contact($_POST['name, number, address']);
      $contact->save();

      return "
          <h2>Contact Saved</h2>
          <p>
          ". $contact->getName(). // Just name?
          "</p>
          <p><a href='/'>View List</a></p>
      ";

    });


/*/ APP ROUTE TO OVERWRITE CONTACT ARRAY: POST(FUNCTION CLASSSTATIC DELETEALL FUNC)
  $app->post("/delete_contacts", function(){
          Contact::deleteContact();

          return "
              <p><h2>You got rid of that pesky contacts!  Go play!</h2></p>

        ";
      });
*/

//DON'T FORGET TO RETURN ALL THE APP'S HARD WORK
  return $app;
?>
