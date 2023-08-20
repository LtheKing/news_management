<?php

namespace App\Http\Controllers;

use App\Events\NewsProcessLogs;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    //API
    public function getNewsArray()
    {
        $news = News::all()->toArray();
        return $news;
    }

    public function create(Request $request)
    {
        if ($request->Role == 'Admin') {
            # code...
            $image = $request->file('Img');
            $fileName = $request->Title . '.' . $image->getClientOriginalExtension();
            $request->merge([
                'ImageName' => $fileName,
                'FileName' => $fileName,
            ]);
            $img = Image::make($image->getRealPath());

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');

            $errorMsg = '';
            $status = 'Succeed';
            $log = new News;
            try {
                $log = News::create($request->all());
            } catch (\Throwable $th) {
                // dd($th);
                $errorMsg = $th->getMessage();
                $status = 'Failed';
                Arr::add($log, 'id', 0);
            }

            Arr::add($log, 'EventType', 'Create');
            Arr::add($log, 'ResponseData', $log->toJson());
            Arr::add($log, 'ExceptionMessage', ' ');
            Arr::add($log, 'Role', $request->Role);
            Arr::add($log, 'ExceptionMessage', $errorMsg);
            Arr::add($log, 'Status', $status);

            // dd($log);
            event(new NewsProcessLogs($log));

            return ('Succeed');
        } else {
            return ("You'not allowed to create post");
        }

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        if ($request->Role == 'Admin') {
            $data = News::find($id);
            Storage::disk('public')->delete('/images/' . $data->ImageName);
            $image = $request->file('Img');
            $fileName = $request->Title . '.' . $image->getClientOriginalExtension();
            $request->merge([
                'ImageName' => $fileName,
                'FileName' => $fileName,
            ]);
            $img = Image::make($image->getRealPath());

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/' . $fileName, $img, 'public');
            $data->update($request->all());

            return 'Update Succeed';
        } else {
            return ("You'not allowed to update this post");
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->Role == 'Admin') {
            $news = News::find($id);
            $news->delete();
            Storage::disk('public')->delete('/images/' . $news->ImageName);
            return ('delete succeeded');
        } else {
            return ("you're not allowed to delete this post");
        }
    }
}
