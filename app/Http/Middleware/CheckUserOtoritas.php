namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOtoritas
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->kd_otoritas != 1) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
