<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthLoginAPIRequest;
use App\Http\Requests\API\AuthRegisterAPIRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AuthAPIController extends AppBaseController //Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      summary="register",
     *      tags={"Auth"},
     *      description="register user",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AuthRegister")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function register(AuthRegisterAPIRequest $request): JsonResponse
    {
        # code...
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $this->userRepository->create($input);

        return $this->sendSuccess("Register successfully");
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      summary="login",
     *      tags={"Auth"},
     *      description="login user",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              )
     *
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(AuthLoginAPIRequest $request): JsonResponse
    {
        # code...

        if(!Auth::attempt($request->all())){
            return $this->sendError("Invalid Credential",400);
        }

        $auth = Auth::user();
        $tokenResult = $auth->createToken('auth_token')->plainTextToken;
        // $token = $tokenResult->token;
        // $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();

        $data['token'] = $tokenResult;
        $data['type'] = "Bearer";

        return $this->sendResponse($data,"successfully");
    }

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      summary="logout",
     *      tags={"Auth"},
     *      security={{"token":{}}},
     *      description="logout user",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function logout(Request $request)
    {
        # code...
        Auth::user()->tokens()->delete();

        return $this->sendSuccess("Logout successfully");
    }

    /**
     * @OA\Get(
     *      path="/auth/user",
     *      summary="Get user",
     *      tags={"Auth"},
     *      security={{"token":{}}},
     *      description="Get user",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getUser(Request $request)
    {
        # code...
        $user = $request->user();
        $data =  [
            "id"=>$user->id,
            "name" => $user->name,
            "email" => $user->email
        ];
        return $this->sendResponse($data,"successfully");
    }
}
