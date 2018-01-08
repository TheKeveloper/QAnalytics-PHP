function getPath(){
    var loc = window.location.pathname;
    return loc.substring(0, loc.lastIndexOf("/"));
}