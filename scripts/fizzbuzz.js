function runFizzBuzz() {

    let first = document.getElementById("first").value.trim();
    let middle = document.getElementById("middle").value.trim();
    let last = document.getElementById("last").value.trim();

    let defaultWord = document.getElementById("defaultWord").value.trim();
    let count = parseInt(document.getElementById("count").value);

    let w1 = document.getElementById("word1").value.trim();
    let d1 = parseInt(document.getElementById("div1").value);

    let w2 = document.getElementById("word2").value.trim();
    let d2 = parseInt(document.getElementById("div2").value);

    let w3 = document.getElementById("word3").value.trim();
    let d3 = parseInt(document.getElementById("div3").value);

    if (!first || !last) {
        alert("First and last name are required.");
        return;
    }

    if (middle && middle.length !== 1) {
        alert("Middle initial must be exactly one letter.");
        return;
    }

    let fullName = middle ? `${first} ${middle}. ${last}` : `${first} ${last}`;

    let output = `<h3>Welcome, ${fullName}!</h3>`;
    output += "<ol>";

    for (let n = 1; n <= count; n++) {
        let text = "";

        if (w1 && d1 && n % d1 === 0) text += w1;
        if (w2 && d2 && n % d2 === 0) text += w2;
        if (w3 && d3 && n % d3 === 0) text += w3;

        if (!text) text = defaultWord;

        output += `<li>${text}</li>`;
    }

    output += "</ol>";

    // FIX: Insert output into the correct area
    document.getElementById("outputArea").innerHTML = output;
}
