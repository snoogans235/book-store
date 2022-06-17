<?php

class Controller
{
    public function SearchData($field, $value): array
    {
        //spin up model and search and return results
        $Model = new Model();
        return empty($field) ?
            $Model->SearchData($value) :
            $Model->SearchDataByKey($field, $value);

    }

}