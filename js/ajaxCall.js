$(document).ready(function(){
    var loader="<img src=\"img/loading.gif\">";
    $.ajax({
        type: 'POST',
        data:"proc=WinSCP.com",
        url: 'showprocess.php',
        success: function(good) {
            var result = JSON.parse(good);
            if (result.num_trasfering >0 ){
                var refreshIntervalId =setInterval(function() {
                    $.ajax({
                        type: 'POST',
                        data:"proc=WinSCP.com",
                        url: 'showprocess.php',
                        success: function(res2) {
                            var work = JSON.parse(res2);
                            var site ="";
                            if (work.num_trasfering >0 ){
                                for(var i in work.sites) {
                                    site += data[i]+"</br>";
                                }
                                if (!site){
                                    $("#procmsgid").append(site);
                                }
                                $("#procmsgid").empty();
                                $("#procmsgid").append(work.msg+loader);
                            }else {
                                $("#procmsgid").empty();
                                clearInterval(refreshIntervalId);
                                location.reload(true);
                            }                            
                        },
                        failure: function(bad) {}
                    });
                }, 10000);
                $("#procmsgid").append(result.msg+loader);
            }
        },
        failure: function(bad) {}
    });
    
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
