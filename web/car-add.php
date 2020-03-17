<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Car Name</label> <span
            id="name-info" class="info"></span><br /> <input type="text"
            name="name" id="name" class="demoInputBox">
    </div>
    <div>
        <label>Car Built</label> <span id="car-built-info"
            class="info"></span><br /> <input type="text"
            name="car_built" id="car_built" class="demoInputBox">
    </div>
	 <div>
        <label>Charge</label> <span id="charge-info"
            class="info"></span><br /> <input type="text"
            name="charge" id="charge" class="demoInputBox">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#car_built").val()) {
        $("#car-built-info").html("(required)");
        $("#car_built").css('background-color','#FFFFDF');
        valid = false;
    } 
	if(!$("#charge").val()) {
        $("#charge-info").html("(required)");
        $("#charge").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid;
}
</script>
</body>
</html>