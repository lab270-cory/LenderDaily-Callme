<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TestingSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing-setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a database and runs migrations and seeder';

    /**
     * the database which will be created for testing
     *
     * @var string
     */
    protected $dbName = 'testing_db';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Config::set('database.connections.mysql.database', 'testing_db');
        $this->info('creating database');
        $this->createDB('testing_db');
        $this->info('running migrations');
        Artisan::call('migrate');
        $this->info(Artisan::output());
        $this->info('running seeders');
        Artisan::call('db:seed');
        $this->info(Artisan::output());
    }

    /**
     * Creates an empty DB with given name
     * @param string $dbName    name of the DB
     * @return null
     */
    private function createDB(string $dbName)
    {
        \DB::purge('mysql');
        // removing old db
        \DB::connection('mysql')->getPdo()->exec("DROP DATABASE IF EXISTS `{$dbName}`");

        // Creating testing_db
        \DB::connection('mysql')->getPdo()->exec("CREATE DATABASE `{$dbName}`");

        //disconnecting it will remove database config from the memory so that new database name can be
        \DB::disconnect('mysql');
    }
}
