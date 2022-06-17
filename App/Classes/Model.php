<?php

class Model
{
    private string $dataDirectory = __DIR__ . '/../catalog';
    private string $dataDelimiter = '=';

    /** @var array $data */
    protected array $data = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    function __construct()
    {
        $data = $this->_loadData($this->dataDirectory);
        $this->data = array_merge([], ...$data);
    }

    public function SearchData($value): array
    {
        $value = $this->_cleanString($value);

        $results = [];
        foreach($this->data as $data){
            if ( in_array($value, $data) ){
                $results[] = $data;
            }
        }

        return $results;
    }

    public function SearchDataByKey($key, $value): array
    {
        $value = $this->_cleanString($value);
        $key = $this->_cleanString($key);

        $results = [];
        foreach($this->data as $data){
            if ( $data[strtolower($key)] === $value ){
                $results[] = $data;
            }
        }

        return $results;
    }

    private function _loadData($directory): array
    {
        $directoryContents = $this->_getDirectoryContents($directory);
        $data = [];
        foreach($directoryContents as $dc){
            $fullDc = $directory.'/'.$dc;
            if ( is_dir($fullDc) ){
                $data[] = $this->_loadData($fullDc);
                continue;
            }

            $f = fopen($fullDc,'r');
            $fileData = [
                'identifier' => $dc
            ];
            if ( $f ){
                while( $row = fgets($f) ){
                    $parts = explode($this->dataDelimiter, $row);
                    $key = $this->_cleanString($parts[0]);
                    $value = implode($this->dataDelimiter, array_slice($parts,1,count($parts)-1));
                    $fileData[$key] = $this->_cleanString($value);
                }
            }
            $data[] = $fileData;
        }

        return $data;
    }

    private function _getDirectoryContents($directory): array
    {
        return array_diff(scandir($directory), ['.', '..']);
    }

    private function _cleanString($string): string
    {
        $string = trim($string);
        $string = preg_replace('/([\n\r])/', '', $string);
        return strtolower($string);
    }

}