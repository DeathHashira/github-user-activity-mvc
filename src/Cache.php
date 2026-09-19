<?php

namespace Src;

use Predis\Client;

class Cache
{
    public Client $redis;

    public function __construct()
    {
        $this->redis = new Client();
    }

    public function get(string $key)
    {
        return $this->redis->get($key) ?? null;
    }

    public function set(array $keyValue)
    {
        foreach ($keyValue as $key => $value) {
            $this->redis->set($key, json_encode($value), 'EX', 300);
        }
    }
}