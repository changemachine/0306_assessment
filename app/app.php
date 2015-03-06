<?php  /*CONTROL OBJECTS, OPERATE ON STUFF
*/

//DEPENDENCIES.  OBJECTS AND AUTOLOAD (VENDOR == COMPOSER?)
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/task.php";

//START SESSION, ADD ARRAY COOKIE IF NOT PRESENT
    session_start();
    if (empty($_SESSION['task_list'])){
      $_SESSION['task_list'] = array();
    }

// INSTANCIATE A NEW SILEX APP
    $app = new Silex\Application();

// APP, REGISTER TWIG AS A NEW TOOL FOR YOU (DON'T FORGET WHAT KIND OF APP IT IS)
    $app->register(new Silex\Provider\TwigServiceProvider(), array ('twig.path' => __DIR__.'/../views'
  ));

// GET(/ f u).  RETURN VIA TWIG'S RENDER('/', array, class getAll), A NEW DISPLAY ARRAY('TASKS'class-op>Task::getAll)
    $app->get("/", function() use ($app){
        return $app['twig']->render('tasks.twig', array('tasks_display' => Task::getAll()));
    });

// APP ROUTE TO POST TASKS TO THE TASKS PAGE.  CHECK 'descrip' vs 'description'
    $app->post("/tasks", function(){
      $task = new Task($_POST['descrip']);
      $task->save();
      return "
          <h2>'Task Saved'</h2>
          <p>
          ". $task->getDescription()."
          </p>
          <p><a href='/'>View List</a></p>
      ";

    });


// APP ROUTE TO OVERWRITE TASK ARRAY: POST(FUNCTION CLASSSTATIC DELETEALL FUNC)
  $app->post("/delete_tasks", function(){
          Task::deleteAll();

          return "
                <p><h2>You got rid of all those pesky tasks!  Go play!</h2></p>

          ";
        });

//DON'T FORGET TO RETURN ALL THE APP'S HARD WORK
  return $app;
?>
