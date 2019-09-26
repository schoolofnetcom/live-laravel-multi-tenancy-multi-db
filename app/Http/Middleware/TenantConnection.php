<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;

class TenantConnection
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $prefix = $request->route('prefix');
        $company = null;
        if ($prefix) {
            $company = Company::where('prefix', $prefix)->first();
            if ($company) {
                \Tenant::setTenant($company);
            }
        }
        if(\Tenant::isTenantRequest() && !$company){
            abort(403, 'Tenant not found');
        }
        return $next($request);
    }
}
