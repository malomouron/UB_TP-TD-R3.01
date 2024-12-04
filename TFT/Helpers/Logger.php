<?php

namespace Helpers;

class Logger
{

    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function log(string $message): void
    {
        try {
            $date = date('Y-m-d H:i:s');
            $message = $date . ' - ' . $message . PHP_EOL;
            file_put_contents($this->file, $message, FILE_APPEND);
        }
        catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}