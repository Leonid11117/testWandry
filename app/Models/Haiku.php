<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $subject enum('weather','autumn','lyrics','music')
 * @property boolean $published
 * @property string $publication_date
 * @property string $created_at
 * @property string $updated_at
 */
class Haiku extends Model
{
    use HasFactory;

    protected $table = 'haikus';

    protected $fillable = [
        'user_id',
        'name',
        'subject',
        'published',
        'publication_date',
    ];

    protected $casts = [
        self::UPDATED_AT => 'datetime:Y-m-d H:i:s',
        self::CREATED_AT => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
