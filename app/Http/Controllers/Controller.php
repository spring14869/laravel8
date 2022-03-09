<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PATH = 'storage' . DIRECTORY_SEPARATOR;

    public $admin = [];

    /**
     * view包裝，內部處理user session
     * @param string $path
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view($path = '', $data = [])
    {
        $data['admin'] = Session::get('user');

        return view($path, $data);
    }


    /**
     * 上傳檔案
     * @param $fileObject
     * @param string $fileName
     * @return string
     */
    protected function uploadFile($fileObject, $fileName = '')
    {
        if (empty($fileObject)) {
            return '';
        }

        $uploadFileName = $fileName . '.' . $fileObject->extension();

        return static::PATH . Storage::disk('public')->putFileAs(
            'user', $fileObject, $uploadFileName
        );
    }


    /**
     * 縮圖
     * @param $filePath
     * @param int $width
     * @param null $height
     * @return bool|string
     */
    protected function resizeImage($filePath, $width = 200, $height = NULL)
    {
        if (empty($filePath)) {
            return NULL;
        }

        $image = Image::make($filePath);

        if (empty($height)) {
            $image->widen($width);
        } else {
            $image->resize($width, $height);
        }

        if (!$image->save()) {
            return false;
        }

        return $image->basePath();
    }

    /**
     * @param string $key
     * @return string
     */
    protected function createToken($key = '')
    {
        return hash('sha256', $key . time() . Str::random(40));
    }


    protected function setLoginSession($account, $name, $token)
    {
        session([
            'user' => [
                'account' => $account,
                'name' => $name,
                'token' => $token
            ]
        ]);
    }

    protected function destroySession()
    {
        Session::flush();
    }
}
