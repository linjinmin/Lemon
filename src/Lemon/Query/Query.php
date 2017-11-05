<?php

namespace Lemon\Query;

use Lemon\Container\Container;

/**
 *  查询,.
 */
class Query
{
    /**
     * 配置资源.
     *
     * @var array
     */
    private $config;

    public function __construct()
    {
        if (Container::bound('config') && !$this->config) {
            $this->config = Container::make('config');
        } else {
            $this->config = include __DIR__.'/../Config/Config.php';
            Container::bind('config', $this->config);
        }
    }

    /**
     * 查询.
     *
     * @param string $idCard
     *
     * @return string
     */
    public static function query($idCard)
    {
        $query = self::getInstance();

        if (!$query->check($idCard) || strlen($idCard) < 4) {
            throw new \InvalidArgumentException('Bad id card number');
        }

        $province = $query->getProvince($idCard);
        $city = $query->getCity($idCard);

        return $query->returnData($province, $city);
    }

    /**
     * 返回当前实例.
     *
     * @return object
     *
     * @deprecated
     */
    public static function _getInstance()
    {
        return static::getInstance();
    }

    /**
     * 返回当前实例.
     *
     * @return Query
     */
    public static function getInstance()
    {
        if (Container::bound('query')) {
            return Container::make('query');
        }
        $query = new self();
        Container::bind('query', $query);

        return $query;
    }

    /**
     * Alias of getProvince,废除.
     *
     * @param string $idCard
     *
     * @return string
     *
     * @deprecated
     */
    public function _getProvince($idCard)
    {
        return $this->getProvince($idCard);
    }

    /**
     * @param string $idCard
     *
     * @return string
     */
    public function getProvince($idCard)
    {
        $idCard = substr($idCard, 0, 2);

        return isset($this->config['province'][$idCard]) ? $this->config['province'][$idCard] : '';
    }

    /**
     * getCity 别名，废除.
     *
     * @param string $idCard
     *
     * @return string
     *
     * @deprecated
     */
    public function _getCity($idCard)
    {
        return $this->getCity($idCard);
    }

    /**
     * @param string $idCard
     *
     * @return string
     */
    public function getCity($idCard)
    {
        $idCard = substr($idCard, 0, 4);

        return isset($this->config['city'][$idCard]) ? $this->config['city'][$idCard] : '';
    }

    /**
     * 检查合法性，别名废除.
     *
     * @param string $idCard
     *
     * @return bool
     *
     * @deprecated
     */
    public function _check($idCard)
    {
        return $this->check($idCard);
    }

    /**
     * 判断身份证是否合法.
     *
     * @param string $idCard
     *
     * @return bool
     *
     * @internal
     */
    public function check($idCard)
    {
        if (preg_match('/^\d*$/', $idCard)) {
            return true;
        }

        return false;
    }

    /**
     * 返回数据.
     *
     * @param string $province
     * @param string $city
     *
     * @return string
     */
    protected function returnData($province = '', $city = '')
    {
        return json_encode([
            'province' => $province,
            'city' => $city,
        ]);
    }
}
