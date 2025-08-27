<?php

namespace App\Models;

use App\Models\UploadDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Events\UploadCreatedEvent;

class Upload extends Model
{
    const STATUS_PENDING = 'Processing';
    const STATUS_DONE = 'Done';

    protected $fillable = [
        'path',
        'disk',
        'status',
    ];

    protected $dispatchesEvents = [
        'created' => UploadCreatedEvent::class,
    ];

    /**
     * Get the details for this upload.
     */
    public function details(): HasMany
    {
        return $this->hasMany(UploadDetails::class);
    }
}
