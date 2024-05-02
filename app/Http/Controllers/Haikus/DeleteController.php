<?php

namespace App\Http\Controllers\Haikus;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Haiku\HaikuService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 *  Class DeleteController
 *
 * @OA\Delete(
 *     tags={"Haikus"},
 *     path="/api/haikus/{id}",
 *     summary="Delete haiku",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No content",
 *     ),
 *     @OA\Response(response="400", description="Bad request"),
 *     @OA\Response(response="422", description="Error validation"),
 *     @OA\Response(response="500", description="Error server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * @package App\Http\Controllers\Haikus
 */
final class DeleteController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $service = new HaikuService();
        $service->delete($id);

        return \response()->json([], ResponseAlias::HTTP_NO_CONTENT);
    }
}
