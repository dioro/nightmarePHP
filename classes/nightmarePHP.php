<?php
/**
 * Created by PhpStorm.
 * User: dioro
 * Date: 29/10/2017
 * Time: 16:59
 */

namespace Rayac\nightmarePHP;


class nightmarePHP
{
    private $nodeCode;
    private $result;

    public function __construct()
    {

    }

    public function rawInput($rawNightmareJS)
    {
        $this->nodeCode = $rawNightmareJS;
        return $this;
    }

    public function run()
    {
        //creating temp file and storing nightmareJS code in it
        $tempname = tempnam("../", "jej");
        $temp = fopen($tempname, "r+");
        fwrite($temp, $this->nodeCode);

        //execution of code
        exec("xvfb-run node ../example.js", $output);

        //cleanup
        fclose($temp);
        unlink($tempname);

        $this->result = $output;

        return $this;
    }

    public function getResult()
    {
        return $this->result;
    }
}