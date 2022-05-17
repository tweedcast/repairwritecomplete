<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecureShareAuth
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
      if(strlen($request->getContent()) <= 200){
        $body = $request->getContent();
      } elseif(strlen($request->getContent()) > 200){
        $body = substr($request->getContent(), 0, 200);
      }

      $signature = base64_encode(hash_hmac('sha1', $body , config('app.secure_share'), true));

      if($signature == $request->header('X-SecureShare-Signature')){
        return $next($request);
      }
    }
}