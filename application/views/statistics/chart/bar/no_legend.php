
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
                backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
            },
            <?php
                endforeach;
            ?>
        ]
    },

    options: {
        // judul
        title: {
            display: true,
            text: '<?php echo $title; ?>'
        },

        // NO legend
        legend: {
            display: false,
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
