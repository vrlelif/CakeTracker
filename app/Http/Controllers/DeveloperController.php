<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    public function uploadBirthdays(Request $request)
    {
        $request->validate(['file' => 'required|mimes:txt']);

        $file = $request->file('file');
        $content = file($file->getPathname());

        foreach ($content as $line) {
            [$name, $dob] = explode(',', trim($line));
            Developer::create(['name' => $name, 'date_of_birth' => $dob]);
        }

        return response()->json(['message' => 'File processed successfully'], 200);
    }
}

