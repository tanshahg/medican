 <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="itbaba.com">ITBABA</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
   <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.colVis.min.js"></script>
<script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
<script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
  
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js?v=1"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
</html>

<div class="modal fade" id="mymodal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><a href="#" class="close" data-dismiss="modal">&times</a></div>
<div class="modal-body">

</div>
</div>
</div>
</div>

<div class="modal fade" id="calc">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<a href="#" class="close" data-dismiss="modal">&times</a>
<style>
#box {
background:white !important;
font-size:24px;
height:50px;
}
.btnn {
margin-top:10px;
margin-left:10px;
width:80px;
border-radius:18px;
box-shadow:inset 0px -2px 3px 3px rgba(80,50,40,0.2),
				 0px 2px 2px rgba(0,0,0,0.8),
				 inset 0px -1px 1px rgba(255,255,255,0.5);
				 
				
}
#clr ,#enter {
margin-top:20px;
margin-left:10px;
width:47%;

box-shadow:inset 0px -2px 3px 3px rgba(80,50,40,0.2),
				 0px 2px 2px rgba(0,0,0,0.8),
				 inset 0px -1px 1px rgba(255,255,255,0.5);
}
.calculator {
border-radius:50px;
background:white;
padding:50px;
box-shadow:inset 0px -2px 3px 3px rgba(80,50,40,0.2),
				 0px 2px 2px rgba(0,0,0,0.8),
				 inset 0px -1px 1px rgba(255,255,255,0.5),
				 inset 0px -1px 1px rgba(30,144,255,0.5);


}
button:focus
{
outline:none !important;
}

</style>



<script>
$(document).ready(function() {


    
    $('#calc').on('shown.bs.modal', function() {
  $('#box').focus();
})

$(".btnn").click(function() {
var txt=$(this).text();
$("#box").val($("#box").val()+txt);
});

$("#enter").click(function() {
$("#box").val(eval($("#box").val()));
$('#box').focus();
});

$("#clr").click(function() {
$("#box").val("");
$('#box').focus();
});

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        $("#box").val(eval($("#box").val()));
    }
});
});
</script>

<div class="col-md-12 mx-auto well calculator" style="margin-top:50px">
<input type=text id="box" class="form-control" placeholder="0. " ><br>

<div class="row justify-content-center">

<button class="btn btn-default btn-lg btnn">7</button>
<button class="btn btn-default btn-lg btnn">8</button>
<button class="btn btn-default btn-lg btnn">9</button>
<button class="btn btn-danger btn-lg btnn">+</button>
</div>

<div class="row justify-content-center">
<button class="btn btn-default btn-lg btnn">4</button>
<button class="btn btn-default btn-lg btnn">5</button>
<button class="btn btn-default btn-lg btnn">6</button>
<button class="btn btn-danger btn-lg btnn">-</button>
</div>
<div class="row justify-content-center">
<button class="btn btn-default btn-lg btnn">3</button>
<button class="btn btn-default btn-lg btnn">2</button>
<button class="btn btn-default btn-lg btnn">1</button>
<button class="btn btn-danger btn-lg btnn">*</button>
</div>
<div class="row justify-content-center">
<button class="btn btn-default btn-lg btnn">.</button>
<button class="btn btn-default btn-lg btnn">0</button>
<button class="btn btn-default btn-lg btnn">%</button>
<button class="btn btn-danger btn-lg btnn">/</button>
</div>
<div class="row justify-content-center">
<button class="btn btn-info btn-lg " id="clr">CE</button>
<button class="btn btn-warning btn-lg " id="enter">=</button>
</div>

</div>

</div>
</div>
</div>
</div>

<script>
$(document).ready(function() {

$("#king").on('submit', function(e){
	e.preventDefault();
	 });

$("#mymodal").on("show.bs.modal",function(event) {
	
	var shownVal = document.getElementById("answer").value;
var p = document.querySelector("#answers option[value='"+shownVal+"']").dataset.value;
$(".modal-header").html(shownVal+'<a href="#" class="close" data-dismiss="modal">&times</a>');
$.post("ajaxcall/showsearch.php", {code: p}, function(result){
		if(result==1) {$(".modal-body").html("invalid item Code"); return}
		else
		{
        $(".modal-body").html(result);
		$("#answer").val("");
		
		}
   


});
});

$("#mymodal").on("hide.bs.modal",function(event) {
$(".modal-body").html("");
});

  
	
});


</script>