// JavaScript Document
function submitForm() {
	var score = document.getElementById("grade");
	var expr = /[^0-9]/g;
	var validation = score.match(expr);
	if(validation.length != 0){
		alert("Invalid Grade");
	} else {
		if (confirm("Are you sure you want to submit this grade?")){
			document.forms["gradeForm"].submit();
		}
	}
}