<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Responses\NoContentResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResource
    {
        $currentUser = auth()->user();
        if ($currentUser) {
            if ($currentUser->is_admin)
                return UserResource::collection(User::all());
            else 
                return UserResource::collection(User::where('id', $currentUser->id)->orWhere('is_admin', true)->get());
        }

        return new NoContentResponse;
    }
}
