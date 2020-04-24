// JavaScript Document
function submitForm() {
	"use strict";
	
	var score = document.getElementById("score");
	var expr = /[^0-9]/g;
	var validation = score.match(expr);
	if(validation.length != 0){
		alert("Invalid Score!");
	} else {
		alert("Score would've been submitted if implemented!")
	}
}