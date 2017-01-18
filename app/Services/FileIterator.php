<?php

namespace FotoStrana\Services;

use SeekableIterator;

class BigFileReader implements SeekableIterator
{
    /**
     * @var File
     */
    protected $file;
    protected $position;

    public function __construct($path)
    {
        $this->file = new File($path);
    }

    public function current()
    {
        return $this->file->string($this->position);
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return $this->position < $this->file->count();
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function seek($position)
    {
        if ($position < 0 || $position >= $this->file->count()) {
            throw new \OutOfBoundsException("invalid seek position ($position)");
        }
        $this->position = $position;
    }
}