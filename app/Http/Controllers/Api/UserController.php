<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{

    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $query = User::query();
        $query = $request->get('type') == 'admin'
            ? $query->admin()
            : $query->ordinary();

        return UserResource::collection($query->paginate());
    }
}
