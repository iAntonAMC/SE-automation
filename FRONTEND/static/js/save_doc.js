function saveDoc() {
    // Get form values to save
    var doc_title = document.getElementById("doc_title").value;
    var doc_type = document.getElementsById("doc_type").value;
    var doc_level = document.getElementById("doc_level").value;
    var doc_calendar = document.getElementById("doc_calendar").innerHTML;
    var doc_campus = document.getElementById("doc_campus").value;

    const req = new XMLHttpRequest();
    req.open("POST", URL + "docs/new");
    req.send("t=" + doc_title);

}
