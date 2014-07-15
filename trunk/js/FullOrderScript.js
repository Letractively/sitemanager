
/*AJAX*/
function ajaxtext(url, containerid) 
{
    var tmp_text = "";
    var page_request = false;
    if (window.XMLHttpRequest) // Mozilla, Safari etc
        page_request = new XMLHttpRequest();
    else if (window.ActiveXObject) 
    { // IE
        try 
        {
            page_request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) 
        {
            try 
            {
                page_request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) 
            {
                alert("error on ajaxtext");
            }
        }
    }
    else
        return false;
    page_request.onreadystatechange = function () { tmp_text = loadtext(page_request, containerid); };
    page_request.open('GET', url, true);
    page_request.send(null);
}


// esclude spazi e apici
function FiltraSpazioPlus(event) {
    if (event.keyCode == 32) 
    {

        // spazio non ammesso
        event.preventDefault();
    }
    else if ((event.keyCode == 198) || (event.keyCode == 219) || (event.keyCode == 222) )
    {

        // singolo apice non ammesso
        event.preventDefault();
    }
    else
    {
        return;
    } 
}

// permette inserimento di soli numeri
function FiltraNumeri(event) {
    // Allow: backspace, delete, tab, escape, and enter 
    if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
    // Allow: Ctrl+A 
        (event.keyCode == 65 && event.ctrlKey === true) ||
    // Allow: Ctrl+C 
        (event.keyCode == 67 && event.ctrlKey === true) ||
    // Allow: Ctrl+V 
        (event.keyCode == 86 && event.ctrlKey === true) ||
    // Allow: home, end, left, right 
        (event.keyCode >= 35 && event.keyCode <= 39)) 
    {
        // let it happen, don't do anything 
        return;
    }
    else 
    {
        // Ensure that it is a number and stop the keypress 
        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
            event.preventDefault();
        }
    }
}

// aggiornamento dei comuni
function AggiornaComuni(provincia, preimposta) {
    if (!preimposta) {
        $("#0_0_ComuneInt").val("");
    }
    ajaxtext("getComuni.asp?lang=" + Lingua + "&provincia=" + provincia, "divComuni");
}

// aggiornamento dei comuni (fatturazione)
function AggiornaComuniFatturazione(provincia, preimposta) {
    if (!preimposta) {
        $("#0_0_ComuneFat").val("");
    }
    ajaxtext("getComuni.asp?lang=" + Lingua + "&provincia=" + provincia + "&type=fatturazione", "divComune");
}

// aggiornamento dei comuni nascita
function AggiornaComuniNascita(provincia, preimposta) {
    if (!preimposta) {
        $("#0_0_ComuneNasc").val("");
    }
    ajaxtext("getComuni.asp?lang=" + Lingua + "&provincia=" + provincia + "&type=nascita", "divComuniNascita");
}

// aggiornamento dei comuni (caso rappresentante legale)
function AggiornaComuniRichiedente(provincia, preimposta) {
    if (!preimposta) {
        $("#0_0_ComuneInt_Ric").val("");
    }
    ajaxtext("getComuni.asp?lang=" + Lingua + "&provincia=" + provincia + "&type=resric", "divComuniRichiedente");
}

// aggiornamento dei comuni (caso rappresentante legale - nascita)
function AggiornaComuniNascitaRichiedente(provincia, preimposta) {
    if (!preimposta) {
        $("#0_0_ComuneIntNascitaRichiedente").val("");
    }
    ajaxtext("getComuni.asp?lang=" + Lingua + "&provincia=" + provincia + "&type=nascita", "divComuniNascitaRichiedente");
}

// ricerca utente
function SpedisciDati() {
    //window.open("../Domini/SpedisciDati.asp?IDSessione=<%=strIDSessioneCorrente%>&Lang=<%=lang%>", "finestra", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=300,top=50,left=100")
    window.open("../Domini/SpedisciDatiDominio.asp?opensection=registration")
    $("div:ui-dialog:visible").dialog("close");
}

// set focus
function TogliScroll()
{
	window.focus()
}

// controlla che un campo non è vuoto
function Int_ControllaNonVuoto(jvs_NomeCampo) 
{
	var no_vuota = 1;
	var objDato
	objDato = document.getElementsByName(jvs_NomeCampo)
	objDato[0].value = LeftTrim(objDato[0].value)
	objDato[0].value = RightTrim(objDato[0].value)

	if 	(objDato[0].value.length>0)
	{
		no_vuota = 1
	}
	else
	{
		no_vuota = 0
	}
	return no_vuota
}

// validazione del codice fiscale
function ValidaCodFis(jvs_IDAreaVendita) 
{
    var no_errore = 1;
    var radioButtons = $("#" + nomeForm + " input:radio[name='" + nomeRadioCittadinanzaCF + "']");
    if (radioButtons[1].checked)
    {
	    //Non lo devo più calcolare perchè si richiede il num doc identità
        no_errore = Int_ControllaNonVuoto(nomeInputDocIdentita);
	    if (no_errore==0)
	    {
	        document.getElementById(nomeErrDocIdentita).style.display = '';
		    jvs_form_valido = 0
		    jvs_elenco_errori = jvs_elenco_errori + "\n" + "<%=GestioneErrori_testo38%>"
	    }
	    else
	    {
	        document.getElementById(nomeErrDocIdentita).style.display = 'none';
	    }
    }
    else
    {
	    if (jvs_IDAreaVendita==1 || jvs_IDAreaVendita==2 || jvs_IDAreaVendita==3 || jvs_IDAreaVendita==15) 
	    {
		    var objDato
		    objDato = document.getElementsByName(nomeInputCodFis)
		    objDato = objDato[0].value.toUpperCase();
		    if (window.RegExp) 
		    {

			    //var validoCF="^[0-9a-zA-Z]+$)"
			    var validoCF= /^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/;
			    var regvCF = new RegExp(validoCF);
			    var validoPiva=/^\d{11}$/;
			    var regvPiva = new RegExp(validoPiva);
			    if (regvCF.test(objDato) || regvPiva.test(objDato))
			    {
			        //ok
			    }
			    else
			    {

			        //controllo omocodia
				    validoCF= /^[A-Za-z]{6}[0-9LMNPQRSTUV]{2}[A-Za-z]{1}[0-9LMNPQRSTUV]{2}[A-Za-z]{1}[0-9LMNPQRSTUV]{3}[A -Za-z]{1}$/;
				    regvCF = new RegExp(validoCF);
						    
				    var CodiceFiscaleInseritoCliente = objDato
				    var omocodici = "LMNPQRSTUV"
					        						    
				    if (regvCF.test(objDato))
				    {
						    
                        //alert("controllo omocodia regvCF")
					    for (var k=14 ; k>=6; k--)
					    {
					        if (k == 8 || k == 11) 
                            {
                            }
					        else
					        {
					            controllox = omocodici.indexOf(CodiceFiscaleInseritoCliente.charAt(k))
					            if (controllox != -1)
					            {
					                CodiceFiscaleInseritoCliente = CodiceFiscaleInseritoCliente.split("");
                                    CodiceFiscaleInseritoCliente[k] = controllox;
                                    CodiceFiscaleInseritoCliente = CodiceFiscaleInseritoCliente.join("");
					            }
					        }
					    }

					    //tolgo ultima lettera e la ricalcolo
					    CodiceFiscaleInseritoCliente = CodiceFiscaleInseritoCliente.substring(0,15)
    					        
			            //Ultima lettera (F)
					    //Controllo caratteri pari
					    var TempNum = 0
					    var tmp_AppoNum1 = "B1A0KKPPLLC2QQD3RRE4VVOOSSF5TTG6UUH7MMI8NNJ9WWZZYYXX"
					    var tmp_AppoNum2 = "A0B1C2D3E4F5G6H7I8J9KKLLMMNNOOPPQQRRSSTTUUVVWWXXYYZZ"
					    var AppoNum = 0
					    for (var i = 0; i < 15; i++) 
                        {

						    //	 I DISPARI
						    AppoNum = tmp_AppoNum1.indexOf(CodiceFiscaleInseritoCliente.charAt(i))
						    TempNum = TempNum + (AppoNum & 32766) / 2

						    i=i+1
						    if (i == 14) break;
    							    
						    //	 I PARI
						    AppoNum = tmp_AppoNum2.indexOf(CodiceFiscaleInseritoCliente.charAt(i))
						    TempNum = TempNum + (AppoNum & 32766) / 2
					    }
    							
					    TempNum = TempNum % 26;
					    var Consonanti = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
					    CodiceFiscaleInseritoCliente = CodiceFiscaleInseritoCliente + Consonanti.charAt(TempNum)
    					        
					    // codice fiscale inserito ricalcolato come omocodia quello principale
					    //alert("Codice Fiscale 'Principale' = " + CodiceFiscaleInseritoCliente)
					}			    		    
				}
						
				if (regvCF.test(objDato) || regvPiva.test(objDato) || regvCF.test(CodiceFiscaleInseritoCliente))
				{
					var CodiceFiscaleCalcolato = ""
					var cognome
					cognome = objDato.substring(0,3)
									
					var nome
					nome = objDato.substring(3,6)

					//RICAVO IL COGNOME (123)
					var cognomeInserito
					cognomeInserito = document.getElementsByName(nomeInputCognome)
					cognomeInserito = cognomeInserito[0].value.toUpperCase();	

					var Vocali 
					var VocaliCognome = ""
					var Consonanti 
					var ConsonantiCognome = ""
								
					var elencoVocali = "AEIOU"
					var elencoConsonanti = "BCDFGHJKLMNPQRSTVWXYZ"
					for (var i=0; i<cognomeInserito.length; i++) {
								
						Vocali = elencoVocali.indexOf(cognomeInserito.charAt(i));
									
						if (Vocali == (-1))
						{
						}
						else
						{
							VocaliCognome = VocaliCognome + cognomeInserito.charAt(i)
						}
					}

                    for (var i = 0; i < cognomeInserito.length; i++) 
                    {	
						Consonanti = elencoConsonanti.indexOf(cognomeInserito.charAt(i));
									
						if (Consonanti == (-1))
						{
						}
						else
						{
							ConsonantiCognome = ConsonantiCognome + cognomeInserito.charAt(i)
						}
						if (ConsonantiCognome.length == 3) break;
					}
								
					if (ConsonantiCognome.length < 3)
					{
						ConsonantiCognome = ConsonantiCognome + VocaliCognome.substring(0, 3-ConsonantiCognome.length)
					}
								
					if (ConsonantiCognome.length < 3)
					{
						if (ConsonantiCognome.length ==1) 
						{
							ConsonantiCognome = ConsonantiCognome +"XX"
						}
						if (ConsonantiCognome.length ==2) 
						{
							ConsonantiCognome = ConsonantiCognome +"X"
						}
					}

					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + ConsonantiCognome
					//FINE COGNOME
								
					//RICAVO IL NOME
					var nomeInserito
					nomeInserito = document.getElementsByName(nomeInputNome)
					nomeInserito = nomeInserito[0].value.toUpperCase();
									
					//FINE NOME
					var Vocali 
					var VocaliNome = ""
					var Consonanti 
					var ConsonantiNome = ""
					for (var i=0; i<nomeInserito.length; i++) {
						Vocali = elencoVocali.indexOf(nomeInserito.charAt(i));
						if (Vocali == (-1))
						{
						}
						else
						{
							VocaliNome = VocaliNome + nomeInserito.charAt(i)
						}
									
						Consonanti = elencoConsonanti.indexOf(nomeInserito.charAt(i));
						if (Consonanti == (-1))
						{
						}
						else
						{
							ConsonantiNome = ConsonantiNome + nomeInserito.charAt(i)
						}
					}
								
					if (ConsonantiNome.length >= 4)
					{
						//	isolo la prima, terza e quarta consonante
						ConsonantiNome = ConsonantiNome.substring(0,1) + ConsonantiNome.substring(2,4)
					}
								
					if (ConsonantiNome.length < 3)
					{

						//	 Aggiungo le vocali
						ConsonantiVocali = ConsonantiNome + VocaliNome
						ConsonantiNome = ConsonantiVocali.substring(0,3)
									
						//	 se non basta, aggiungo le X
						if (ConsonantiNome.length < 3)
						{
							ConsonantiX = ConsonantiNome + "XXX"
							ConsonantiNome = ConsonantiX.substring(0,3)
						}
					}
								
					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + ConsonantiNome
									
					var annoNascita
					annoNascita = objDato.substring(6,8)
					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + annoNascita
									
					var meseNascita
					meseNascita = objDato.substring(8,9)

					var mesiAnno 
					mesiAnno = "ABCDEHLMPRST"
								
					var trova = mesiAnno.indexOf(meseNascita);	
								
					if (trova == (-1))
					{
						no_errore = 0;	
					}

					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + meseNascita
									
					var giornoNascita
					giornoNascita = objDato.substring(9,11)
									
					var Sesso
					if (giornoNascita>31) 
					{
						var validaGiornoNascita = giornoNascita - 40
						Sesso = "F"
						if (validaGiornoNascita>31) 
						{
							no_errore = 0;
						}
					}
					else
					{
						Sesso = "M"
					}
								
					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + giornoNascita

					var CodiceComune
					CodiceComune = objDato.substring(11,15)
							
					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + CodiceComune
								
					//Ultima lettera (F)
					//Controllo caratteri pari
					var TempNum = 0
					var tmp_AppoNum1 = "B1A0KKPPLLC2QQD3RRE4VVOOSSF5TTG6UUH7MMI8NNJ9WWZZYYXX"
					var tmp_AppoNum2 = "A0B1C2D3E4F5G6H7I8J9KKLLMMNNOOPPQQRRSSTTUUVVWWXXYYZZ"
					var AppoNum = 0
					for (var i = 0; i < 15; i++) 
                    {

						//	 I DISPARI
						AppoNum = tmp_AppoNum1.indexOf(CodiceFiscaleCalcolato.charAt(i))
						TempNum = TempNum + (AppoNum & 32766) / 2

						i=i+1
						if (i == 14) break;
								    
						//	 I PARI
						AppoNum = tmp_AppoNum2.indexOf(CodiceFiscaleCalcolato.charAt(i))
						TempNum = TempNum + (AppoNum & 32766) / 2
					}
								
					TempNum = TempNum % 26;
						
					var Consonanti = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
					CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + Consonanti.charAt(TempNum)

					//alert("Calcolato da sito = " + CodiceFiscaleCalcolato)
					if (objDato != CodiceFiscaleCalcolato)
					{
						//controllo omocodia
						//alert("codfisc inserito dal cliente ( " + objDato + " ) e diverso da quello calcolato " + CodiceFiscaleCalcolato)
						no_errore = 0;
					}
					else
					{
						no_errore = 1;
					}
				}
				else 
				{					
					no_errore = 0;	
				}
			}
			else 
			{
				no_errore = 1;
			}	
		}
		else 
		{
		    no_errore = Int_ControllaNonVuoto(nomeInputCodFis);
		}
	}

    //alert("CodiceFiscaleCalcolato:  " + CodiceFiscaleCalcolato);
	return no_errore;
}

// validazione del codice fiscale
function ValidaCodiceFiscaleAzienda( codiceFiscale) {
    var no_errore = 1;

    var objDato
    objDato = codiceFiscale.toUpperCase();
    if (window.RegExp) {
        var validoPiva = /^\d{11}$/;
        var validoPivaIT = /^IT\d{11}$/;
        var regvPiva = new RegExp(validoPiva);
        var regvPivaIT = new RegExp(validoPivaIT);

        if (regvPiva.test(objDato) || regvPivaIT.test(objDato)) {
            //ok
            no_errore = 1;
        }
        else {
            no_errore = 0;
        }
    }
    else {
        no_errore = 1;
    }
    return no_errore;
}

// validazione della email		
function ValidaEmail() {
		
	var no_errore = 1;
	var objMail
	objMail = document.getElementsByName(nomeInputEMail)
	objMail = objMail[0].value.toLowerCase();
			
	var objConfMail
	objConfMail = document.getElementsByName(nomeInputConfEMail)
	objConfMail = objConfMail[0].value.toLowerCase();
			
	if (window.RegExp) 
	{
				
		/*var nonvalido = "(@.*@)|(\\.\\.)|(@\\.)|(@\\-)|(@\\_)|(\\.@)|(\\-@)|(\\_@)|(^\\.)|(^-)|(^_)";
		var valido = "^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
		var regnv = new RegExp(nonvalido);
		var regv = new RegExp(valido);*/

	    var regv = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		if (regv.test(objMail))
		{
			if(objMail!=objConfMail)
			{
				no_errore = 0;
			}
			else
			{
				no_errore = 1;
			}
		}
		else 
		{
			no_errore = 0;	
		}
	}
	else 
	{
		if(objMail.indexOf("@") >= 0)
		{
			if(objMail!=objConfMail)
			{
				no_errore = 0;
			}
			else
			{
				no_errore = 1;
			}
		}
		else 
		{
			no_errore = 0;
		}
	}

	return no_errore;
}

// validazione della email alternativa
function ValidaEmailAlternativa() {

	var no_errore = 1;
	var objMail
	objMail = document.getElementsByName(nomeInputEMailAlternativa)
	objMail = objMail[0].value.toLowerCase();
	if (window.RegExp) {

		/*var nonvalido = "(@.*@)|(\\.\\.)|(@\\.)|(@\\-)|(@\\_)|(\\.@)|(\\-@)|(\\_@)|(^\\.)|(^-)|(^_)";
		var valido = "^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
		var regnv = new RegExp(nonvalido);
		var regv = new RegExp(valido);*/

	    var regv = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		if (regv.test(objMail)) 
        {
		    no_errore = 1;
		}
		else 
        {
		    no_errore = 0;
		}
	}
	else
    {
		if (objMail.indexOf("@") >= 0) {
		    no_errore = 1;
		}
		else 
        {
		    no_errore = 0;
		}
	}

	return no_errore;
}

// validazione campi tipo telefono
function ValidaTelefono_Fax(prefisso, numero) {
		
	var no_errore = 1;

	if(numero.indexOf(" ") >= 0)
	{
				
	}
	else
	{
		numero = numero.substring(0,3) + " " + numero.substring(3,numero.length)
	}

	var objDato = prefisso +" "+ numero

	if (window.RegExp) 
	{
		var nonvalido = "(\\+\\+)|[a-zA-Z]";
		//var valido = "^+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
		//var valido="^(\\+){0,1}[0-9]+(\\ ){0,1}+[0-9]+(\\ ){0,1}+[0-9]+(\\ ){0,1}"
		var regnv = new RegExp(nonvalido);
		var valido="^(\\+)+[0-9]+[ ]+[0-9]+[ ]+[0-9]+$"
		var regv = new RegExp(valido);
	
		if (!regnv.test(objDato) && regv.test(objDato))
		{
			no_errore = 1;
		}
		else 
		{
			no_errore = 0;	
		}
	}
	else 
	{	
		no_errore = 1;
	}	

	return no_errore;
}

// controlla che un campo contenga caratteri alfa numerici
function CheckStringaAlfaNumerica(strControlla) 
{
    var no_errore = 1;
	if (strControlla.length > 0) 
    {
		var strControlla = strControlla.toUpperCase();
		for (var i = 0; i < strControlla.length; i++) 
        {

		    var CarattereCorrente = strControlla.charAt(i)
		    var CarattereCorrente2 = CarattereCorrente.charCodeAt()
		    if (((CarattereCorrente2 > 47 && CarattereCorrente2 < 58) || ((CarattereCorrente2 > 64) && (CarattereCorrente2 < 91)))) {
		    }
		    else 
            {
		        no_errore = 0;
		    }
		}
	}
    else 
    {
		no_errore = 0;
	}
	return no_errore;
}

// controlla campo di tipo numerico
function CheckBloccoNumerico(strControlla)
{
	var no_errore = 1;	
	if (strControlla.length > 0)
	{
		for (var i=0; i<strControlla.length; i++) 
		{

			var CarattereCorrente = strControlla.charAt(i)
			var CarattereCorrente2 = CarattereCorrente.charCodeAt()
			if(CarattereCorrente2 > 47 && CarattereCorrente2 < 58)
			{
							
			}
			else
			{
				no_errore = 0;
			}
		}	
	}
	else
	{
		no_errore = 0;
	}
	return no_errore;
}

// controllo che un campo contenga solo stringhe
function CheckStringaAlfabetica(jvs_NomeCampo) 
{
	var objDato
	objDato = document.getElementsByName(jvs_NomeCampo)
	var no_errore = 1;
	var strControlla = objDato[0].value.toUpperCase();
	if (strControlla.length > 0)
	{
		for (var i=0; i<strControlla.length; i++) 
		{
    		
			var CarattereCorrente = strControlla.charAt(i)
			var CarattereCorrente2 = CarattereCorrente.charCodeAt()
			if (((CarattereCorrente2 > 64) && (CarattereCorrente2 < 91)) || CarattereCorrente2 == 32 || CarattereCorrente2 == 39 || CarattereCorrente2 == 38 || CarattereCorrente2 == 45 || CarattereCorrente2 == 46 || ((CarattereCorrente2 > 191) && (CarattereCorrente2 < 224)))
			{
    						
			}
			else
			{
				no_errore = 0;
			}
		}	
	}
	else
	{
		no_errore = 0;
	}
	return no_errore;
}

// seleziona un elemento della combo dal valore dato
// usato per i prefissi
function SelectComboByText(sel, sel_naz) 
{
    var txt = sel_naz.options[sel_naz.selectedIndex].text;
    var val = sel_naz.value;
    if (val == "_null") 
    {
        sel.selectedIndex = 0;
    }
    else 
    {
        var opts = sel.options;
        for (var i = 0, L = opts.length; i < L; i++) 
        {
            if (opts[i].text.indexOf(txt) != -1) 
            {
                sel.selectedIndex = i;
                break;
            }
        }
    }
}

// seleziona il prefisso ITALIA della combo
function SelectComboItalia(sel) 
{
    var txt = "ITALIA";

    var opts = sel.options;
    for (var i = 0, L = opts.length; i < L; i++) 
    {
        if (opts[i].text.indexOf(txt) != -1) 
        {
            sel.selectedIndex = i;
            break;
        }
    }
}

// controllo sulla nazione della partita iva
function CheckNazionePartitaIva(PartitaIva, Nazione) 
{
    var pIvaDaControllare = "";
    var primiCaratteriPiva = PartitaIva.substring(0, 2)
    var strprimiCaratteriPiva = primiCaratteriPiva.toUpperCase()
    var strNazione = Nazione.toUpperCase()
    var radioButtons = $("#" + nomeForm + " input:radio[name='" + nomeRadioCittadinanzaPIVA + "']");

    //Toppa greca
    if (strNazione == "GR") 
    {
        Nazione = "EL"
        strNazione = "EL"
    }

    if (strprimiCaratteriPiva != strNazione) 
    {

        //i primi due caratteri NON sono uguali alla nazione scelta
        //Aggiungo quindi la sigla della nazione e poi provo a validarla
        if (radioButtons[0].checked) //radio ita selezionato
        {
            pIvaDaControllare = "IT" + PartitaIva
        }
        else 
        {
            pIvaDaControllare = Nazione + PartitaIva
        }
    }
    else 
    {
        pIvaDaControllare = PartitaIva
    }
    return pIvaDaControllare;
}

// validazione della partita iva
function ValidaPartitaIva() 
{

    var no_errore = 1;
    var PartitaIva = "";
    var PartitaIvaInserita = document.getElementsByName(nomeInputPartitaIVA)
    PartitaIva = PartitaIvaInserita[0].value.toUpperCase();
    //alert("PartitaIva: " + PartitaIva);

    //tolgo gli eventuali spazi inseriti nella parita iva
    for (var i = 0; i < PartitaIva.length; i++) {
        if (PartitaIva.charAt(i) == " ") {
            PartitaIva = PartitaIva.replace(PartitaIva.charAt(i), "")
        }
    }

    //CONTROLLO CHE CI SIANO SOLO CARATTERI ALFA NUMERICI
    var str_PartitaIva = CheckStringaAlfaNumerica(PartitaIva)
    if (str_PartitaIva == 0) {
        no_errore = 0;
    }
    //alert("str_PartitaIva: " + str_PartitaIva);

    var NazioneEstera = document.getElementsByName(nomeInputNazioneEstera)
    //alert("NazioneEstera: " + NazioneEstera);
    if (NazioneEstera[0].value == "_null") {
        var NazioneEstera = document.getElementsByName(nomeInputNazioneEsteraIT)
    }
    else {

        //Aggiornamento 9-2-2007 Silvia Municchi
        //Controllo se i primi due caratteri della partita iva sono lettere
        //Se non sono lettere ce le aggiungo io in base alla nazione selezionata
        //Xkè la maggior parte degli utenti non mette la sigla del paese e quindi la procedura darebbe errore.
        PartitaIva = CheckNazionePartitaIva(PartitaIva, NazioneEstera[0].value)
        //alert("PartitaIva: " + PartitaIva);
    }

    if (NazioneEstera[0].value == "AT")//AUSTRIA
    {
        var valida = /^ATU[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "BE")//BELGIO
    {
        var valida = /^BE[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            valida = /^BE0[0-9]{9,9}$/;
            regv = new RegExp(valida);
            if (regv.test(PartitaIva) == false) {
                no_errore = 0;
            }
        }
    }

    if (NazioneEstera[0].value == "CY")//CIPRO
    {
        var valida = /^CY[0-9]{8,8}[a-zA-Z]{1,1}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }

    }

    if (NazioneEstera[0].value == "CZ")//REPUBBLICA CECA
    {
        var valida = /^CZ[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            valida = /^CZ[0-9]{9,9}$/;
            regv = new RegExp(valida);
            if (regv.test(PartitaIva) == false) {
                valida = /^CZ[0-9]{10,10}$/;
                regv = new RegExp(valida);
                if (regv.test(PartitaIva) == false) {
                    no_errore = 0;
                }
            }
        }
    }

    if (NazioneEstera[0].value == "DE")//GERMANIA
    {
        var valida = /^DE[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "DK")//DANIMARCA
    {
        var valida = /^DK[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "EE")//ESTONIA
    {
        var valida = /^EE[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "GR" || NazioneEstera[0].value == "EL")//GRECIA
    {
        var valida = /^EL[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "ES")//SPAGNA
    {
        var valida = /^ES[a-zA-Z0-9][0-9]{7,7}[a-zA-Z0-9]{1,1}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
        else {

            //controllo se in terza e in ultima posizione sono stati inseriti 2 numeri
            //-->se trovo 2 numeri nn va bene
            var TerzaCifra = PartitaIva.substring(2, 3)
            var UltimaCifra = PartitaIva.substring(10, PartitaIva.length)
            if (CheckBloccoNumerico(TerzaCifra) == 1 && CheckBloccoNumerico(UltimaCifra) == 1) {
                no_errore = 0;
            }
        }
    }

    if (NazioneEstera[0].value == "FI")//FINLANDIA
    {
        var valida = /^FI[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "FR")//FRANCIA
    {
        var valida = /^FR[a-zA-Z0-9]{2,2}[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "GB")//GRAN BRETAGNA
    {
        var valida = /^GB[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            valida = /^GB[0-9]{12,12}$/;
            regv = new RegExp(valida);
            if (regv.test(PartitaIva) == false) {
                valida = /^GBGD[0-9]{3,3}$/;
                regv = new RegExp(valida);
                if (regv.test(PartitaIva) == false) {
                    valida = /^GBHA[0-9]{3,3}$/;
                    regv = new RegExp(valida);
                    if (regv.test(PartitaIva) == false) {
                        no_errore = 0;
                    }
                }
            }
        }
    }


    if (NazioneEstera[0].value == "HU")//UNGHERIA
    {
        var valida = /^HU[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "IE")//IRLANDA
    {
        var valida = /^IE[0-9]{1,1}[a-zA-Z0-9]{1,1}[0-9]{5,5}[a-df-hl-zA-DF-HL-Z]$/; //A-Albiani 14-10-2009
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "LT")//LITUANIA
    {
        var valida = /^LT[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            var valida = /^LT[0-9]{12,12}$/;
            var regv = new RegExp(valida);
            if (regv.test(PartitaIva) == false) {
                no_errore = 0;
            }
        }
    }

    if (NazioneEstera[0].value == "LU")//LUSSEMBURGO
    {
        var valida = /^LU[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "LV")//LETTONIA
    {
        var valida = /^LV[0-9]{11,11}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "MT")//MALTA
    {
        var valida = /^MT[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "NL")//OLANDA (paesi bassi)
    {
        var valida = /^NL[0-9]{9,9}B[0-9]{2,2}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "PL")//POLONIA
    {
        var valida = /^PL[0-9]{10,10}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "PT")//PORTOGALLO
    {
        var valida = /^PT[0-9]{9,9}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "RO")//ROMANIA
    {
        var valida = /^RO[0-9]{2,10}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "SE")//SVEZIA
    {
        var valida = /^SE[0-9]{12,12}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "SI")//SLOVENIA
    {
        var valida = /^SI[0-9]{8,8}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "SK")//SLOVACCHIA
    {
        var valida = /^SK[0-9]{10,10}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            no_errore = 0;
        }
    }

    if (NazioneEstera[0].value == "IT")//ITALIA
    {
        var valida = /^\d{11}$/;
        var regv = new RegExp(valida);
        if (regv.test(PartitaIva) == false) {
            valida = /^IT\d{11}$/;
            regv = new RegExp(valida);
            if (regv.test(PartitaIva) == false) {
                no_errore = 0;
            }
        }
    }

    //alert("Partita iva valida?:  "+no_errore)
    return no_errore;
}

// Togli spazi a sinistra		
function LeftTrim(STRING)
{
	while(STRING.charAt(0)==" ")
	{
		STRING = STRING.replace(STRING.charAt(0),"");
	}
	return STRING;
}

// Togli spazi a destra		
function RightTrim(STRING)
{
	while(STRING.charAt(STRING.length - 1) == " ")
	{
	    STRING = STRING.substring(0, STRING.length - 1);
	}
	return STRING;
}

// calcola il codice fiscale
function CalcolaCodiceFiscale() {
	var no_errore = 1;
	var CodiceFiscaleCalcolato = ""
			
	//RICAVO IL COGNOME (123)
	var cognomeInserito
	cognomeInserito = document.getElementsByName(nomeInputCognome)
	cognomeInserito = cognomeInserito[0].value.toUpperCase();	

	var Vocali 
	var VocaliCognome = ""
	var Consonanti 
	var ConsonantiCognome = ""
			
	var elencoVocali = "AEIOU"
	var elencoConsonanti = "BCDFGHJKLMNPQRSTVWXYZ"
	for (var i=0; i<cognomeInserito.length; i++) {
		Vocali = elencoVocali.indexOf(cognomeInserito.charAt(i));
		if (Vocali == (-1))
		{
		}
		else
		{
			VocaliCognome = VocaliCognome + cognomeInserito.charAt(i)
		}
	}
			
	for (var i=0; i<cognomeInserito.length; i++) {	
		Consonanti = elencoConsonanti.indexOf(cognomeInserito.charAt(i));
		if (Consonanti == (-1))
		{
		}
		else
		{
			ConsonantiCognome = ConsonantiCognome + cognomeInserito.charAt(i)
		}
		if (ConsonantiCognome.length == 3) break;
				
	}
	if (ConsonantiCognome.length < 3)
	{
		ConsonantiCognome = ConsonantiCognome + VocaliCognome.substring(0, 3-ConsonantiCognome.length)
	}
			
	if (ConsonantiCognome.length < 3)
	{
		if (ConsonantiCognome.length ==1) 
		{
			ConsonantiCognome = ConsonantiCognome +"XX"
		}
		if (ConsonantiCognome.length ==2) 
		{
			ConsonantiCognome = ConsonantiCognome +"X"
		}
				
	}
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + ConsonantiCognome
	//FINE COGNOME
							
	//RICAVO IL NOME
	var nomeInserito
	nomeInserito = document.getElementsByName(nomeInputNome)
	nomeInserito = nomeInserito[0].value.toUpperCase();
				
	//FINE NOME
	var Vocali 
	var VocaliNome = ""
	var Consonanti 
	var ConsonantiNome = ""
			
	for (var i=0; i<nomeInserito.length; i++) {
		Vocali = elencoVocali.indexOf(nomeInserito.charAt(i));
		if (Vocali == (-1))
		{
		}
		else
		{
			VocaliNome = VocaliNome + nomeInserito.charAt(i)
		}
				
		Consonanti = elencoConsonanti.indexOf(nomeInserito.charAt(i));
		if (Consonanti == (-1))
		{
		}
		else
		{
			ConsonantiNome = ConsonantiNome + nomeInserito.charAt(i)
		}
	}
			
	if (ConsonantiNome.length >= 4)
	{

		//	isolo la prima, terza e quarta consonante
		ConsonantiNome = ConsonantiNome.substring(0,1) + ConsonantiNome.substring(2,4)	
	}
			
	if (ConsonantiNome.length < 3)
	{

		//	 Aggiungo le vocali
		ConsonantiVocali = ConsonantiNome + VocaliNome
		ConsonantiNome = ConsonantiVocali.substring(0,3)
				
		//	 se non basta, aggiungo le X
		if (ConsonantiNome.length < 3)
		{
			ConsonantiX = ConsonantiNome + "XXX"
			ConsonantiNome = ConsonantiX.substring(0,3)
		}
	}
			
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + ConsonantiNome
								
	var annoNascita
	annoNascita = document.getElementsByName(nomeInputAnnoDataNascita)
	annoNascita = annoNascita[0].value.substr(annoNascita[0].value.length-2,annoNascita[0].value.length)
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + annoNascita
								
	var meseNascita
	meseNascita = document.getElementsByName(nomeInputMeseDataNascita)
			
	var mesiAnno 
	mesiAnno = "ABCDEHLMPRST"
			
	var trova 
	trova = mesiAnno.charAt(meseNascita[0].value-1);	
			
	if (trova == (-1))
	{
		no_errore = 0;	
	}
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + trova
								
	var giornoNascita
	giornoNascita = document.getElementsByName(nomeInputGiornoDataNascita)
								
	var sesso
	sesso = document.getElementsByName(nomeInputSesso)
	if (sesso[0].value == "F")
	{
		giornoNascita = 40+eval(giornoNascita[0].value)
	}
	else
	{
		giornoNascita = eval(giornoNascita[0].value)
	}
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + giornoNascita
			
	var CodiceNazione
	CodiceNazione = document.getElementsByName(nomeInputNazioneNascita)
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + CodiceNazione[0].value
							
	//Ultima lettera (F)
	//Controllo caratteri pari
	var TempNum = 0
	var tmp_AppoNum1 = "B1A0KKPPLLC2QQD3RRE4VVOOSSF5TTG6UUH7MMI8NNJ9WWZZYYXX"
	var tmp_AppoNum2 = "A0B1C2D3E4F5G6H7I8J9KKLLMMNNOOPPQQRRSSTTUUVVWWXXYYZZ"
	var AppoNum = 0
	for (var i=0; i<15; i++) {

		//	 I DISPARI
		AppoNum = tmp_AppoNum1.indexOf(CodiceFiscaleCalcolato.charAt(i))
		TempNum = TempNum + (AppoNum & 32766) / 2
		i=i+1
		if (i == 14) break;
				
		//	 I PARI
		AppoNum = tmp_AppoNum2.indexOf(CodiceFiscaleCalcolato.charAt(i))
		TempNum = TempNum + (AppoNum & 32766) / 2
	}
		
	TempNum = TempNum % 26;
	
	var Consonanti = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
	CodiceFiscaleCalcolato = CodiceFiscaleCalcolato + Consonanti.charAt(TempNum)
    return CodiceFiscaleCalcolato;
}

// controllo per codice fiscale
function Check_CFStr()
{
	var objCodFis
	objCodFis = document.getElementsByName(nomeInputCodFis)
	objCodFis = objCodFis[0].value.toUpperCase();	
			
	//Controllo se il cliente è nato all'estero
	var CodiceComune
	CodiceComune = objCodFis.substring(11,15)
	if (CodiceComune.substring(0,1) == "Z")
	{
		if (document.all)	// Explorer
		{
			document.getElementById(nomeInputCittaNascita).style.display = '';
		}
		else
		{
			document.getElementById(nomeInputCittaNascita).style.display = '';
		}
	}
	else
	{
		if (document.all)	// Explorer
		{
			document.getElementById(nomeInputCittaNascita).style.display = 'none';
		}
		else
		{
			document.getElementById(nomeInputCittaNascita).style.display = 'none';
		}			
	}
}

// validazione dell'ultimo carattere del codice fiscale
function ValidaCarattereControlloCodiceFiscale(codiceFiscale) {
    set1 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    set2 = "ABCDEFGHIJABCDEFGHIJKLMNOPQRSTUVWXYZ";
    setpari = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    setdisp = "BAKPLCQDREVOSFTGUHMINJWZYX";
    s = 0;

    codiceFiscale = codiceFiscale.toUpperCase();

    for (var i = 1; i <= 13; i += 2) {
        s += setpari.indexOf(set2.charAt(set1.indexOf(codiceFiscale.charAt(i))));
    }

    for (var i = 0; i <= 14; i += 2) {
        s += setdisp.indexOf(set2.charAt(set1.indexOf(codiceFiscale.charAt(i))));
    }

    if (s % 26 != codiceFiscale.charCodeAt(15) - 'A'.charCodeAt(0)) {
        return false;
    } else {
        return true;
    }
}

//validazione password
function Valida_Pw() {

    var no_errore = 1;

    var objPw
    objPw = document.getElementsByName("0_0_UserPass")
    objPw = objPw[0].value.toLowerCase();

    var objConfPw
    objConfPw = document.getElementsByName("ConfUserPass")
    objConfPw = objConfPw[0].value.toLowerCase();

    //alert("password:  "+objPw)
    //alert("conferma password:  "+objConfPw)

    if (objPw.length < 8) {
        no_errore = 0;
    }
    else {
        var ValidaPw = CheckStringaAlfaNumerica(objPw)
        if (ValidaPw == 0) {
            no_errore = 0;
        }
        else {
            if (objPw != objConfPw) {
                no_errore = 0;
            }

        }
    }
    return no_errore;

}

function trim(stringa) {
    while (stringa.substring(0, 1) == ' ') {
        stringa = stringa.substring(1, stringa.length);
    }
    while (stringa.substring(stringa.length - 1, stringa.length) == ' ') {
        stringa = stringa.substring(0, stringa.length - 1);
    }
    return stringa;
}

//confronto tra Codice Fiscale/Partita Iva inserito/a e quello restituito dal WhoIS 
function ConfrontoRegCode(nomeFieldInput) {
    var ResultConfrontoRegCode = "true";
    var RegCodeForNoPIva = RegCode.replace(".", "");
    RegCodeForNoPIva = trim(RegCodeForNoPIva);

    if (RegCodeForNoPIva == "na") {
        //Associazione senza PIVA
        ResultConfrontoRegCode = "true";
    } else {
        if (RegCode != "" && $("#" + nomeFieldInput).val() != "" && (trim(RegCode) == trim($("#" + nomeFieldInput).val()))) {
            ResultConfrontoRegCode = "true";
        } else {
            ResultConfrontoRegCode = "false";
        }
    }
    return ResultConfrontoRegCode;
}

function replaceSpace(stringa) {
    var arrayStringa = trim(stringa).split(' ');
    var ReplaceStringa = "";
    for (var i = 0; i < arrayStringa.length; i++) {
        if (trim(arrayStringa[i]) != "") {
            if (ReplaceStringa != "") {
                ReplaceStringa = ReplaceStringa + " " + arrayStringa[i];
            } else {
                ReplaceStringa = arrayStringa[i];
            }
        }
    }
    return ReplaceStringa
}
