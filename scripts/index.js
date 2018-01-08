function listPages_SelectionChanged(){
    var listPages = document.getElementById("listPages");
    var search = document.getElementById("valSearch").value;
    window.location.href = getPath() + "/index.php?page=" + listPages.selectedIndex + "&search=" + search;

}

function btnSearch_Click(){
    var txtSearch = document.getElementById("txtSearch");
    var listPages = document.getElementById("listPages");
    var search = txtSearch.value;
    search = search.replace(" ", "%");
    window.location.href = getPath() + "/index.php?page=" + listPages.selectedIndex + "&search=" + search;
}

function lblTitle_Click(){
    window.location.href = "/index.php";
}