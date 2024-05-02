<?php

namespace App\Http\Requests\Haiku;

use App\Rules\NameLineCountRule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Haiku\HaikuSubjectEnum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HaikuRequest
 *
 * @OA\Schema (
 *     title="HaikuRequest",
 *     required={"name", "subject"},
 *     @OA\Property(property="name", type="strig", example="test"),
 *     @OA\Property(property="subject", type="string", format="date", enum={"weather","autumn","lyrics","music"}),
 *     @OA\Property(property="published", type="null|boolean", example="null|true"),
 *     @OA\Property(property="publication_date", type="null|string", example="2023-12-19T19:47:23.000000Z")
 * )
 * @property string $name
 * @property string $subject
 * @property string $published
 * @property string $publication_date
 */
final class HaikuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', new NameLineCountRule(4)],
            'subject' => ['required', 'string', new Enum(HaikuSubjectEnum::class)],
            'published' => ['nullable', 'boolean'],
            'publication_date' => ['nullable', 'date'],
        ];
    }
}
