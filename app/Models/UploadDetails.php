<?php

namespace App\Models;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadDetails extends Model
{
    protected $fillable = [
        'upload_id',
        'name',
        'email',
        'phone',
        'address',
        'birthday',
    ];

    /**
     * Get the upload that owns this line of detail.
     */
    public function upload(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}
