<?php

namespace App;

class Uploader
{

    protected $fieldName;

    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    protected function isUploaded()
    {
        if (isset($_FILES[$this->fieldName])) {
            if (0 === $_FILES[$this->fieldName]['error']) {
                return true;
            }
        }
        return false;
    }

    public function upload()
    {
        if (true == $this->isUploaded()) {
            if (true == move_uploaded_file($_FILES[$this->fieldName]['tmp_name'], __DIR__ . '/../images/' . $_FILES[$this->fieldName]['name'])) {
                return $this;
            }
        }
        return false;
    }

    public function getPath()
    {
        return '/NaturalStone/images/' . $_FILES[$this->fieldName]['name'];
    }
}