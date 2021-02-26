<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        return [
            'token' => $token,
            'user' => auth('api')->user()
        ];
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $token = Auth::login($user);
        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function logout()
    {
        $result = Auth::logout();
        return response()->json(['success' => true]);
    }

    public function me()
    {
        return auth('api')->user();
    }

    public function refreshToken()
    {
        $token = Auth::refresh();
        return [
            'token' => $token
        ];
    }
    public function authUser()
    {
        $user = auth('api')->user();
        return $user;
    }
    public function authUserGallery(Request $request) 
    {
        $user = auth('api')->user();

        $galleriesQuery = Gallery::query();
        $galleriesQuery->with('user', 'images');
        $search = $request->header('searchText');
        $galleriesQuery->where( function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orwhereHas('user', function($que) use ($search) {
                    $que->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%');
                });
        });

        $galleries = $galleriesQuery->where('user_id', $user->id)->take($request->header('pagination'))
        ->get();

        $count = $galleriesQuery->count();

        return [$user, $galleries, $count];
    }

}
