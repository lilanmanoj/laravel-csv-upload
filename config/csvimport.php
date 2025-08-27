<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CSV Import Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for CSV import functionality.
    | You can set the maximum file size for uploads and other related settings.
    |
    */

    'max_file_size' => env('CSV_MAX_FILE_SIZE', 102400), // Maximum file size in KB (Default 100 MB)
    'chunk_size' => env('CSV_CHUNK_SIZE', 1000), // Number of rows to process in each chunk
];