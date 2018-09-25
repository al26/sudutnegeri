// Create a "close" button and append it to each list item
// var myNodelist = document.getElementsByTagName("LI");
// var i;
// for (i = 0; i < myNodelist.length; i++) {
//     var span = document.createElement("SPAN");
//     var txt = document.createTextNode("\u00D7");
//     span.className = "dynamic-close";
//     span.appendChild(txt);
//     myNodelist[i].appendChild(span);
// }

// Click on a close button to hide the current list item
// dynamicCloseList = function () {
//     var close = document.getElementsByClassName("dynamic-close");
//     var i;
//     for (i = 0; i < close.length; i++) {
//         close[i].onclick = function() {
//             var div = this.parentElement;
//             div.style.display = "none";
//         }
//     }
// }

// Add a "checked" symbol when clicking on a list item
// var list = document.querySelector('ul');
// list.addEventListener('click', function(ev) {
//     if (ev.target.tagName === 'LI') {
//         ev.target.classList.toggle('checked');
//     }
// }, false);

// Create a new list item when clicking on the "Add" button
dynamicList = function (input, targetList, storeTo) {
    var targetList = document.getElementById(targetList);
    var li = document.createElement("li");
    var inputValue = document.getElementById(input).value;
    // console.log(targetList + ",," + li + ",," + );
    var t = document.createTextNode(inputValue);
    li.appendChild(t);
    if (inputValue === '') {
        // alert("You must write something!");
    } else {
        targetList.appendChild(li);
    }
    document.getElementById(input).value = "";
    
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "dynamic-close";
    span.appendChild(txt);
    li.appendChild(span);

    var existList = targetList.getElementsByTagName("li");
    var listVal = new Array();
    for (var i = 0; i < existList.length; i++) {
        listVal[i] = existList[i].firstChild.nodeValue;
        existList[i].onclick = function() {
            var index = listVal.indexOf(this.firstChild.nodeValue);
            listVal.splice(index, 1);
            this.parentElement.removeChild(this);
            document.getElementById(storeTo).value = listVal;
            console.log(document.getElementById(storeTo).value);
        }
    }

    document.getElementById(storeTo).value = listVal;
    console.log(document.getElementById(storeTo).value);

}