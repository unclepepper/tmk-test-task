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
    public function parse(string $nameFile): array
    {
        $path = $this->kernel->getProjectDir().$nameFile;

        if(!file_exists($path))
        {
            throw new Exception('Cannot open file');
        }

        if(($handle = fopen($path, 'r')) !== false)
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
