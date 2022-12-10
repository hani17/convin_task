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
        $searchBy = $request->get('q');
        $type = $request->get('type');

        $query = $type == 'admin'
            ? $query->admin()
            : $query->ordinary();

        $query = $searchBy
            ? $query->search($searchBy)
            : $query;

        return UserResource::collection($query->paginate());
    }
}
