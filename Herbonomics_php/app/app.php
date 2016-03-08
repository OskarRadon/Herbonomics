
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

    $app->get("/allstrains", function() use ($app) {
        //all strains page
        $strains = GrowersStrains::getAll();
        return $app['twig']->render('grower_supply.html.twig', array(
            'strains' => $strains
        ));
    });
    return $app;
?>
