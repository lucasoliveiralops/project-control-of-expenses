<?php

namespace App\Http\Controllers\V1\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Account\Login as LoginRequest;
use App\Http\Resources\V1\Account\Login as Resources;
use App\Services\V1\Account\Login as LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService): JsonResponse|Resources
    {
        $request = $request->only('userMail', 'password');
        if ($loginService->login($request['userMail'], $request['password'])) {
            return  new Resources($loginService->generateToken());
        }
        return Response::json(
            [
                'message' => 'Invalid Credentials',
            ],
            HttpResponse::HTTP_UNAUTHORIZED
        );
    }
}
