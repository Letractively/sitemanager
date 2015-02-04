function removeLink(id) {
    document.getElementById("co" + id).style.display = "none";
    loadOverlay();
}

function removeCommit(id) {
    document.getElementById("c" + id).style.display = "none";
    loadOverlay();
}

function loadOverlay() {
    document.getElementById("overlay").style.display = "block";
}

function createInterval(removedObject) {
    var refreshIntervalId = setInterval(function () {
        $.ajax({
            type: 'GET',
            url: 'showprocess.php',
            success: function (res2) {
                var work = JSON.parse(res2);
                var site = "";
                var removedObjectAfter = new Array();
                if (work.svn !== undefined && work.svn.num_trasfering > 0) {
                    for (var i in work.svn.sites) {
                        site += work.svn.sites[i].nome + ",";
                        document.getElementById("c" + work.svn.sites[i].id).style.display = "none";
                        removedObjectAfter.push("c" + work.svn.sites[i].id);
                        document.getElementById("u" + work.svn.sites[i].id).style.display = "none";
                        removedObjectAfter.push("#" + work.svn.sites[i].id);
                    }
                    for(var i in removedObject){
                        if (removedObjectAfter.indexOf(removedObject[i]) == -1) {
                            document.getElementById(removedObject[i]).style.display = "block";
                        }
                    }
                    document.getElementById("procmsgid").style.display = "block";
                    $("#procmsgid").change(site + " attività SVN");
                } else if (work.WinSCP !== undefined && work.WinSCP.num_trasfering > 0) {
                    for (var i in work.WinSCP.sites) {
                        site += work.WinSCP.sites[i].nome + ",";
                    }
                    if (!site) {
                        $("#procmsgid").append(site);
                    }
                    document.getElementById("procmsgid").style.display = "block";
                    $("#procmsgid").change(site + " in trasferimento FTP");
                } else {
                    clearInterval(refreshIntervalId);
                    location.reload(true);
                }
            },
            failure: function (bad) {
                console.log(bad);
            }
        });
    }, 10000);
}

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: 'showprocess.php',
        success: function (good) {
            var result = JSON.parse(good);
            var site = "";
            var create = false;
            var removedObject = new Array();
            if (result.WinSCP !== undefined && result.WinSCP.num_trasfering > 0) {
                for (var i in result.WinSCP.sites) {
                    site += result.WinSCP.sites[i].nome + ",";
                }
                var msg = " in trasferimento FTP";
                document.getElementById("procmsgid").style.display = "block";
                $("#procmsgid").append(site + msg);
                create = true;
            }
            if (result.svn !== undefined && result.svn.num_trasfering > 0) {
                var msg = " attività SVN";
                for (var i in result.svn.sites) {
                    site += result.svn.sites[i].nome + ",";
                    removedObject.push("c" + result.svn.sites[i].id);
                    removedObject.push("u" + result.svn.sites[i].id);
                    document.getElementById("c" + result.svn.sites[i].id).style.display = "none";
                    document.getElementById("u" + result.svn.sites[i].id).style.display = "none";
                }
                document.getElementById("procmsgid").style.display = "block";
                $("#procmsgid").append(site + msg);
                create = true;
            }
            if (create) {
                createInterval(removedObject);
            }
        },
        failure: function (bad) {
        }
    });

    $(".infotable").hide();

    $(".info").click(function () {
        $(".infotable").show();
        var sentId = $(this).attr('id');
        var dataString = {
            id: '' + sentId + ''
        };
        if ($(".infotable").is(':visible')) {
            $(".infoclasses").remove();
        }
        $.post('showinfo.php', dataString, function (data, status) {
            if (data.length > 0) {
                obj = JSON.parse(data);
                var tablecontents = "";
                var subdomainExploded = obj.domain.split("/");
                var domain = "";
                if (subdomainExploded.length > 0) {
                    domain = subdomainExploded[0];
                } else {
                    domain = obj.domain;
                }
                var arubaControlPanel = "http://admin." + obj.domainName + "." + domain + "/login.aspx";
                var myslqControlPanel = "http://mysql.aruba.it/login/index.php?lang=it-iso-8859-1";
                tablecontents += "<table border=\"1\" class=\"infoclasses\" ><tbody>";
                tablecontents += "<tr><td colspan=\"3\"><a href=\"" + arubaControlPanel + "\" target=\"_blank\">" + arubaControlPanel + "</a></td></tr>";
                tablecontents += "<tr><td rowspan=\"3\" align=\"center\" valign=\"middle\" >Credenziali FTP</td><td>Username</td><td>" + obj.ftp_username + "</td></tr><tr><td>Password</td><td>" + obj.ftp_pwd + "</td></tr><tr><td>host</td><td>" + obj.ftp_host + "</td></tr>";
                tablecontents += "<tr><td  colspan=\"3\"><a href=\"" + myslqControlPanel + "\" target=\"_blank\">" + myslqControlPanel + "</a></td></tr>";
                tablecontents += "<tbody><tr><td rowspan=\"4\" align=\"center\" valign=\"middle\" >Credenziali Data Base</td><td>Username</td><td>" + obj.dbusername + "</td></tr><tr><td>Password</td><td>" + obj.dbpwd + "</td></tr><tr><td>Nome DB</td><td >" + obj.db;
                tablecontents += "</td></tr><tr><td>host</td><td>" + obj.hostdb + "</td></tr>";
                tablecontents += "</tbody></table>";
                $("#infotableid").append(tablecontents);
            }
        });

    });
});
