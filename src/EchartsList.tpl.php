<!-- page script -->
<script>
    $(function () {
        option = {
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data: <?=$echartsList->getNamesJson()?>
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : <?=$echartsList->getDatesJson()?>
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                <?php foreach ($echartsList->getNames() as $k=>$item){?>
                {
                    name:'<?=$item?>',
                    type:'line',
                    stack: '总量',
                    areaStyle: {normal: {}},
                    data:[120, 132, 101, 134, 90, 230, 210]
                }<?=count($echartsList->getNames())>$k+1?',':''?>
                <?}?>
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        var myChart = echarts.init(document.getElementById('areaChart'));
        myChart.setOption(option);
    });
</script>