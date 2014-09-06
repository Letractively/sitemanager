function ContenutoBarraInfo(jsv_Contenuto)
{
	if (jsv_Contenuto == '')
	{
		//Inserisco contenuto standard
		jsv_Contenuto = 'Benvenuto su Aruba.it! Scegli il nome a dominio che preferisci e scopri come essere in rete con pochi click.'
	}
	document.getElementById("BarraInfo").innerHTML = jsv_Contenuto
}

function BarraInfoPopUp(IDInformazione)
{
	window.open("/info_nh/BarraInfo.asp?ID=" + IDInformazione,"finestra","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=366,height=400,top=100,left=100");
}

function chiudi()
{
A = window.open("/Attesa.asp","Attesa","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=150,top=200,left=300")
A.close()
}
