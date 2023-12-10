<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEntitieStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $entitieId = isset(Auth::user()->data->entitie) ? Auth::user()->data->entitie : null;
            $entitie = User::find($entitieId);
            if (Auth::user()->state != 'rejected' || Auth::user()->data->role == 'admin') {
                if(empty($entitie->state) || $entitie->state != 'rejected'){
                    return $next($request);
                }
            }
        }
        return abort(403, 'A sua entidade foi rejeitada.');
    }
}
