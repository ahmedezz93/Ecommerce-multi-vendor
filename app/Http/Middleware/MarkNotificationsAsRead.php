<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationsAsRead
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

        $notif_id = $request->query('notification_id');
        if ($notif_id) {
            $user = auth()->user();
            if ($user) {

                $notification =  $user->UnreadNotifications()->find($notif_id);

                if ($notification) {

                    $notification->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
