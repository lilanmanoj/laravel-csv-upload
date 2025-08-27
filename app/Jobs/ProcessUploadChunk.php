<?php

namespace App\Jobs;

use App\Models\UploadDetails;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class ProcessUploadChunk implements ShouldQueue
{
    use Batchable, Queueable, SerializesModels;

    protected $uploadId;
    protected $rows;

    /**
     * Create a new job instance.
     */
    public function __construct($uploadId, array $rows)
    {
        $this->uploadId = $uploadId;
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->batch()->cancelled()) {
            // Determine if the batch has been cancelled...
            return;
        }

        $data = [];

        foreach ($this->rows as $row) {
            $fields = str_getcsv($row);
            $data[] = [
                'upload_id' => $this->uploadId,
                'name' => $fields[0],
                'email' => $fields[1],
                'phone' => $fields[2],
                'address' => $fields[3],
                'birthday' => $fields[4]
            ];
        }

        UploadDetails::insert($data);
    }
}
