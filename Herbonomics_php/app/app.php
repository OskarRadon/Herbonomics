
<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Dispensary.php";
    require_once __DIR__."/../src/DispensaryDemand.php";
    require_once __DIR__."/../src/Grower.php";
    require_once __DIR__."/../src/GrowersStrains.php";


    $server = 'mysql:host=localhost;dbname=herbonomics';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    use Symfony\Component\Debug\Debug;
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));
 // instantiate Silex app, add twig capability to app


    $app->get("/", function() use ($app) {
        //home page
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/dispensary/sign_in", function() use ($app) {//get or post?

        $dispensary = Dispensary::signIn($_GET['username'], $_GET['password']);

        if($dispensary = null) {
            return $app['twig']->render('login.html.twig');
        } else

        return $app['twig']->render('dispensary_account.html.twig', array('dispensary' => $dispensary));
    });

    return $app;
?>
