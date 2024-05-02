<?php

namespace App\Http\Controllers\Haikus;

use App\Models\Haiku;
use App\Http\Controllers\Controller;
use App\Http\Resources\Haiku\ViewHaikuResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ViewController
 *
 * @OA\Get(
 *     tags={"Haikus"},
 *     path="/api/haikus/{id}",
 *     summary="View haiku",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/ViewHaikuResource",
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Haikus
 */
final class ViewController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResource
     */
    public function __invoke(int $id): JsonResource
    {
        $user = auth()->user();

        $haiku = Haiku::query()->where('id', '=', $id)
            ->where('user_id', '=', $user->id)
            ->firstOrFail();

        return ViewHaikuResource::make($haiku);
    }
}
