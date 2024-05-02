<?php

namespace App\Http\Controllers\Haikus;

use App\Models\Haiku;
use App\Http\Controllers\Controller;
use App\Http\Resources\Haiku\IndexHaikuResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class IndexController
 *
 * @OA\Get(
 *     tags={"Haikus"},
 *     path="/api/haikus",
 *     summary="Haiku list",
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/IndexHaikuResource")
 *              ),
 *          )
 *     ),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Haikus
 */
final class IndexController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $user = \auth()->user();

        $haiku = Haiku::query()->where('user_id', $user->id)->paginate(10);

        return IndexHaikuResource::collection($haiku);
    }
}
