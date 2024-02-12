<?php

namespace App\Http\Middleware;

use App\Domain\Landlord\Repositories\Interfaces\ILanguageRepository;
use App\Exceptions\Custom\ApiCustomException;
use Closure;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AppLocalization
{
    /**
     * Localization constructor.
     * @param Application $app
     * @param ILanguageRepository $languageRepository
     */
    public function __construct(
        private readonly Application $app,
        private readonly ILanguageRepository $languageRepository
    ) {
    }

    /**
     * @throws Throwable
     */
    public function handle($request, Closure $next)
    {
        $requestLanguage = $request->header('Accept-Language');
        if (in_array($requestLanguage, [null, 'en-us,en;q=0.5']) || empty($requestLanguage)) {
            $requestLanguage = $this->getDefaultAppLanguage();
        }

        $checkTenantHasHeaderLanguage = $this->languageRepository->findActiveLanguagesForTenant()->get($requestLanguage);

        throw_if(empty($checkTenantHasHeaderLanguage), new ApiCustomException(trans('validation.unsupported-language', [
            'attribute' => $requestLanguage,
        ]), Response::HTTP_NOT_FOUND));

        $this->app->setLocale($requestLanguage);
        $response = $next($request);
        $response->headers->set('Accept-Language', $requestLanguage);
        return $response;
    }

    private function getDefaultAppLanguage(): string
    {
        return config('app.locale');
    }
}
