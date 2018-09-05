<?php
namespace Pluma\Filesystem;

class FileAlreadyExists extends \Exception {

    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'File already exists.';
}