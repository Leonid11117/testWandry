<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\DTO\Auth\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\ViewAuthResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/api/login",
 *     summary="Authorization",
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest"),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/ViewAuthResource",
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ }
 * )
 *
 * Class LoginController
 *
 * @package App\Http\Controllers\Auth
 */
final class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     *
     * @return JsonResource
     */
    public function __invoke(LoginRequest $request): JsonResource
    {
        $user = User::query()->where('email', '=', $request->email)->first();
        $token = $user->createToken(User::TOKEN_NAME);

        /** @var User $user */
        return ViewAuthResource::make(
            new RegisteredUser(
                $token->plainTextToken,
                $user,
            )
        );
    }
}
