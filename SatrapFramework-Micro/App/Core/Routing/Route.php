<?PhP 
namespace App\Core\Routing;

#Preparing and getting the required routes that are defined on the web.php

class Route{
    /**
     * Available routes
     *
     * @var array
     */
    private static $routes = [];

    /**
     * Add a route to routes 
     *
     * @param string|array $methods
     * @param string $uri
     * @param string $controller
     * @param array|null $middleware
     * @return void
     */
    public function add(string|array $methods , string $uri , string $controller , array $middleware = null){
        $methods = is_array($methods) ? $methods : [$methods];

        self::$routes[] = [
            'method' => $methods,
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => $middleware,
        ];
    }

    /**
     * Add a route with get method
     *
     * @param string $uri
     * @param string $controller
     * @param array|null $middleware
     * @return void
     */
    public static function get(string $uri , string $controller , array $middleware = null){
        self::add('get' , $uri , $controller , $middleware);
    }
    
    /**
     * Add a route with post method
     *
     * @param string $uri
     * @param string $controller
     * @param array|null $middleware
     * @return void
     */
    public static function post(string $uri , string $controller , array $middleware = null){
        self::add('post' , $uri , $controller , $middleware);
    }

    /**
     * Add a route with put method
     *
     * @param string $uri
     * @param string $controller
     * @param array|null $middleware
     * @return void
     */
    public static function put(string $uri , string $controller , array $middleware = null){
        self::add('put' , $uri , $controller , $middleware);
    }

    /**
     * Add a route with delete method
     *
     * @param string $uri
     * @param string $controller
     * @param array|null $middleware
     * @return void
     */
    public static function delete(string $uri , string $controller , array $middleware = null){
        self::add('delete' , $uri , $controller , $middleware);
    }

    /**
     * Giving all of the routes 
     *
     * @return array
     */
    public static function getRoutes(){
        return self::$routes;
    }
}

