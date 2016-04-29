<?php
/**
 * Created by: luozf01@mysoft.com.cn
 * Date: 2016/4/26 10:48
 */
?>
<div id="main" style="width: 400px;height:300px;"></div>
<script type="text/javascript">

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        //color:['#c23531','#2f4554', '#61a0a8', '#d48265', '#91c7ae','#749f83',  '#ca8622', '#bda29a','#6e7074', '#546570', '#c4ccd3'], //全局默认的颜色
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            },
            //formatter: '{b}<br />{a0}: {c0}%<br />{a1}: {c1}%'
            formatter: function (params) {
                var len = params.length;
                var str = '';
                for( var i=0; i<len; i++ ){
                    str += "<div style='float:left; margin:6px 4px 0px 0px; background-color:"+params[i].color+";border-radius: 100%;width: 10px;height: 10px; '></div>" +
                    "<div style='float:left'> "+params[i].seriesName+" : "+params[i].value +"%</div><br>"
                }
                return str;
            }
        },

        //图例组件设置
        legend: {
            data:['男','女'],
            show:true,
            itemGap:20,  //图例每项之间的间隔
            top:15, //距离顶部距离，默认是自适应
        },
        grid: {
            x: 100,
        },
        xAxis : [
            {
                type : 'category',
                data : ['产业型客户','私营主','周边居民', '已成交客户', '未成交客户', '潜在客户'],

                //x轴网格设置
                splitLine:{
                    show:true,  //显示网格
                    lineStyle: {
                        color: '#ccc'  //网格颜色
                    }
                },

                //x轴轴线设置
                axisLine:{
                    show:false,  //如果x轴存在网格就把x轴轴线隐藏，避免重叠
                    lineStyle:{
                        color:'#ccc'
                    }
                },

                //x轴刻度设置
                axisTick:{
                    show:false,  //显示刻度
                },

                //x轴值设置
                axisLabel:{
                    show:true,  //显示值
                    textStyle:{
                        color:'#000'  //字体颜色
                    },
                    interval:0, //坐标轴刻度标签的显示间隔,默认会采用标签不重叠的策略间隔显示标签，可以设置成 0 强制显示所有标签。
                    //rotate:-30,  //旋转

                    //换行显示
                    formatter: function(params){
                        var number = 2;
                        var newParamsName = "";
                        var paramsNameNumber = params.length;
                        var provideNumber = number;
                        var rowNumber = Math.ceil(paramsNameNumber / provideNumber);
                        if (paramsNameNumber > provideNumber) {
                            for (var p = 0; p < rowNumber; p++) {
                                var tempStr = "";
                                var start = p * provideNumber;
                                var end = start + provideNumber;
                                if (p == rowNumber - 1) {
                                    tempStr = params.substring(start, paramsNameNumber);
                                } else {
                                    tempStr = params.substring(start, end) + "\n";
                                }
                                newParamsName += tempStr;
                            }
                        } else {
                            newParamsName = params;
                        }
                        return newParamsName
                    }
                }

            }
        ],
        yAxis : [
            {
                type : 'value',
                min: 0,
                max: 100,

                splitNumber:2,  //y坐标轴的分割段数

                //y轴网格
                splitLine:{
                    show:true,
                    lineStyle: {
                        color: '#ccc'  //网格颜色
                    }
                },

                //y轴轴线设置
                axisLine:{
                    show:false,  //如果y轴存在网格就把x轴轴线隐藏，避免重叠
                    lineStyle:{
                        color:'#ccc'
                    }
                },

                //y轴刻度设置
                axisTick:{
                    show:false,  //显示刻度
                },

                //y轴值设置
                axisLabel: {
                    show:true,  //显示值
                    formatter: '{value}%',
                    textStyle:{
                        color:'#000'  //字体颜色
                    }
                },

            }
        ],
        series : [
            {
                name:'男',
                type:'bar',  //柱图
                stack: '性别',  //同一个stack会将数据显示在一个柱上
                data:[10, 82, 60, 30, 55, 75],
                label: {
                    normal: {
                        show: true,
                        formatter: '{c}%'
                    }
                },

                //局部调整颜色
                itemStyle:{
                    normal:{
                        //color:'#ccc'
                    }
                },
                //barMaxWidth:50,  //在自适应的宽度情况下，运行每个柱图的最大宽度
                //barWidth:30,  //柱图宽度

            },
            {
                name:'女',
                type:'bar',
                stack: '性别',
                data:[90, 18, 40, 70, 45, 25],
                label: {
                    normal: {
                        show: true,
                        formatter: '{c}%'
                    }
                }
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
