// JavaScript Document
function validateForm() {
  var score = document.getElementById("grade").value;
  if(isNaN(score)){
    alert("Invalid Grade");
    return false;
  } else {
	if (confirm("Are you sure you want to submit this grade?")){
  	  return true;
	}
	return false;
  }
}
