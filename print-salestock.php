<?php 
include "secure.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
include "include/header.php";
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

@media all {
   
    body {
        background: white !important;

    }

     @page { size: auto;  margin: 1px 40px 5px 12px; }
    
    table td,table th {
        border-top: #000 solid 1px  !important;
        border-bottom: #000 solid 1px !important;
        border-left: #000 solid 1px  !important;
        border-right: #000 solid 1px !important;

        font-family: 'Roboto', sans-serif;
        font-size: 12px !important;
        height: 15px !important;
        line-height: 15px !important;
        padding: 1px 0 0 3px !important;
        }
    
    
        td.noline {
            border-top:none !important;
            border-bottom:none !important;
            border-left:none !important;
            border-right:none !important;
            
        }

        td.hrow {
            font-family: 'Roboto', sans-serif;
        font-size: 14px !important;
        height: 25px !important;
        line-height: 25px !important;
        padding: 5px 0 0 5px !important;
        background-color: rgba(0,0,0,0.5) !important;
      -webkit-print-color-adjust: exact;
      color: white;
            
        }


       th.trow {
       
    background-color: #E8D5DD !important;
    color: #333;
    -webkit-print-color-adjust: exact; 


        }

        
} 



    </style>
  
</head>

<body onload="javascript:window.print();">
          
            <div class="row">
              <div class="col-12">
            

<table  style="width:100%;border-collapse: collapse;">
                        

<tbody>

    <?php 

    echo $_POST['data'];
     ?>

</tbody>
</table>
</div>
</div>
</div>
</body>
</html>

<script>
  
  (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
    
  setTimeout(function(){ 
    window.close();
     }, 1000);
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());

   


</script>
