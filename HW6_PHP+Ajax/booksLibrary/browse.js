var filter = "None";
var opt = "None";
function jsonParse(text) {
    let json;
    try {
        json = JSON.parse(text);
    } catch (e) {
        return false;
    }
    return json;
}

function get_filtered_by_genre() {
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log("Response Text:", this.responseText);
            let table = document.getElementsByTagName("table")[0];
            let oldTableBody = document.getElementsByTagName("tbody")[0];

            // We create a new ody for the table
            let newTableBody = document.createElement('tbody');
            
            let json = jsonParse(this.responseText);
            for (let i = 0; i < json.length; i++) {
                let document1 = json[i];
                let row = newTableBody.insertRow();
                
                Object.keys(document1).forEach(function (k) {
                    let text;
                    let cell = row.insertCell();
                    text = document1[k];
                    cell.appendChild(document.createTextNode(text));
                });
            }

            // At the end, we replace the old body table with the new one
            table.appendChild(newTableBody);
            oldTableBody.parentNode.removeChild(oldTableBody);
        }
    }

    ajax.open('POST', 'getAllBooksByGenre.php', true);
    let genre = document.getElementsByTagName("select")[0].value;
    let json = JSON.stringify({'genre': genre});
    ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    ajax.send(json);

    setPrevious("Genre", genre);
}

function setPrevious(filt, option){
    document.getElementById("previous-filter").innerHTML = "Previously used: " + filter + " filter: " + opt;
    filter=filt;
    opt = option;

}