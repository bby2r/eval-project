<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserViewedPostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(31);
        $time = now();
        $post = json_decode($request->post);
        Log::channel('post-view')->info("Post \"{$request->post->title}\"\n\t has been viewed by user $user->name at $time");
        return $next($request);
    }
}
