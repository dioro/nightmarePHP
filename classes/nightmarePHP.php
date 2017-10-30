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

    private $raw;

    public function __construct()
    {
        $this->raw = false;
    }


    /**
     * Prepares raw nightmareJS code.
     * @param string $rawNightmareJS
     * @return $this
     */
    public function rawInput($rawNightmareJS)
    {
        $this->raw = true;
        $this->nodeCode = trim($rawNightmareJS);
        return $this;
    }


    /**
     * Mainly used for debugging
     * @return string raw nightmareJS code
     */
    public function getCode()
    {
        return $this->nodeCode;
    }
    

    /**
     * Runs the code
     * @return $this
     */
    public function run()
    {
        //creating temp file and storing nightmareJS code in it
        $tempname = tempnam("../", "jej");
        $temp = fopen($tempname, "r+");
        fwrite($temp, $this->nodeCode);

        //execution of code
        exec("xvfb-run node " . $tempname, $output);

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