<?php

abstract class TransferObject {

    public abstract function setAll($dataArray);
    public abstract function __get($name);
    public abstract function __set($name, $value);
    public abstract function __toString();

    protected function setArray(&$oldData, $newData)
    {
        foreach ($newData as $key => $value) {
            if (array_key_exists($key, $oldData)) {
                $oldData[$key] = $value;
            }
        }
    }

    protected function get(&$data, $name)
    {
        if (array_key_exists($name, $data)) {
            return $data[$name];
        }
        return null;
    }

    protected function set(&$data, $name, $value)
    {
        if (array_key_exists($name, $data)) {
            $data[$name] = $value;
        }
    }

    protected function toString(&$data)
    {
        $prettyPrint = '';
        foreach ($data as $key => $value) {
            if (is_array($value)){
                $prettyPrint .= "<pre>". print_r($value) . "</pre>";
            }
            else {
                $prettyPrint .= "$key = $value<br />";
            }
        }
        return $prettyPrint;
    }

}