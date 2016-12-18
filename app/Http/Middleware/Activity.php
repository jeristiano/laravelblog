<?php
namespace App\Http\Middleware;
use Closure;

class activity{
    public function handle($request,Closure $next ){
        if (time() <strtotime('2016-12-8')){
            return redirect('activity0');
        }
            return $next($request);

    }
}