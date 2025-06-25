<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Device Scanner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 50px;
        }
        #device-list {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        .device {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Network Device Scanner</h1>
    <button onclick="scanNetwork()">Scan Network</button>
    <div id="device-list"></div>

    <script>
        async function scanNetwork() {
            try {
                // Sunucu tarafındaki Python betiğine GET isteği gönderilir
                const response = await fetch('http://localhost:5000/scan');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const devices = await response.json();

                // Cihazları ekranda gösterme
                const deviceListDiv = document.getElementById('device-list');
                deviceListDiv.innerHTML = "<h3>Discovered Devices:</h3>";

                devices.forEach(device => {
                    const deviceDiv = document.createElement('div');
                    deviceDiv.className = 'device';
                    deviceDiv.textContent = `Name: ${device.name}, IP: ${device.ip}`;
                    deviceListDiv.appendChild(deviceDiv);
                });
            } catch (error) {
                console.error('Error scanning network:', error);
                alert('Failed to scan network. Please make sure the server is running.');
            }
        }
    </script>
</body>
</html>
