<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<title>Servizio Hosting</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="js/style.css" rel="stylesheet" type="text/css">
<link href="js/top.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
  vp3_startSess = new Date;
</script>
<script type="text/javascript">
function vaiAinside() {
var url = vuoi_form.vuoi.options[vuoi_form.vuoi.selectedIndex].value;
location.href = url;
}
function noCTRL(e)
{
	var code = (document.all) ? event.keyCode:e.which;
	var ctrl = (document.all) ? event.ctrlKey:e.ctrlKey;
	if (document.all)
	{
		if (ctrl && code==86) //CTRL+V
		{
			window.event.returnValue = false;
		}
	}
	else 
	{
		if (ctrl && code==86)
		{
			window.event.returnValue = false;
		}
	}
} 
function browser(e)
{
	if (document.layers)
	{
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown=clickNS4;
	}
	else if (document.all&&!document.getElementById)
	{
		document.onmousedown=clickIE4;
	}
	document.oncontextmenu=new Function("return false")
}
function clickIE4()
{
	if (event.button==2)
	{
		return false;
	}
}
function clickNS4(e)
{
	if (document.layers||document.getElementById&&!document.all)
	{
		if (e.which==2||e.which==3)
		{
			return false;
		}
	}
}
function reenable()
{
	function clickIE() {if (document.all) {return true;}}
	function clickNS(e) {if
	(document.layers||(document.getElementById&&!document.all)) {
	if (e.which==2||e.which==3) {return true;}}}
	if (document.layers)
	{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
	else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
	document.oncontextmenu=new Function("return true")
}

</script><script language="JavaScript" src="js/NH_JavaScript.js"></script><style type="text/css" charset="utf-8">/* See license.txt for terms of usage */

/** reset styling **/

.firebugResetStyles {

    z-index: 2147483646 !important;

    top: 0 !important;

    left: 0 !important;

    display: block !important;

    border: 0 none !important;

    margin: 0 !important;

    padding: 0 !important;

    outline: 0 !important;

    min-width: 0 !important;

    max-width: none !important;

    min-height: 0 !important;

    max-height: none !important;

    position: fixed !important;

    transform: rotate(0deg) !important;

    transform-origin: 50% 50% !important;

    border-radius: 0 !important;

    box-shadow: none !important;

    background: transparent none !important;

    pointer-events: none !important;

    white-space: normal !important;

}



.firebugBlockBackgroundColor {

    background-color: transparent !important;

}



.firebugResetStyles:before, .firebugResetStyles:after {

    content: "" !important;

}

/**actual styling to be modified by firebug theme**/

.firebugCanvas {

    display: none !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBox {

    width: auto !important;

    position: static !important;

}



.firebugLayoutBoxOffset {

    opacity: 0.8 !important;

    position: fixed !important;

}



.firebugLayoutLine {

    opacity: 0.4 !important;

    background-color: #000000 !important;

}



.firebugLayoutLineLeft, .firebugLayoutLineRight {

    width: 1px !important;

    height: 100% !important;

}



.firebugLayoutLineTop, .firebugLayoutLineBottom {

    width: 100% !important;

    height: 1px !important;

}



.firebugLayoutLineTop {

    margin-top: -1px !important;

    border-top: 1px solid #999999 !important;

}



.firebugLayoutLineRight {

    border-right: 1px solid #999999 !important;

}



.firebugLayoutLineBottom {

    border-bottom: 1px solid #999999 !important;

}



.firebugLayoutLineLeft {

    margin-left: -1px !important;

    border-left: 1px solid #999999 !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.firebugLayoutBoxParent {

    border-top: 0 none !important;

    border-right: 1px dashed #E00 !important;

    border-bottom: 1px dashed #E00 !important;

    border-left: 0 none !important;

    position: fixed !important;

    width: auto !important;

}



.firebugRuler{

    position: absolute !important;

}



.firebugRulerH {

    top: -15px !important;

    left: 0 !important;

    width: 100% !important;

    height: 14px !important;

    background: url("data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%13%88%00%00%00%0E%08%02%00%00%00L%25a%0A%00%00%00%04gAMA%00%00%D6%D8%D4OX2%00%00%00%19tEXtSoftware%00Adobe%20ImageReadyq%C9e%3C%00%00%04%F8IDATx%DA%EC%DD%D1n%E2%3A%00E%D1%80%F8%FF%EF%E2%AF2%95%D0D4%0E%C1%14%B0%8Fa-%E9%3E%CC%9C%87n%B9%81%A6W0%1C%A6i%9A%E7y%0As8%1CT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AATE9%FE%FCw%3E%9F%AF%2B%2F%BA%97%FDT%1D~K(%5C%9D%D5%EA%1B%5C%86%B5%A9%BDU%B5y%80%ED%AB*%03%FAV9%AB%E1%CEj%E7%82%EF%FB%18%BC%AEJ8%AB%FA'%D2%BEU9%D7U%ECc0%E1%A2r%5DynwVi%CFW%7F%BB%17%7Dy%EACU%CD%0E%F0%FA%3BX%FEbV%FEM%9B%2B%AD%BE%AA%E5%95v%AB%AA%E3E5%DCu%15rV9%07%B5%7F%B5w%FCm%BA%BE%AA%FBY%3D%14%F0%EE%C7%60%0EU%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5JU%88%D3%F5%1F%AE%DF%3B%1B%F2%3E%DAUCNa%F92%D02%AC%7Dm%F9%3A%D4%F2%8B6%AE*%BF%5C%C2Ym~9g5%D0Y%95%17%7C%C8c%B0%7C%18%26%9CU%CD%13i%F7%AA%90%B3Z%7D%95%B4%C7%60%E6E%B5%BC%05%B4%FBY%95U%9E%DB%FD%1C%FC%E0%9F%83%7F%BE%17%7DkjMU%E3%03%AC%7CWj%DF%83%9An%BCG%AE%F1%95%96yQ%0Dq%5Dy%00%3Et%B5'%FC6%5DS%95pV%95%01%81%FF'%07%00%00%00%00%00%00%00%00%00%F8x%C7%F0%BE%9COp%5D%C9%7C%AD%E7%E6%EBV%FB%1E%E0(%07%E5%AC%C6%3A%ABi%9C%8F%C6%0E9%AB%C0'%D2%8E%9F%F99%D0E%B5%99%14%F5%0D%CD%7F%24%C6%DEH%B8%E9rV%DFs%DB%D0%F7%00k%FE%1D%84%84%83J%B8%E3%BA%FB%EF%20%84%1C%D7%AD%B0%8E%D7U%C8Y%05%1E%D4t%EF%AD%95Q%BF8w%BF%E9%0A%BF%EB%03%00%00%00%00%00%00%00%00%00%B8vJ%8E%BB%F5%B1u%8Cx%80%E1o%5E%CA9%AB%CB%CB%8E%03%DF%1D%B7T%25%9C%D5(%EFJM8%AB%CC'%D2%B2*%A4s%E7c6%FB%3E%FA%A2%1E%80~%0E%3E%DA%10x%5D%95Uig%15u%15%ED%7C%14%B6%87%A1%3B%FCo8%A8%D8o%D3%ADO%01%EDx%83%1A~%1B%9FpP%A3%DC%C6'%9C%95gK%00%00%00%00%00%00%00%00%00%20%D9%C9%11%D0%C0%40%AF%3F%EE%EE%92%94%D6%16X%B5%BCMH%15%2F%BF%D4%A7%C87%F1%8E%F2%81%AE%AAvzr%DA2%ABV%17%7C%E63%83%E7I%DC%C6%0Bs%1B%EF6%1E%00%00%00%00%00%00%00%00%00%80cr%9CW%FF%7F%C6%01%0E%F1%CE%A5%84%B3%CA%BC%E0%CB%AA%84%CE%F9%BF)%EC%13%08WU%AE%AB%B1%AE%2BO%EC%8E%CBYe%FE%8CN%ABr%5Dy%60~%CFA%0D%F4%AE%D4%BE%C75%CA%EDVB%EA(%B7%F1%09g%E5%D9%12%00%00%00%00%00%00%00%00%00H%F6%EB%13S%E7y%5E%5E%FB%98%F0%22%D1%B2'%A7%F0%92%B1%BC%24z3%AC%7Dm%60%D5%92%B4%7CEUO%5E%F0%AA*%3BU%B9%AE%3E%A0j%94%07%A0%C7%A0%AB%FD%B5%3F%A0%F7%03T%3Dy%D7%F7%D6%D4%C0%AAU%D2%E6%DFt%3F%A8%CC%AA%F2%86%B9%D7%F5%1F%18%E6%01%F8%CC%D5%9E%F0%F3z%88%AA%90%EF%20%00%00%00%00%00%00%00%00%00%C0%A6%D3%EA%CFi%AFb%2C%7BB%0A%2B%C3%1A%D7%06V%D5%07%A8r%5D%3D%D9%A6%CAu%F5%25%CF%A2%99%97zNX%60%95%AB%5DUZ%D5%FBR%03%AB%1C%D4k%9F%3F%BB%5C%FF%81a%AE%AB'%7F%F3%EA%FE%F3z%94%AA%D8%DF%5B%01%00%00%00%00%00%00%00%00%00%8E%FB%F3%F2%B1%1B%8DWU%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*UiU%C7%BBe%E7%F3%B9%CB%AAJ%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5J%95*U%AAT%A9R%A5*%AAj%FD%C6%D4%5Eo%90%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5%86%AF%1B%9F%98%DA%EBm%BBV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%ADV%AB%D5j%B5Z%AD%D6%E4%F58%01%00%00%00%00%00%00%00%00%00%00%00%00%00%40%85%7F%02%0C%008%C2%D0H%16j%8FX%00%00%00%00IEND%AEB%60%82") repeat-x !important;

    border-top: 1px solid #BBBBBB !important;

    border-right: 1px dashed #BBBBBB !important;

    border-bottom: 1px solid #000000 !important;

}



.firebugRulerV {

    top: 0 !important;

    left: -15px !important;

    width: 14px !important;

    height: 100% !important;

    background: url("data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%00%0E%00%00%13%88%08%02%00%00%00%0E%F5%CB%10%00%00%00%04gAMA%00%00%D6%D8%D4OX2%00%00%00%19tEXtSoftware%00Adobe%20ImageReadyq%C9e%3C%00%00%06~IDATx%DA%EC%DD%D1v%A20%14%40Qt%F1%FF%FF%E4%97%D9%07%3BT%19%92%DC%40(%90%EEy%9A5%CB%B6%E8%F6%9Ac%A4%CC0%84%FF%DC%9E%CF%E7%E3%F1%88%DE4%F8%5D%C7%9F%2F%BA%DD%5E%7FI%7D%F18%DDn%BA%C5%FB%DF%97%BFk%F2%10%FF%FD%B4%F2M%A7%FB%FD%FD%B3%22%07p%8F%3F%AE%E3%F4S%8A%8F%40%EEq%9D%BE8D%F0%0EY%A1Uq%B7%EA%1F%81%88V%E8X%3F%B4%CEy%B7h%D1%A2E%EBohU%FC%D9%AF2fO%8BBeD%BE%F7X%0C%97%A4%D6b7%2Ck%A5%12%E3%9B%60v%B7r%C7%1AI%8C%BD%2B%23r%00c0%B2v%9B%AD%CA%26%0C%1Ek%05A%FD%93%D0%2B%A1u%8B%16-%95q%5Ce%DCSO%8E%E4M%23%8B%F7%C2%FE%40%BB%BD%8C%FC%8A%B5V%EBu%40%F9%3B%A72%FA%AE%8C%D4%01%CC%B5%DA%13%9CB%AB%E2I%18%24%B0n%A9%0CZ*Ce%9C%A22%8E%D8NJ%1E%EB%FF%8F%AE%CAP%19*%C3%BAEKe%AC%D1%AAX%8C*%DEH%8F%C5W%A1e%AD%D4%B7%5C%5B%19%C5%DB%0D%EF%9F%19%1D%7B%5E%86%BD%0C%95%A12%AC%5B*%83%96%CAP%19%F62T%86%CAP%19*%83%96%CA%B8Xe%BC%FE)T%19%A1%17xg%7F%DA%CBP%19*%C3%BA%A52T%86%CAP%19%F62T%86%CA%B0n%A9%0CZ%1DV%C6%3D%F3%FCH%DE%B4%B8~%7F%5CZc%F1%D6%1F%AF%84%F9%0F6%E6%EBVt9%0E~%BEr%AF%23%B0%97%A12T%86%CAP%19%B4T%86%CA%B8Re%D8%CBP%19*%C3%BA%A52huX%19%AE%CA%E5%BC%0C%7B%19*CeX%B7h%A9%0C%95%E1%BC%0C%7B%19*CeX%B7T%06%AD%CB%5E%95%2B%BF.%8F%C5%97%D5%E4%7B%EE%82%D6%FB%CF-%9C%FD%B9%CF%3By%7B%19%F62T%86%CA%B0n%D1R%19*%A3%D3%CA%B0%97%A12T%86uKe%D0%EA%B02*%3F1%99%5DB%2B%A4%B5%F8%3A%7C%BA%2B%8Co%7D%5C%EDe%A8%0C%95a%DDR%19%B4T%C66%82fA%B2%ED%DA%9FC%FC%17GZ%06%C9%E1%B3%E5%2C%1A%9FoiB%EB%96%CA%A0%D5qe4%7B%7D%FD%85%F7%5B%ED_%E0s%07%F0k%951%ECr%0D%B5C%D7-g%D1%A8%0C%EB%96%CA%A0%A52T%C6)*%C3%5E%86%CAP%19%D6-%95A%EB*%95q%F8%BB%E3%F9%AB%F6%E21%ACZ%B7%22%B7%9B%3F%02%85%CB%A2%5B%B7%BA%5E%B7%9C%97%E1%BC%0C%EB%16-%95%A12z%AC%0C%BFc%A22T%86uKe%D0%EA%B02V%DD%AD%8A%2B%8CWhe%5E%AF%CF%F5%3B%26%CE%CBh%5C%19%CE%CB%B0%F3%A4%095%A1%CAP%19*Ce%A8%0C%3BO*Ce%A8%0C%95%A12%3A%AD%8C%0A%82%7B%F0v%1F%2FD%A9%5B%9F%EE%EA%26%AF%03%CA%DF9%7B%19*Ce%A8%0C%95%A12T%86%CA%B8Ze%D8%CBP%19*Ce%A8%0C%95%D1ae%EC%F7%89I%E1%B4%D7M%D7P%8BjU%5C%BB%3E%F2%20%D8%CBP%19*Ce%A8%0C%95%A12T%C6%D5*%C3%5E%86%CAP%19*Ce%B4O%07%7B%F0W%7Bw%1C%7C%1A%8C%B3%3B%D1%EE%AA%5C%D6-%EBV%83%80%5E%D0%CA%10%5CU%2BD%E07YU%86%CAP%19*%E3%9A%95%91%D9%A0%C8%AD%5B%EDv%9E%82%FFKOee%E4%8FUe%A8%0C%95%A12T%C6%1F%A9%8C%C8%3D%5B%A5%15%FD%14%22r%E7B%9F%17l%F8%BF%ED%EAf%2B%7F%CF%ECe%D8%CBP%19*Ce%A8%0C%95%E1%93~%7B%19%F62T%86%CAP%19*Ce%A8%0C%E7%13%DA%CBP%19*Ce%A8%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4h%A9%0C%B3E%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4h%A9%0C%B3E%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%A9%0CZf%8B%16-Z%B4h%D1R%19f%8B%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1R%19%B4%CC%16-Z%B4h%D1%A2%A52%CC%16-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2%A52h%99-Z%B4h%D1%A2EKe%98-Z%B4h%D1%A2EKe%D02%5B%B4h%D1%A2EKe%D02%5B%B4h%D1%A2E%8B%96%CA0%5B%B4h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%96%CA%A0e%B6h%D1%A2E%8B%16-%95a%B6h%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-%95A%CBl%D1%A2E%8B%16-Z*%C3l%D1%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z*%83%96%D9%A2E%8B%16-Z%B4T%86%D9%A2E%8B%16-Z%B4T%06-%B3E%8B%16-Z%B4%AE%A4%F5%25%C0%00%DE%BF%5C'%0F%DA%B8q%00%00%00%00IEND%AEB%60%82") repeat-y !important;

    border-left: 1px solid #BBBBBB !important;

    border-right: 1px solid #000000 !important;

    border-bottom: 1px dashed #BBBBBB !important;

}



.overflowRulerX > .firebugRulerV {

    left: 0 !important;

}



.overflowRulerY > .firebugRulerH {

    top: 0 !important;

}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

.fbProxyElement {

    position: fixed !important;

    pointer-events: auto !important;

}

</style></head>

<!-- FunzioniSicurezza.asp -->



<body>
<link href="js/style.css" rel="stylesheet" type="text/css"><table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tbody>
<script language="javascript">
function Load()
{
	for (var iElementCounter = 0; iElementCounter < document.DomainOptions.length; iElementCounter++)
	{
		jsv_strNomeCheck = document.DomainOptions[iElementCounter].name
		
		// Controllo che l'elemento corrente sia un Check
		if (jsv_strNomeCheck.indexOf("_Check") != -1)
		{
			// Recupero l'oggetto Check
			jsv_objOggettoNomeCheck = document.getElementsByName(jsv_strNomeCheck)
			
			//alert ('jsv_strNomeCheck: ' + jsv_strNomeCheck)
			//alert(document.getElementsByName(jsv_strNomeCheck)[0].checked)
			
			if (document.getElementsByName(jsv_strNomeCheck)[0].checked)
			{
				// Faccio il Replace per avere solo l' articolo
				regexpAppoggio = /_Check/
				jsv_strIndiceCheck = jsv_strNomeCheck.replace(regexpAppoggio,"")
				
				//alert (jsv_strIndiceCheck)
				
				//Determino se esistono varianti per quel servizio dalla var vbsv_IDArticoloAggiuntivo
				jsv_strNomeVariante = jsv_strIndiceCheck + '_SelectVariante'				
				//alert("PrimadiAvereDefinitoNomeVariante")
				//alert (jsv_strNomeVariante)
				//alert(document.getElementsByName(jsv_strNomeVariante).length)
				
				jsv_EsisteOggettoNomeVariante = "NO"
				
				if (document.getElementsByName(jsv_strNomeVariante).length > 0)
				{
					//Esiste
					jsv_EsisteOggettoNomeVariante = "SI"
					
					//alert(jsv_EsisteOggettoNomeVariante)
					
					jsv_OggettoNomeVariante = document.getElementsByName(jsv_strNomeVariante)
					jsv_OggettoNomeVariante[0].disabled = false
					
					//alert(document.getElementsByName(jsv_strNomeVariante)[0].disabled)

				}
				
				//Controllo se è il print
				//6_998_QuantitaScelta
				//6_998_Formato
				jsv_strNomeQuantitaScelta = jsv_strIndiceCheck + '_QuantitaScelta'
					//alert(jsv_strNomeQuantitaScelta)
					//alert(document.getElementsByName(jsv_strNomeQuantitaScelta).length)
				
				if (document.getElementsByName(jsv_strNomeQuantitaScelta).length > 0)
				{
					//Abilita
					jsv_OggettoQuantitaScelta = document.getElementsByName(jsv_strNomeQuantitaScelta)
					jsv_OggettoQuantitaScelta[0].disabled = false
				}
				
				jsv_strNomeFormato = jsv_strIndiceCheck + '_Formato'
					//alert(jsv_strNomeFormato)
					//alert(document.getElementsByName(jsv_strNomeFormato).length)
				
				if (document.getElementsByName(jsv_strNomeFormato).length > 0)
				{
					//Abilita
					jsv_OggettoNomeFormato = document.getElementsByName(jsv_strNomeFormato)
					jsv_OggettoNomeFormato[0].disabled = false
				}
				
			}
		}
	}
}
</script>

<tr><td align="center" height="100%" valign="top">


<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
    <tbody><tr>
      <td height="100%" valign="top">

<style>
    @import url("styles/jquery-ui.css");
    @import url("styles/template.css");
</style>
<!--[if lt IE 8]><style>@import url("styles/template_lt_ie8.css");</style><![endif]-->

<script type="text/javascript" language="javascript" src="js/jquery-1.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery_blockUI.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>


</td><td align="center" height="100%" valign="top"><table border="0" cellpadding="0" cellspacing="3" width="100%">
	<tbody>
		<tr>
			<td align="center"><script language="JavaScript" type="text/javascript">

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function querySt(ji) {
	hu = window.location.search.substring(1);
	gy = hu.split("&");
	for (i=0;i<gy.length;i++) {
		ft = gy[i].split("=");
		if (ft[0] == ji) {
			return ft[1];
		}
	}
}
	
function init() {
	document.getElementById('Radio1').checked=false;
	document.getElementById('Radio2').checked=false;
	document.getElementById('Radio3').checked=false;

	var cd = querySt("CaricaDati");
	
	if (cd == "DaStessaLogin") {
		document.getElementById('Radio1').checked=true;
		return;
	}
	if (cd == "NuovaIscrizione") {
		document.getElementById('Radio3').checked=true;
		return;
	}
	var loginInt = "";
	var pwInt = "";
	if (loginInt != "" && pwInt != "") {
		document.getElementById('Radio2').checked=true;
		document.getElementById('LoginIntestatario').value = loginInt;
		document.getElementById('PwIntestatario').value = pwInt;
		document.getElementById('LoginIntestatario').disabled=false;
		document.getElementById('PwIntestatario').disabled=false;
		document.getElementById('BtnAltraLogin').disabled=false;
	}
}

window.onload = init; 
</script>
				<form novalidate="novalidate" action="SalvaDatiIntestatario_InAnagrafica.asp?IDSessione=5EE152AE-1DDD-4019-8CC0-B6A6EE7C1ED2" method="post" name="DatiDominio" id="DatiDominio">
					<br />
					<table class="tbl_cornice" id="Table2" border="0" cellpadding="0" cellspacing="0" width="700">
						<tbody>

							<tr>
								<td><input name="Lettera" value="Fis" type="hidden" />
									<input name="Lang" value="DEFAULT" type="hidden" />
									<font color="red">&nbsp;									</font></td>
							</tr>
							<tr>
								<td><fieldset>
									<!-- Italiano o Straniero ? -->
									<label for="Cittadinanza4"><b>I dati inseriti sono relativi ad:</b></label>
									<dl>
										<dt>
											<input checked="checked" name="Cittadinanza" id="Cittadinanza4" value="1" onclick="CittadinoItaliano_Straniero()" type="radio" />
											Un Cittadino Italiano </dt>
										<dt>
											<input name="Cittadinanza" id="Cittadinanza4" value="0" onclick="CittadinoItaliano_Straniero()" type="radio" />
											Un Cittadino Straniero </dt>
									</dl>
									<br />
									<!-- Nazioni -->
									<div id="p_Nazionalita" style="display: none;">
										<label for="Select_Nazionalita_Estera">Scegli la Nazionalit&agrave; <span class="asterisco">*</span></label>
										<select id="Select_Nazionalita_Estera" name="Select_Nazionalita_Estera" class="completo" onchange="javascript:int_ImpostaNazionalita(this.value)">
											<option value="_null" selected="selected">Scegli la Nazionalit&agrave;</option>
											<option value="AF">Afghana</option>
											<option value="AL">Albanese</option>
											<option value="DZ">Algerina</option>
											<option value="AD">Andorrana</option>
											<option value="AO">Angolana</option>
											<option value="AE">Araba (Emirati)</option>
											<option value="AR">Argentina</option>
											<option value="AM">Armena</option>
											<option value="AU">Australiana</option>
											<option value="AT">Austriaca</option>
											<option value="AZ">Azera</option>
											<option value="BS">Bahamense</option>
											<option value="BH">Bahreiniana</option>
											<option value="BD">Bangalese</option>
											<option value="BB">Barbadoregna</option>
											<option value="BE">Belga</option>
											<option value="BZ">Beliziana</option>
											<option value="BJ">Beninese</option>
											<option value="BT">Bhutanese</option>
											<option value="BY">Bielorussa</option>
											<option value="MM">Birmana</option>
											<option value="BO">Boliviana</option>
											<option value="BA">Bosniaca</option>
											<option value="BR">Brasiliana</option>
											<option value="BG">Bulgara</option>
											<option value="BF">Burkinab&eacute;</option>
											<option value="BI">Burundiana</option>
											<option value="KH">Cambogiana</option>
											<option value="CM">Camerunense</option>
											<option value="CA">Canadese</option>
											<option value="CV">Capoverdiana</option>
											<option value="CZ">Ceca</option>
											<option value="CL">Cilena</option>
											<option value="CN">Cinese</option>
											<option value="LK">Cingalese</option>
											<option value="CY">Cipriota</option>
											<option value="CO">Colombiana</option>
											<option value="CR">Costaricense</option>
											<option value="HR">Croata</option>
											<option value="CU">Cubana</option>
											<option value="DK">Danese</option>
											<option value="DO">Dominicana</option>
											<option value="DM">Dominicana</option>
											<option value="EG">Egiziana</option>
											<option value="EC">Equadoregna</option>
											<option value="ER">Eritrea</option>
											<option value="EE">Estone</option>
											<option value="ET">Etiope</option>
											<option value="Fj">Fijana</option>
											<option value="PH">Filippina</option>
											<option value="FI">Finlandese</option>
											<option value="FR">Francese</option>
											<option value="GE">Georgiana</option>
											<option value="GH">Ghanese</option>
											<option value="JM">Giamaicana</option>
											<option value="JP">Giapponese</option>
											<option value="JO">Giordana</option>
											<option value="GR">Greca</option>
											<option value="GD">Grenadiana</option>
											<option value="GL">Groenlandese</option>
											<option value="GT">Guatemalteca</option>
											<option value="GF">Guayanese</option>
											<option value="GN">Guineano</option>
											<option value="HT">Haitiana</option>
											<option value="HN">Honduregna</option>
											<option value="HK">Hongkongiana</option>
											<option value="IN">Indiana</option>
											<option value="ID">Indonesiana</option>
											<option value="GB">Inglese</option>
											<option value="IQ">Irachena</option>
											<option value="IR">Iraniana</option>
											<option value="IE">Irlandese</option>
											<option value="IS">Islandese</option>
											<option value="IL">Israeliana</option>
											<option value="IT">Italiana</option>
											<option value="CK">Ivoriana</option>
											<option value="KZ">Kazaka</option>
											<option value="KE">Keniana</option>
											<option value="KG">Kirghiza</option>
											<option value="KW">Kuwaitiana</option>
											<option value="LA">Laotiana</option>
											<option value="LV">Lettone</option>
											<option value="LB">Libanese</option>
											<option value="LR">Liberiana</option>
											<option value="LY">Libica</option>
											<option value="LI">Liechtensteinese</option>
											<option value="LT">Lituano</option>
											<option value="LU">Lussemburghese</option>
											<option value="MK">Macedone</option>
											<option value="MY">Malese</option>
											<option value="MG">Malgascia</option>
											<option value="MT">Maltese</option>
											<option value="MA">Marocchina</option>
											<option value="MU">Mauriziana</option>
											<option value="MX">Messicana</option>
											<option value="MD">Moldava</option>
											<option value="MC">Monegasca</option>
											<option value="MN">Mongola</option>
											<option value="ME">Montenegrino</option>
											<option value="NA">Namibiana</option>
											<option value="NC">Neo Caledone</option>
											<option value="NZ">Neo Zelandese</option>
											<option value="NP">Nepalese</option>
											<option value="NI">Nicaraguense</option>
											<option value="NG">Nigeriana</option>
											<option value="KP">Nord Coreana</option>
											<option value="NO">Norvegese</option>
											<option value="NL">Olandese</option>
											<option value="PK">Pakistan</option>
											<option value="PA">Panamense</option>
											<option value="PY">Paraguayana</option>
											<option value="PE">Peruviana</option>
											<option value="PL">Polacco</option>
											<option value="PF">Polinesiana</option>
											<option value="PT">Portoghese</option>
											<option value="PR">Portoricana</option>
											<option value="RW">Ruandese</option>
											<option value="RO">Rumena</option>
											<option value="RU">Russa</option>
											<option value="SV">Salvadoregna</option>
											<option value="SM">Sammarinese</option>
											<option value="WS">Samoana (Occidentale)</option>
											<option value="AS">Samoana (USA)</option>
											<option value="SA">Saudita</option>
											<option value="SN">Senegalese</option>
											<option value="RS">serba</option>
											<option value="SC">Seychelles</option>
											<option value="SG">Singaporegna</option>
											<option value="SY">Siriana</option>
											<option value="SK">Slovacca</option>
											<option value="SI">Slovena</option>
											<option value="SO">Somale</option>
											<option value="ES">Spagnola</option>
											<option value="US">Statunitense</option>
											<option value="KP">Sud Coreana</option>
											<option value="ZA">Sudafricana</option>
											<option value="SD">Sudanese</option>
											<option value="SE">Svedese</option>
											<option value="CH">Svizzera</option>
											<option value="TJ">Tagika</option>
											<option value="TZ">Tanzana</option>
											<option value="DE">Tedesca</option>
											<option value="TH">Thailandese</option>
											<option value="TP">Timorese</option>
											<option value="TG">Togolese</option>
											<option value="TN">Tunisina</option>
											<option value="TR">Turca</option>
											<option value="UA">Ucraina</option>
											<option value="UG">Ugandese</option>
											<option value="HU">Ungherese</option>
											<option value="UY">Uruguaiana</option>
											<option value="UZ">Uzbeka</option>
											<option value="VA">Vaticana</option>
											<option value="VE">Venezuelana</option>
											<option value="VN">Vietnamita</option>
											<option value="YE">Yemenita</option>
											<option value="ZW">Zimbawese</option>
										</select>
										<div id="lblNazionalita" class="txterrore" style="display:none;">Specificare la nazione di residenza</div>
										<br />
									</div>
									<!-- Nome -->
									<label for="0_0_NomeInt">Nome <span class="asterisco">*</span></label>
									<input name="0_0_NomeInt" class="completo" maxlength="100" id="0_0_NomeInt" type="text" />
									<div id="lblNome" class="txterrore" style="display:none;">Inserire il nome</div>
									<br />
									<!-- Cognome -->
									<label for="0_0_CognomeInt">Cognome <span class="asterisco">*</span></label>
									<input name="0_0_CognomeInt" class="completo" maxlength="150" id="0_0_CognomeInt" type="text" />
									<div id="lblCognome" class="txterrore" style="display:none;">Inserire il cognome</div>
									<br />
									<!-- Indirizzo -->
									<label for="0_0_IndirizzoInt">Indirizzo <span class="asterisco">*</span></label>
									<input name="0_0_IndirizzoInt" class="completo" maxlength="150" id="0_0_IndirizzoInt" type="text" />
									<div id="lblIndirizzo" class="txterrore" style="display:none;">Inserire l'indirizzo</div>
									<br />
									<!-- Numero Civico -->
									<label for="0_0_NumCivico">Num. Civico <span class="asterisco">*</span></label>
									<input name="0_0_NumCivico" class="completo" maxlength="6" id="0_0_NumCivico" type="text" />
									<div id="lblNumCivico" class="txterrore" style="display:none;">Inserire il numero civico</div>
									<br />
									<!-- CAP -->
									<label for="0_0_CapInt">CAP <span class="asterisco">*</span></label>
									<input name="0_0_CapInt" class="completo" maxlength="5" id="0_0_CapInt" type="text" />
									<div id="lblCap" class="txterrore" style="display:none;">Inserire il codice di avviamento postale</div>
									<br />
									<div id="divNazione" style="display:inline;">
										<label for="0_0_NazioneInt">Nazione <span class="asterisco">*</span></label>
										<select name="0_0_NazioneInt" id="0_0_NazioneInt" class="completo" onchange="javascript:AggiornaPr_Comune('DEFAULT','','')">
											<option value="_null">Seleziona Nazione</option>
											<option value="AF">AFGHANISTAN</option>
											<option value="AL">ALBANIA</option>
											<option value="DZ">ALGERIA</option>
											<option value="AD">ANDORRA</option>
											<option value="AO">ANGOLA</option>
											<option value="AI">ANGUILLA</option>
											<option value="AO">ANTARTIDE</option>
											<option value="AG">ANTIGUA E BARBUDA</option>
											<option value="SA">ARABIA SAUDITA</option>
											<option value="AR">ARGENTINA</option>
											<option value="AM">ARMENIA</option>
											<option value="AW">ARUBA</option>
											<option value="AU">AUSTRALIA</option>
											<option value="AT">AUSTRIA</option>
											<option value="AZ">AZERBAIGIAN</option>
											<option value="BS">BAHAMAS</option>
											<option value="BH">BAHRAIN</option>
											<option value="BD">BANGLADESH</option>
											<option value="BB">BARBADOS</option>
											<option value="BE">BELGIO</option>
											<option value="BZ">BELIZE</option>
											<option value="BJ">BENIN</option>
											<option value="BM">BERMUDA</option>
											<option value="BT">BHUTAN</option>
											<option value="BY">BIELORUSSIA</option>
											<option value="MM">BIRMANIA</option>
											<option value="BO">BOLIVIA</option>
											<option value="BA">BOSNIA ED ERZEGOVINA</option>
											<option value="BW">BOTSWANA</option>
											<option value="BR">BRASILE</option>
											<option value="BN">BRUNEI</option>
											<option value="BG">BULGARIA</option>
											<option value="BF">BURKINA FASO</option>
											<option value="BI">BURUNDI</option>
											<option value="KH">CAMBOGIA</option>
											<option value="CM">CAMERUN</option>
											<option value="CA">CANADA</option>
											<option value="CV">CAPO VERDE</option>
											<option value="TD">CIAD</option>
											<option value="CL">CILE</option>
											<option value="CN">CINA</option>
											<option value="CY">CIPRO</option>
											<option value="VA">CITTA' DEL VATICANO</option>
											<option value="CO">COLOMBIA</option>
											<option value="KM">COMORE</option>
											<option value="KP">COREA DEL NORD</option>
											<option value="KP">COREA DEL SUD</option>
											<option value="CK">COSTA D'AVORIO</option>
											<option value="CR">COSTA RICA</option>
											<option value="HR">CROAZIA</option>
											<option value="CU">CUBA</option>
											<option value="AN">CURACAO</option>
											<option value="DK">DANIMARCA</option>
											<option value="DM">DOMINICA</option>
											<option value="EC">ECUADOR</option>
											<option value="EG">EGITTO</option>
											<option value="SV">EL SALVADOR</option>
											<option value="AE">EMIRATI ARABI UNITI</option>
											<option value="ER">ERITREA</option>
											<option value="EE">ESTONIA</option>
											<option value="ET">ETIOPIA</option>
											<option value="Fj">FIGI</option>
											<option value="PH">FILIPPINE</option>
											<option value="FI">FINLANDIA</option>
											<option value="FR">FRANCIA</option>
											<option value="GA">GABON</option>
											<option value="GM">GAMBIA</option>
											<option value="GE">GEORGIA</option>
											<option value="GS">GEORGIA D. SUD E I. SANDWICH</option>
											<option value="DE">GERMANIA</option>
											<option value="GH">GHANA</option>
											<option value="JM">GIAMAICA</option>
											<option value="JP">GIAPPONE</option>
											<option value="GI">GIBILTERRA</option>
											<option value="DJ">GIBUTI</option>
											<option value="JO">GIORDANIA</option>
											<option value="GR">GRECIA</option>
											<option value="GD">GRENADA</option>
											<option value="GL">GROENLANDIA</option>
											<option value="GP">GUADALUPA</option>
											<option value="GU">GUAM</option>
											<option value="GT">GUATEMALA</option>
											<option value="GG">GUERNSEY</option>
											<option value="GN">GUINEA</option>
											<option value="GQ">GUINEA EQUATORIALE</option>
											<option value="GW">GUINEA-BISSAU</option>
											<option value="GY">GUYANA</option>
											<option value="GF">GUYANA FRANCESE</option>
											<option value="HT">HAITI</option>
											<option value="HN">HONDURAS</option>
											<option value="HK">HONG KONG</option>
											<option value="IN">INDIA</option>
											<option value="ID">INDONESIA</option>
											<option value="IR">IRAN</option>
											<option value="IQ">IRAQ</option>
											<option value="IE">IRLANDA</option>
											<option value="IS">ISLANDA</option>
											<option value="AX">ISOLA ALAND</option>
											<option value="BV">ISOLA BOUVET</option>
											<option value="IM">ISOLA DI MAN</option>
											<option value="CX">ISOLA DI NATALE</option>
											<option value="NF">ISOLA NORFOLK</option>
											<option value="BQ">ISOLE BES</option>
											<option value="KY">ISOLE CAYMAN</option>
											<option value="CC">ISOLE COCOS E KEELING</option>
											<option value="CK">ISOLE COOK</option>
											<option value="FO">ISOLE FAER OER</option>
											<option value="FK">ISOLE FALKLAND</option>
											<option value="HM">ISOLE HEARD E MCDONALD</option>
											<option value="MP">ISOLE MARIANNE SETTENTRIONALI</option>
											<option value="MH">ISOLE MARSHALL</option>
											<option value="UM">ISOLE MINORI DEGLI STATI UNITI</option>
											<option value="PN">ISOLE PITCAIRN</option>
											<option value="SB">ISOLE SALOMONE</option>
											<option value="VI">ISOLE VERGINI AMERICANE</option>
											<option value="VG">ISOLE VERGINI BRITANNICHE</option>
											<option value="IL">ISRAELE</option>
											<option value="IT" selected="selected">ITALIA</option>
											<option value="JE">JERSEY</option>
											<option value="KZ">KAZAKISTAN</option>
											<option value="KE">KENYA</option>
											<option value="KG">KIRGHIZISTAN</option>
											<option value="KI">KIRIBATI</option>
											<option value="KW">KUWAIT</option>
											<option value="LA">LAOS</option>
											<option value="LS">LESOTHO</option>
											<option value="LV">LETTONIA</option>
											<option value="LB">LIBANO</option>
											<option value="LR">LIBERIA</option>
											<option value="LY">LIBIA</option>
											<option value="LI">LIECHTENSTEIN</option>
											<option value="LT">LITUANIA</option>
											<option value="LU">LUSSEMBURGO</option>
											<option value="MO">MACAO</option>
											<option value="MG">MADAGASCAR</option>
											<option value="MW">MALAWI</option>
											<option value="MV">MALDIVE</option>
											<option value="MY">MALESIA</option>
											<option value="ML">MALI</option>
											<option value="MT">MALTA</option>
											<option value="MA">MAROCCO</option>
											<option value="MQ">MARTINICA</option>
											<option value="MR">MAURITANIA</option>
											<option value="MU">MAURITIUS</option>
											<option value="YT">MAYOTTE</option>
											<option value="MX">MESSICO</option>
											<option value="FM">MICRONESIA</option>
											<option value="MD">MOLDAVIA</option>
											<option value="MN">MONGOLIA</option>
											<option value="ME">MONTENEGRO</option>
											<option value="MS">MONTSERRAT</option>
											<option value="MZ">MOZAMBICO</option>
											<option value="NA">NAMIBIA</option>
											<option value="NR">NAURU</option>
											<option value="NP">NEPAL</option>
											<option value="NI">NICARAGUA</option>
											<option value="NE">NIGER</option>
											<option value="NG">NIGERIA</option>
											<option value="NU">NIUE</option>
											<option value="NO">NORVEGIA</option>
											<option value="NC">NUOVA CALEDONIA</option>
											<option value="NZ">NUOVA ZELANDA</option>
											<option value="OM">OMAN</option>
											<option value="NL">PAESI BASSI</option>
											<option value="PK">PAKISTAN</option>
											<option value="PW">PALAU</option>
											<option value="PS">PALESTINA</option>
											<option value="PA">PANAMA</option>
											<option value="PG">PAPUA NUOVA GUINEA</option>
											<option value="PY">PARAGUAY</option>
											<option value="PE">PERU'</option>
											<option value="PF">POLINESIA FRANCESE</option>
											<option value="PL">POLONIA</option>
											<option value="PR">PORTO RICO</option>
											<option value="PT">PORTOGALLO</option>
											<option value="MC">PRINCIPATO DI MONACO</option>
											<option value="QA">QATAR</option>
											<option value="GB">REGNO UNITO</option>
											<option value="CG">REP. DEMOCRATICA DEL CONGO</option>
											<option value="DO">REP. DOMINICANA</option>
											<option value="CZ">REPUBBLICA CECA</option>
											<option value="CF">REPUBBLICA CENTRAFRICANA</option>
											<option value="CG">REPUBBLICA DEL CONGO</option>
											<option value="MK">REPUBBLICA DI MACEDONIA</option>
											<option value="RE">RIUNIONE</option>
											<option value="RO">ROMANIA</option>
											<option value="RW">RUANDA</option>
											<option value="RU">RUSSIA</option>
											<option value="EH">SAHARA OCCIDENTALE</option>
											<option value="KN">SAINT KITTS E NEVIS</option>
											<option value="PM">SAINT PIERRE ET MIQUELON</option>
											<option value="VC">SAINT VINCENT E GRENADINE</option>
											<option value="BL">SAINT-BARTHELEMY</option>
											<option value="MF">SAINT-MARTIN</option>
											<option value="WS">SAMOA</option>
											<option value="AS">SAMOA AMERICANE</option>
											<option value="SM">SAN MARINO</option>
											<option value="LC">SANTA LUCIA</option>
											<option value="SH">SANT'ELENA</option>
											<option value="ST">SAO TOME E PRINCIPE</option>
											<option value="SN">SENEGAL</option>
											<option value="RS">SERBIA</option>
											<option value="SC">SEYCHELLES</option>
											<option value="SL">SIERRA LEONE</option>
											<option value="SG">SINGAPORE</option>
											<option value="SX">SINT MAARTEN</option>
											<option value="SY">SIRIA</option>
											<option value="SK">SLOVACCHIA</option>
											<option value="SI">SLOVENIA</option>
											<option value="SO">SOMALIA</option>
											<option value="ES">SPAGNA</option>
											<option value="LK">SRI LANKA</option>
											<option value="US">STATI UNITI D'AMERICA</option>
											<option value="ZA">SUDAFRICANA</option>
											<option value="SD">SUDAN</option>
											<option value="SS">SUDAN DEL SUD</option>
											<option value="SR">SURINAME</option>
											<option value="SJ">SVALBARD E JAN MAYEN</option>
											<option value="SE">SVEZIA</option>
											<option value="CH">SVIZZERA</option>
											<option value="SZ">SWAZILAND</option>
											<option value="TF">T. AUSTRALI E ANT. FRANCESI</option>
											<option value="IO">T. BRITANNICO DELL'OCEANO IND.</option>
											<option value="TJ">TAGIKISTAN</option>
											<option value="TW">TAIWAN</option>
											<option value="TZ">TANZANIA</option>
											<option value="TH">THAILANDIA</option>
											<option value="TP">TIMOR EST</option>
											<option value="TG">TOGO</option>
											<option value="TK">TOKELAU</option>
											<option value="TO">TONGA</option>
											<option value="TT">TRINIDAD E TOBAGO</option>
											<option value="TN">TUNISIA</option>
											<option value="TR">TURCHIA</option>
											<option value="TM">TURKMENISTAN</option>
											<option value="TC">TURKS E CAICOS</option>
											<option value="TV">TUVALU</option>
											<option value="UA">UCRAINA</option>
											<option value="UG">UGANDA</option>
											<option value="HU">UNGHERIA</option>
											<option value="UY">URUGUAY</option>
											<option value="UZ">UZBEKISTAN</option>
											<option value="VU">VANUATU</option>
											<option value="VE">VENEZUELA</option>
											<option value="VN">VIETNAM</option>
											<option value="WF">WALLIS E FUTUNA</option>
											<option value="YE">YEMEN</option>
											<option value="ZM">ZAMBIA</option>
											<option value="ZW">ZIMBAWE</option>
										</select>
										<div id="lblNazione" class="txterrore" style="display:none;">Specificare la nazione di residenza</div>
										<br />
									</div>
									<!-- Province: visualizzate solo se Italia -->
									<div id="divProvince" style="">
										<label for="Province">Provincia di Residenza *</label>
										<select class="completo" name="Province" onchange="javascript:AggiornaComuni(this.value, false)" id="Province">
											<option selected="selected" value="_null">Seleziona Provincia</option>
											<option value="AG">AG</option>
											<option value="AL">AL</option>
											<option value="AN">AN</option>
											<option value="AO">AO</option>
											<option value="AP">AP</option>
											<option value="AQ">AQ</option>
											<option value="AR">AR</option>
											<option value="AT">AT</option>
											<option value="AV">AV</option>
											<option value="BA">BA</option>
											<option value="BG">BG</option>
											<option value="BI">BI</option>
											<option value="BL">BL</option>
											<option value="BN">BN</option>
											<option value="BO">BO</option>
											<option value="BR">BR</option>
											<option value="BS">BS</option>
											<option value="BT">BT</option>
											<option value="BZ">BZ</option>
											<option value="CA">CA</option>
											<option value="CB">CB</option>
											<option value="CE">CE</option>
											<option value="CH">CH</option>
											<option value="CI">CI</option>
											<option value="CL">CL</option>
											<option value="CN">CN</option>
											<option value="CO">CO</option>
											<option value="CR">CR</option>
											<option value="CS">CS</option>
											<option value="CT">CT</option>
											<option value="CZ">CZ</option>
											<option value="EN">EN</option>
											<option value="FC">FC</option>
											<option value="FE">FE</option>
											<option value="FG">FG</option>
											<option value="FI">FI</option>
											<option value="FM">FM</option>
											<option value="FR">FR</option>
											<option value="GE">GE</option>
											<option value="GO">GO</option>
											<option value="GR">GR</option>
											<option value="IM">IM</option>
											<option value="IS">IS</option>
											<option value="KR">KR</option>
											<option value="LC">LC</option>
											<option value="LE">LE</option>
											<option value="LI">LI</option>
											<option value="LO">LO</option>
											<option value="LT">LT</option>
											<option value="LU">LU</option>
											<option value="MB">MB</option>
											<option value="MC">MC</option>
											<option value="ME">ME</option>
											<option value="MI">MI</option>
											<option value="MN">MN</option>
											<option value="MO">MO</option>
											<option value="MS">MS</option>
											<option value="MT">MT</option>
											<option value="NA">NA</option>
											<option value="NO">NO</option>
											<option value="NU">NU</option>
											<option value="OG">OG</option>
											<option value="OR">OR</option>
											<option value="OT">OT</option>
											<option value="PA">PA</option>
											<option value="PC">PC</option>
											<option value="PD">PD</option>
											<option value="PE">PE</option>
											<option value="PG">PG</option>
											<option value="PI">PI</option>
											<option value="PN">PN</option>
											<option value="PO">PO</option>
											<option value="PR">PR</option>
											<option value="PT">PT</option>
											<option value="PU">PU</option>
											<option value="PV">PV</option>
											<option value="PZ">PZ</option>
											<option value="RA">RA</option>
											<option value="RC">RC</option>
											<option value="RE">RE</option>
											<option value="RG">RG</option>
											<option value="RI">RI</option>
											<option value="RM">RM</option>
											<option value="RN">RN</option>
											<option value="RO">RO</option>
											<option value="SA">SA</option>
											<option value="SI">SI</option>
											<option value="SO">SO</option>
											<option value="SP">SP</option>
											<option value="SR">SR</option>
											<option value="SS">SS</option>
											<option value="SV">SV</option>
											<option value="TA">TA</option>
											<option value="TE">TE</option>
											<option value="TN">TN</option>
											<option value="TO">TO</option>
											<option value="TP">TP</option>
											<option value="TR">TR</option>
											<option value="TS">TS</option>
											<option value="TV">TV</option>
											<option value="UD">UD</option>
											<option value="VA">VA</option>
											<option value="VB">VB</option>
											<option value="VC">VC</option>
											<option value="VE">VE</option>
											<option value="VI">VI</option>
											<option value="VR">VR</option>
											<option value="VS">VS</option>
											<option value="VT">VT</option>
											<option value="VV">VV</option>
										</select>
										<div id="lblProvince" class="txterrore" style="display:none;">Inserire Comune e Provincia di residenza</div>
										<br />
									</div>
									<!-- Comuni: visualizzate solo se Italia, ricaricate da Provincia -->
									<div id="divComuni" style="">
										<label for="Comune">Comune di Residenza *</label>
										<select class="completo" name="Comune" id="Comune">
											<option selected="selected" value="_null">Seleziona Comune</option>
										</select>
										<div id="lblComune" class="txterrore" style="display:none;">Inserire Comune e Provincia di residenza se residente in Italia, altrimenti la Citt&agrave; e la Nazione di residenza</div>
										<br />
									</div>
									<!-- Comune Straniero: visualizzato solo se diverso da Italia -->
									<div id="divComuneStraniero" style="display: none;">
										<label for="ComuneStraniero">Citt&agrave; <span class="asterisco">*</span></label>
										<input class="completo" name="ComuneStraniero" id="ComuneStraniero" maxlength="100" type="text" />
										<div id="lblComuneStraniero" class="txterrore" style="display:none;">Inserire Comune e Provincia di residenza se residente in Italia, altrimenti la Citt&agrave; e la Nazione di residenza</div>
										<br />
									</div>
									<!-- Telefono -->
									<label for="0_0_PrefissoTelInt">Telefono <span class="asterisco">*</span></label>
									<select class="mezzo" name="0_0_PrefissoTelInt" onchange="TogliScroll()" id="0_0_PrefissoTelInt">
										<option value="_null"></option>
										<option value="+93">+93&nbsp;AFGHANISTAN</option>
										<option value="+355">+355&nbsp;ALBANIA</option>
										<option value="+213">+213&nbsp;ALGERIA</option>
										<option value="+376">+376&nbsp;ANDORRA</option>
										<option value="+244">+244&nbsp;ANGOLA</option>
										<option value="+1139">+1139&nbsp;ANGUILLA</option>
										<option value="+6721">+6721&nbsp;ANTARTIDE</option>
										<option value="+1268">+1268&nbsp;ANTIGUA E BARBUDA</option>
										<option value="+966">+966&nbsp;ARABIA SAUDITA</option>
										<option value="+54">+54&nbsp;ARGENTINA</option>
										<option value="+374">+374&nbsp;ARMENIA</option>
										<option value="+297">+297&nbsp;ARUBA</option>
										<option value="+61">+61&nbsp;AUSTRALIA</option>
										<option value="+43">+43&nbsp;AUSTRIA</option>
										<option value="+994">+994&nbsp;AZERBAIGIAN</option>
										<option value="+1242">+1242&nbsp;BAHAMAS</option>
										<option value="+973">+973&nbsp;BAHRAIN</option>
										<option value="+880">+880&nbsp;BANGLADESH</option>
										<option value="+1246">+1246&nbsp;BARBADOS</option>
										<option value="+32">+32&nbsp;BELGIO</option>
										<option value="+501">+501&nbsp;BELIZE</option>
										<option value="+229">+229&nbsp;BENIN</option>
										<option value="+1441">+1441&nbsp;BERMUDA</option>
										<option value="+975">+975&nbsp;BHUTAN</option>
										<option value="+375">+375&nbsp;BIELORUSSIA</option>
										<option value="+95">+95&nbsp;BIRMANIA</option>
										<option value="+591">+591&nbsp;BOLIVIA</option>
										<option value="+387">+387&nbsp;BOSNIA ED ERZEGOVINA</option>
										<option value="+267">+267&nbsp;BOTSWANA</option>
										<option value="+55">+55&nbsp;BRASILE</option>
										<option value="+673">+673&nbsp;BRUNEI</option>
										<option value="+359">+359&nbsp;BULGARIA</option>
										<option value="+226">+226&nbsp;BURKINA FASO</option>
										<option value="+257">+257&nbsp;BURUNDI</option>
										<option value="+855">+855&nbsp;CAMBOGIA</option>
										<option value="+237">+237&nbsp;CAMERUN</option>
										<option value="+1">+1&nbsp;CANADA</option>
										<option value="+238">+238&nbsp;CAPO VERDE</option>
										<option value="+235">+235&nbsp;CIAD</option>
										<option value="+56">+56&nbsp;CILE</option>
										<option value="+86">+86&nbsp;CINA</option>
										<option value="+357">+357&nbsp;CIPRO</option>
										<option value="+39">+39&nbsp;CITTA' DEL VATICANO</option>
										<option value="+57">+57&nbsp;COLOMBIA</option>
										<option value="+269">+269&nbsp;COMORE</option>
										<option value="+850">+850&nbsp;COREA DEL NORD</option>
										<option value="+82">+82&nbsp;COREA DEL SUD</option>
										<option value="+225">+225&nbsp;COSTA D'AVORIO</option>
										<option value="+506">+506&nbsp;COSTA RICA</option>
										<option value="+385">+385&nbsp;CROAZIA</option>
										<option value="+53">+53&nbsp;CUBA</option>
										<option value="+5999">+5999&nbsp;CURACAO</option>
										<option value="+45">+45&nbsp;DANIMARCA</option>
										<option value="+1767">+1767&nbsp;DOMINICA</option>
										<option value="+593">+593&nbsp;ECUADOR</option>
										<option value="+20">+20&nbsp;EGITTO</option>
										<option value="+503">+503&nbsp;EL SALVADOR</option>
										<option value="+971">+971&nbsp;EMIRATI ARABI UNITI</option>
										<option value="+291">+291&nbsp;ERITREA</option>
										<option value="+372">+372&nbsp;ESTONIA</option>
										<option value="+251">+251&nbsp;ETIOPIA</option>
										<option value="+679">+679&nbsp;FIGI</option>
										<option value="+63">+63&nbsp;FILIPPINE</option>
										<option value="+358">+358&nbsp;FINLANDIA</option>
										<option value="+33">+33&nbsp;FRANCIA</option>
										<option value="+241">+241&nbsp;GABON</option>
										<option value="+220">+220&nbsp;GAMBIA</option>
										<option value="+995">+995&nbsp;GEORGIA</option>
										<option value="+44">+44&nbsp;GEORGIA D. SUD E I. SANDWICH</option>
										<option value="+49">+49&nbsp;GERMANIA</option>
										<option value="+233">+233&nbsp;GHANA</option>
										<option value="+1876">+1876&nbsp;GIAMAICA</option>
										<option value="+81">+81&nbsp;GIAPPONE</option>
										<option value="+350">+350&nbsp;GIBILTERRA</option>
										<option value="+253">+253&nbsp;GIBUTI</option>
										<option value="+962">+962&nbsp;GIORDANIA</option>
										<option value="+30">+30&nbsp;GRECIA</option>
										<option value="+1473">+1473&nbsp;GRENADA</option>
										<option value="+299">+299&nbsp;GROENLANDIA</option>
										<option value="+590">+590&nbsp;GUADALUPA</option>
										<option value="+671">+671&nbsp;GUAM</option>
										<option value="+502">+502&nbsp;GUATEMALA</option>
										<option value="+44">+44&nbsp;GUERNSEY</option>
										<option value="+224">+224&nbsp;GUINEA</option>
										<option value="+240">+240&nbsp;GUINEA EQUATORIALE</option>
										<option value="+245">+245&nbsp;GUINEA-BISSAU</option>
										<option value="+592">+592&nbsp;GUYANA</option>
										<option value="+594">+594&nbsp;GUYANA FRANCESE</option>
										<option value="+509">+509&nbsp;HAITI</option>
										<option value="+504">+504&nbsp;HONDURAS</option>
										<option value="+852">+852&nbsp;HONG KONG</option>
										<option value="+91">+91&nbsp;INDIA</option>
										<option value="+62">+62&nbsp;INDONESIA</option>
										<option value="+98">+98&nbsp;IRAN</option>
										<option value="+964">+964&nbsp;IRAQ</option>
										<option value="+353">+353&nbsp;IRLANDA</option>
										<option value="+354">+354&nbsp;ISLANDA</option>
										<option value="+358">+358&nbsp;ISOLA ALAND</option>
										<option value="+47">+47&nbsp;ISOLA BOUVET</option>
										<option value="+44">+44&nbsp;ISOLA DI MAN</option>
										<option value="+261">+261&nbsp;ISOLA DI NATALE</option>
										<option value="+672">+672&nbsp;ISOLA NORFOLK</option>
										<option value="+599">+599&nbsp;ISOLE BES</option>
										<option value="+134">+134&nbsp;ISOLE CAYMAN</option>
										<option value="+672">+672&nbsp;ISOLE COCOS E KEELING</option>
										<option value="+682">+682&nbsp;ISOLE COOK</option>
										<option value="+298">+298&nbsp;ISOLE FAER OER</option>
										<option value="Z609">Z609&nbsp;ISOLE FALKLAND</option>
										<option value="+61">+61&nbsp;ISOLE HEARD E MCDONALD</option>
										<option value="+16">+16&nbsp;ISOLE MARIANNE SETTENTRIONALI</option>
										<option value="+692">+692&nbsp;ISOLE MARSHALL</option>
										<option value="+1">+1&nbsp;ISOLE MINORI DEGLI STATI UNITI</option>
										<option value="+649">+649&nbsp;ISOLE PITCAIRN</option>
										<option value="+677">+677&nbsp;ISOLE SALOMONE</option>
										<option value="+1340">+1340&nbsp;ISOLE VERGINI AMERICANE</option>
										<option value="+1284">+1284&nbsp;ISOLE VERGINI BRITANNICHE</option>
										<option value="+972">+972&nbsp;ISRAELE</option>
										<option value="+39" selected="selected">+39&nbsp;ITALIA</option>
										<option value="+44">+44&nbsp;JERSEY</option>
										<option value="+996">+996&nbsp;KAZAKISTAN</option>
										<option value="+254">+254&nbsp;KENYA</option>
										<option value="+996">+996&nbsp;KIRGHIZISTAN</option>
										<option value="+686">+686&nbsp;KIRIBATI</option>
										<option value="+965">+965&nbsp;KUWAIT</option>
										<option value="+856">+856&nbsp;LAOS</option>
										<option value="+266">+266&nbsp;LESOTHO</option>
										<option value="+371">+371&nbsp;LETTONIA</option>
										<option value="+961">+961&nbsp;LIBANO</option>
										<option value="+231">+231&nbsp;LIBERIA</option>
										<option value="+218">+218&nbsp;LIBIA</option>
										<option value="+423">+423&nbsp;LIECHTENSTEIN</option>
										<option value="+370">+370&nbsp;LITUANIA</option>
										<option value="+352">+352&nbsp;LUSSEMBURGO</option>
										<option value="+853">+853&nbsp;MACAO</option>
										<option value="+261">+261&nbsp;MADAGASCAR</option>
										<option value="+265">+265&nbsp;MALAWI</option>
										<option value="+960">+960&nbsp;MALDIVE</option>
										<option value="+60">+60&nbsp;MALESIA</option>
										<option value="+223">+223&nbsp;MALI</option>
										<option value="+356">+356&nbsp;MALTA</option>
										<option value="+212">+212&nbsp;MAROCCO</option>
										<option value="+596">+596&nbsp;MARTINICA</option>
										<option value="+222">+222&nbsp;MAURITANIA</option>
										<option value="+230">+230&nbsp;MAURITIUS</option>
										<option value="+269">+269&nbsp;MAYOTTE</option>
										<option value="+52">+52&nbsp;MESSICO</option>
										<option value="+691">+691&nbsp;MICRONESIA</option>
										<option value="+373">+373&nbsp;MOLDAVIA</option>
										<option value="+976">+976&nbsp;MONGOLIA</option>
										<option value="+382">+382&nbsp;MONTENEGRO</option>
										<option value="+1664">+1664&nbsp;MONTSERRAT</option>
										<option value="+258">+258&nbsp;MOZAMBICO</option>
										<option value="+264">+264&nbsp;NAMIBIA</option>
										<option value="+674">+674&nbsp;NAURU</option>
										<option value="+977">+977&nbsp;NEPAL</option>
										<option value="+505">+505&nbsp;NICARAGUA</option>
										<option value="+227">+227&nbsp;NIGER</option>
										<option value="+234">+234&nbsp;NIGERIA</option>
										<option value="+683">+683&nbsp;NIUE</option>
										<option value="+47">+47&nbsp;NORVEGIA</option>
										<option value="+687">+687&nbsp;NUOVA CALEDONIA</option>
										<option value="+64">+64&nbsp;NUOVA ZELANDA</option>
										<option value="+968">+968&nbsp;OMAN</option>
										<option value="+31">+31&nbsp;PAESI BASSI</option>
										<option value="+92">+92&nbsp;PAKISTAN</option>
										<option value="+680">+680&nbsp;PALAU</option>
										<option value="+970">+970&nbsp;PALESTINA</option>
										<option value="+507">+507&nbsp;PANAMA</option>
										<option value="+675">+675&nbsp;PAPUA NUOVA GUINEA</option>
										<option value="+595">+595&nbsp;PARAGUAY</option>
										<option value="+51">+51&nbsp;PERU'</option>
										<option value="+689">+689&nbsp;POLINESIA FRANCESE</option>
										<option value="+48">+48&nbsp;POLONIA</option>
										<option value="+1787">+1787&nbsp;PORTO RICO</option>
										<option value="+351">+351&nbsp;PORTOGALLO</option>
										<option value="+377">+377&nbsp;PRINCIPATO DI MONACO</option>
										<option value="+974">+974&nbsp;QATAR</option>
										<option value="+44">+44&nbsp;REGNO UNITO</option>
										<option value="+243">+243&nbsp;REP. DEMOCRATICA DEL CONGO</option>
										<option value="+1809">+1809&nbsp;REP. DOMINICANA</option>
										<option value="+420">+420&nbsp;REPUBBLICA CECA</option>
										<option value="+236">+236&nbsp;REPUBBLICA CENTRAFRICANA</option>
										<option value="+242">+242&nbsp;REPUBBLICA DEL CONGO</option>
										<option value="+389">+389&nbsp;REPUBBLICA DI MACEDONIA</option>
										<option value="+262">+262&nbsp;RIUNIONE</option>
										<option value="+40">+40&nbsp;ROMANIA</option>
										<option value="+250">+250&nbsp;RUANDA</option>
										<option value="+7">+7&nbsp;RUSSIA</option>
										<option value="+212">+212&nbsp;SAHARA OCCIDENTALE</option>
										<option value="+1869">+1869&nbsp;SAINT KITTS E NEVIS</option>
										<option value="+508">+508&nbsp;SAINT PIERRE ET MIQUELON</option>
										<option value="+1784">+1784&nbsp;SAINT VINCENT E GRENADINE</option>
										<option value="+590">+590&nbsp;SAINT-BARTHELEMY</option>
										<option value="+599">+599&nbsp;SAINT-MARTIN</option>
										<option value="+685">+685&nbsp;SAMOA</option>
										<option value="+684">+684&nbsp;SAMOA AMERICANE</option>
										<option value="+39">+39&nbsp;SAN MARINO</option>
										<option value="+17">+17&nbsp;SANTA LUCIA</option>
										<option value="+290">+290&nbsp;SANT'ELENA</option>
										<option value="+239">+239&nbsp;SAO TOME E PRINCIPE</option>
										<option value="+221">+221&nbsp;SENEGAL</option>
										<option value="+381">+381&nbsp;SERBIA</option>
										<option value="+248">+248&nbsp;SEYCHELLES</option>
										<option value="+232">+232&nbsp;SIERRA LEONE</option>
										<option value="+65">+65&nbsp;SINGAPORE</option>
										<option value="+1721">+1721&nbsp;SINT MAARTEN</option>
										<option value="+963">+963&nbsp;SIRIA</option>
										<option value="+421">+421&nbsp;SLOVACCHIA</option>
										<option value="+386">+386&nbsp;SLOVENIA</option>
										<option value="+252">+252&nbsp;SOMALIA</option>
										<option value="+34">+34&nbsp;SPAGNA</option>
										<option value="+94">+94&nbsp;SRI LANKA</option>
										<option value="+1">+1&nbsp;STATI UNITI D'AMERICA</option>
										<option value="+27">+27&nbsp;SUDAFRICANA</option>
										<option value="+249">+249&nbsp;SUDAN</option>
										<option value="+211">+211&nbsp;SUDAN DEL SUD</option>
										<option value="+597">+597&nbsp;SURINAME</option>
										<option value="+47">+47&nbsp;SVALBARD E JAN MAYEN</option>
										<option value="+46">+46&nbsp;SVEZIA</option>
										<option value="+41">+41&nbsp;SVIZZERA</option>
										<option value="+268">+268&nbsp;SWAZILAND</option>
										<option value="+992">+992&nbsp;TAGIKISTAN</option>
										<option value="+886">+886&nbsp;TAIWAN</option>
										<option value="+255">+255&nbsp;TANZANIA</option>
										<option value="+66">+66&nbsp;THAILANDIA</option>
										<option value="+670">+670&nbsp;TIMOR EST</option>
										<option value="+228">+228&nbsp;TOGO</option>
										<option value="+690">+690&nbsp;TOKELAU</option>
										<option value="+676">+676&nbsp;TONGA</option>
										<option value="+1868">+1868&nbsp;TRINIDAD E TOBAGO</option>
										<option value="+216">+216&nbsp;TUNISIA</option>
										<option value="+90">+90&nbsp;TURCHIA</option>
										<option value="+993">+993&nbsp;TURKMENISTAN</option>
										<option value="+1649">+1649&nbsp;TURKS E CAICOS</option>
										<option value="+688">+688&nbsp;TUVALU</option>
										<option value="+380">+380&nbsp;UCRAINA</option>
										<option value="+256">+256&nbsp;UGANDA</option>
										<option value="+36">+36&nbsp;UNGHERIA</option>
										<option value="+598">+598&nbsp;URUGUAY</option>
										<option value="+998">+998&nbsp;UZBEKISTAN</option>
										<option value="+678">+678&nbsp;VANUATU</option>
										<option value="+58">+58&nbsp;VENEZUELA</option>
										<option value="+84">+84&nbsp;VIETNAM</option>
										<option value="+681">+681&nbsp;WALLIS E FUTUNA</option>
										<option value="+967">+967&nbsp;YEMEN</option>
										<option value="+260">+260&nbsp;ZAMBIA</option>
										<option value="+263">+263&nbsp;ZIMBAWE</option>
									</select>
									<input class="mezzo" name="0_0_TelInt" maxlength="20" id="0_0_TelInt" type="text" />
									<div id="lblTelefono" class="txterrore" style="display:none;">Inserire un numero di telefono valido</div>
									<br />
									<!-- Fax -->
									<label for="0_0_PrefissoFaxInt">Fax <span class="asterisco">&nbsp;</span></label>
									<select class="mezzo" name="0_0_PrefissoFaxInt" id="0_0_PrefissoFaxInt" onchange="TogliScroll()">
										<option value="_null"></option>
										<option value="+93">+93&nbsp;AFGHANISTAN</option>
										<option value="+355">+355&nbsp;ALBANIA</option>
										<option value="+213">+213&nbsp;ALGERIA</option>
										<option value="+376">+376&nbsp;ANDORRA</option>
										<option value="+244">+244&nbsp;ANGOLA</option>
										<option value="+1139">+1139&nbsp;ANGUILLA</option>
										<option value="+6721">+6721&nbsp;ANTARTIDE</option>
										<option value="+1268">+1268&nbsp;ANTIGUA E BARBUDA</option>
										<option value="+966">+966&nbsp;ARABIA SAUDITA</option>
										<option value="+54">+54&nbsp;ARGENTINA</option>
										<option value="+374">+374&nbsp;ARMENIA</option>
										<option value="+297">+297&nbsp;ARUBA</option>
										<option value="+61">+61&nbsp;AUSTRALIA</option>
										<option value="+43">+43&nbsp;AUSTRIA</option>
										<option value="+994">+994&nbsp;AZERBAIGIAN</option>
										<option value="+1242">+1242&nbsp;BAHAMAS</option>
										<option value="+973">+973&nbsp;BAHRAIN</option>
										<option value="+880">+880&nbsp;BANGLADESH</option>
										<option value="+1246">+1246&nbsp;BARBADOS</option>
										<option value="+32">+32&nbsp;BELGIO</option>
										<option value="+501">+501&nbsp;BELIZE</option>
										<option value="+229">+229&nbsp;BENIN</option>
										<option value="+1441">+1441&nbsp;BERMUDA</option>
										<option value="+975">+975&nbsp;BHUTAN</option>
										<option value="+375">+375&nbsp;BIELORUSSIA</option>
										<option value="+95">+95&nbsp;BIRMANIA</option>
										<option value="+591">+591&nbsp;BOLIVIA</option>
										<option value="+387">+387&nbsp;BOSNIA ED ERZEGOVINA</option>
										<option value="+267">+267&nbsp;BOTSWANA</option>
										<option value="+55">+55&nbsp;BRASILE</option>
										<option value="+673">+673&nbsp;BRUNEI</option>
										<option value="+359">+359&nbsp;BULGARIA</option>
										<option value="+226">+226&nbsp;BURKINA FASO</option>
										<option value="+257">+257&nbsp;BURUNDI</option>
										<option value="+855">+855&nbsp;CAMBOGIA</option>
										<option value="+237">+237&nbsp;CAMERUN</option>
										<option value="+1">+1&nbsp;CANADA</option>
										<option value="+238">+238&nbsp;CAPO VERDE</option>
										<option value="+235">+235&nbsp;CIAD</option>
										<option value="+56">+56&nbsp;CILE</option>
										<option value="+86">+86&nbsp;CINA</option>
										<option value="+357">+357&nbsp;CIPRO</option>
										<option value="+39">+39&nbsp;CITTA' DEL VATICANO</option>
										<option value="+57">+57&nbsp;COLOMBIA</option>
										<option value="+269">+269&nbsp;COMORE</option>
										<option value="+850">+850&nbsp;COREA DEL NORD</option>
										<option value="+82">+82&nbsp;COREA DEL SUD</option>
										<option value="+225">+225&nbsp;COSTA D'AVORIO</option>
										<option value="+506">+506&nbsp;COSTA RICA</option>
										<option value="+385">+385&nbsp;CROAZIA</option>
										<option value="+53">+53&nbsp;CUBA</option>
										<option value="+5999">+5999&nbsp;CURACAO</option>
										<option value="+45">+45&nbsp;DANIMARCA</option>
										<option value="+1767">+1767&nbsp;DOMINICA</option>
										<option value="+593">+593&nbsp;ECUADOR</option>
										<option value="+20">+20&nbsp;EGITTO</option>
										<option value="+503">+503&nbsp;EL SALVADOR</option>
										<option value="+971">+971&nbsp;EMIRATI ARABI UNITI</option>
										<option value="+291">+291&nbsp;ERITREA</option>
										<option value="+372">+372&nbsp;ESTONIA</option>
										<option value="+251">+251&nbsp;ETIOPIA</option>
										<option value="+679">+679&nbsp;FIGI</option>
										<option value="+63">+63&nbsp;FILIPPINE</option>
										<option value="+358">+358&nbsp;FINLANDIA</option>
										<option value="+33">+33&nbsp;FRANCIA</option>
										<option value="+241">+241&nbsp;GABON</option>
										<option value="+220">+220&nbsp;GAMBIA</option>
										<option value="+995">+995&nbsp;GEORGIA</option>
										<option value="+44">+44&nbsp;GEORGIA D. SUD E I. SANDWICH</option>
										<option value="+49">+49&nbsp;GERMANIA</option>
										<option value="+233">+233&nbsp;GHANA</option>
										<option value="+1876">+1876&nbsp;GIAMAICA</option>
										<option value="+81">+81&nbsp;GIAPPONE</option>
										<option value="+350">+350&nbsp;GIBILTERRA</option>
										<option value="+253">+253&nbsp;GIBUTI</option>
										<option value="+962">+962&nbsp;GIORDANIA</option>
										<option value="+30">+30&nbsp;GRECIA</option>
										<option value="+1473">+1473&nbsp;GRENADA</option>
										<option value="+299">+299&nbsp;GROENLANDIA</option>
										<option value="+590">+590&nbsp;GUADALUPA</option>
										<option value="+671">+671&nbsp;GUAM</option>
										<option value="+502">+502&nbsp;GUATEMALA</option>
										<option value="+44">+44&nbsp;GUERNSEY</option>
										<option value="+224">+224&nbsp;GUINEA</option>
										<option value="+240">+240&nbsp;GUINEA EQUATORIALE</option>
										<option value="+245">+245&nbsp;GUINEA-BISSAU</option>
										<option value="+592">+592&nbsp;GUYANA</option>
										<option value="+594">+594&nbsp;GUYANA FRANCESE</option>
										<option value="+509">+509&nbsp;HAITI</option>
										<option value="+504">+504&nbsp;HONDURAS</option>
										<option value="+852">+852&nbsp;HONG KONG</option>
										<option value="+91">+91&nbsp;INDIA</option>
										<option value="+62">+62&nbsp;INDONESIA</option>
										<option value="+98">+98&nbsp;IRAN</option>
										<option value="+964">+964&nbsp;IRAQ</option>
										<option value="+353">+353&nbsp;IRLANDA</option>
										<option value="+354">+354&nbsp;ISLANDA</option>
										<option value="+358">+358&nbsp;ISOLA ALAND</option>
										<option value="+47">+47&nbsp;ISOLA BOUVET</option>
										<option value="+44">+44&nbsp;ISOLA DI MAN</option>
										<option value="+261">+261&nbsp;ISOLA DI NATALE</option>
										<option value="+672">+672&nbsp;ISOLA NORFOLK</option>
										<option value="+599">+599&nbsp;ISOLE BES</option>
										<option value="+134">+134&nbsp;ISOLE CAYMAN</option>
										<option value="+672">+672&nbsp;ISOLE COCOS E KEELING</option>
										<option value="+682">+682&nbsp;ISOLE COOK</option>
										<option value="+298">+298&nbsp;ISOLE FAER OER</option>
										<option value="Z609">Z609&nbsp;ISOLE FALKLAND</option>
										<option value="+61">+61&nbsp;ISOLE HEARD E MCDONALD</option>
										<option value="+16">+16&nbsp;ISOLE MARIANNE SETTENTRIONALI</option>
										<option value="+692">+692&nbsp;ISOLE MARSHALL</option>
										<option value="+1">+1&nbsp;ISOLE MINORI DEGLI STATI UNITI</option>
										<option value="+649">+649&nbsp;ISOLE PITCAIRN</option>
										<option value="+677">+677&nbsp;ISOLE SALOMONE</option>
										<option value="+1340">+1340&nbsp;ISOLE VERGINI AMERICANE</option>
										<option value="+1284">+1284&nbsp;ISOLE VERGINI BRITANNICHE</option>
										<option value="+972">+972&nbsp;ISRAELE</option>
										<option selected="selected" value="+39">+39&nbsp;ITALIA</option>
										<option value="+44">+44&nbsp;JERSEY</option>
										<option value="+996">+996&nbsp;KAZAKISTAN</option>
										<option value="+254">+254&nbsp;KENYA</option>
										<option value="+996">+996&nbsp;KIRGHIZISTAN</option>
										<option value="+686">+686&nbsp;KIRIBATI</option>
										<option value="+965">+965&nbsp;KUWAIT</option>
										<option value="+856">+856&nbsp;LAOS</option>
										<option value="+266">+266&nbsp;LESOTHO</option>
										<option value="+371">+371&nbsp;LETTONIA</option>
										<option value="+961">+961&nbsp;LIBANO</option>
										<option value="+231">+231&nbsp;LIBERIA</option>
										<option value="+218">+218&nbsp;LIBIA</option>
										<option value="+423">+423&nbsp;LIECHTENSTEIN</option>
										<option value="+370">+370&nbsp;LITUANIA</option>
										<option value="+352">+352&nbsp;LUSSEMBURGO</option>
										<option value="+853">+853&nbsp;MACAO</option>
										<option value="+261">+261&nbsp;MADAGASCAR</option>
										<option value="+265">+265&nbsp;MALAWI</option>
										<option value="+960">+960&nbsp;MALDIVE</option>
										<option value="+60">+60&nbsp;MALESIA</option>
										<option value="+223">+223&nbsp;MALI</option>
										<option value="+356">+356&nbsp;MALTA</option>
										<option value="+212">+212&nbsp;MAROCCO</option>
										<option value="+596">+596&nbsp;MARTINICA</option>
										<option value="+222">+222&nbsp;MAURITANIA</option>
										<option value="+230">+230&nbsp;MAURITIUS</option>
										<option value="+269">+269&nbsp;MAYOTTE</option>
										<option value="+52">+52&nbsp;MESSICO</option>
										<option value="+691">+691&nbsp;MICRONESIA</option>
										<option value="+373">+373&nbsp;MOLDAVIA</option>
										<option value="+976">+976&nbsp;MONGOLIA</option>
										<option value="+382">+382&nbsp;MONTENEGRO</option>
										<option value="+1664">+1664&nbsp;MONTSERRAT</option>
										<option value="+258">+258&nbsp;MOZAMBICO</option>
										<option value="+264">+264&nbsp;NAMIBIA</option>
										<option value="+674">+674&nbsp;NAURU</option>
										<option value="+977">+977&nbsp;NEPAL</option>
										<option value="+505">+505&nbsp;NICARAGUA</option>
										<option value="+227">+227&nbsp;NIGER</option>
										<option value="+234">+234&nbsp;NIGERIA</option>
										<option value="+683">+683&nbsp;NIUE</option>
										<option value="+47">+47&nbsp;NORVEGIA</option>
										<option value="+687">+687&nbsp;NUOVA CALEDONIA</option>
										<option value="+64">+64&nbsp;NUOVA ZELANDA</option>
										<option value="+968">+968&nbsp;OMAN</option>
										<option value="+31">+31&nbsp;PAESI BASSI</option>
										<option value="+92">+92&nbsp;PAKISTAN</option>
										<option value="+680">+680&nbsp;PALAU</option>
										<option value="+970">+970&nbsp;PALESTINA</option>
										<option value="+507">+507&nbsp;PANAMA</option>
										<option value="+675">+675&nbsp;PAPUA NUOVA GUINEA</option>
										<option value="+595">+595&nbsp;PARAGUAY</option>
										<option value="+51">+51&nbsp;PERU'</option>
										<option value="+689">+689&nbsp;POLINESIA FRANCESE</option>
										<option value="+48">+48&nbsp;POLONIA</option>
										<option value="+1787">+1787&nbsp;PORTO RICO</option>
										<option value="+351">+351&nbsp;PORTOGALLO</option>
										<option value="+377">+377&nbsp;PRINCIPATO DI MONACO</option>
										<option value="+974">+974&nbsp;QATAR</option>
										<option value="+44">+44&nbsp;REGNO UNITO</option>
										<option value="+243">+243&nbsp;REP. DEMOCRATICA DEL CONGO</option>
										<option value="+1809">+1809&nbsp;REP. DOMINICANA</option>
										<option value="+420">+420&nbsp;REPUBBLICA CECA</option>
										<option value="+236">+236&nbsp;REPUBBLICA CENTRAFRICANA</option>
										<option value="+242">+242&nbsp;REPUBBLICA DEL CONGO</option>
										<option value="+389">+389&nbsp;REPUBBLICA DI MACEDONIA</option>
										<option value="+262">+262&nbsp;RIUNIONE</option>
										<option value="+40">+40&nbsp;ROMANIA</option>
										<option value="+250">+250&nbsp;RUANDA</option>
										<option value="+7">+7&nbsp;RUSSIA</option>
										<option value="+212">+212&nbsp;SAHARA OCCIDENTALE</option>
										<option value="+1869">+1869&nbsp;SAINT KITTS E NEVIS</option>
										<option value="+508">+508&nbsp;SAINT PIERRE ET MIQUELON</option>
										<option value="+1784">+1784&nbsp;SAINT VINCENT E GRENADINE</option>
										<option value="+590">+590&nbsp;SAINT-BARTHELEMY</option>
										<option value="+599">+599&nbsp;SAINT-MARTIN</option>
										<option value="+685">+685&nbsp;SAMOA</option>
										<option value="+684">+684&nbsp;SAMOA AMERICANE</option>
										<option value="+39">+39&nbsp;SAN MARINO</option>
										<option value="+17">+17&nbsp;SANTA LUCIA</option>
										<option value="+290">+290&nbsp;SANT'ELENA</option>
										<option value="+239">+239&nbsp;SAO TOME E PRINCIPE</option>
										<option value="+221">+221&nbsp;SENEGAL</option>
										<option value="+381">+381&nbsp;SERBIA</option>
										<option value="+248">+248&nbsp;SEYCHELLES</option>
										<option value="+232">+232&nbsp;SIERRA LEONE</option>
										<option value="+65">+65&nbsp;SINGAPORE</option>
										<option value="+1721">+1721&nbsp;SINT MAARTEN</option>
										<option value="+963">+963&nbsp;SIRIA</option>
										<option value="+421">+421&nbsp;SLOVACCHIA</option>
										<option value="+386">+386&nbsp;SLOVENIA</option>
										<option value="+252">+252&nbsp;SOMALIA</option>
										<option value="+34">+34&nbsp;SPAGNA</option>
										<option value="+94">+94&nbsp;SRI LANKA</option>
										<option value="+1">+1&nbsp;STATI UNITI D'AMERICA</option>
										<option value="+27">+27&nbsp;SUDAFRICANA</option>
										<option value="+249">+249&nbsp;SUDAN</option>
										<option value="+211">+211&nbsp;SUDAN DEL SUD</option>
										<option value="+597">+597&nbsp;SURINAME</option>
										<option value="+47">+47&nbsp;SVALBARD E JAN MAYEN</option>
										<option value="+46">+46&nbsp;SVEZIA</option>
										<option value="+41">+41&nbsp;SVIZZERA</option>
										<option value="+268">+268&nbsp;SWAZILAND</option>
										<option value="+992">+992&nbsp;TAGIKISTAN</option>
										<option value="+886">+886&nbsp;TAIWAN</option>
										<option value="+255">+255&nbsp;TANZANIA</option>
										<option value="+66">+66&nbsp;THAILANDIA</option>
										<option value="+670">+670&nbsp;TIMOR EST</option>
										<option value="+228">+228&nbsp;TOGO</option>
										<option value="+690">+690&nbsp;TOKELAU</option>
										<option value="+676">+676&nbsp;TONGA</option>
										<option value="+1868">+1868&nbsp;TRINIDAD E TOBAGO</option>
										<option value="+216">+216&nbsp;TUNISIA</option>
										<option value="+90">+90&nbsp;TURCHIA</option>
										<option value="+993">+993&nbsp;TURKMENISTAN</option>
										<option value="+1649">+1649&nbsp;TURKS E CAICOS</option>
										<option value="+688">+688&nbsp;TUVALU</option>
										<option value="+380">+380&nbsp;UCRAINA</option>
										<option value="+256">+256&nbsp;UGANDA</option>
										<option value="+36">+36&nbsp;UNGHERIA</option>
										<option value="+598">+598&nbsp;URUGUAY</option>
										<option value="+998">+998&nbsp;UZBEKISTAN</option>
										<option value="+678">+678&nbsp;VANUATU</option>
										<option value="+58">+58&nbsp;VENEZUELA</option>
										<option value="+84">+84&nbsp;VIETNAM</option>
										<option value="+681">+681&nbsp;WALLIS E FUTUNA</option>
										<option value="+967">+967&nbsp;YEMEN</option>
										<option value="+260">+260&nbsp;ZAMBIA</option>
										<option value="+263">+263&nbsp;ZIMBAWE</option>
									</select>
									<input class="mezzo" name="0_0_FaxInt" maxlength="20" id="0_0_FaxInt" type="text" />
									<div id="lblFax" class="txterrore" style="display:none;">Inserire un numero di fax valido</div>
									<br />
									<!-- CodiceFiscale -->
									<div id="divCodiceFiscale" style="">
										<label for="0_0_CodFisInt">Codice Fiscale *</label>
										<input class="completo" maxlength="16" id="0_0_CodFisInt" name="0_0_CodFisInt" type="text" />
										<div id="lblCodFis" class="txterrore" style="display:none;">Inserire un codice fiscale valido</div>
									</div>
									<div id="divCalcoloCF" style="vertical-align: top;">
										<label></label>
										<a href="http://www.comuni.it/servizi/codfisc/" target="_blank">Calcola Codice Fiscale</a> <br />
									</div>
									<!-- Paese di nascita -->
									<div id="divCittaNascita" style="display:none">
										<label for="PaeseEstero_IT">Citt&agrave; <span class="asterisco">*</span></label>
										<input class="completo" name="PaeseEstero_IT" maxlength="16" id="PaeseEstero_IT" type="text" />
										<div id="lblCittaNasc" class="txterrore" style="display:none;">Inserire la citt&agrave; di nascita</div>
										<br />
									</div>
									<!-- Documento di Identit&agrave; -->
									<div id="divDocumentoIdentita" style="display: none;">
										<label for="0_0_DocIdentita">Documento Identit&agrave; <span class="asterisco">*</span></label>
										<input class="completo" name="0_0_DocIdentita" maxlength="16" id="0_0_DocIdentita" type="text" />
										<div id="lblDocIdentita" class="txterrore" style="display:none;">Indicare il numero di documento d'identit&agrave;</div>
										<br />
									</div>
									<!-- Sesso: visualizzate solo se non Italia -->
									<div id="divSesso" style="display: none;">
										<label for="0_0_SessoInt">Sesso <span class="asterisco">*</span></label>
										<select class="quarto" name="0_0_SessoInt" id="0_0_SessoInt">
											<option selected="selected" value=""></option>
											<option value="M">M</option>
											<option value="F">F</option>
										</select>
										<div id="lblSesso" class="txterrore" style="display:none;">Specificare il Sesso</div>
										<br />
									</div>
									<!-- Data di Nascita: visualizzate solo se non Italia -->
									<div id="divDataNascita" style="display: none;">
										<label for="0_0_DataGG">Data di nascita <span class="asterisco">*</span></label>
										<select class="quarto" name="0_0_DataGG" id="0_0_DataGG">
											<option selected="selected" value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
										</select>
										<select class="quarto" name="0_0_DataMM" id="0_0_DataMM">
											<option selected="selected" value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
										<input class="mezzo" name="0_0_DataII" id="0_0_DataII" maxlength="4" type="text" />
										<div id="lblDataNascita" class="txterrore" style="display:none;">Inserire una data di nascita valida</div>
										<br />
									</div>
									<!-- Nazione Estera di Nascita -->
									<div id="divNazioneEsteraNascita" style="display: none;">
										<label for="Nazione_Estera_Nascita">Nazione di Nascita <span class="asterisco">*</span></label>
										<select class="completo" name="Nazione_Estera_Nascita" id="Nazione_Estera_Nascita" onchange="AggiornaPr_ComuneNascita('DEFAULT')">
											<option selected="selected" value="_null">Seleziona Nazione</option>
											<option value="Z200">AFGHANISTAN</option>
											<option value="Z100">ALBANIA</option>
											<option value="Z301">ALGERIA</option>
											<option value="Z101">ANDORRA</option>
											<option value="Z302">ANGOLA</option>
											<option value="Z529">ANGUILLA</option>
											<option value="Z532">ANTIGUA E BARBUDA</option>
											<option value="Z203">ARABIA SAUDITA</option>
											<option value="Z600">ARGENTINA</option>
											<option value="Z137">ARMENIA</option>
											<option value="Z700">AUSTRALIA</option>
											<option value="Z102">AUSTRIA</option>
											<option value="Z141">AZERBAIGIAN</option>
											<option value="Z502">BAHAMAS</option>
											<option value="Z204">BAHRAIN</option>
											<option value="Z249">BANGLADESH</option>
											<option value="Z522">BARBADOS</option>
											<option value="Z103">BELGIO</option>
											<option value="Z512">BELIZE</option>
											<option value="Z314">BENIN</option>
											<option value="Z400">BERMUDA</option>
											<option value="Z205">BHUTAN</option>
											<option value="Z139">BIELORUSSIA</option>
											<option value="Z206">BIRMANIA</option>
											<option value="Z601">BOLIVIA</option>
											<option value="Z153">BOSNIA ED ERZEGOVINA</option>
											<option value="Z358">BOTSWANA</option>
											<option value="Z602">BRASILE</option>
											<option value="Z207">BRUNEI</option>
											<option value="Z104">BULGARIA</option>
											<option value="Z354">BURKINA FASO</option>
											<option value="Z305">BURUNDI</option>
											<option value="Z208">CAMBOGIA</option>
											<option value="Z306">CAMERUN</option>
											<option value="Z401">CANADA</option>
											<option value="Z307">CAPO VERDE</option>
											<option value="Z309">CIAD</option>
											<option value="Z603">CILE</option>
											<option value="Z210">CINA</option>
											<option value="Z211">CIPRO</option>
											<option value="Z106">CITTA' DEL VATICANO</option>
											<option value="Z604">COLOMBIA</option>
											<option value="Z310">COMORE</option>
											<option value="Z214">COREA DEL NORD</option>
											<option value="Z213">COREA DEL SUD</option>
											<option value="Z313">COSTA D'AVORIO</option>
											<option value="Z503">COSTA RICA</option>
											<option value="Z149">CROAZIA</option>
											<option value="Z504">CUBA</option>
											<option value="Z107">DANIMARCA</option>
											<option value="Z526">DOMINICA</option>
											<option value="Z605">ECUADOR</option>
											<option value="Z336">EGITTO</option>
											<option value="Z506">EL SALVADOR</option>
											<option value="Z215">EMIRATI ARABI UNITI</option>
											<option value="Z368">ERITREA</option>
											<option value="Z144">ESTONIA</option>
											<option value="Z315">ETIOPIA</option>
											<option value="Z704">FIGI</option>
											<option value="Z216">FILIPPINE</option>
											<option value="Z109">FINLANDIA</option>
											<option value="Z110">FRANCIA</option>
											<option value="Z316">GABON</option>
											<option value="Z317">GAMBIA</option>
											<option value="Z254">GEORGIA</option>
											<option value="Z112">GERMANIA</option>
											<option value="Z318">GHANA</option>
											<option value="Z507">GIAMAICA</option>
											<option value="Z219">GIAPPONE</option>
											<option value="Z113">GIBILTERRA</option>
											<option value="Z361">GIBUTI</option>
											<option value="Z220">GIORDANIA</option>
											<option value="Z115">GRECIA</option>
											<option value="Z524">GRENADA</option>
											<option value="Z402">GROENLANDIA</option>
											<option value="Z508">GUADALUPA</option>
											<option value="Z706">GUAM</option>
											<option value="Z509">GUATEMALA</option>
											<option value="Z319">GUINEA</option>
											<option value="Z321">GUINEA EQUATORIALE</option>
											<option value="Z320">GUINEA-BISSAU</option>
											<option value="Z606">GUYANA</option>
											<option value="Z607">GUYANA FRANCESE</option>
											<option value="Z510">HAITI</option>
											<option value="Z511">HONDURAS</option>
											<option value="Z221">HONG KONG</option>
											<option value="Z222">INDIA</option>
											<option value="Z223">INDONESIA</option>
											<option value="Z224">IRAN</option>
											<option value="Z225">IRAQ</option>
											<option value="Z116">IRLANDA</option>
											<option value="Z117">ISLANDA</option>
											<option value="Z122">ISOLA DI MAN</option>
											<option value="Z715">ISOLA NORFOLK</option>
											<option value="Z530">ISOLE CAYMAN</option>
											<option value="Z212">ISOLE COCOS E KEELING</option>
											<option value="Z703">ISOLE COOK</option>
											<option value="Z108">ISOLE FAER OER</option>
											<option value="Z710">ISOLE MARIANNE SETTENTRIONALI</option>
											<option value="Z711">ISOLE MARSHALL</option>
											<option value="Z722">ISOLE PITCAIRN</option>
											<option value="Z724">ISOLE SALOMONE</option>
											<option value="Z520">ISOLE VERGINI AMERICANE</option>
											<option value="Z525">ISOLE VERGINI BRITANNICHE</option>
											<option value="Z226">ISRAELE</option>
											<option value="Italiana">ITALIA</option>
											<option value="Z152">KAZAKISTAN</option>
											<option value="Z322">KENYA</option>
											<option value="Z142">KIRGHIZISTAN</option>
											<option value="Z731">KIRIBATI</option>
											<option value="Z227">KUWAIT</option>
											<option value="Z228">LAOS</option>
											<option value="Z359">LESOTHO</option>
											<option value="Z145">LETTONIA</option>
											<option value="Z229">LIBANO</option>
											<option value="Z325">LIBERIA</option>
											<option value="Z326">LIBIA</option>
											<option value="Z119">LIECHTENSTEIN</option>
											<option value="Z146">LITUANIA</option>
											<option value="Z120">LUSSEMBURGO</option>
											<option value="Z231">MACAO</option>
											<option value="Z327">MADAGASCAR</option>
											<option value="Z328">MALAWI</option>
											<option value="Z232">MALDIVE</option>
											<option value="Z230">MALESIA</option>
											<option value="Z329">MALI</option>
											<option value="Z121">MALTA</option>
											<option value="Z330">MAROCCO</option>
											<option value="Z513">MARTINICA</option>
											<option value="Z331">MAURITANIA</option>
											<option value="Z332">MAURITIUS</option>
											<option value="Z360">MAYOTTE</option>
											<option value="Z514">MESSICO</option>
											<option value="Z735">MICRONESIA</option>
											<option value="Z140">MOLDAVIA</option>
											<option value="Z233">MONGOLIA</option>
											<option value="Z157">MONTENEGRO</option>
											<option value="Z531">MONTSERRAT</option>
											<option value="Z333">MOZAMBICO</option>
											<option value="Z300">NAMIBIA</option>
											<option value="Z713">NAURU</option>
											<option value="Z234">NEPAL</option>
											<option value="Z515">NICARAGUA</option>
											<option value="Z334">NIGER</option>
											<option value="Z335">NIGERIA</option>
											<option value="Z714">NIUE</option>
											<option value="Z125">NORVEGIA</option>
											<option value="Z716">NUOVA CALEDONIA</option>
											<option value="Z719">NUOVA ZELANDA</option>
											<option value="Z235">OMAN</option>
											<option value="Z126">PAESI BASSI</option>
											<option value="Z236">PAKISTAN</option>
											<option value="Z734">PALAU</option>
											<option value="Z218">PALESTINA</option>
											<option value="Z516">PANAMA</option>
											<option value="Z730">PAPUA NUOVA GUINEA</option>
											<option value="Z610">PARAGUAY</option>
											<option value="Z611">PERU'</option>
											<option value="Z723">POLINESIA FRANCESE</option>
											<option value="Z127">POLONIA</option>
											<option value="Z518">PORTO RICO</option>
											<option value="Z128">PORTOGALLO</option>
											<option value="Z123">PRINCIPATO DI MONACO</option>
											<option value="Z237">QATAR</option>
											<option value="Z114">REGNO UNITO</option>
											<option value="Z312">REP. DEMOCRATICA DEL CONGO</option>
											<option value="Z505">REP. DOMINICANA</option>
											<option value="Z156">REPUBBLICA CECA</option>
											<option value="Z308">REPUBBLICA CENTRAFRICANA</option>
											<option value="Z311">REPUBBLICA DEL CONGO</option>
											<option value="Z148">REPUBBLICA DI MACEDONIA</option>
											<option value="Z324">RIUNIONE</option>
											<option value="Z129">ROMANIA</option>
											<option value="Z338">RUANDA</option>
											<option value="Z154">RUSSIA</option>
											<option value="Z362">SAHARA OCCIDENTALE</option>
											<option value="Z533">SAINT KITTS E NEVIS</option>
											<option value="Z403">SAINT PIERRE ET MIQUELON</option>
											<option value="Z528">SAINT VINCENT E GRENADINE</option>
											<option value="Z726">SAMOA</option>
											<option value="Z725">SAMOA AMERICANE</option>
											<option value="Z130">SAN MARINO</option>
											<option value="Z527">SANTA LUCIA</option>
											<option value="Z340">SANT'ELENA</option>
											<option value="Z341">SAO TOME E PRINCIPE</option>
											<option value="Z343">SENEGAL</option>
											<option value="Z158">SERBIA</option>
											<option value="Z342">SEYCHELLES</option>
											<option value="Z344">SIERRA LEONE</option>
											<option value="Z248">SINGAPORE</option>
											<option value="Z501">SINT MAARTEN</option>
											<option value="Z240">SIRIA</option>
											<option value="Z155">SLOVACCHIA</option>
											<option value="Z150">SLOVENIA</option>
											<option value="Z345">SOMALIA</option>
											<option value="Z131">SPAGNA</option>
											<option value="Z209">SRI LANKA</option>
											<option value="Z404">STATI UNITI D'AMERICA</option>
											<option value="Z347">SUDAFRICANA</option>
											<option value="Z348">SUDAN</option>
											<option value="Z608">SURINAME</option>
											<option value="Z132">SVEZIA</option>
											<option value="Z133">SVIZZERA</option>
											<option value="Z349">SWAZILAND</option>
											<option value="Z147">TAGIKISTAN</option>
											<option value="Z217">TAIWAN</option>
											<option value="Z357">TANZANIA</option>
											<option value="Z241">THAILANDIA</option>
											<option value="Z242">TIMOR EST</option>
											<option value="Z351">TOGO</option>
											<option value="Z727">TOKELAU</option>
											<option value="Z728">TONGA</option>
											<option value="Z612">TRINIDAD E TOBAGO</option>
											<option value="Z352">TUNISIA</option>
											<option value="Z243">TURCHIA</option>
											<option value="Z151">TURKMENISTAN</option>
											<option value="Z519">TURKS E CAICOS</option>
											<option value="Z732">TUVALU</option>
											<option value="Z138">UCRAINA</option>
											<option value="Z353">UGANDA</option>
											<option value="Z134">UNGHERIA</option>
											<option value="Z613">URUGUAY</option>
											<option value="Z143">UZBEKISTAN</option>
											<option value="Z733">VANUATU</option>
											<option value="Z614">VENEZUELA</option>
											<option value="Z251">VIETNAM</option>
											<option value="Z729">WALLIS E FUTUNA</option>
											<option value="Z246">YEMEN</option>
											<option value="Z355">ZAMBIA</option>
											<option value="Z337">ZIMBAWE</option>
										</select>
										<div id="lblNazioneNascita" class="txterrore" style="display:none;">Inserire la nazione di nascita</div>
										<br />
									</div>
									<!-- Provincia Nascita: visualizzata solo se Nazione_Estera_Nascita = Italia -->
									<div id="divProvinceNascita" style="display:none">
										<label for="ProvinceNascita">Provincia di Nascita <span class="asterisco">*</span></label>
										<select class="completo" name="ProvinceNascita" onchange="javascript:AggiornaComuniNascita(this.value, false)" id="ProvinceNascita">
											<option selected="selected" value="_null">Seleziona Provincia</option>
											<option value="AG">AG</option>
											<option value="AL">AL</option>
											<option value="AN">AN</option>
											<option value="AO">AO</option>
											<option value="AP">AP</option>
											<option value="AQ">AQ</option>
											<option value="AR">AR</option>
											<option value="AT">AT</option>
											<option value="AV">AV</option>
											<option value="BA">BA</option>
											<option value="BG">BG</option>
											<option value="BI">BI</option>
											<option value="BL">BL</option>
											<option value="BN">BN</option>
											<option value="BO">BO</option>
											<option value="BR">BR</option>
											<option value="BS">BS</option>
											<option value="BT">BT</option>
											<option value="BZ">BZ</option>
											<option value="CA">CA</option>
											<option value="CB">CB</option>
											<option value="CE">CE</option>
											<option value="CH">CH</option>
											<option value="CI">CI</option>
											<option value="CL">CL</option>
											<option value="CN">CN</option>
											<option value="CO">CO</option>
											<option value="CR">CR</option>
											<option value="CS">CS</option>
											<option value="CT">CT</option>
											<option value="CZ">CZ</option>
											<option value="EN">EN</option>
											<option value="FC">FC</option>
											<option value="FE">FE</option>
											<option value="FG">FG</option>
											<option value="FI">FI</option>
											<option value="FM">FM</option>
											<option value="FR">FR</option>
											<option value="GE">GE</option>
											<option value="GO">GO</option>
											<option value="GR">GR</option>
											<option value="IM">IM</option>
											<option value="IS">IS</option>
											<option value="KR">KR</option>
											<option value="LC">LC</option>
											<option value="LE">LE</option>
											<option value="LI">LI</option>
											<option value="LO">LO</option>
											<option value="LT">LT</option>
											<option value="LU">LU</option>
											<option value="MB">MB</option>
											<option value="MC">MC</option>
											<option value="ME">ME</option>
											<option value="MI">MI</option>
											<option value="MN">MN</option>
											<option value="MO">MO</option>
											<option value="MS">MS</option>
											<option value="MT">MT</option>
											<option value="NA">NA</option>
											<option value="NO">NO</option>
											<option value="NU">NU</option>
											<option value="OG">OG</option>
											<option value="OR">OR</option>
											<option value="OT">OT</option>
											<option value="PA">PA</option>
											<option value="PC">PC</option>
											<option value="PD">PD</option>
											<option value="PE">PE</option>
											<option value="PG">PG</option>
											<option value="PI">PI</option>
											<option value="PN">PN</option>
											<option value="PO">PO</option>
											<option value="PR">PR</option>
											<option value="PT">PT</option>
											<option value="PU">PU</option>
											<option value="PV">PV</option>
											<option value="PZ">PZ</option>
											<option value="RA">RA</option>
											<option value="RC">RC</option>
											<option value="RE">RE</option>
											<option value="RG">RG</option>
											<option value="RI">RI</option>
											<option value="RM">RM</option>
											<option value="RN">RN</option>
											<option value="RO">RO</option>
											<option value="SA">SA</option>
											<option value="SI">SI</option>
											<option value="SO">SO</option>
											<option value="SP">SP</option>
											<option value="SR">SR</option>
											<option value="SS">SS</option>
											<option value="SV">SV</option>
											<option value="TA">TA</option>
											<option value="TE">TE</option>
											<option value="TN">TN</option>
											<option value="TO">TO</option>
											<option value="TP">TP</option>
											<option value="TR">TR</option>
											<option value="TS">TS</option>
											<option value="TV">TV</option>
											<option value="UD">UD</option>
											<option value="VA">VA</option>
											<option value="VB">VB</option>
											<option value="VC">VC</option>
											<option value="VE">VE</option>
											<option value="VI">VI</option>
											<option value="VR">VR</option>
											<option value="VS">VS</option>
											<option value="VT">VT</option>
											<option value="VV">VV</option>
										</select>
										<div id="lblProvinceNascita" class="txterrore" style="display:none;">Inserire Comune e Provincia di residenza</div>
										<br />
									</div>
									<!-- Comuni Nascita: visualizzate solo se Nazione_Estera_Nascita = Italia, ricaricate da Provincia -->
									<div id="divComuniNascita" style="display:none">
										<label for="ComuneNascita">Comune di Nascita <span class="asterisco">*</span></label>
										<select class="completo" name="ComuneNascita" id="ComuneNascita">
											<option selected="selected" value="_null">Seleziona Comune</option>
										</select>
										<div id="lblComuneNascita" class="txterrore" style="display:none;">Inserire Comune e Provincia di residenza se residente in Italia, altrimenti la Citt&agrave; e la Nazione di residenza</div>
										<br />
									</div>
									<!-- Comune Nascita Straniero: visualizzato solo se Nazione_Estera_Nascita diverso da Italia -->
									<div id="divPaeseEsteroNascita" style="display: none;">
										<label for="PaeseEsteroNascita">Comune di Nascita <span class="asterisco">*</span></label>
										<input class="completo" name="PaeseEsteroNascita" maxlength="100" id="PaeseEsteroNascita" type="text" />
										<div id="lblPaeseEsteroNascita" class="txterrore" style="display:none;">Inserire la citt&agrave; di nascita</div>
										<br />
									</div>
									<!-- Email -->
									<label for="0_0_EmailInt">Email <span class="asterisco">*</span></label>
									<input class="completo" name="0_0_EmailInt" maxlength="100" id="0_0_EmailInt" type="text" />
									<div id="lblEmail" class="txterrore" style="display:none;">Inserire un indirizzo email valido</div>
									<div id="lblEmailDominio" class="txterrore" style="display:none;">Lo
										staff di Aruba consiglia di utilizzare un indirizzo e-mail diverso da 
										quello collegato al dominio che si sta ordinando o trasferendo. 
										Successivamente all&rsquo;attivazione o al trasferimento di tale dominio, si 
										potr&agrave; utilizzare l&rsquo;indirizzo e-mail che vi &egrave; associato.</div>
									<br />
									<!-- Email Conferma -->
									<label for="ConfEmail">Conferma Email <span class="asterisco">*</span></label>
									<input class="completo" id="ConfEmail" name="ConfEmail" maxlength="100" oncopy="return false" onpaste="return false" oncut="return false" type="text" />
									<div id="lblConfEmail" class="txterrore" style="display:none;">Indirizzo Email non Corrispondente</div>
									<br />
								</fieldset>
									<input name="DominioItOrdinato" value="0" type="hidden" />
									<input name="0_0_ProvInt" value="" id="0_0_ProvInt" type="hidden" />
									<input name="0_0_ComuneInt" value="" id="0_0_ComuneInt" type="hidden" />
									<input name="0_0_ProvNasc" value="" id="0_0_ProvNasc" type="hidden" />
									<input name="0_0_ComuneNasc" value="" id="0_0_ComuneNasc" type="hidden" />
									<input name="0_0_PaeseEstero" value="" id="0_0_PaeseEstero" type="hidden" />
									<input name="0_0_UserName" value="nonserve" type="hidden" />
									<input name="0_0_UserPass" value="nonserve" type="hidden" />
									<input name="ConfUserPass" value="nonserve" type="hidden" />
									<input name="0_0_ConsensoPubbDatiInt" value="1" id="0_0_ConsensoPubbDatiInt" type="hidden" />
									<input name="lblUserName" id="lblUserName" type="hidden" />
									<input name="lblUserPass" id="lblUserPass" type="hidden" />
									<input name="lblConfUserPass" id="lblConfUserPass" type="hidden" />
									<!--#######-->
									<input name="0_0_Nazionalita" id="0_0_Nazionalita" value="IT" type="hidden" /></td>
							</tr>
						</tbody>
					</table>
					<script language="JavaScript" type="text/javascript">
    var IdAreaVendita = '1';
    var Lingua = 'DEFAULT';
    var formValidator = null;
    var checkUserExist = false;
    var userAlreadyExist = false;
    var testoMsgUtenteRegistrato = "";
    var testoMsgOld_CF = "";
    var testoMsgOld_Doc = "";
    var listaDomini = "provamelo.com";
    var nomeForm = "DatiDominio";
    var nomeRadioCittadinanzaPIVA = "Cittadinanza";
    var nomeRadioCittadinanzaCF = "Cittadinanza";
    var nomeInputDocIdentita = "0_0_DocIdentita";
    var nomeErrDocIdentita = "lblDocIdentita";
    var nomeInputCodFis = "0_0_CodFisInt";
    var nomeInputCognome = "0_0_CognomeInt";
    var nomeInputNome = "0_0_NomeInt";
    var nomeInputEMail = "Email";
    var nomeInputConfEMail = "ConfEmail";
    var nomeInputEMailAlternativa = "";
    var nomeInputPartitaIVA = "";
    var nomeInputNazioneEstera = "";
    var nomeInputNazioneEsteraIT = "";
    var nomeInputGiornoDataNascita = "0_0_DataGG";
    var nomeInputMeseDataNascita = "0_0_DataMM";
    var nomeInputAnnoDataNascita = "0_0_DataII";
    var nomeInputSesso = "0_0_SessoInt";
    var nomeInputNazioneNascita = "Nazione_Estera_Nascita";
    var nomeInputCittaNascita = "PaeseEstero_IT";

    var precaricaComuni = false;

    var ctrlDominiEU = false;
	</script>
					<script language="JavaScript" type="text/javascript" src="js/isDate.js"></script>
					<script language="JavaScript" type="text/javascript" src="js/FullOrderScript.js"></script>
					<script language="JavaScript" type="text/javascript" src="js/fullorderScriptRegistrazioneIntestatarioPrivato.js"></script>
					<script language="JavaScript" type="text/javascript">
    function ImpostaComuni() {
        ajaxtext("getComuni.asp?lang=DEFAULT&provincia=&comune=", "divComuni");
    }
	</script>
					<div id="datiEU"></div>
				</form></td>
		</tr>
	</tbody>
</table>	
<script language="JavaScript" type="text/javascript"> 
var
today = new Date(); 
year = (today.getFullYear()); 
function print_date()
{
    document.write(year);
} 
</script> 
</td>
</tr>
</tbody></table>
</td>
</tr>

</tbody></table>
      
      
<!-- Inizio Codice Conversion Lab -->
<script language="JavaScript" type="text/javascript">
   var us='d645920e395fedad7bbbed0eca3fe2e02';
</script>
<script language="JavaScript" src="js/tsend.js" type="text/javascript"></script><div id="cl5_div" style="position:absolute;left:1;top:1;visibility:hidden;display:none;"><iframe src="js/cl_002.gif" style="display:none;visibility:hidden;width:1px;height:1px;"></iframe></div><div id="cl5_ediv" style="position:absolute;left:1;top:1;visibility:hidden;display:none;">&nbsp;</div>
<noscript>
   <a href="http://www.arubamediamarketing.it/">
      
        <img src="https://tracks.arubamediamarketing.it/track/cl.gif?md5=d645920e395fedad7bbbed0eca3fe2e0">
      
   </a>
</noscript>
<!-- Fine Codice Conversion Lab --> 
<!-- Inizio Codice VisualPath 3 -->

<script src="js/d645920e395fedad7bbbed0eca3fe2e0.js" type="text/javascript"></script>
<script src="js/include.js" type="text/javascript"></script><!--[if IE]><script language="JavaScript" src="//visual.arubamediamarketing.it/track/visual_ie.js" type="text/javascript"></script><![endif]--><!--[if !IE]><!--><script language="JavaScript" src="js/visual.js" type="text/javascript"></script><div id="visual_img" style="width:0px;height:0px;position:absolute;bottom:2;right:2;display:none;"></div><!--<![endif]--> 	

<!-- Fine Codice VisualPath 3 -->

<div aria-labelledby="ui-dialog-title-dlgMessage" role="dialog" tabindex="-1" class="ui-dialog ui-widget ui-widget-content ui-corner-all  ui-draggable ui-resizable" style="display: none; position: absolute; overflow: hidden; z-index: 1000; outline: 0px none;"><div style="-moz-user-select: none;" unselectable="on" class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span style="-moz-user-select: none;" unselectable="on" id="ui-dialog-title-dlgMessage" class="ui-dialog-title"><img unselectable="on" src="js/icoAlert.png" style="vertical-align: middle; -moz-user-select: none;"><span unselectable="on" style="margin-left: 10px; font-size: 16px; -moz-user-select: none;">Attenzione</span></span><a style="-moz-user-select: none;" unselectable="on" role="button" class="ui-dialog-titlebar-close ui-corner-all" href="#"><span style="-moz-user-select: none;" unselectable="on" class="ui-icon ui-icon-closethick">close</span></a></div><div class="ui-dialog-content ui-widget-content" id="dlgMessage">
    <fieldset style="text-align: left;">
        <br>
        <label class="dialog_red">Attenzione</label>
        <br>
        <br>
        <label class="dialog">La registrazione di nomi a dominio con 
estensione .it è consentita solo nel caso in cui l'intestatario del 
dominio sia un soggetto con cittadinanza o residenza o sede nell'Unione 
Europea.</label>
        <br>
        <br>
	</fieldset>
    <div style="text-align: center;">
        <a href="#" class="buttonGreen" onclick="javascript:$('#dlgMessage').dialog('close');"><span>PROSEGUI</span></a>
    </div>
</div><div style="-moz-user-select: none;" unselectable="on" class="ui-resizable-handle ui-resizable-n"></div><div style="-moz-user-select: none;" unselectable="on" class="ui-resizable-handle ui-resizable-e"></div><div style="-moz-user-select: none;" unselectable="on" class="ui-resizable-handle ui-resizable-s"></div><div style="-moz-user-select: none;" unselectable="on" class="ui-resizable-handle ui-resizable-w"></div><div unselectable="on" style="z-index: 1001; -moz-user-select: none;" class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se ui-icon-grip-diagonal-se"></div><div unselectable="on" style="z-index: 1002; -moz-user-select: none;" class="ui-resizable-handle ui-resizable-sw"></div><div unselectable="on" style="z-index: 1003; -moz-user-select: none;" class="ui-resizable-handle ui-resizable-ne"></div><div unselectable="on" style="z-index: 1004; -moz-user-select: none;" class="ui-resizable-handle ui-resizable-nw"></div></div></body></html>