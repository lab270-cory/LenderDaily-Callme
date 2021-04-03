<?php


namespace App\Console\Commands;


use Artisan;
use Illuminate\Console\Command;

class IdeHelper extends Command
{
    public $signature = 'ide-helper:all';

    public $description = "runs required commands for ide helper";

    public function handle()
    {
        if(app()->isLocal()){
            $this->info('> @php artisan ide-helper:generate');
            Artisan::call('ide-helper:generate');
            $this->info('> @php artisan ide-helper:meta');
            Artisan::call('ide-helper:meta');
            $this->info('> @php artisan ide-helper:models --write');
            Artisan::call('ide-helper:models', ['--write'=> true]);
        }
    }
}
