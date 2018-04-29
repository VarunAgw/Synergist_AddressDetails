<?php

namespace VarunAgw\Framework;

use Dflydev\DotAccessData\Data;

class Config {

    protected $_config;

    public function __construct() {
        $config = require('./app/config.php');
        $this->_config = new Data($config);
    }

    /**
     * Read a config value
     * Use a.b.c to read multiple levels
     * @param string $key
     * @return array|string
     */
    public function read($key) {
        return $this->_config->get($key);
    }

    /**
     * Read a config value
     * Throw an error if fails to find it
     * Use a.b.c to read multiple levels
     * @param string $key
     * @return array|string
     */
    public function readOrFail($key) {
        $config = $this->read($key);

        if (!empty($config)) {
            return $config;
        } else {
            throw new \Exception("Config missing or empty $key");
        }
    }

}
