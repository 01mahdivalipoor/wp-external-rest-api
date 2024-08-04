elementId = 0;

function btnPress() {
    document.getElementById('result').innerHTML = "";
    elementId = document.getElementById('restCallInput').value;
    callApi(elementId);
}

const callApi = async (id) => {
    const response = await fetch(`https://api.restful-api.dev/objects/${id}`);
    const json = await response.json(); 

    for (let x in json.data) {
        document.getElementById('result').innerHTML += x + ": " + json.data[x] + "<br/>";
    }
}
