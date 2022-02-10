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


    /**
     * Move the file to intended location
     *
     * @param  mixed $temp_path
     * @param  mixed $folder
     * @param  mixed $file
     * @param  mixed $new_filename
     * @return null|static
     */
    public static function move($temp_path, $folder, $file, $new_filename = '')
    {
        $fileObj = new static;
        $ds = DIRECTORY_SEPARATOR;

        // set file name
        $fileObj->setName($file, $new_filename);
        // get renamed file name
        $file_name = $fileObj->getName();

        //check if folder is a dir
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // set file path
        $fileObj->path = "{$folder}{$ds}{$file_name}";
        $absolute_path = BASE_PATH . "{$ds}public{$ds}{$fileObj->path}";
        if (move_uploaded_file($temp_path, $absolute_path)) {
            return $fileObj;
        }

        return null;
    }
}