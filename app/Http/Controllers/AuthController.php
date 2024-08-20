<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminResetCodeRequest;
use App\Http\Requests\Auth\AdminResetPasswordRequest;
use App\Http\Requests\Auth\AdminVerifyRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login(AdminLoginRequest $request)
    {
        $admin = Admin::whereEmail($request->email)->first();
        $password = !Hash::check($request->password, $admin->password);

        if (!$admin || $password) {
             return self::failResponse(422, __('application.unauthorized'));
        }

        $admin->access_token = $admin->createToken('PersonalAccessToken')->plainTextToken;

        return self::successResponse(__('application.login_successfully'), AdminResource::make($admin));
    }

//    public function verify(AdminVerifyRequest $request): JsonResponse
//    {
//        $admin = Admin::whereCode($request->code)->first();
//
//        if ($admin->code != $request->code) {
//            return self::failResponse(422, __('application.wrong_code'));
//        }
//
//        $admin->update(['is_verified' => 1]);
//        $admin->access_token = $admin->createToken('PersonalAccessToken')->plainTextToken;
//
//        return self::successResponse(__('application.verified'), AdminResource::make($admin));
//    }


//    public function resetCode(AdminResetCodeRequest $request): JsonResponse
//    {
//        $admin = Admin::whereEmail($request->email)->first();
//        $admin->update(['code' => generate_verification_code()]);
//
//        return self::successResponse(__('application.resend_code'), AdminResource::make($admin));
//    }
//

//    public function resendCode(Request $request): JsonResponse
//    {
//        $admin = Admin::whereEmail($request->email)->first();
//        $admin->update(['code' => generate_verification_code()]);
//
//        return self::successResponse(__('application.resend_code'), AdminResource::make($admin));
//    }

//    public function resetPassword(AdminResetPasswordRequest $request): JsonResponse
//    {
//        $admin = Admin::whereEmail($request->email)->first();
//        $admin->update(['password' => bcrypt($request->password)]);
//
//        return self::successResponse(__('application.password_updated'), AdminResource::make($admin));
//    }

    public function profile(): JsonResponse
    {
        return self::successResponse(data: AdminResource::make(auth('admin')->user()));
    }

    public function logout(Request $request): JsonResponse
    {
        auth('admin')->user()->currentAccessToken()->delete();

        return self::successResponse(__('application.log_out'));
    }

//    public function adminDelete(): JsonResponse
//    {
//        auth('admin')->user()->update(['is_deleted' => 1]);
//
//        return self::successResponse(message: __('application.deleted'));
//    }
}
