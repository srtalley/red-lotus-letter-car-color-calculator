function getCheckedValue(radioObj) {
    if (!radioObj)
        return "";
    var radioLength = radioObj.length;
    if (radioLength == undefined)
        if (radioObj.checked)
            return radioObj.value;
        else
            return "";
    for (var i = 0; i < radioLength; i++) {
        if (radioObj[i].checked) {
            return radioObj[i].value;
        }
    }
    return "";
}

function getKuaColors() {
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("rl-car-clr-calc-kua-results").innerHTML = xmlhttp.responseText;
        }
    }

    var gen = getCheckedValue(document.getElementsByName("rlccc_gender"));
    var yr = document.getElementById("rlccc_year").value;
    var day = document.getElementById("rlccc_day").value;
    var mon = document.getElementById("rlccc_month").value;

    xmlhttp.open("GET", "<?php echo $rlccc_baseurl ?>rlccc-kclrs.php?rlccc_gender=" + gen + "&rlccc_year=" + yr + "&rlccc_month=" + mon + "&rlccc_day=" + day, true);
    xmlhttp.send();
}

function getAsprColors() {
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("rl-car-clr-calc-aspr-results").innerHTML = xmlhttp.responseText;
        }
    }
    var aspr = document.getElementById("rlccc_aspr").value;
    xmlhttp.open("GET", "<?php echo $rlccc_baseurl ?>rlccc-aclrs.php?rlccc_aspr=" + aspr, true);
    xmlhttp.send();
}