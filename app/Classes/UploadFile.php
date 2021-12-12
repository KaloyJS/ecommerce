<?php

namespace App\Classes;

class UploadFile
{
    protected $filename;
    protected $max_filesize = 2097152;
    protected $extension;
    protected $path;


    /**
     * Get Filename
     *
     * @return void
     */
    public function getName()
    {
        return $this->filename;
    }

    /**
     * set filename
     *
     * @param  string $file
     * @param  string $name
     * @return void
     */
    protected function setName($file, $name = "")
    {
        if ($name === "") {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(['-', ' '], '-', $name));
        $hash = md5(microtime());
        $ext = $this->fileExtension($file);
        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    /**
     * Get file extension
     *
     * @param  mixed $file
     * @return string
     */
    protected function fileExtension($file)
    {
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * checks whether file size is greater than max filesize
     *
     * @param  mixed $file
     * @return boolean
     */
    public static function fileSize($file)
    {
        $fileobj = new static;
        return $file > $fileobj->max_filesize ? true : false;
    }

    /**
     * checks if uploaded file is an image
     *
     * @param  $file
     * @return boolean
     */
    public static function isImage($file)
    {
        $fileobj = new static;
        $ext = $fileobj->fileExtension($file);
        $validExt = array(
            'jpg',
            'jpeg',
            'png',
            'bmp',
            'gif'
        );

        if (!in_array(strtolower($ext), $validExt)) {
            return false;
        }

        return true;
    }

    /**
     * Get the path of where the file was uploaded to
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }
}