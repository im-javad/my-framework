<?PhP 
# Front controller 

include "bootstrap/init.php";

/* Wake up the router for routing  */
$router = new App\Core\Routing\Router();
$router->run();

