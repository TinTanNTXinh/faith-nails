<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function postImport(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
//            $data = Excel::load($path, function ($reader) {
//            })->get();
//            if (!empty($data) && $data->count()) {
//                foreach ($data as $key => $value) {
//                    $insert[] = ['name' => $value->name, 'description' => $value->description];
//                }
//                if (!empty($insert)) {
//                    DB::table('collections')->insert($insert);
//                    dd('Insert Record successfully.');
//                }
//            }
        }
        return back();
    }
}
