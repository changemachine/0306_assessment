<?php
    // GROUNDWORK
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contactObj.php";

    session_start();
    if (empty($_SESSION['contact_list'])){
        $_SESSION['contact_list'] = array();
    };

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
  ));


//==THE LOGIC ==================
        //----Home page generation
    $app->get("/", function() use ($app){
        return $app['twig']->render('contacts.twig');
    });

        //----ARRANGE, INSTANCIATE

    $app->post("/added", function() use ($app) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $address = $_POST['address'];

        //----OBJECT
        $new_contact = new Contact($name, $number, $address);
        //----METHODS
        $new_contact->save();

        return $app['twig']->render('added.twig', array('contact_list' => $_SESSION['contact_list']));

    });


/*  $app->post("/delete_contacts", function(){
          Contact::deleteContact();
          return "
              <p><h2>You got rid of that pesky contacts!  Go play!</h2></p>
        ";
    });*/

//== OUTPUT
     return $app;

?>
