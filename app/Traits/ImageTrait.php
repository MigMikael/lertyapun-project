<?php
namespace App\Traits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use App\Helpers\StringGenerator;
use Illuminate\Support\Facades\Log;

trait ImageTrait
{
    public $thumb = 150;
    public $small = 300;
    public $medium = 500;
    public $large = 1024;
    public $origin = null;

    public function storeImage($file, $type)
    {
        $ex = $file->getClientOriginalExtension();
        [$width, $height] = getimagesize($file);

        Storage::disk('local')->put($file->getFilename() . '.' . $ex, File::get($file));

        $fileRecord = [
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => $file->getFilename() . '.' . $ex,
            'mime' => $file->getClientMimeType(),
            'original_name' => $file->getClientOriginalName(),
        ];

        $file = \App\Models\Image::create($fileRecord);

        self::compress($file);
        self::resizeImage($file, $width, $height);

        return $file;
    }

    public function compress($file)
    {
        $size = Storage::disk('local')->size($file->name);

        $img_path = storage_path().'/app/'.$file->name;
        $des_path = storage_path().'/app/cp_'.$file->name;

        if ($file->mime == 'image/jpeg'){
            $image = imagecreatefromjpeg($img_path);
        }
        elseif ($file->mime == 'image/gif'){
            $image = imagecreatefromgif($img_path);
        }
        elseif ($file->mime == 'image/png'){
            $image = imagecreatefrompng($img_path);
        }
        else return abort(500);

        if($size > 10000000){//         5 MB
            imagejpeg($image, $des_path, 10);
        }elseif($size > 2000000){//     2 MB
            imagejpeg($image, $des_path, 20);
        }elseif($size > 1000000){//     1 MB
            imagejpeg($image, $des_path, 25);
        }elseif($size > 200000){//      200 KB
            imagejpeg($image, $des_path, 50);
        }else{
            imagejpeg($image, $des_path, 80);
        }

        $file->name = 'cp_'.$file->name;
        $file->save();
    }

    public function resizeImage($file, $width, $height)
    {
        $image = Storage::disk('local')->get($file->name);
        $old_filename = $file->name;

        if ($width > 2000) {
            if ($width == $height) {
                $height = '1200';
                $width = '1200';
            } else {
                $height = strval(($height / $width) * 1200);
                $width = '1200';
            }
        }

        $img = Image::make($image)->resize($width, $height);
        $img->save(storage_path().'/app/re_'.$file->name);
        $file->name = 're_'.$file->name;
        $file->save();


        // make image thumbnail
        $img = Image::make($image)->resize($this->thumb, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path().'/app/thumb_'.$file->name);


        // make image small
        $img = Image::make($image)->resize($this->small, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path().'/app/small_'.$file->name);


        // make image medium
        $img = Image::make($image)->resize($this->medium, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path().'/app/medium_'.$file->name);


        // make image large
        $img = Image::make($image)->resize($this->large, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path().'/app/large_'.$file->name);


        Storage::delete($old_filename);
    }
}
