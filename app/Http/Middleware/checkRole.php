<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if($request->user()->getRole() === $this->_getRole($role)) {
            return $next($request);
        }

        return response()->json([
            'message' => trans('text.account.http_unauthorized'),
            'status' => Response::HTTP_UNAUTHORIZED
        ], Response::HTTP_UNAUTHORIZED);
    }
    

    private function _getRole(string $roleName) {
        $roles = [
            'student' => STUDENT,
            'teacher' => TEARCHER,
            'homeroom_teacher' => HOMEROOM_TEACHER
        ];
        return key_exists($roleName, $roles) ? $roles[$roleName] : '';
    }
}
