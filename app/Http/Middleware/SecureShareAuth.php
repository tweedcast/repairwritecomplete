<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
      if(mb_strlen($request->getContent()) <= 200){
        $body = $request->getContent();
      } elseif(mb_strlen($request->getContent()) > 200){
        $body = mb_substr($request->getContent(), 0, 200);
      }
      $signature = base64_encode(hash_hmac('sha1', $request->fullUrl() . $body, config('app.secure_share_key'), $raw_output=TRUE));
      if($signature == $request->header('X-SecureShare-Signature')){
        return $next($request);
      }
      abort(401);
    }
}
