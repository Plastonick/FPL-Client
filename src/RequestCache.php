<?php

namespace Plastonick\FPLClient;

use Psr\SimpleCache\CacheInterface;
use function array_key_exists;

class RequestCache implements CacheInterface
{
    private $cache = [];

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        } else {
            return $default;
        }
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null): bool
    {
        $this->cache[$key] = $value;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete($key): bool
    {
        unset($this->cache[$key]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        $this->cache = [];

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        $output = [];
        foreach ($keys as $key) {
            $output[$key] = $this->get($key);
        }

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
    }

    /**
     * @inheritDoc
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->cache);
    }
}
