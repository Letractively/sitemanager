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

   checkjquery(s);
   return result;
}

function validateSubscription(){
    var s=document.forms["datasubcription"]["db"].value;
    var us=document.forms["datasubcription"]["username"].value;
    var pwd=document.forms["datasubcription"]["pwd"].value;
    var hostdb=document.forms["datasubcription"]["hostdb"].value;
    var domain=document.forms["datasubcription"]["domain"].value;
    var domainname=document.forms["datasubcription"]["domainname"].value;
    var source=document.forms["datasubcription"]["source"].value;
    var dataqui=document.forms["datasubcription"]["dataacqui"].value;

    var result=true;
    if (dataqui==null || dataqui=="" || hasWhiteSpace(dataqui)){
        alert("Inserisci la data");
        result= false;
    }else if (s==null || s=="" || hasWhiteSpace(s)){
        alert("Inserisci/correggi il nome del db");
        result= false;
    }else if (us==null || us=="" || hasWhiteSpace(us)){
        alert("Inserisci/correggi un username");
        result= false;
    }else if (pwd==null || pwd=="" || hasWhiteSpace(pwd)){
        alert("Inserisci/correggi la password del db");
        result= false;
    }else if (hostdb==null || hostdb=="" || hasWhiteSpace(hostdb)){
        alert("Inserisci/correggi l\'host del db");
        result= false;
    }else if (domain==null || domain=="" || hasWhiteSpace(domain)){
        alert("Inserisci/correggi il dominio (.it,.com,.org...)");
        result= false;
    }else if (domainname==null || domainname=="" || hasWhiteSpace(domainname)){
        alert("Inserisci/correggi il nome del dominio");
        result= false;
    }else if (source==null || source=="" || hasWhiteSpace(source)){
        alert("La sorgente non puo essere vuota");
        result= false;
    }
    return result;
}

function checkjquery(s) {
    //TODO: jquery per vedere se esiste sito o db
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
