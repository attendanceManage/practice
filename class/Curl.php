<?php

class Curl
{
    private $url;
    private $option;
    private $handler;
    private $response;

    public function __construct($url, $option = null)
    {
        $this->url = $url;
        $this->option = is_null($option) ? CURLOPT_URL : $option;
    }

    public function init()
    {
        $this->handler = curl_init();
    }

    public function setOption($option=null,$value=null)
    {
        return curl_setopt($this->handler,is_null($option)?$this->option:$option,is_null($value)?$this->url:$value);

    }

    public function execute()
    {
        return curl_exec($this->handler);
    }

    public function decode()
    {
         $this->response = json_decode($this->execute(),true);
         return $this;
    }

    public function fetch()
    {
        return $this->response;

    }
    public function close()
    {
       curl_close($this->handler);
       return $this;
    }
}