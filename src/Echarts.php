<?php

namespace xltxlm\echarts;

use xltxlm\helper\Hclass\LoadFromArray;

/**
 * 图标展示
 * Class Echarts.
 */
final class Echarts
{
    use LoadFromArray;
    /** @var string 姓名 */
    protected $name = '';
    /** @var string 日期 */
    protected $date = '';
    /** @var string 个数 */
    protected $num = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Echarts
     */
    public function setName(string $name): Echarts
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return Echarts
     */
    public function setDate(string $date): Echarts
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getNum(): string
    {
        return $this->num;
    }

    /**
     * @param string $num
     *
     * @return Echarts
     */
    public function setNum(string $num): Echarts
    {
        $this->num = $num;

        return $this;
    }
}
