<?php

namespace App\Helpers;

use Exception;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Log\Logger;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Factory
     */
    protected $storage;

    /**
     * @var  \Illuminate\Filesystem\Filesystem
     */
    protected $file;

    /**
     * @var  \Illuminate\Log\Logger
     */
    protected $log;

    /**
     * FileHelper constructor.
     *
     * @param  \Illuminate\Contracts\Filesystem\Factory $storage
     * @param  \Illuminate\Filesystem\Filesystem $file
     * @param Logger $log
     */
    public function __construct(Storage $storage, File $file, Logger $log)
    {
        $this->storage = $storage;
        $this->file = $file;
        $this->log = $log;
    }

    /**
     * Uploads file to the storage.
     *
     * @param  \Symfony\Component\HttpFoundation\File\UploadedFile  $uploadedFile
     * @param  string  $dir
     * @return mixed
     */
    public function upload(UploadedFile $uploadedFile, $dir = '')
    {
        if (strlen($dir) && strrpos($dir, DIRECTORY_SEPARATOR) !== strlen($dir) - 1) {
            $dir .= DIRECTORY_SEPARATOR;
        }

        $name = md5($uploadedFile->getFilename() . time());
        $extension = $uploadedFile->getClientOriginalExtension();

        $fileName =  str_replace('\\', '/', "{$dir}{$name}.{$extension}");

        try {

            if ($this->storage->disk('public')->put($fileName, $this->file->get($uploadedFile)) === false) {
                return false;
            }
            return $fileName;
        } catch (Exception $e) {
            $this->log->error($e->getMessage(), [
                'filename' => $fileName
            ]);

            return false;
        }
    }

    /**
     * Delete the file at a given path.
     *
     * @param  string|array  $paths
     * @return bool
     */
    public function delete($paths)
    {
        return $this->storage->delete($paths);
    }

    /**
     * Gets contents of a file specified by path
     *
     * @param $path
     * @return mixed
     */
    public function get($path)
    {
        return $this->storage->get($path);
    }
}
