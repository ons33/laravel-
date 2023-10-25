<!DOCTYPE html>
<html>
<head>
    <title>Contrat</title>
</head>
<body>
    <h1>Contrat</h1>
    <p>Type : {{ $contract->type }}</p>
    <p>Durée : {{ $contract->duree }}</p>
    <p>Salaire : {{ $contract->salaire }}</p>
    <p>Date de début : {{ $contract->date_debut }}</p>
    <p>Date de fin : {{ $contract->date_fin }}</p>
    <p>Description : {{ $contract->description }}</p>
    <p>État : {{ $contract->etat }}</p>
</body>
</html>
