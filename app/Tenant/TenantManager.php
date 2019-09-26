<?php
declare(strict_types=1);

namespace App\Tenant;


use App\Models\Company;
use Illuminate\Support\Facades\Schema;

class TenantManager
{
    private $tenant;

    /**
     * @return Company
     */
    public function getTenant(): ?Company
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     */
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
        $this->makeTenantConnection();
    }

    private function makeTenantConnection()
    {
        $clone = config('database.connections.system');
        $clone['database'] = $this->tenant->database;
        \Config::set('database.connections.tenant', $clone);
        \DB::reconnect('tenant');
    }

    public function loadConnections()
    {
        if (Schema::hasTable((new Company())->getTable())) {
            $companies = Company::all();
            foreach ($companies as $company) {
                $clone = config('database.connections.system');
                $clone['database'] = $company->database;
                \Config::set("database.connections.{$company->prefix}", $clone); //company1
            }
        }
    }

    public function isTenantRequest(){
        return !\Request::is('system/*') && \Request::route('prefix');
    }
}
