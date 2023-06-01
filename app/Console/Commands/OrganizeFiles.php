<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OrganizeFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:organize-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = File::files(public_path() . '/files');
        foreach($files as $file){
            $belongsTo = explode('-', $file->getFilename());
            $path =  $file->getPath() . '/' . $belongsTo[0];
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            } 
            File::move($file->getRealPath(), $path . '/' . $file->getFilename());
        }
    }
}
