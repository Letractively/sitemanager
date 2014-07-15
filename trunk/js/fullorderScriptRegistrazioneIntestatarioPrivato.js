
/* JQuery: validatore per il CAP */
$.validator.addMethod("check_cap", function (value) {
    var esito = true;
    var tmpCap = value.replace(/^\s*/, "").replace(/\s*$/, "");
    if (tmpCap.length == 0) {
        esito = false;
    } else {
        if ($("#0_0_NazioneInt").val() == "IT") {
            if ((tmpCap.length != 5) || (CheckBloccoNumerico(value) == 0)) {
                esito = false;
            }
        } else {
            if (CheckStringaAlfaNumerica(tmpCap) == 0) {
                esito = false;
            }
        }
    }
    return esito;
}, "msg errore!");

/* JQuery: validatore per il codice fiscale */
$.validator.addMethod("check_CF", function (value) {
    var esito = true;
    if (ValidaCodFis(IdAreaVendita) != 1) {
        if (testoMsgOld_CF == "") {
            testoMsgOld_CF = $("#0_0_CodFisInt").next("div.txterrore").text();
        }
        $("#0_0_CodFisInt").next("div.txterrore").text(testoMsgOld_CF);
        esito = false;
    } else {
        var tmpCF = $("#0_0_CodFisInt").val();
        if (tmpCF.charAt(11) == "z" || tmpCF.charAt(11) == "Z") {
            document.getElementById("divCittaNascita").style.display = '';
        }
        else {
            document.getElementById("divCittaNascita").style.display = 'none';
        }
    }
    return esito;
}, "msg errore!");

/* JQuery: validatore per documento identita; viene utilizzato per controllare che l'utente non sia già registrato */
$.validator.addMethod("check_DocIdentita", function (value) {
    var esito = true;
    var tmpDoc = value.replace(/^\s*/, "").replace(/\s*$/, "");
    if (tmpDoc.length == 0) {
        if (testoMsgOld_Doc == "") {
            testoMsgOld_Doc = $("#0_0_DocIdentita").next("div.txterrore").text();
        }
        $("#0_0_DocIdentita").next("div.txterrore").text(testoMsgOld_Doc);
        esito = false;
    }
    return esito;
}, "msg errore!");

/* JQuery: validatore per la data di nascita: attenzione il  
controllo isDate controlla la data in formato MM/DD/YYYY */
$.validator.addMethod("check_Data", function (value) {
    var esito = true;
    var tmpAnno = value.replace(/^\s*/, "").replace(/\s*$/, "");
    var tmpMese = $("#0_0_DataMM").val().replace(/^\s*/, "").replace(/\s*$/, "");
    var tmpGiorno = $("#0_0_DataGG").val().replace(/^\s*/, "").replace(/\s*$/, "");
    if (tmpAnno == "" || tmpMese == "" || tmpGiorno == "") {
        esito = false;
    }
    else {
        var dateStr = tmpMese + '/' + tmpGiorno + '/' + tmpAnno;
        if (isDate(dateStr) == "true") {
            esito = true;
        }
        else {
            esito = false;
        }
    }
    return esito;
}, "msg errore!");

/* JQuery: validatore per email non su stesso dominio */
$.validator.addMethod("check_DominioMail", function (value) {
	$("#lblEmailDominio").hide();
    var esito = true;
    var tabDomini = listaDomini.split(";");
    for (var i = 0; i < tabDomini.length; i++) {
        if (value.match(tabDomini[i] + "$")) {
            $("#lblEmail").hide();
            $("#lblEmailDominio").show();
            esito = true;
            break;
        }
    }
    return esito;
}, "msg errore!");

/* JQuery: validatore per il nome */
$.validator.addMethod("check_Nome", function (value) {
    if (CheckStringaAlfabetica('0_0_NomeInt') == 1) {
        return true;
    } else {
        return false;
    }
}, "msg errore!");

/* JQuery: validatore per il cognome */
$.validator.addMethod("check_Cognome", function (value) {
    if (CheckStringaAlfabetica('0_0_CognomeInt') == 1) {
        return true;
    } else {
        return false;
    }
}, "msg errore!");

/* JQuery: validatore per la città estera */
$.validator.addMethod("check_CittaEstera", function (value) {
    if (CheckStringaAlfabetica('PaeseEstero_IT') == 1) {
        return true;
    } else {
        return false;
    }
}, "msg errore!");

/* JQuery: validatore per il telefono */
$.validator.addMethod("check_telefono", function (value) {
    if (CheckBloccoNumerico(value) == 1) {
        return true;
    } else {
        return false;
    }
}, "msg errore!");

/* JQuery: validatore per il fax */
$.validator.addMethod("check_fax", function (value) {
    if (value == "") {
        return true;
    } else {
        if (CheckBloccoNumerico(value) == 1) {
            return true;
        } else {
            return false;
        }
    }
}, "msg errore!");

/* JQuery: validatore per le dropdown */
$.validator.addMethod("check_select", function (value) {
    return value != "_null";
}, "msg errore!");

$.validator.addMethod("check_select_fax", function (value) {
    if ($("#0_0_FaxInt").val() == "") {
        return true;
    } else {
        return value != "_null";
    }
}, "msg errore!");

/* JQuery: ready */
$().ready(function () {
    $("#0_0_CodFisInt").bind('paste', function (e) {
        var el = $(this);
        $(el).attr("maxlength", "50");
        setTimeout(function () {
            var text = $(el).val();
            $(el).val(text.split(' ').join(''));
            if ($(el).val().length > 16) {
                $(el).val($(el).val().substring(0, 16))
            }
            $(el).attr("maxlength", "16");
        }, 100);
    });

    /* chiama il dialogo */
    $("#dlgMessage").dialog({
        bgiframe: true,
        autoOpen: false,
        height: 260,
        width: 360,
        modal: true
    });

    /* JQuery: carica i comuni */
    if ($("#0_0_ProvInt").val() != "") {
        AggiornaComuni($("#0_0_ProvInt").val(), true);
    }

    /* JQuery: validatore per i campi documento di identità e codice fiscale: spazi e apici non ammessi */
    $("#0_0_CodFisInt").keydown(function (event) {
        FiltraSpazioPlus(event);
    });
    $("#0_0_DocIdentita").keydown(function (event) {
        FiltraSpazioPlus(event);
    });

    /* JQuery: validatore per i campi numerici: telefono, fax, cellulare e anno di nascita */
    $("#0_0_TelInt").keydown(function (event) {
        FiltraNumeri(event);
    });

    $("#0_0_FaxInt").keydown(function (event) {
        FiltraNumeri(event);
    });

    $("#0_0_DataII").keydown(function (event) {
        FiltraNumeri(event);
    });

    // JQuery: validazione completa
    formValidator = $("#DatiDominio").validate({

        // Workaround: negli elementi di tipo select (i.e. dropdown) la validazione
        // non funziona correttamente in IE (selezionare Please select in http://jsfiddle.net/Soul_Master/MFMcR/)
        onclick: function (element) {
            if (element.name in this.submitted) {
                if ($.browser.msie && $(element).is('select')) return;
                this.element(element);
            }
            else if (element.parentNode.name in this.submitted) {
                if ($.browser.msie && $(element).is('select')) return;
                this.element(element.parentNode);
            }
        },
        errorPlacement: function (error, element) {
            $(element).attr("style", "border-color: #d60010; background-color: #FFFBFB;");
            $(element).next("div.txterrore").show();
        },
        success: function (element) {
            var nomecampo = '#' + $(element).attr('htmlFor');
            $(nomecampo).attr("style", "border-color: #0cb504; background-color: #FBFFFB");
            $(nomecampo).next("div.txterrore").hide();
        },
        rules: {
            "Select_Nazionalita_Estera": "check_select",
            "0_0_AuthInfo": "required",
            "0_0_NomeInt": "check_Nome",
            "0_0_CognomeInt": "check_Cognome",
            "0_0_IndirizzoInt": "required",
            "0_0_CapInt": "check_cap",
            "0_0_NumCivico": "required",
            "0_0_NazioneInt": "check_select",
            "Province": "check_select",
            "Comune": "check_select",
            "ComuneStraniero": "required",
            "0_0_PrefissoTelInt": "check_select",
            "0_0_TelInt": "check_telefono",
            "0_0_PrefissoFaxInt": "check_select_fax",
            "0_0_FaxInt": "check_fax",
            "PaeseEstero_IT": "check_CittaEstera",
            "0_0_DocIdentita": "check_DocIdentita",
            "0_0_SessoInt": "required",
            "0_0_DataGG": "required",
            "0_0_DataMM": "required",
            "0_0_DataII": "check_Data",
            "Nazione_Estera_Nascita": "check_select",
            "PaeseEsteroNascita": "required",
            "ProvinceNascita": "check_select",
            "ComuneNascita": "check_select",
            "0_0_CodFisInt": "check_CF",
            "0_0_EmailInt": {
                required: true,
                email: true,
                check_DominioMail: true
            },
            "ConfEmail": {
                required: true,
                email: true,
                equalTo: "#0_0_EmailInt"
            },

            // Sezione Dominio EU
            "0_0_PaeseUnioneEuropea": "check_select",
            "0_0_EmailWhois": {
                required: true,
                email: true
            },
            "0_0_LinguaProceduraADR": "check_select"
        }
    });

    // JQuery: province e comuni
    $('#DatiDominio').submit(function () {

        // se non può aprire un dominio it, bloccalo
        if (!checkNazionalitaDominiIT(true)) {
            return false;
        }

        if ($("#0_0_NazioneInt").val() == "IT") {
            if ($("#Province").val() != "_null") {
                $("#0_0_ProvInt").val($("#Province").val());
            } else {
                $("#0_0_ProvInt").val("");
            }
            if ($("#Comune").val() != "_null") {
                $("#0_0_ComuneInt").val($("#Comune").val());
            } else {
                $("#0_0_ComuneInt").val("");
            }
        } else {
            $("#0_0_ComuneInt").val($("#ComuneStraniero").val());
        }

        if ($("#Nazione_Estera_Nascita").val() == "ITALIA" || $("#Nazione_Estera_Nascita").val() == "IT" || $("#Nazione_Estera_Nascita").val() == "Italiana") {
            if ($("#ProvinceNascita").val() != "_null") {
                $("#0_0_ProvNasc").val($("#ProvinceNascita").val());
            } else {
                $("#0_0_ProvNasc").val();
            }
            $("#0_0_ComuneNasc").val($("#ComuneNascita").val());
            $("#0_0_PaeseEstero").val("");
        } else {
            if ($("#Nazione_Estera_Nascita").val() != "_null") {
                $("#0_0_ProvNasc").val($("#Nazione_Estera_Nascita").val());
            } else {
                $("#0_0_ProvNasc").val();
            }
            $("#0_0_ComuneNasc").val("");
            $("#0_0_PaeseEstero").val($("#PaeseEsteroNascita").val());
        }

        //if (ctrlDominiEU) {
        //    document.Return_Eu;
        //    CheckDatiEu();
        //    if (!document.Return_Eu) {
        //        return false;
        //    }
        //}

        // prevenire il click doppio sul bottone (il secondo viene ignorato)
        //$(this).submit(function () {
        //    alert("Submit già clickato !!");
        //    return false;
        //});
        return checkNazionalitaDominiIT(true);

    });

    CittadinoItaliano_Straniero();
    if (precaricaComuni) {
        precaricaComuni = false;
        ImpostaComuni();
    }
});

function loadtext(page_request, containerid) {
    if (page_request.readyState == 4 && (page_request.status == 200 || window.location.href.indexOf("http") == -1)) {
        try {
            document.getElementById(containerid).innerHTML = page_request.responseText;
            if ($("#0_0_ComuneInt").val() != "") {
                $("#Comune").val($("#0_0_ComuneInt").val());
            }
        } catch (e) {
            //IE alert("error on loadtext"); 
        }
    }
}


function HelpFormatoTelefono()
{
	window.open("../info_nh/HelpFormatoTelefono.asp","finestra","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=366,height=250,top=100,left=100");
}
function HelpConsensoPubbDati()
{
	window.open("../info_nh/HelpConsensoPubbDati.asp","finestra","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=366,height=250,top=100,left=100");
}

function showMessage() {
    $("#dlgMessage").dialog("open");
}

function CittadinoItaliano_Straniero()
{
		
	if (document.DatiDominio.Cittadinanza[1].checked == true)
	{
	    $("#0_0_CapInt").attr("maxlength", "10");
	    $("#0_0_CapInt").unbind("keydown");
		
		var Nazione_Estera
	
		Nazione_Estera = document.getElementsByName("0_0_NazioneInt")
		if(Nazione_Estera[0].value == "" || Nazione_Estera[0].value == "IT" || Nazione_Estera[0].value == "it")
		{
			Nazione_Estera[0].value = "_null";
		}
			
		//la nazionalità deve essere svuotata per farla scegliere al richiedente
		//se invece ho già scelto in precedenza una nazionalità ci rimetto quella
			
		js_Nazionalita_Scelta = document.getElementById("Select_Nazionalita_Estera").value
			
		if(js_Nazionalita_Scelta == "" ) //svuoto						
			document.getElementsByName("0_0_Nazionalita")[0].value = ""
		else  //reimposto valore scelto prima
			document.getElementsByName("0_0_Nazionalita")[0].value = js_Nazionalita_Scelta
		    document.getElementById("0_0_NazioneInt").value = Nazione_Estera[0].value
		    document.getElementById("divProvince").style.display = "none";
		    document.getElementById("divComuni").style.display = "none";
		    document.getElementById("divComuneStraniero").style.display = "";
			document.getElementById("divSesso").style.display="";
			document.getElementById("divDataNascita").style.display="";
			document.getElementById("divNazioneEsteraNascita").style.display = "";
			document.getElementById("divProvinceNascita").style.display = "none";
			document.getElementById("divComuniNascita").style.display = "none";
			document.getElementById("divCodiceFiscale").style.display = "none";
			document.getElementById("divCalcoloCF").style.display = "none";
			document.getElementById("divPaeseEsteroNascita").style.display = "";
			document.getElementById("divCittaNascita").style.display = "none";
			document.getElementById("divDocumentoIdentita").style.display = "";
				
			//visualizzo il select della nazionalità
			document.getElementById("p_Nazionalita").style.display="";

	}else if (document.DatiDominio.Cittadinanza[0].checked == true) {
        $("#0_0_CapInt").attr("maxlength", "5");
        $("#0_0_CapInt").bind("keydown", function (event) {
	        FiltraNumeri(event);
	    });

		//controllo comune sia per ie che altri browser
		//l'ho messo qui per non duplicarlo nelle 2 if --alessio
		var pippo = document.getElementsByName("0_0_CodFisInt")
		var pippo2 = pippo[0].value
		var zeta = pippo2.charAt(11)
			
		//la nazionalità deve essere reimpostata ad ITALIANO
		document.getElementsByName("0_0_Nazionalita")[0].value="IT"
		document.getElementById("0_0_NazioneInt").value = "IT";
		document.getElementById("divProvince").style.display = "";
		document.getElementById("divComuni").style.display = "";
		document.getElementById("divComuneStraniero").style.display = "none";
		document.getElementById("divSesso").style.display = 'none';
		document.getElementById("divDataNascita").style.display='none';
		document.getElementById("divNazioneEsteraNascita").style.display = 'none';
		document.getElementById("divProvinceNascita").style.display = "none";
		document.getElementById("divComuniNascita").style.display = "none";
		document.getElementById("divPaeseEsteroNascita").style.display = "none";
			
		if (zeta=="z" || zeta=="Z")
		{
		    document.getElementById("divCittaNascita").style.display = '';
		}
		else
		{
		    document.getElementById("divCittaNascita").style.display = 'none';
		}
        document.getElementById("divCodiceFiscale").style.display = '';
        document.getElementById("divCalcoloCF").style.display = "";
		document.getElementById("divDocumentoIdentita").style.display = 'none';
			
		//nascondo il select della nazionalità
		document.getElementById("p_Nazionalita").style.display = 'none';

		var comboSel = document.getElementById("0_0_NazioneInt");
		SelectComboByText(document.getElementById("0_0_PrefissoTelInt"), comboSel);
		SelectComboByText(document.getElementById("0_0_PrefissoFaxInt"), comboSel);
	}
}

function checkNazionalitaDominiIT(apriPopup) {
    var esito = true;
    if (document.getElementsByName("DominioItOrdinato")[0].value == 1) {
        if ($("#0_0_Nazionalita").val() != "_null" || $("#0_0_NazioneInt").val() != "_null") {
            var Nazionalita = document.getElementsByName("0_0_Nazionalita")[0].value;
            var NazioneInt = document.getElementsByName("0_0_NazioneInt")[0].value;

            var NazioneUnioneEuropea = "AT;BE;BG;CY;DK;EE;FI;FR;DE;GB;GR;IE;IT;LV;LT;LU;MT;PT;NL;PL;CZ;SK;RO;SI;ES;SE;HU;VA;IS;LI;NO;SM;CH";
            if (NazioneUnioneEuropea.indexOf(Nazionalita) == -1 && NazioneUnioneEuropea.indexOf(NazioneInt) == -1) {
                esito = false;
                if (apriPopup) {
                    showMessage();
                }
            }
        }
    }
    return esito;
}

function int_ImpostaNazionalita(Naz_Scelta) {
    document.getElementsByName("0_0_Nazionalita")[0].value = Naz_Scelta
    checkNazionalitaDominiIT(true);
}

function AggiornaPr_Comune(lang, provincia, Comune) {
    //Azzero
    document.getElementById("Province").value = "_null"
    document.getElementById("Comune").value = "_null"
    if (document.getElementById("0_0_NazioneInt").value == "IT") {
        $("#0_0_CapInt").attr("maxlength", "5");
        $("#0_0_CapInt").bind("keydown", function (event) {
            FiltraNumeri(event);
        });
        document.getElementById("divProvince").style.display = "";
        document.getElementById("divComuni").style.display = "";
        document.getElementById("divComuneStraniero").style.display = "none";
    } else {
        $("#0_0_CapInt").attr("maxlength", "10");
        $("#0_0_CapInt").unbind("keydown");
        document.getElementById("divProvince").style.display = "none";
        document.getElementById("divComuni").style.display = "none";
        document.getElementById("divComuneStraniero").style.display = "";
    }

    var comboSel = document.getElementById("0_0_NazioneInt");
    SelectComboByText(document.getElementById("0_0_PrefissoTelInt"), comboSel);
    SelectComboByText(document.getElementById("0_0_PrefissoFaxInt"), comboSel);

    checkNazionalitaDominiIT(true);
}

function AggiornaPr_ComuneNascita(lang) {
    //Azzero
    document.getElementById("0_0_ProvNasc").value = "";
    document.getElementById("0_0_ComuneNasc").value = "";
    if (document.getElementById("Nazione_Estera_Nascita").value == "ITALIA" || document.getElementById("Nazione_Estera_Nascita").value == "IT" || document.getElementById("Nazione_Estera_Nascita").value == "Italiana") {
        document.getElementById("divProvinceNascita").style.display = "";
        document.getElementById("divComuniNascita").style.display = "";
        document.getElementById("divPaeseEsteroNascita").style.display = "none";
    } else {
        document.getElementById("divProvinceNascita").style.display = "none";
        document.getElementById("divComuniNascita").style.display = "none";
        document.getElementById("divPaeseEsteroNascita").style.display = "";
    }
}

function SelezionaNazione(nazione) {
    for (var i = 0; i < document.getElementById("0_0_NazioneInt").length; i++) {
        if (document.getElementById("0_0_NazioneInt")[i].value == nazione) {
            document.getElementById("0_0_NazioneInt")[i].selected = true;
        }
    }
}
