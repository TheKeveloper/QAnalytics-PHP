function listPages_SelectionChanged(){
    var listPages = document.getElementById("listPages");
    var search = document.getElementById("valSearch").value;
    window.location.href = window.location.origin + "/Default.aspx?page=" + listPages.selectedIndex + "&search=" + search;

}

function btnSearch_Click(){
    var txtSearch = document.getElementById("txtSearch");
    var listPages = document.getElementById("listPages");
    var search = txtSearch.value;
    search = search.replace(" ", "%");
    window.location.href = window.location.origin + "../Default.aspx?page=" + listPages.selectedIndex + "&search=" + search;
}

function lblTitle_Click(){
    window.location.href = "/Default.aspx";
}