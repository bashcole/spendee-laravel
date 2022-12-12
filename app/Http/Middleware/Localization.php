<?php

namespace App\Http\Middleware;

use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\Language;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {

        # Prepare and clean the parameters
        $parameters = $request->route()->parameters();

        unset($parameters['locale']);

        # Fetch the locale parameter
        $localeSegment = $request->segment(1);

        # Fetch all languages with cache
        $languages = cache()->remember('languages', now()->addSeconds(10), function () {
            return Language::all();
        });

        if (!session()->exists('locale') && !$request->hasCookie('locale')) {

            if (app()->environment(['production'])) {
                # Fetch client IP address
                $ipAddress = app()->environment(['production']) ? $request->ip() : '78.83.231.188';

                # Find the country code
                $countryCode = strtolower(GeoLocation::lookup($ipAddress)->getCountryCode() ?? 'bg');
            } else {
                $countryCode = 'bg';
            }

            # Check if the locale parameter and the country are different
            if ($localeSegment != $countryCode) {
                # Re-assign the local parameter
                $localeSegment = $countryCode;

                # Find the current language
                $currentLanguage = $languages->where('abbr', $localeSegment)->first();

                # Set the session
                session()->put('locale', $currentLanguage);

                # Redirect
                return redirect()->route($request->route()->getName(), array_merge($parameters, ['locale' => $localeSegment]));
            }
        }

        # Find the current language
        $currentLanguage = $languages->where('abbr', $localeSegment)->first();
        $locale = $currentLanguage->abbr ?? 'bg';
        $languageID = $currentLanguage->id ?? 1;

        # Define
        $localeLinks = [];

        # Loop though the languages
        foreach ($languages as $language) {
            $localeLinks[] = [
                'name'      => strtoupper($language['abbr']),
                'routeName' => $request->route()->getName(),
                'params'    => array_merge($parameters, ['locale' => $language['abbr']])
            ];
        }

        # Assign
        view()->share('localeLinks', $localeLinks);
        app()->setLocale($locale);
        session()->put('languageID', $languageID);
        session()->put('locale', $locale);
        $request->route()->forgetParameter('locale');

        # Continue
        return $next($request)->withCookie(cookie('locale', $locale, 120));
    }
}
