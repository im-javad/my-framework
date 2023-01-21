<?PhP 
namespace App\Middleware;

# Middleware for block internet exploler(IE)

use App\Middleware\Contract\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class BlockIE implements MiddlewareInterface{
    public function handle(){
        if(Browser::isIE())
            die('We blocked internet exploler!');
    }
}
