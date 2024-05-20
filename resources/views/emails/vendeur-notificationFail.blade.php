<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification d'enchère terminée</title>
</head>
<body>
    <p>Bonjour,</p>
    <p>L'enchère sur votre voiture {{ $voiture->matricule }} est maintenant terminée, mais elle n'a pas été vendue.</p>

    <p><strong>Informations sur la voiture :</strong></p>
    <ul>
        <li>Marque : {{ $voiture->marque->nomMarque }}</li>
        <li>Modèle : {{ $voiture->model->nomModel }}</li>
        <li>Version : {{ $voiture->version->nomVersion }}</li>
        <li>Année de fabrication : {{ $voiture->annee }}</li>
        <li>Prix initial : {{ $voiture->prix_initial }}</li>
    </ul>

    <p>Merci pour votre confiance.</p>
</body>
</html>
