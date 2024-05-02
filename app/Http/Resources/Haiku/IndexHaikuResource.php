<?php

namespace App\Http\Resources\Haiku;

use App\Models\Haiku;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IndexHaikuResource
 *
 * @OA\Schema(
 *     schema="IndexHaikuResource",
 *     @OA\Property(property="id", type="integer", example="1"),
 *     @OA\Property(property="user_id", type="integer", example="1"),
 *     @OA\Property(property="name", type="strig", example="test"),
 *     @OA\Property(property="subject", type="string", format="date", enum={"weather","autumn","lyrics","music"}),
 *     @OA\Property(property="published", type="null|boolean", example="null|true"),
 *     @OA\Property(property="publication_date", type="null|string", example="2023-12-19T19:47:23.000000Z"),
 *     @OA\Property(property="created_at", type="string", format="date", example="2023-12-19T19:47:23.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date", example="2023-12-19T19:47:23.000000Z"),
 * )
 *
 * @property-read Haiku $resource
 */
final class IndexHaikuResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return string[]
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'name' => $this->resource->name,
            'subject' => $this->resource->subject,
            'published' => $this->resource->published,
            'publication_date' => $this->resource->publication_date,
        ];
    }
}
