<?php

namespace App\Listeners;

use App\Models\Upload;
use App\Models\UploadDetails;
use App\Events\UploadCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class UploadCreatedListener implements ShouldQueue
{
    use Queueable;

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
            // Read csv file and store each row in UploadDetails
            $content = Storage::disk('local')->readStream($event->upload->path);

            while (($row = fgetcsv($content)) !== FALSE) {
                if ($row[0] == 'Name') {
                    continue; // Skip the header row
                } else {
                    UploadDetails::create([
                        'upload_id' => $event->upload->id,
                        'name' => $row[0],
                        'email' => $row[1],
                        'phone' => $row[2],
                        'address' => $row[3],
                        'birthday' => $row[4],
                    ]);
                }
            }
        }

        // After processing, update the status of the upload
        $event->upload->status = Upload::STATUS_DONE;
        $event->upload->save();
    }
}
