<?php
namespace Pluma\Filesystem;

class FileNotFound extends \Exception {

    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'File not found.';
}