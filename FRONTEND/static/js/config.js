const URL = "http://localhost:8000/";

async function tryAPI() {
    const req = new XMLHttpRequest();
    req.open("GET", URL);
    var res = await req.send();
    console.log(res.responseText);
}
