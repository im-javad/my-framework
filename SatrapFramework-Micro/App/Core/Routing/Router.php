<?PhP 
namespace App\Core\Routing;

#To perform routing operations and perform specific routes with entities

use App\Core\Request;

class Router{
    /**
     * All registered routes
     *
     * @var array
     */
    private $routesList;

    /**
     * Request content
     *
     * @var \App\Core\Request
     */
    private $request;

    /**
     * Current route
     *
     * @var array
     */
    private $currentRoute;

    const BASE_MIDDLEWARE = '\App\Middleware\\';
    const BASE_CONTROLLER = '\App\Controllers\\';
    /* Preparation */
    public function __construct(){
        $this->routesList = Route::getRoutes();

        $this->request = new Request();

        $this->currentRoute = $this->findCurrentRoute($this->request);
    }

    /**
     * Find current route of route list
     *
     * @param \App\Core\Request $request
     * @return mixed
     */
    public function findCurrentRoute(Request $request){
        foreach($this->routesList as $route){
            if(!in_array(strtolower($request->getMethod()) , $route['method']))
                return false; 
            if($this->regexMatch($route))
                return $route;
        }

        return null;
    }

    /**
     * Checking route with regex pattern
     *
     * @param array $route
     * @return bool
     */ 
    public function regexMatch(array $route){
        global $request;

        $pattern = '/^' . str_replace(['/' , '{' , '}'] , ['\/' , '(?<' , '>[-%\w]+)'] , $route['uri']) . '$/';

        $requestRoute = $request->getRoute();

        $resul = preg_match($pattern , $requestRoute , $matches);

        if(!$resul)
            return false;

        foreach ($matches as $key => $value) {
            if(!is_int($key))
                $request->addRouteParam($key , $value);
        }

        return true;
    }

    /**
     * Implementation of the routing system
     *
     * @return void
     */
    public function run(){
        if(is_null($this->currentRoute))
            viewError('404');

        $this->handleMiddleware($this->currentRoute['middlewar'] ?? null);
        
        $this->handleController($this->currentRoute['controller']);
    }

    /**
     * Run the current route middleware
     *
     * @param array $middleware
     * @return null|void
     */
    public function handleMiddleware(array|null $middleware){
        if(is_null($middleware))
            return null;

        foreach($middleware as $mid){
            $middlewareName = self::BASE_MIDDLEWARE . $mid;
            $middlewareObject = new $middlewareName;
            $middlewareObject->handle();
        }
    }

    /**
     * Run the current route controller
     *
     * @param array $middleware
     * @return mixed
     */
    public function handleController(string $controller){
        $action = explode('@' , $controller);

        $controllerClassName = self::BASE_CONTROLLER . $action[0];

        $controllerMethod = $action[1];

        if(!class_exists($controllerClassName))
            throw new \Exception("Class $controllerClassName Not Exists!");

        $controllerObject = new $controllerClassName();

        try{        
            $controllerObject->{$controllerMethod}();
        }catch(\Throwable $th){
            echo $th->getMessage();
        }
    }
}



