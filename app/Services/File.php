<?php

namespace FotoStrana\Services;

class File
{
    private $handle;
    private $strings = [];
    private $count;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->count = 0;
        $this->handle = fopen($path, "r");
        $this->fillStrings();
    }

    /**
     * Возвращает количество строк
     *
     * @return int
     */
    public function count(){
        return $this->count;
    }

    /**
     * Возвращает запрошенную строку
     *
     * @param int $index
     *
     * @return string
     * @throws \LogicException
     */
    public function string($index) {
        if ($index >= $this->count()) {
            throw new \LogicException('Too big index');
        }
        if ($index === 0){
            fseek($this->handle, 0);
        } else {
            fseek($this->handle, $this->strings[$index - 1]);
        }
        return rtrim(fgets($this->handle), "\r\n");
    }

    /**
     * Заполняет массив строк файла
     */
    private function fillStrings()
    {
        while (fgets($this->handle) !== false) {
            $this->strings[] = ftell($this->handle);
            ++$this->count;
        }
    }
}