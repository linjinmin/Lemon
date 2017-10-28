<?php

namespace lemon\Query;

use lemon\Container\Container;

/**
 *  查询
 */
class Query
{

    private $config;

    public function __construct()
    {
        if (Container::bound('config') && !$this->config) {
            $this->config = Container::make('config');
        } else {
            $this->config = require '../Config/config.php';
            Container::bind('config', $this->config);
        }
    }

    /**
     * 查询
     * @param  string $idCard
     * @return string
     */
    public static function query($idCard)
    {
        $query = Query::_getInstance();

        if ($query->_check($idCard) || strlen($idCard)) {
            return $query->_returnData('', '');
        }

        $province = $query->_getProvince($idCard);
        $city     = $query->_getCity($city);

        return $query->_returnData($province, $city);
    }

    /**
     * 返回当前实例
     * @return object
     */
    public static function _getInstance()
    {
        if (Container::bound('query')) {
            return Container::make('query');
        }

        $query = new Query();
        Container::bind('query', $query);
        return $query;
    }

    /**
     * @param  string $idCard
     * @return string
     */
    public function _getProvince($idCard)
    {
        $idCard = substr($idCard, 0, 2);
        return isset($this->config['province'][$idCard]) ? $this->config['province'][$idCard] : '';
    }

    /**
     * @param  string $idCard
     * @return string
     */
    public function _getCity($idCard)
    {
        $idCard = substr($idCard, 0, 4);
        return isset($this->config['city'][$idCard]) ? $this->config['city'][$idCard] : '';
    }

    /**
     * 判断身份证是否合法
     * @param  string $idCard
     * @return bool
     */
    public function _check($idCard)
    {
        if (preg_match('/^\d*$/', $idCard)) {
            return true;
        }

        return false;
    }

    /**
     * 返回数据
     * @param  string $province
     * @param  string $city
     * @return string
     */
    public function _returnData($province = '', $city = '')
    {
        return json_encode([
            'province' => $provincem,
            'city'     => $city,
        ]);
    }

}
