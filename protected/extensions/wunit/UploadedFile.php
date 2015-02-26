<?php

/**
 * @author Weavora Team <hello@weavora.com>
 * @link http://weavora.com
 * @copyright Copyright (c) 2011 Weavora LLC
 */
class UploadedFile extends CUploadedFile
{

    static private $_files;
    private $_name;
    private $_tempName;
    private $_type;
    private $_size;
    private $_error;

    /**
     * Returns an instance of the specified uploaded file.
     * The name can be a plain string or a string like an array element (e.g. 'Post[imageFile]', or 'Post[0][imageFile]').
     * @param string $name the name of the file input field.
     * @return CUploadedFile the instance of the uploaded file.
     * Null is returned if no file is uploaded for the specified name.
     */
    public static function getInstanceByName($name)
    {
        if (null === self::$_files)
            self::prefetchFiles();

        return isset(self::$_files[$name]) && self::$_files[$name]->getError() != UPLOAD_ERR_NO_FILE ? self::$_files[$name] : null;
    }

    /**
     * Returns an array of instances for the specified array name.
     *
     * If multiple files were uploaded and saved as 'Files[0]', 'Files[1]',
     * 'Files[n]'..., you can have them all by passing 'Files' as array name.
     * @param string $name the name of the array of files
     * @return array the array of CUploadedFile objects. Empty array is returned
     * if no adequate upload was found. Please note that this array will contain
     * all files from all subarrays regardless how deeply nested they are.
     */
    public static function getInstancesByName($name)
    {
        if (null === self::$_files)
            self::prefetchFiles();

        $len = strlen($name);
        $results = [];
        foreach (array_keys(self::$_files) as $key)
            if (0 === strncmp($key, $name, $len) && self::$_files[$key]->getError() != UPLOAD_ERR_NO_FILE)
                $results[] = self::$_files[$key];
        return $results;
    }

    /**
     * Cleans up the loaded CUploadedFile instances.
     * This method is mainly used by test scripts to set up a fixture.
     * @since 1.1.4
     */
    public static function reset()
    {
        self::$_files = null;
    }

    /**
     * Initially processes $_FILES superglobal for easier use.
     * Only for internal usage.
     */
    protected static function prefetchFiles()
    {
        self::$_files = [];
        if (!isset($_FILES) || !is_array($_FILES))
            return;

        foreach ($_FILES as $class => $info)
            self::collectFilesRecursive($class, $info['name'], $info['tmp_name'], $info['type'], $info['size'], $info['error']);
    }

    /**
     * Processes incoming files for {@link getInstanceByName}.
     * @param string $key key for identifiing uploaded file: class name and subarray indexes
     * @param mixed $names file names provided by PHP
     * @param mixed $tmp_names temporary file names provided by PHP
     * @param mixed $types filetypes provided by PHP
     * @param mixed $sizes file sizes provided by PHP
     * @param mixed $errors uploading issues provided by PHP
     */
    protected static function collectFilesRecursive($key, $names, $tmp_names, $types, $sizes, $errors)
    {
        if (is_array($names)) {
            foreach ($names as $item => $name)
                self::collectFilesRecursive($key . '[' . $item . ']', $names[$item], $tmp_names[$item], $types[$item], $sizes[$item], $errors[$item]);
        } else
            self::$_files[$key] = new UploadedFile($names, $tmp_names, $types, $sizes, $errors);
    }

    /**
     * Constructor.
     * Use {@link getInstance} to get an instance of an uploaded file.
     * @param string $name the original name of the file being uploaded
     * @param string $tempName the path of the uploaded file on the server.
     * @param string $type the MIME-type of the uploaded file (such as "image/gif").
     * @param integer $size the actual size of the uploaded file in bytes
     * @param integer $error the error code
     */
    public function __construct($name, $tempName, $type, $size, $error)
    {
        $this->_name = $name;
        $this->_tempName = $tempName;
        $this->_type = $type;
        $this->_size = $size;
        $this->_error = $error;
    }

    /**
     * String output.
     * This is PHP magic method that returns string representation of an object.
     * The implementation here returns the uploaded file's name.
     * @return string the string representation of the object
     */
    public function __toString()
    {
        return $this->_name;
    }

    /**
     * Saves the uploaded file.
     * @param string $file the file path used to save the uploaded file
     * @param boolean $deleteTempFile whether to delete the temporary file after saving.
     * If true, you will not be able to save the uploaded file again in the current request.
     * @return boolean true whether the file is saved successfully
     */
    public function saveAs($file, $deleteTempFile = true)
    {
        if ($this->_error == UPLOAD_ERR_OK) {
            error_reporting(E_ALL);
            if (!copy($this->_tempName, $file))
                return false;
            if ($deleteTempFile)
                unlink($this->_tempName);

            return true;
        } else
            return false;
    }

    /**
     * @return string the original name of the file being uploaded
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return string the path of the uploaded file on the server.
     * Note, this is a temporary file which will be automatically deleted by PHP
     * after the current request is processed.
     */
    public function getTempName()
    {
        return $this->_tempName;
    }

    /**
     * @return string the MIME-type of the uploaded file (such as "image/gif").
     * Since this MIME type is not checked on the server side, do not take this value for granted.
     * Instead, use {@link CFileHelper::getMimeType} to determine the exact MIME type.
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return integer the actual size of the uploaded file in bytes
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * Returns an error code describing the status of this file uploading.
     * @return integer the error code
     * @see http://www.php.net/manual/en/features.file-upload.errors.php
     */
    public function getError()
    {
        return $this->_error;
    }

    /**
     * @return boolean whether there is an error with the uploaded file.
     * Check {@link error} for detailed error code information.
     */
    public function getHasError()
    {
        return $this->_error != UPLOAD_ERR_OK;
    }

    /**
     * @return string the file extension name for {@link name}.
     * The extension name does not include the dot character. An empty string
     * is returned if {@link name} does not have an extension name.
     */
    public function getExtensionName()
    {
        if (($pos = strrpos($this->_name, '.')) !== false)
            return (string)substr($this->_name, $pos + 1);
        else
            return '';
    }

}
