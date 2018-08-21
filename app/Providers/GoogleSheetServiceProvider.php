<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google_Client;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

class GoogleSheetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path(). '/'.env('GOOGLE_APPLICATION_CREDENTIALS'));
        $client = new Google_Client;
        $client->useApplicationDefaultCredentials();

        $client->setApplicationName("Get Twitter Profiles");
        $client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);

        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
        ServiceRequestFactory::setInstance(
            new DefaultServiceRequest($accessToken)
        );

        $spreadsheet = (new \Google\Spreadsheet\SpreadsheetService)
        ->getSpreadsheetFeed()
        ->getByTitle(env('GOOGLE_SPREADSHEET_FILENAME'));

        // Get the first worksheet (tab)
        $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
        $worksheet = $worksheets[0];
        $cellFeed = $worksheet->getCellFeed();
        $cellFeed->editCell(1,1, "Profile Name");
        $cellFeed->editCell(1,2, "Total Followers");
        $listFeed = $worksheet->getListFeed();
        config(['app.listFeed' => $listFeed]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
