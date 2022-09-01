<?php

namespace DynosendSDK\Resource;

use DynosendSDK\Resource\Base;

class Transactional extends Base {
    public function getSubject()
    {
        return '';
    }

    public function sendmessage($params) {
        return $this->makeRequest('transactional', 'POST', $params);
    }
}