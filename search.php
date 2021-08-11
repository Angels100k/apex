<?php 
// connect met de db
include 'conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<style>
    .custom-select {
        position: relative;
        font-family: Arial;
        padding: 0;
    }

    .custom-select select {
        display: none;
        /*hide original SELECT element: */
    }

    .select-selected {
        background: linear-gradient(to right, #6065d9, #17d7fa);
    }

    /* Style the arrow inside the select element: */
    .select-selected:after {
        position: absolute;
        content: "";
        top: 14px;
        right: 10px;
        width: 0;
        height: 0;
        border: 6px solid transparent;
        border-color: #fff transparent transparent transparent;
    }

    /* Point the arrow upwards when the select box is open (active): */
    .select-selected.select-arrow-active:after {
        border-color: transparent transparent #fff transparent;
        top: 7px;
    }

    /* style the items (options), including the selected item: */
    .select-items div,
    .select-selected {
        color: #ffffff;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
    }

    /* Style items (options): */
    .select-items {
        position: absolute;
        background: linear-gradient(to right, #6065d9, #17d7fa);
        top: 100%;
        left: 0;
        right: 0;
        z-index: 99;
    }

    /* Hide the items when the select box is closed: */
    .select-hide {
        display: none;
    }

    .select-items div:hover,
    .same-as-selected {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }

    button:hover,
    a:hover {
        opacity: 0.7;
    }
</style>
<!-- plaatst de head van de site -->
<?php include_once 'head.php'?>
<!-- C2fxwdoK2Mlt4CNXiUuP -->
<body>
<?php include_once 'background.php'?>

    <div class="main mx-auto container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">search account</h1>
                <div class="row justify-content-center">
                <div class="custom-select mt-5" style="width:200px; padding:0;">
                    <select>
                        <option value="0">PC</option>
                        <option value="0">PC</option>
                        <option value="1">PS4</option>
                        <option value="2">X1</option>
                    </select>
                </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <input id="Username" type="text" placeholder="Name user">
                </div>
                <div class="row justify-content-center">
                    <div class="col-3">
                        <button onclick="account()" id="button" class="btn-submit mx-auto d-block px-5 btn-bg mt-5 btn-lg border-0 rounded">search</button>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
        </div>
        <div class="row mt-5" id="row">

        </div>
    </div>
    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.setAttribute("id", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function (e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function (e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }
        function account(){
            var element = document.getElementById("button");
            element.disabled = true;
            var platform = document.getElementById("select-selected").innerText;
            var name = document.getElementById("Username").value;
            function reqListener () {
                element.disabled = false;
                if(this.status == 500){
                    alert("error 500")
                }
                const obj = JSON.parse(this.responseText);
                if(obj["Error"]){
                    alert("name does not exist");
                }
                document.getElementById("row").innerHTML +='<div class="col-sm"><div class="card"><img src="'+ obj["global"]["avatar"]+'" alt="John" style="width:100%"><h1>'+ obj["global"]["name"]+'</h1><p class="title">'+ obj["global"]["level"]+'</p><h2>Battle royale</h2><p>'+ obj["global"]["rank"]["rankScore"]+'</p><img src="'+ obj["global"]["rank"]["rankImg"]+'" alt="John" style="width:50%; margin-left: auto; margin-right: auto;">        <h2>Arena</h2>        <p>'+ obj["global"]["arena"]["rankScore"]+'</p>        <img src="'+ obj["global"]["arena"]["rankImg"]+'" alt="John" style="width:50%; margin-left: auto; margin-right: auto;">  </div></div>';
                document.getElementById("Username").value = "";
            }

            var oReq = new XMLHttpRequest();
            oReq.addEventListener("load", reqListener);
            oReq.open("GET", "https://api.mozambiquehe.re/bridge?version=5&platform="+platform+"&player="+name+"&auth=C2fxwdoK2Mlt4CNXiUuP");
            oReq.send();
            // $.get( "https://api.mozambiquehe.re/bridge?version=5&platform="+platform+"&player="+name+"&auth=C2fxwdoK2Mlt4CNXiUuP", function( data ) {
            //     //   $( ".result" ).html( data );
            // });
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    </script>
</body>

</html>