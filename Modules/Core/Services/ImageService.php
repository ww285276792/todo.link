<?php

namespace Modules\Core\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageService
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ImageService
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * ImageService constructor.
     *
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @param $name
     * @param Request $request
     *
     * @return null|string
     */
    public function upload($name, Request $request)
    {
        if ($request->hasFile($name)) {
            if (!is_dir('storage/uploads')) {
                Storage::makeDirectory('public/uploads', 0777, true, true);
            }

            $file = $request->file($name);
            $destinationPath = 'storage/uploads/';
            $extension = $file->getClientOriginalExtension();
            $fileName = date('Y-m-d-H-i-s') . time() . "-" . md5(uniqid(rand())) . '.' . $extension;
            $filePath = $destinationPath . $fileName;

            $this->image->make($file->getRealPath())->save($filePath);

            return 'uploads/' . $fileName;
        }

        return null;
    }
}
