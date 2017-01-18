/**
 * Created by CameronCampbell on 13/01/2017.
 */
$(document).ready(function(){



    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("f_d").innerHTML =
                    this.responseText;
            }
        };

        xhttp.open("POST", "../../temp.txt", true);
        xhttp.send();
    }

});
