<?php

namespace App\Http\Controllers\Haikus;

use App\Models\Haiku;
use App\DTO\Haiku\HaikuItem;
use App\Http\Controllers\Controller;
use App\Services\Haiku\HaikuService;
use App\Http\Requests\Haiku\HaikuRequest;
use App\Http\Resources\Haiku\ViewHaikuResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UpdateController
 *
 * @OA\Put(
 *     tags={"Haikus"},
 *     path="/api/haikus/{id}",
 *     summary="Update haiku",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(ref="#/components/schemas/HaikuRequest")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *               @OA\Property(
 *                   property="data",
 *                   type="object",
 *                   ref="#/components/schemas/ViewHaikuResource",
 *               )
 *           )
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Haikus
 */
final class UpdateController extends Controller
{
    /**
     * @param int $id
     * @param HaikuRequest $request
     *
     * @return JsonResource
     */
    public function __invoke(int $id, HaikuRequest $request): JsonResource
    {
        $service = new HaikuService();

        $item = new HaikuItem(
            name: $request->name,
            subject: $request->subject,
            published: $request->published,
            publication_date: $request->publication_date,
        );

        $item->setId($id);

        $service->update($item);

        $haiku = Haiku::query()->findOrFail($id);

        return ViewHaikuResource::make($haiku);
    }
}
