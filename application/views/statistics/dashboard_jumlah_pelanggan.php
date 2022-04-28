<div id="bar_div">

</div>
<script type="text/javascript">
$(function(){
    var area_chart = c3.generate({
        bindto: '#bar_div',
        size: { height: 250 },
        // point: {
        //     r: 1
        // },
        // color: {
        //     pattern: ['#E53935', '#3949AB']
        // },
        data: {

            // columns: [['jumlah Pelanggan', '30', '200', '100', '400', '150', '250']],
            columns: [<?php echo $statistic['data']; ?>],
            types: 'bar'
        },

		axis : {
            x : {
                // max: 0,
                type: 'category',
                // categories : ['jan','Feb','Mar','21:35','21:40','21:45','21:50','21:55','22:00','22:05','22:10','22:15']
                categories : <?php echo $statistic['bulan']; ?>
            },
            y : {
                label :{
                    text : 'Jumlah Pelanggan',
                    position: 'outer-middle'
                }
            }
        },

        grid: {
            y: {
                show: false
            }
        },
        // tooltip: {
        //     format: {
        //         value: function (value, ratio, id) {
        //             return value+' Mbps';
        //         }
        //     }
        // },
        // area: {
        //   zerobased: true
        // }
    });


});
</script>
