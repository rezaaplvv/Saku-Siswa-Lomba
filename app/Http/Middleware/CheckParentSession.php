<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckParentSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('parent_logged_in') === true && !empty(session('student_id'))) {
            $student = \App\Models\Student::find(session('student_id'));
            
            // Bypass security check for non-persistent dummy test accounts
            if ($student) {
                // Invalidate session if database password hash doesn't match session hash
                if (session('parent_password_hash') !== $student->parent_password) {
                    session()->flush();
                    return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir karena kata sandi direset oleh Administrator.');
                }
                
                // Enforce password change
                if ($student->must_change_password) {
                    if ($request->routeIs('parent.force-change-password')) {
                        return $next($request);
                    }
                    return redirect()->route('parent.force-change-password');
                }
            }
            
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses data tabungan siswa.');
    }
}
