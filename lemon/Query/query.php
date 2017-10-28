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
    public function query($idCard)
    {
    	if ($this->_check($idCard)) {
    		return $this->_returnData('', '');
    	}

    	$province = $this->_getProvince($idCard);
    	$city = $this->_getCity($city);

    	return $this->_returnData($province, $city);
    }


    /**
     * @param  string $idCard
     * @return string
     */
    private function _getProvince($idCard)
    {
    	$idCard = substr($idCard, 0, 2);
    	return isset($this->config['province'][$idCard]) ? $this->config['province'][$idCard] : '';
    }

	/**
     * @param  string $idCard
     * @return string
     */
    private function _getCity($idCard)
    {
    	$idCard = substr($idCard, 0, 4);
    	return isset($this->config['city'][$idCard]) ? $this->config['city'][$idCard] : '';
    }



    /**
     * 判断身份证是否合法
     * @param  string $idCard
     * @return bool
     */
    private function _check($idCard)
    {
    	if (preg_match(/^\d*$/, $idCard)) {
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
    private function _returnData($province='', $city='')
    {
    	return json_encode([
    		'province' => $provincem,
    		'city'	=> $city,
    	]);
    }

}
