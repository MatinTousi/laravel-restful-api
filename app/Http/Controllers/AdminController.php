<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
   public function index()
{
    Gate::authorize('create', Post::class);

    // اگر مجاز بود ادامه می‌ده
    return response()->json(['message' => 'Post show']);
}

}
