<?php

declare(strict_types=1);

namespace App\Application\Service\Common\Parse;

use Exception;


final class ParseTxtFile extends AbstractParseFile
{

    /**
     * @return string[]
     * @throws Exception
     */
    public function parse(): array
    {
        if(!file_exists($this->path))
        {
            throw new Exception('Cannot open file');
        }

        if(($handle = fopen($this->path, 'r')) !== false)
        {
            if(($header = fgetcsv($handle, 1000, ';')) !== false)
            {

                while(($row = fgetcsv($handle, 1000, ';')) !== false)
                {

                    if(count($header) !== count($row))
                    {
                        continue;
                    }

                    $this->data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        else
        {
            throw new Exception('File not found');
        }

        return $this->data;
    }

}
