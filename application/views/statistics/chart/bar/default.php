
<?php

    $label = '"'.implode('","', $label).'"';
    // pre($label);
?>

<canvas id="<?php echo $canvas_id; ?>" width="400" height="200"></canvas>
<script>
var ctx = document.getElementById("<?php echo $canvas_id; ?>");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // labels: ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu"],
        labels: [<?php echo $label; ?>],
        datasets: [
            <?php
                foreach($datasets as $dataset):
                    $data = implode($dataset['data'], ', ');
            ?>
            {
                label: '<?php echo $dataset['label']; ?>',
                data: [<?php echo $data; ?>],
                backgroundColor: '<?php echo $dataset['color']; ?>'
            },
            <?php
                endforeach;
            ?>
        ]
    },

    options: {
        //judul
        title: {
            display: true,
            text: '<?php echo $title; ?>'
        },


        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{

                ticks: {
                    stepSize: 1,
                    min: 0,
                    autoSkip: false
                }
            }]
        },

        layout: {
            padding: {
                left: 50,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }

});
</script>
