function validateForm() {
	var s=document.forms["newsite"]["nome"].value;
        var result=true;
        
	if (s==null || s==""){
		alert("Inserisci il nome");
		result= false;
	}else if (hasCapitalLetter(s)){
		alert("Non inserire lettere maiuscole");
		result= false;
	} else if (hasWhiteSpace(s)){
		alert("Non inserire spazi");
		result= false;
	} else if (!isAWord(s)){
		alert("Solo caratteri standard");
		result= false;
	}
        return result;
}

function isAWord(s) {
	var pattern = /^[\w-_]+$/;
	return pattern.test(s);
}

function hasCapitalLetter(s){
	var pattern = /[A-Z]/;
	return pattern.test(s);
}

function hasWhiteSpace(s) {
	var pattern = " ";
	return s.indexOf(pattern) >= 0;
}
