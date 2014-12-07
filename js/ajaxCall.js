function removeLink(id) {
    $("#co" + id).empty();
    loadOverlay();
}

function removeCommit(id) {
    $("#c" + id).empty();
    loadOverlay();
}

function loadOverlay() {
    var over = '<div id="overlay"><img id="loading" src="img/loading.gif"></div>';
    $(over).appendTo('body');
}

function createInterval(removedObject) {
    var loader = "<img src=\"img/loading.gif\">";
    var refreshIntervalId = setInterval(function () {
        $.ajax({
            type: 'GET',
            url: 'showprocess.php',
            success: function (res2) {
                var work = JSON.parse(res2);
                var site = "";
                var removedObjectAfter = {};
                if (work.svn !== undefined && work.svn.num_trasfering > 0) {
                    for (var i in work.svn.sites) {
                        site += work.svn.sites[i].nome + ",";
                        removedObjectAfter["c" + work.svn.sites[i].id] = document.getElementById("c" + work.svn.sites[i].id).cloneNode();
                        removedObjectAfter["u" + work.svn.sites[i].id] = document.getElementById("u" + work.svn.sites[i].id).cloneNode();
                        $("#c" + work.svn.sites[i].id).empty();
                        $("#u" + work.svn.sites[i].id).empty();
                    }
                    for (var i = 0, keys = Object.keys(removedObject), ii = keys.length; i < ii; i++) {
                        if (removedObjectAfter[keys[i]] === undefined) {
                            document.getElementById(keys[i]).innerHTML = removedObject[keys[i]];
                        }
                    }
                    $("#procmsgid").empty();
                    $("#procmsgid").append(loader + site + " attività SVN");
                } else if (result.WinSCP !== undefined && work.WinSCP.num_trasfering > 0) {
                    for (var i in work.WinSCP.sites) {
                        site += work.WinSCP.sites[i].nome + ",";
                    }
                    if (!site) {
                        $("#procmsgid").append(site);
                    }
                    $("#procmsgid").empty();
                    $("#procmsgid").append(loader + site + " in trasferimento FTP");
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
    var loader = "<img src=\"img/loading.gif\">";
    $.ajax({
        type: 'GET',
        url: 'showprocess.php',
        success: function (good) {
            var result = JSON.parse(good);
            var site = "";
            var create = false;
            var removedObject = {};
            if (result.WinSCP !== undefined && result.WinSCP.num_trasfering > 0) {
                for (var i in result.WinSCP.sites) {
                    site += result.WinSCP.sites[i].nome + ",";
                }
                var msg = " in trasferimento FTP";
                $("#procmsgid").append(loader + site + msg);
                create = true;
            }
            if (result.svn !== undefined && result.svn.num_trasfering > 0) {
                var msg = " attività SVN";
                for (var i in result.svn.sites) {
                    site += result.svn.sites[i].nome + ",";
                    removedObject["c" + result.svn.sites[i].id] = document.getElementById("c" + result.svn.sites[i].id).innerHTML;
                    removedObject["u" + result.svn.sites[i].id] = document.getElementById("u" + result.svn.sites[i].id).innerHTML;
                    $("#c" + result.svn.sites[i].id).empty();
                    $("#u" + result.svn.sites[i].id).empty();
                }
                $("#procmsgid").append(loader + site + msg);
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
