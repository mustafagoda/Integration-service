<?php

namespace App\Http\Middleware;

use App\Domain\Landlord\Repositories\Interfaces\ICurrencyRepository;
use App\Exceptions\Custom\ApiCustomException;
use Closure;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AppCurrency
{
    /**
     * Localization constructor.
     * @param Application $app
     * @param ICurrencyRepository $currencyRepository
     */
    public function __construct(
        private readonly Application $app,
        private readonly ICurrencyRepository $currencyRepository
    ) {
    }

    /**
     * @throws Throwable
     */
    public function handle($request, Closure $next)
    {
        $searchCurrency = ! empty($request->header('Search-Currency')) ?
            $request->header('Search-Currency') :
            $this->getDefaultAppCurrency();
        $checkTenantHasCurrency = $this->currencyRepository->findActiveCurrenciesForTenant()->get($searchCurrency);
        throw_if(empty($checkTenantHasCurrency), new ApiCustomException(trans('validation.unsupported-currency', [
            'attribute' => $searchCurrency,
        ]), Response::HTTP_NOT_FOUND));

        $this->app['config']->set('app.currency', $searchCurrency);
        $response = $next($request);
        $response->headers->set('Search-Currency', $searchCurrency);
        return $response;
    }

    private function getDefaultAppCurrency(): string
    {
        return config('app.currency');
    }
}
