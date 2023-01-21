<?PhP 
namespace App\Core;

class Request{
    private $route;
    private $method;
    private $domain;
    private $port;
    private $protocol;
    private $routeParam;

    /**
     * Request ball preparation (con)
     */ 
    public function __construct(){
        $this->route = strtok($_SERVER['REQUEST_URL']);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->domain = $_SERVER['SERVER_NAME'];
        $this->port = $_SERVER['SERVER_PORT'];
        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * Add a route to param 
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addRouteParam(string $key , string $value){
        $this->routeParam[$key] = $value;
    }

    /**
     * Giving the desired root from the request
     * 
     * @return string|null
     */
    public function getRoute(){
        return $this->route;
    }
    
    /**
     * Giving the method from the request
     *
     * @return string
     */
    public function getMethod(){
        return $this->method;
    }

    /**
     * Giving domain
     *
     * @return string|null
     */
    public function getDomain(){
        return $this->domain;
    }

    /**
     * Giving current port
     *
     * @return int
     */
    public function getPort(){
        return $this->port;
    }

    /**
     * Giving request protocol
     *
     * @return string
     */
    public function getProtocol(){
        return $this->protocol;
    }

    /**
     * Giving route params
     *
     * @return array|null 
     */
    public function getRouteParam(){
        
    }
}


