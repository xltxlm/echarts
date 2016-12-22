<?php

namespace xltxlm\echarts\tests;

use xltxlm\echarts\Echarts;
use xltxlm\echarts\EchartsList;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: xialintai
 * Date: 2016/12/22
 * Time: 19:22.
 */
class EchartsListTest extends TestCase
{
    protected $datas = [
        [
            'name' => '夏琳泰',
            'date' => '2016-10-2',
            'num' => '14',
        ],
        [
            'name' => '夏琳泰',
            'date' => '2016-10-1',
            'num' => '10',
        ],
        [
            'name' => '夏琳泰',
            'date' => '2016-10-4',
            'num' => '52',
        ],
        [
            'name' => '夏琳泰',
            'date' => '2016-10-5',
            'num' => '63',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-1',
            'num' => '23',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-2',
            'num' => '27',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-3',
            'num' => '69',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-4',
            'num' => '35',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-5',
            'num' => '45',
        ],
        [
            'name' => '测试',
            'date' => '2016-10-8',
            'num' => '90',
        ],
    ];

    public function test1()
    {
        $echartsList = new EchartsList();
        foreach ($this->datas as $data) {
            $echartsList
                ->setEcharts((new Echarts($data)));
        }
        $echartsList->__invoke();
        $this->assertGreaterThan(1, count($echartsList->getNames()));
        $this->assertGreaterThan(1, strlen($echartsList->getNamesDataJson('夏琳泰')));
        $this->assertGreaterThan(1, count($echartsList->getDates()));
        $this->assertEquals(count($echartsList->getDates()), count(json_decode($echartsList->getNamesDataJson('夏琳泰'), true)));
        $this->assertEquals(count($echartsList->getDates()), count(json_decode($echartsList->getNamesDataJson('测试'), true)));
    }

    public function test2()
    {
        $echartsList = new EchartsList($this->datas);
        $echartsList->__invoke();
        $this->assertGreaterThan(1, count($echartsList->getNames()));
        $this->assertGreaterThan(1, strlen($echartsList->getNamesDataJson('夏琳泰')));
        $this->assertGreaterThan(1, count($echartsList->getDates()));
        $this->assertEquals(count($echartsList->getDates()), count(json_decode($echartsList->getNamesDataJson('夏琳泰'), true)));
        $this->assertEquals(count($echartsList->getDates()), count(json_decode($echartsList->getNamesDataJson('测试'), true)));
    }

}
