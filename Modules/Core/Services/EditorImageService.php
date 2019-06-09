<?php

namespace Modules\Core\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class EditorImageService
 *
 * @author  luffy007  <285276792@qq.com>
 */
class EditorImageService
{
    /**
     * @param $name
     * @param Request $request
     * @param $uuid
     *
     * @return false|null|string
     */
    public function upload($name, Request $request, $uuid)
    {
        if ($request->hasFile($name)) {
            if (!Storage::exists($uuid)) {
                Storage::makeDirectory($uuid, 0777, true, true);
            }

            $file = $request->file($name);
            $extension = $file->getClientOriginalExtension();
            $fileName = date('Y-m-d-H-i-s') . time() . "-" . md5(uniqid(rand())) . '.' . $extension;
            $request->file($name)->storeAs($uuid, $fileName);

            return $fileName;
        }

        return null;
    }
}
