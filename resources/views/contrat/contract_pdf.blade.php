<!DOCTYPE html>
<html>
<head>
    <title>Contrat PDF</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <iframe srcdoc="{{ $pdfContent }}"></iframe>
</body>
</html>
