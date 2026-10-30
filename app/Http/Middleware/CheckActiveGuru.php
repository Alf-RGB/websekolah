<?php

namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Symfony\Component\HttpFoundation\Response;

   class CheckActiveGuru
   {
       public function handle(Request $request, Closure $next): Response
       {
           if (Auth::guard('guru')->check()) {
               $guru = Auth::guard('guru')->user();
               
               if ($guru->is_active == 0) {
                   Auth::guard('guru')->logout();
                   $request->session()->invalidate();
                   $request->session()->regenerateToken();
                   
                   return redirect()->route('portal.login')
                       ->with('error', 'Akun Anda telah dinonaktifkan oleh administrator.');
               }
           }
           
           return $next($request);
       }
   }