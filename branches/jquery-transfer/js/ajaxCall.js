$(document).ready(function(){
    $(".infotable").hide();

    $(".info").click(function(){
        $(".infotable").show();
        var sentId=$(this).attr('id');
        var dataString = {
            id: ''+ sentId+''
        };
        if ($(".infotable").is(':visible')){
            $(".infoclasses").remove();
        }
        $.post('showinfo.php', dataString , function(data,status){
            if (data.length>0){
                obj = JSON.parse(data);
                var tablecontents = "";
                var subdomainExploded = obj.domain.split("/");
                var domain ="";
                if (subdomainExploded.length>0){
                    domain=subdomainExploded[0];
                }else {
                    domain =obj.domain; 
                }
                var arubaControlPanel = "http://admin." +obj.domainName+ "." + domain + "/login.aspx";
                var myslqControlPanel ="http://mysql.aruba.it/login/index.php?lang=it-iso-8859-1";
                tablecontents += "<table border=\"1\" class=\"infoclasses\" ><tbody>";
                tablecontents += "<tr><td colspan=\"3\"><a href=\"" + arubaControlPanel + "\" target=\"_blank\">"+ arubaControlPanel + "</a></td></tr>";
                tablecontents += "<tr><td rowspan=\"3\" align=\"center\" valign=\"middle\" >Credenziali FTP</td><td>Username</td><td>"+obj.ftp_username+"</td></tr><tr><td>Password</td><td>"+obj.ftp_pwd+ "</td></tr><tr><td>host</td><td>" +obj.ftp_host+ "</td></tr>";
                tablecontents += "<tr><td  colspan=\"3\"><a href=\""+myslqControlPanel+"\" target=\"_blank\">" +myslqControlPanel+ "</a></td></tr>";
                tablecontents += "<tbody><tr><td rowspan=\"4\" align=\"center\" valign=\"middle\" >Credenziali Data Base</td><td>Username</td><td>"+obj.dbusername+"</td></tr><tr><td>Password</td><td>" +obj.dbpwd+ "</td></tr><tr><td>Nome DB</td><td >"+obj.db;
                tablecontents += "</td></tr><tr><td>host</td><td>" +obj.hostdb+ "</td></tr>";
                tablecontents += "</tbody></table>";
                $("#infotableid").append(tablecontents);
            }
        });  

    });
});
