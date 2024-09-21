<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent Popup</title>
    <style>
        #consent-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        #consent-popup .content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="consent-popup">
        <div class="content">
            <p>We use cookies to improve your experience. Do you consent to the use of cookies?</p>
            <button onclick="giveConsent()">Yes</button>
            <button onclick="denyConsent()">No</button>
        </div>
    </div>

    <script>
        function giveConsent() {
            document.cookie = "consent=true; max-age=" + 60 * 60 * 24 * 365;
            document.getElementById('consent-popup').style.display = 'none';
        }

        function denyConsent() {
            document.getElementById('consent-popup').style.display = 'none';
        }

        function checkConsent() {
            if (!document.cookie.split('; ').find(row => row.startsWith('consent='))) {
                document.getElementById('consent-popup').style.display = 'flex';
            }
        }

        window.onload = checkConsent;
    </script>
</body>
</html>