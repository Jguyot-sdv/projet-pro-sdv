<!DOCTYPE html>
<html>
<head>
    <title>Network Tool Web Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="form" method="post">
        <div class="form-group">
            <label for="ip">IP Address or Domain:</label>
            <input type="text" id="ip" name="ip">
        </div>
        <div class="form-group">
            <label for="command">Command:</label>
            <select id="command" name="command">
                <option value="nmap">Nmap</option>
		<option value="nslookup">Nslookup</option>
		<option value="dig">Dig</option>
		<option value="sqlmap">Sqlmap</option>
		<option value="nikto">Nikto</option>
		<option value="traceroute">Traceroute</option>
        	<option value="ping">Ping</option>
        	<option value="netcat">Netcat</option>
		<option value="whois">Whois</option>
		<option value="gobuster">Gobuster</option>
	    </select>
        </div>
        <div class="form-group">
            <button type="submit">Execute</button>
        </div>
    </form>
    <div id="loader" class="loader" style="display: none;"></div>
    <div id="result"></div>
	<script>
document.getElementById('form').addEventListener('submit', function(e) {
    e.preventDefault();

    var loader = document.getElementById('loader');
    var resultDiv = document.getElementById('result');

    loader.style.display = 'block';
    resultDiv.innerHTML = '';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'execute.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        loader.style.display = 'none';

        if (this.status == 200) {
            var response = JSON.parse(this.responseText);
            resultDiv.innerHTML = '<h2>Result:</h2><pre>' + response.output +
                '</pre><p>Output saved to file: ' + response.filename + '</p>' +
                '<p><a href="' + response.filename + '" download>Download File</a></p>';
        } else {
            resultDiv.innerHTML = 'Error: ' + this.status;
        }
    };

    var data = 'ip=' + encodeURIComponent(document.getElementById('ip').value) +
        '&command=' + encodeURIComponent(document.getElementById('command').value);
    xhr.send(data);
});
</script>

</body>
</html>

