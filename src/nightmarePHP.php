<?php

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
        fseek($temp, 0);
        dump(fread($temp, 1024));

        //cleanup
        fclose($temp);
        unlink($this->tempname);

        $this->result = $output;

        return $this;
    }


    public function getResult()
    {
        return $this->result;
    }


    public function config($config)
    {
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
        $text = isset($text) ? ", '" . $text . "'": "";
        $this->nodeCode .= "\n.type('".$selector."'".$text.")";
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


    public function click($selector)
    {
        $this->nodeCode .= "\n.click('".$selector."')";
        return $this;
    }


    public function back()
    {
        $this->nodeCode .= "\n.back()";
        return $this;
    }


    public function forward()
    {
        $this->nodeCode .= "\n.forward()";
        return $this;
    }


    public function refresh()
    {
        $this->nodeCode .= "\n.refresh()";
        return $this;
    }


    public function mousedown($selector)
    {
        $this->nodeCode .= "\n.mousedown('".$selector."')";
        return $this;
    }


    public function mouseup($selector)
    {
        $this->nodeCode .= "\n.mouseup('".$selector."')";
        return $this;
    }


    public function mouseover($selector)
    {
        $this->nodeCode .= "\n.mouseover('".$selector."')";
        return $this;
    }


    public function mouseout($selector)
    {
        $this->nodeCode .= "\n.mouseout('".$selector."')";
        return $this;
    }


    public function insert($selector, $text = null)
    {
        $text = isset($text) ? ", '" . $text . "'": "";
        $this->nodeCode .= "\n.insert('".$selector."'".$text.")";
        return $this;
    }


    public function check($selector)
    {
        $this->nodeCode .= "\n.check('".$selector."')";
        return $this;
    }


    public function uncheck($selector)
    {
        $this->nodeCode .= "\n.uncheck('".$selector."')";
        return $this;
    }


    public function select($selector, $option)
    {
        $this->nodeCode .= "\n.select('".$selector.", ".$option."')";
        return $this;
    }


    public function scrollTo($top, $left)
    {
        $this->nodeCode .= "\n.scrollTo('".$top.", ".$left."')";
        return $this;
    }


    public function viewport($width, $height)
    {
        $this->nodeCode .= "\n.viewport('".$width.", ".$height."')";
        return $this;
    }


    public function inject($type, $file)
    {
        $this->nodeCode .= "\n.inject('".$type.", ".$file."')";
        return $this;
    }


    public function header($header, $value)
    {
        $this->nodeCode .= "\n.header('".$header.", ".$value."')";
        return $this;
    }


    public function exists($selector)
    {
        $this->nodeCode .= "\n.exists('".$selector."')";
        return $this;
    }


    public function visible($selector)
    {
        $this->nodeCode .= "\n.visible('".$selector."')";
        return $this;
    }


    public function on($event, $callback)
    {
        $this->nodeCode .= "\n.on('".$event.", ".$callback."')";
        return $this;
    }


    public function once($event, $callback)
    {
        $this->nodeCode .= "\n.once('".$event.", ".$callback."')";
        return $this;
    }


    public function removeListener($event, $callback)
    {
        $this->nodeCode .= "\n.removeListener('".$event.", ".$callback."')";
        return $this;
    }


    public function screenshot($path, $clip = null)
    {
        $clip = isset($clip) ? ", '" . $clip . "'": "";
        $this->nodeCode .= "\n.screenshot('".$path."'".$clip.")";
        return $this;
    }


    public function html($path, $saveType)
    {
        $this->nodeCode .= "\n.html('".$path.", ".$saveType."')";
        return $this;
    }


    public function pdf($path, $options)
    {
        $this->nodeCode .= "\n.pdf('".$path.", ".$options."')";
        return $this;
    }


    public function title()
    {
        $this->nodeCode .= "\n.title()";
        return $this;
    }


    public function url()
    {
        $this->nodeCode .= "\n.url()";
        return $this;
    }


    public function path()
    {
        $this->nodeCode .= "\n.path()";
        return $this;
    }


    public function cookiesGet($name = null)
    {
        $name = isset($name) ? "'" . $name . "'": "";
        $this->nodeCode .= "\n.cookies.get(".$name.")";
        return $this;
    }


    public function cookiesSet($cookie, $value = null)
    {
        $value = isset($value) ? ", '" . $value . "'": "";
        $this->nodeCode .= "\n.cookies.set('".$cookie. "'" .$value.")";
        return $this;
    }


    public function cookiesClear($name = null)
    {
        $name = isset($name) ? "'" . $name . "'" : "";
        $this->nodeCode .= "\n.cookies.clear(".$name.")";
        return $this;
    }


    public function cookiesClearAll()
    {
        $this->nodeCode .= "\n.cookies.clearAll()";
        return $this;
    }

}