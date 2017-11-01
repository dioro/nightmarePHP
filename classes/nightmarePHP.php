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
    private $tempname;

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
        if($this->raw == true) {
            $this->nodeCode .= ";";
        }
        return trim($this->nodeCode);
    }


    /**
     * Runs the code
     * @return $this
     */
    public function run()
    {
        if($this->raw == true) {
            $this->nodeCode .= ";";
        }

        //creating temp file and storing nightmareJS code in it
        $this->tempname = tempnam("../", "jej");
        $temp = fopen($this->tempname, "r+");
        fwrite($temp, $this->nodeCode);

        //execution of code
        exec("xvfb-run node " . $this->tempname, $output);

        //Used for debugging
        //Dumps temp file contents that has nightmareJS
//        fseek($temp, 0);
//        dump(fread($temp, 1024));

        //cleanup
        fclose($temp);
        unlink($this->tempname);

        $this->result = $output;

        return $this;
    }

    public function config($config)
    {
        $this->raw = true;

        $this->nodeCode = "
const Nightmare = require(\"nightmare\");
const nightmare = Nightmare({". $config. " });
        
nightmare";
    }

    public function _goto($url)
    {
        $this->nodeCode .= "\n.goto('".$url."')";
        return $this;
    }

    public function type($selector, $text = null)
    {
        $this->nodeCode .= "\n.type('".$selector."', '".$text."')";
        return $this;
    }

    public function wait($for)
    {
        $this->nodeCode .= "\n.wait('".$for."')";
        return $this;
    }

    public function evaluate($evaluate)
    {
        $this->nodeCode .= "\n.evaluate(".$evaluate.")";
        return $this;
    }

    public function end($end = null)
    {
        $this->nodeCode .= "\n.end(".$end.")";
        return $this;
    }

    public function then($then)
    {
        $this->nodeCode .= "\n.then(".$then.")";
        return $this;
    }

    public function _catch($catch)
    {
        $this->nodeCode .= "\n.catch(".$catch.")";
        return $this;
    }



    public function getResult()
    {
        return $this->result;
    }
}