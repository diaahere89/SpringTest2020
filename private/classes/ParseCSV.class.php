<?php

class ParseCSV
{
    public static $delimiter = ',';

    private $filename;
    private $headerrow;
    private $data = [];
    private $rowcount = 0;

    public function __construct($filename = '')
    {
        if ($filename != '') {
            $this->file($filename);
        }
    }

    public function file($filename)
    {
        if (!file_exists($filename)) {
            echo "File does NOT exist!";
            return false;
        } elseif (!is_readable($filename)) {
            echo "File is NOT readable!";
            return false;
        }
        $this->filename = $filename;
        return true;
    }

    public function parse()
    {
        if (!isset($this->filename)) {
            echo "File is NOT set yet!";
            return false;
        }
        // clear any prev results
        $this->reset();

        $file = fopen($this->filename, 'r');
        while (!feof($file)) {
            $row = fgetcsv($file, 0, self::$delimiter);
            if ($row == [NULL] || $row === false) {
                continue;
            }
            if (!$this->headerrow) {
                $this->headerrow = $row;
            } else {
                $this->data[] = array_combine($this->headerrow, $row);
                $this->rowcount++;
            }
        }
        fclose($file);

        return $this->data;
    }

    public function read_data()
    {
        return $this->data;
    }

    public function row_count()
    {
        return $this->rowcount;
    }

    private function reset()
    {
        $this->headerrow = NULL;
        $this->data = [];
        $this->rowcount = 0;
    }
}
