<script>
  
  
  $(function () {
    chart1();
	chart2();
    
    // select all on checkbox click
    $("[data-checkboxes]").each(function () {
        var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');

        me.change(function () {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                total = all.length,
                checked_length = checked.length;

            if (role == 'dad') {
                if (me.is(':checked')) {
                    all.prop('checked', true);
                } else {
                    all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                    dad.prop('checked', true);
                } else {
                    dad.prop('checked', false);
                }
            }
        });
    });



});



function chart1() {
    var options = {
        chart: {
            
            type: 'area',
          stacked: false,
          height: 298,
         
            shadow: {
                enabled: true,
                color: "#000",
                top: 18,
                left: 7,
                blur: 10,
                opacity: 1
            },
            toolbar: {
                show: false
            }
        },
        colors: ["#786BED", "#999b9c"],
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: "smooth"
        },
		
		
		<?php 
		include "db.php";
		$q="SELECT sum(gamount),date from sale
WHERE date >= DATE_ADD(CURDATE(), INTERVAL -30 DAY)
group by date limit 12";
$s=$dbpdo->prepare($q);
$s->execute();
$previous="[";
$current="[";
$i=1;
$min=0;
$max=0;
while($row = $s->fetch(PDO::FETCH_BOTH))
{
	if($row[0]>$max) $max=$row[0];
	if($row[0]<$min) $min=$row[0];
if($i<=6) $previous.=$row[0].","; else $current.=$row[0].",";
$i++;
}
$previous=rtrim($previous,",")."]";
$current=rtrim($current,",")."]";
?>
        series: [{
            name: "Last Week",
            data: <?php echo $previous ?>
        },
        {
            name: "Current",
            data: <?php echo $current ?>
        }
	
        ],
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                opacity: 0.0
            }
        },
        markers: {
            size: 4
        },
        xaxis: {
            categories: ["Week-1", "Week-2", "Week-3", "Week-4", "Week-5", "Week-6"],

            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            title: {
                text: "Income"
            },
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            },
            min: <?php echo $min ?>,
            max: <?php echo $max ?>
        },
        legend: {
            position: "top",
            horizontalAlign: "right",
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);

    chart.render();
}


function chart2() {
    var options = {
        chart: {
            width: 300,
            height: 304,
            type: 'donut',
            dropShadow: {
            enabled: true,
            color: '#111',
            top: -1,
            left: 3,
            blur: 3,
            opacity: 0.2
          }
        },
		legend: {
        position: 'bottom',
    horizontalAlign: 'center', 
    floating: false,
    fontSize: '12px',
                },
		
		<?php 
		include "db.php";
		$q="select sum(t1.totalamount) total ,t2.name
from saledetail t1,products t2
WHERE (t1.productcode = t2.id) 
GROUP by t2.name  
ORDER BY `total`  DESC limit 5";
$s=$dbpdo->prepare($q);
$s->execute();
$labels="[";
$series="[";

while($row = $s->fetch(PDO::FETCH_BOTH))
{
	if(strlen($row[1])<2) $name="Unknown"; else $name=$row[1];
	$series.=$row[0].",";
	$labels.="'".substr($name,0,15)."',";
	}
	$series=rtrim($series,",")."]";
	$labels=rtrim($labels,",")."]";
?>

        labels: <?php echo $labels ?>,
        series: <?php echo $series ?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 250
                },
                
            }
        }]
    }

    var chart = new ApexCharts(
        document.querySelector("#chart2"),
        options
    );

    chart.render();
}
  </script>
    
  
</body>
