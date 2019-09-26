<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {--ids= : Ids of tenants to create structure}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ids = explode(",", $this->option('ids'));//1,2,3
        $companies = Company::whereIn('id', $ids)->get();
        foreach ($companies as $company) {
            DB::statement("CREATE DATABASE {$company->database};");

            $this->call('migrate', [
                '--database' => $company->prefix, //conexao company1
                '--path' => 'database/migrations/tenant',
                '--seed'
            ]);
        }
        if(!$companies->count()){
            $this->error('Ids of tenant not found in table.');
        }
    }
}
