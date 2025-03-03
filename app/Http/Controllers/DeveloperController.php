<?php

namespace App\Http\Controllers;

use App\Services\CakeDayService;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Developer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class DeveloperController extends Controller
{
    public function showUploadForm(): View
    {
        return view('uploadForm');
    }
    public function uploadBirthdays(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimetypes:text/plain,text/csv,text/tsv'
        ]);

        $file = $request->file('file');
        $content = file($file->getPathname());

        foreach ($content as $line) {
            $data = explode(',', trim($line));

            if (count($data) !== 2) {
                continue; // Skip invalid lines
            }

            [$name, $dob] = $data;

            if (!preg_match('/\d{4}-\d{2}-\d{2}/', $dob)) {
                continue; // Skip invalid date format
            }

            Developer::updateOrCreate(['name' => $name], ['date_of_birth' => $dob]);
        }

        return redirect('/cakes')->with('success', 'File uploaded successfully!');
    }

    protected $cakeDayService;

    public function __construct(CakeDayService $cakeDayService)
    {
        $this->cakeDayService = $cakeDayService;
    }

    public function getCakeDays()
    {
        $cakeDays = $this->cakeDayService->calculateCakeDays();
        return response()->json($cakeDays, 200);

    }

    public function showCakes(): View
    {
        return view('cake-days');
    }


}

