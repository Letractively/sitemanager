vp3.config			= new Object;					// Oggetto Complessivo

vp3.config.dominio	 	= "//visual.arubamediamarketing.it/track";

toWrite  			 = '<!--[if IE]>';
toWrite 			+= '<script language="JavaScript" src="';
toWrite 			+= vp3.config.dominio+'/visual_ie.js'
toWrite 			+= '" type="text/javascript">';
toWrite 			+= '</script>';
toWrite 			+= '<![endif]-->';
toWrite 			+= '<!--[if !IE]>';
toWrite 			+= '<!-->';
toWrite 			+= '<script language="JavaScript" src="';
toWrite 			+= vp3.config.dominio+'/visual.js';
toWrite 			+= '" type="text/javascript">';
toWrite 			+= '</script>';
toWrite 			+= '<!--<![endif]-->';

document.write(toWrite);
