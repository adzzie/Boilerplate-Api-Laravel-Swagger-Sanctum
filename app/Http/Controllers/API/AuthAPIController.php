<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthLoginApiRequest;
use App\Http\Requests\API\AuthRegisterApiRequest;
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
    public function register(AuthRegisterApiRequest $request): JsonResponse
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
    public function login(AuthLoginApiRequest $request): JsonResponse
    {
        # code...

        $data =[];
        if(Auth::attempt($request->all())){
            $auth = Auth::user();
            $tokenResult = $auth->createToken('auth_token')->plainTextToken;
            // $token = $tokenResult->token;
            // $token->expires_at = Carbon::now()->addWeeks(1);
            // $token->save();

            $data['token'] = $tokenResult;
            $data['type'] = "Bearer";

        }else{
            return $this->sendError("Invalid Credential",400);
        }
        return $this->sendResponse($data,"successfully");
    }
}
