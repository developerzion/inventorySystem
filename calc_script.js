function insertVal(num){
	$(".display").val($(".display").val() + num);
}
function clearVal(){
	$(".display").val("");
}
function equateval(){
	$(".display").val(eval($(".display").val()));
}
function delVal(){
	value = $(".display").val();
	$(".display").val(value.substring(0, value.length - 1));
}