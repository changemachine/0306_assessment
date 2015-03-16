<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contactObj.php";

    session_start();
    //if (empty($_SESSION['contact_list'])){
      $_SESSION['contact_list'] = array();
    //};

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
  ));


//==THE LOGIC ==================
        //== Home page generation
    $app->get("/", function() use ($app){
        return $app['twig']->render('contacts.twig');
    });

        //===== Input form data.  BEING HANDLED IN INSTANCIATION?
    // $app->post("/added", function() use ($app) {
    //     //$INPUT = $POST['_stuff_'];
    //     //$CONTACT =
    //
    // });

        //== INSTANCIATE OBJECT/METHODS
    $new_contact = new Contact($_POST['name'], $_POST['number'], $_POST['address']);
          /* √ $new_contact == object(Contact)#67 (3) { name num & add }*/
    $new_contact->save();
          var_dump($new_contact);

      return $app['twig']->render('contacts.twig', array('contact_display'=> $new_contact));
      //saving to session?

/*  $app->post("/delete_contacts", function(){
          Contact::deleteContact();
          return "
              <p><h2>You got rid of that pesky contacts!  Go play!</h2></p>
        ";
    });*/

//== OUTPUT
  return $app;
?>
