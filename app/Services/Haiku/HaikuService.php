<?php

namespace App\Services\Haiku;

use App\Models\Haiku;
use App\DTO\Haiku\HaikuItem;
use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Model;

class HaikuService
{
    /**
     * @param HaikuItem $item
     *
     * @return array
     */
    private function formDataArray(HaikuItem $item): array
    {
        return ArrayHelper::filterEmpty([
            'user_id' => $item->getUserId(),
            'name' => $item->getName(),
            'subject' => $item->getSubject(),
            'published' => $item->getPublished(),
            'publication_date' => $item->getPublicationDate(),
            'created_at' => $item->getCreatedAt(),
            'updated_at' => $item->getUpdatedAt(),

        ]);
    }

    /**
     * Haiku creation method
     *
     * @param HaikuItem $item
     *
     * @return Model|null
     */
    public function add(HaikuItem $item): ?Model
    {
        $user = auth()->user();

        return Haiku::query()->where('user_id', '=', $user->id)->create($this->formDataArray($item));
    }

    /**
     * Haiku update method
     *
     * @param HaikuItem $item
     *
     *
     */
    public function update(HaikuItem $item)
    {
        $user = auth()->user();

        return Haiku::query()->where('user_id', '=', $user->id)
            ->where('id', '=', $item->getId())
            ->update($this->formDataArray($item));
    }

    public function delete(int $id): mixed
    {
        $user = auth()->user();

        return Haiku::query()->where('user_id', '=', $user->id)
            ->where('id', '=', $id)
            ->delete();
    }
}
