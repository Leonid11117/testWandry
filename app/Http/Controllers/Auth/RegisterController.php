<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\DTO\Auth\RegisteredUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\ViewAuthResource;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/api/register",
 *     summary="Registration",
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/AuthRegisterRequest"),
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
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
final class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     *
     * @return JsonResource
     *
     * @throws \Throwable
     */
    public function __invoke(RegisterRequest $request): JsonResource
    {
        $user = new User();

        $user->fill([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->saveOrFail();

        $token = $user->createToken(User::TOKEN_NAME);

        return ViewAuthResource::make(
            new RegisteredUser(
                $token->plainTextToken,
                $user,
            )
        );
    }
}
