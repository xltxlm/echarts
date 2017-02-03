<?php

namespace xltxlm\echarts;

use xltxlm\template\Template;

/**
 * 配合Echarts图标,格式化数据
 * Class EchartsList.
 */
final class EchartsList extends Template
{
    /** @var array 所有的统计名 */
    protected $names = [];
    /** @var string 所有的统计名 */
    protected $namesJson = '';
    /** @var array 日期列表 */
    protected $dates = [];
    /** @var string 日期列表 */
    protected $datesJson = '';
    /** @var array 统计名下的数据 */
    protected $namesData = [];
    /** @var Echarts[] Echarts */
    protected $echarts = [];

    /**
     * 根据获取的数据直接初始化, 数据格式必须存在3个索引 ['name'=> , 'num'=>'' ,'date'=>'']
     * EchartsList constructor.
     *
     * @param array $datas
     */
    public function __construct(array $datas = [])
    {
        foreach ($datas as $data) {
            //如果是对象,默认传递进来的是符合  username,num,date 的实例
            if (is_object($data)) {
                $this->setEcharts($data);
            } else {
                $this->setEcharts((new Echarts($data)));
            }
        }
    }

    /**
     * @return string
     */
    public function getNamesJson(): string
    {
        return $this->namesJson;
    }

    /**
     * @return string
     */
    public function getDatesJson(): string
    {
        return $this->datesJson;
    }

    /**
     * @return array
     */
    public function getNames(): array
    {
        return $this->names;
    }

    /**
     * @param array $names
     *
     * @return EchartsList
     */
    public function setNames(array $names): EchartsList
    {
        $this->names = $names;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getNamesDataJson(string $name): string
    {
        return json_encode($this->namesData[$name], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param array $namesData
     *
     * @return EchartsList
     */
    public function setNamesData(array $namesData): EchartsList
    {
        $this->namesData = $namesData;

        return $this;
    }

    /**
     * @return array
     */
    public function getDates(): array
    {
        return $this->dates;
    }

    /**
     * @param array $dates
     *
     * @return EchartsList
     */
    public function setDates(array $dates): EchartsList
    {
        $this->dates = $dates;

        return $this;
    }

    /**
     * @param Echarts|mixed $echarts
     *
     * @return EchartsList
     */
    public function setEcharts($echarts): EchartsList
    {
        $this->echarts[] = $echarts;

        return $this;
    }

    /**
     * 重新格式化数据格式.
     *
     * @return $this
     */
    public function make()
    {
        usort($this->echarts, [$this, 'usort']);

        $namesDates = [];
        //计算出横轴的日期
        foreach ($this->echarts as $echart) {
            $this->dates[$echart->getDate()] = $echart->getDate();
            $this->names[$echart->getName()] = $echart->getName();
            $namesDates[$echart->getName()][$echart->getDate()] = $echart;
        }
        $this->namesJson = json_encode(array_values($this->names), JSON_UNESCAPED_UNICODE);
        $this->datesJson = json_encode(array_values($this->dates), JSON_UNESCAPED_UNICODE);

        //日期排序
        sort($this->dates);
        //缺日期的补全数据 0
        foreach ($this->names as $name) {
            foreach ($this->dates as $date) {
                /** @var Echarts $var */
                $var = $namesDates[$name][$date];
                $num = $var ? $var->getNum() : 0;
                $this->namesData[$name][$date] = $num;
            }
        }
        unset($this->echarts);

        return $this;
    }

    /**
     * @param Echarts $a
     * @param Echarts $b
     *
     * @return int
     */
    private function usort($a, $b)
    {
        return $a->getDate() <=> $b->getDate();
    }
}
