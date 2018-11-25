// Create a new list item when clicking on the "Add" button
dynamicList = function (input, targetList, storeTo) {
    var inputElement = document.getElementById(input);
    var targetList = document.getElementById(targetList);
    var li = document.createElement("li");
    var inputValue = inputElement.value;
    var div = document.createElement("DIV");
    var msg = document.createTextNode("Anda belum mengetikkan pertanyaan !");         
    var error = document.getElementById('error-dynamic-list');
    var t = document.createTextNode(inputValue);
    li.appendChild(t);
    if (inputValue === '') {
        div.setAttribute("id", "error-dynamic-list");
        div.classList.add("invalid-feedback");
        div.classList.add("d-block");
        div.appendChild(msg);
        inputElement.classList.add("is-invalid");
        inputElement.parentElement.appendChild(div)
    } else {
        if(error !== null) {
            inputElement.classList.remove("is-invalid");
            inputElement.parentElement.removeChild(error);
        }
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
            document.getElementById(storeTo).value = JSON.stringify(listVal);
            var error = document.getElementById('error-dynamic-list');
            if(error !== null) {
                inputElement.classList.remove("is-invalid");
                inputElement.parentElement.removeChild(error);
            }
            // console.log(document.getElementById(storeTo).value);
        }
    }

    document.getElementById(storeTo).value = JSON.stringify(listVal);
    // console.log(document.getElementById(storeTo).value);

}

dynamicFileList = function (input, targetList, label) {
    if($(input).hasClass('is-invalid')) {
        $(input).removeClass('is-invalid');
    }

    if($(input).siblings('.invalid-feedback')) {
        $(input).siblings('.invalid-feedback').remove();
    }

    var targetList = document.getElementById(targetList);
    while (targetList.firstChild) {
        targetList.removeChild(targetList.firstChild);
    }

    if (input.files) {
        // var hidden = [];
        var filename = new Array();
        var fileArray = new Array();
        for (let index = 0; index < input.files.length; index++) {
            var li = document.createElement("li");
            // var span = document.createElement("SPAN");
            // var txt = document.createTextNode("\u00D7");
            // span.className = "dynamic-close";
            // span.appendChild(txt);
            // li.appendChild(span);

            // hidden[index] = input.files[index].name;
            filename[index] = document.createTextNode(input.files[index].name + ' ('+formatBytes(input.files[index].size)+')');
            targetList.appendChild(li);

            var fileReader = new FileReader(); 
            fileReader.readAsDataURL(input.files[index]);
            fileArray[index] = fileReader;
        }

        var existList = targetList.getElementsByTagName("li");
        for (let i = 0; i < existList.length; i++) {
            existList[i].appendChild(filename[i]);
            // existList[i].onclick = function(e) {
                // fileArray.splice("fa"+i, 1);
                // delete fileArray["fa"+i];
                // input.innerHTML = fileArray;
                // filename.splice("fn"+i, 1);
                // delete filename["fn"+i];
                // hidden.splice("h"+i, 1);
                // delete hidden[i];
                // document.getElementById(storeTo).value = hidden;
                // document.getElementById(label).innerHTML = fileArray.length + " File dipilih";
                // this.parentElement.removeChild(this);
            // }
        }

        // document.getElementById(storeTo).value = hidden;
        document.getElementById(label).innerHTML = fileArray.length + " File dipilih";
    }
}

function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0 B';
    var k = 1024,
        dm = decimals <= 0 ? 0 : decimals || 2,
        sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
 }