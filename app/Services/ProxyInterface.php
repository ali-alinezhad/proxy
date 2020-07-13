<?php


namespace App\Services;


interface ProxyInterface
{
    /**
     * @return array
     */
    public function callAPI() : array;

    /**
     * @return array
     */
    public function makeResult() : array;
}
