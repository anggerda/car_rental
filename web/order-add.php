<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div>
       Select Car : 
	   <select name="car" id="car" class="demoInputBox">
			<?php 
            if (! empty($carResult)) {
                foreach ($carResult as $k => $v) {
            ?>
			<option value="<?php echo $carResult[$k]["car_id"]; ?>"><?php echo $carResult[$k]["car_name"]; ?> - <?php echo $carResult[$k]["car_built"]; ?> - <?php echo $carResult[$k]["charge"]; ?></option>
			<?php
				}
			}
			?>
	   </select> <span id="car_id-info" class="info"></span> <br />
	  Number of Car : <select name="number_car" id="number_car" class="demoInputBox">
			<?php 
            for($i=1;$i<11;$i++) {
            ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
			}
			?>
	   </select> <span id="number_car-info" class="info"></span>
		<br />
		Date : 
		<input type="date" name="startdate" id="startdate" class="demoInputBox" value="<?php echo date('Y-m-d');?>"> <span id="startdate-info" class="info"></span> - 
		<input type="date" name="enddate" id="enddate" class="demoInputBox" value="<?php echo date('Y-m-d');?>"> <span id="enddate-info" class="info"></span>
    </div>
	
	<div>
        <input type="button" name="addtocart" id="btnAdd" value="Add to Cart" />
    </div> 
	
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1" id="order_master">
            <thead>
                <tr>
                    <th><strong>Car</strong></th>
                    <th><strong>Days</strong></th>
                    <th><strong>Qty</strong></th>
					<th><strong>Total</strong></th>
					<th><strong>Action</strong></th>

                </tr>
            </thead>
            <tbody>
            </tbody>
			<tfoot>
				<tr class="right">
                    <th colspan="3"><strong>Subtotal</strong></th>
                    <th class="right"><strong id="subtotal"></strong><input type="hidden" name="subtotalcar" id="subtotalcar"/></th>
                </tr>
				<tr class="left">
                    <th colspan="3"><strong>Discount - rent for 3 days discount 5%</strong></th>
                    <th class="right"><strong id="disc1"></strong><input type="hidden" name="discount1" id="discount1"/></th>
                </tr>
				<tr class="left">
                    <th colspan="3"><strong>Discount - rent 2 car or more discount 10%</strong></th>
                    <th class="right"><strong id="disc2"></strong><input type="hidden" name="discount2" id="discount2"/></th>
                </tr>
				<tr class="left">
                    <th colspan="3"><strong>Discount - rent car built below 2010 discount 7%</strong></th>
                    <th class="right"><strong id="disc3"></strong><input type="hidden" name="discount3" id="discount3"/></th>
                </tr>
                <tr class="right">
                    <th colspan="3"><strong>Total</strong></th>
                    <th class="right"><strong id="total_all"></strong><input type="hidden" name="totalcar" id="totalcar"/></th>
                </tr>
            </tfoot>
        </table>
        
    </div>
	
	<div>
        <input type="submit" name="add" id="btnSubmit" value="Save" />
    </div> 
   
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
var idx = 0;
$(document).ready(function() {
    $("#btnAdd").on("click",function() {
        var car = $('#car').val();
		var num = $('#number_car').val();
		var startdate = $('#startdate').val();
		var enddate = $('#enddate').val();
		
		if(car=='' || num=='' || startdate=='' || enddate=='') {
			alert('Please filled all field');
		}
		else{
			var date1 = new Date(startdate); 
			var date2 = new Date(enddate); 
			var Difference_In_Time = date2.getTime() - date1.getTime(); 
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 
			 
			Difference_In_Days = Difference_In_Days+1;
			
			var arr = $('#car option:selected').text().split(" - ");
			var amount = parseFloat(arr[2]);
			var year = parseFloat(arr[1]);
			
			var flag_double = false;
			//CHECK IF DOUBLE INPUT CAR
			var i =0;
			$.each($('input[name^="car_id"]:hidden'), function(i, item) {
				if(item.value == car) {
					flag_double = true;
					var total = parseFloat(num)*amount*Difference_In_Days;
					var idt = $(this).closest('tr').attr("data-id");
					$('tr[data-id="' + idt+'"]').replaceWith("<tr data-id='"+idt+"'><td><input type='hidden' name='car_id[]' value='"+car+"' /><input type='hidden' name='car_year[]' value='"+year+"' />"+$('#car option:selected').text()+"</td>" +
					"<td><input type='hidden' name='car_totalday[]' value='"+Difference_In_Days+"' /><input type='hidden' name='car_startdate[]' value='"+startdate+"' /><input type='hidden' name='car_enddate[]' value='"+enddate+"' />"+Difference_In_Days+"</td>" +
					"<td><input type='hidden' name='car_totalnum[]' value='"+num+"' />"+num+"</td>" +
					"<td class='right'><input type='hidden' name='car_totalall[]' value='"+total+"' />"+total+"</td>" +
					"<td><span class='btnDeleteAction' onclick='deleteRow("+idt+")' ><img src='web/image/icon-delete.png' /></span></td></tr>");
				}
				i++;
			});
			
			if(!flag_double){
				var total = parseFloat(num)*amount*Difference_In_Days;
				idx++;
				$("#order_master tbody").append(
				  "<tr data-id='"+idx+"'>" +
					"<td><input type='hidden' name='car_id[]' value='"+car+"' /><input type='hidden' name='car_year[]' value='"+year+"' />"+$('#car option:selected').text()+"</td>" +
					"<td><input type='hidden' name='car_totalday[]' value='"+Difference_In_Days+"' /><input type='hidden' name='car_startdate[]' value='"+startdate+"' /><input type='hidden' name='car_enddate[]' value='"+enddate+"' />"+Difference_In_Days+"</td>" +
					"<td><input type='hidden' name='car_totalnum[]' value='"+num+"' />"+num+"</td>" +
					"<td class='right'><input type='hidden' name='car_totalall[]' value='"+total+"' />"+total+"</td>" +
					"<td><span class='btnDeleteAction' onclick='deleteRow("+idx+")' ><img src='web/image/icon-delete.png' /></span></td>" +
				  "</tr>"
				);
			}
			calculate();
		}
    });
	
	
});

function calculate(){
	var i = 0;
	
	var totalall = 0;
	var totalnum = 0;
	var totalday = 0;
	
	var disc1_flag = false;
	var disc2_flag = false;
	var disc3_flag = false;
	
	$('#disc1').html('0');$('#discount1').val('');
	$('#disc2').html('0');$('#discount2').val('');
	$('#disc3').html('0');$('#discount3').val('');
	$('#subtotal').html('0');$('#subtotalcar').val('');
	$('#total_all').html('0');$('#totalcar').val('');
	
	var disc1 = 0;
	var disc2 = 0;
	var disc3 = 0;
	
	$.each($('input[name^="car_id"]:hidden'), function(i, item) {
		var car_year = $('input[name^="car_year"]:hidden')[i];
		if(parseFloat(car_year.value)<2010) disc3_flag=true; //FLAG DISCOUNT RULE NO.3				
		var car_totalall = $('input[name^="car_totalall"]:hidden')[i];
		totalall = totalall+parseFloat(car_totalall.value);
		var car_totalnum = $('input[name^="car_totalnum"]:hidden')[i];
		totalnum = totalnum+parseFloat(car_totalnum.value);
		var car_totalday = $('input[name^="car_totalday"]:hidden')[i];		
		if(parseFloat(car_totalday.value)==3) disc1_flag=true; //FLAG DISCOUNT RULE NO.1		
		totalday = totalday+parseFloat(car_totalday.value);
		i++;
	});
	
	if(totalnum>=2) disc2_flag=true; //FLAG DISCOUNT RULE NO.2
	$('#subtotal').html(totalall);
	$('#subtotalcar').val(totalall);
	
	if(disc1_flag) { $('#disc1').html('-'+totalall*5/100); totalall = totalall*95/100; $('#discount1').val(totalall*95/100); } //DISCOUNT RULE NO.1 5%
	if(disc2_flag) { $('#disc2').html('-'+totalall*10/100); totalall = totalall*90/100; $('#discount2').val(totalall*90/100); } //DISCOUNT RULE NO.2 10%
	if(disc3_flag) { $('#disc3').html('-'+totalall*7/100); totalall = totalall*93/100; $('#discount3').val(totalall*93/100); } //DISCOUNT RULE NO.3 7%
	
	$('#total_all').html(totalall);	
	$('#totalcar').val(totalall);
}

function deleteRow(id){
	$('tr[data-id="'+id+'"]').remove();
	calculate();
}

function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
	var car_id = $('input[name^="car_id"]:hidden');
	//alert(car_id.length);
    if(car_id.length<=0) {
		alert('Please choose car for rent');
        valid = false;
    } 
    return valid;
}
</script>
</body>
</html>