<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use App\DTO\Auth\RegisteredUser;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ViewUserResource;

/**
 * Class ViewAuthResource
 *
 * @property-read RegisteredUser $resource
 *
 * @OA\Schema(
 *      schema="ViewAuthResource",
 *      @OA\Property(property="token", type="string", example="1|Bjb2QGYzxKgqRFLbnHxeUkqR6drD7TpeF7Va3mgU"),
 *      @OA\Property(
 *          property="user",
 *          type="object",
 *          ref="#/components/schemas/ViewAuthResource",
 *      ),
 *  )
 *
 * @package App\Http\Resources\Auth
 */
final class ViewAuthResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->resource->getToken(),
            'user' => ViewUserResource::make($this->resource->getUser()),
        ];
    }
}
