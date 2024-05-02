<?php

namespace App\Http\Controllers\Haikus;

use App\DTO\Haiku\HaikuItem;
use App\Http\Controllers\Controller;
use App\Services\Haiku\HaikuService;
use App\Http\Requests\Haiku\HaikuRequest;
use App\Http\Resources\Haiku\ViewHaikuResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CreateController
 *
 * @OA\Post(
 *     path="/api/haikus",
 *     operationId="createHaiku",
 *     tags={"Haikus"},
 *     summary="Create a new haiku",
 *    @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(ref="#/components/schemas/HaikuRequest")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *           @OA\JsonContent(
 *                @OA\Property(
 *                    property="data",
 *                    type="object",
 *                    ref="#/components/schemas/ViewHaikuResource",
 *                )
 *            )
 *      ),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={{"bearerAuth": {}}},
 * )
 *
 * @package App\Http\Controllers\Tasks
 */
final class CreateController extends Controller
{
    /**
     * @param HaikuRequest $request
     *
     * @return JsonResource
     */
    public function __invoke(HaikuRequest $request): JsonResource
    {
        $user = \auth()->user();

        $service = new HaikuService();

        $item = new HaikuItem(
            name: $request->name,
            subject: $request->subject,
            published: $request->published,
            publication_date: $request->publication_date,
            user_id: $user->id,
        );

        $haiku = $service->add($item);

        return ViewHaikuResource::make($haiku);
    }
}
