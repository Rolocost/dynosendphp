<?php

namespace DynosendSDK;

use DynosendSDK\Resource\Base;
use DynosendSDK\Resource\Campaign;
use DynosendSDK\Resource\Audience;
use DynosendSDK\Resource\Contact;
use DynosendSDK\Resource\Event;
use DynosendSDK\Resource\Transactional;
use DynosendSDK\Resource\Blacklist;


class Client {
    private $token;
    public $uri = "https://api.dynosend.com/api/v2";

    public function __construct($token)
    {

        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function campaign() {
        return new Campaign([], $this);
    }

    public function audience() {
        return new Audience([], $this);
    }

    public function contact() {
        return new Contact([], $this);
    }

    public function event() {
        return new Event([], $this);
    }
	
	public function transactional() {
        return new Transactional([], $this);
    }
	
	public function blacklist() {
        return new Blacklist([], $this);
    }
}