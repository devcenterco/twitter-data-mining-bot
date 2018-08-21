<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        // Get our spreadsheet
        $spreadsheet = (new \Google\Spreadsheet\SpreadsheetService)
        ->getSpreadsheetFeed()
        ->getByTitle('My Twitter Bot');

        // Get the first worksheet (tab)
        $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
        $worksheet = $worksheets[0];
        $cellFeed = $worksheet->getCellFeed();
        $cellFeed->editCell(1,1, "Profile Name");
        $cellFeed->editCell(1,2, "Total Followers");
        $listFeed = $worksheet->getListFeed();

        $listFeed->insert([
        'lastname' => 'Stauffer',
        'firstname' => "Matt",
        // ...
        ]);
    }
}
