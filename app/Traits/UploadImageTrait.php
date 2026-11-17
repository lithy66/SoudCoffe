<?php
namespace App\Traits;


use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadImageTrait
{

    public function upload(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {
        if ($request->hasFile($inputname))
        {
            if (!$request->file($inputname)->isValid())
            {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);
            $name = Str::uuid(). $photo->getClientOriginalName();
            $path = 'images/admin/'. $foldername .'/'. $name;
            $filename = '/' . $name;

            $image = new Image();
            $image->filename = $path;
            $image->imageable_id = $imageable_id;
            $image->imageable_type = $imageable_type;
            $image->save();

            return $request->file($inputname)->storeAs($foldername, $filename, $disk);
        }

        return null;

    }

    public function Delete_attachment($imageableId,$imageableType,$disk)
    {
        $image = Image::where('imageable_id', $imageableId)
            ->where('imageable_type', $imageableType)
            ->first();

        if (!$image) {
            return;
        }

        $oldPath = $image->filename;
        $relativePath = basename(dirname($oldPath)) . '/' . basename($oldPath);

        Storage::disk($disk)->delete($relativePath);
        $image->delete();
    }

}
