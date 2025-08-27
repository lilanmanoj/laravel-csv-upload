<?php

namespace App\Listeners;

use App\Jobs\ProcessUploadChunk;
use App\Models\Upload;
use App\Models\UploadDetails;
use App\Events\UploadCreatedEvent;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;

class UploadCreatedListener implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create the event listener.
     */
    public function __construct(Upload $upload)
    {}

    /**
     * Handle the event.
     */
    public function handle(UploadCreatedEvent $event): void
    {
        if (Storage::disk('local')->exists($event->upload->path)) {
            // get csv file content and parse CSV
            $content = Storage::disk('local')->get($event->upload->path);
            $rows = str_getcsv($content, "\n");

            // shift header row out of the array
            array_shift($rows);

            // Chunking the rows for batch processing
            $chunkSize = config('csvimport.chunk_size', 1000);
            $chunks = array_chunk($rows, $chunkSize);

            $jobs = [];
            foreach ($chunks as $chunk) {
                $jobs[] = new \App\Jobs\ProcessUploadChunk($event->upload->id, $chunk);
            }

            Bus::batch($jobs)->finally(function (Batch $batch) use ($event) {
                // After processing, update the status of the upload
                $event->upload->status = Upload::STATUS_DONE;
                $event->upload->save();
            })->name('Import CSV')->onQueue('imports')->dispatch();

            // while (($row = fgetcsv($content)) !== FALSE) {
            //     if ($row[0] == 'Name') {
            //         continue; // Skip the header row
            //     } else {
            //         UploadDetails::create([
            //             'upload_id' => $event->upload->id,
            //             'name' => $row[0],
            //             'email' => $row[1],
            //             'phone' => $row[2],
            //             'address' => $row[3],
            //             'birthday' => $row[4],
            //         ]);
            //     }
            // }
        }
    }
}
