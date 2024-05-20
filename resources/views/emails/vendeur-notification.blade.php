<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification d'enchère terminée</title>
</head>
<body>
    <p>Bonjour,</p>
    <p>L'enchère sur votre voiture {{ $voiture->matricule }} est maintenant terminée.</p>

    <p>Informations sur l'acheteur :</p>
    <p>Adresse Email : {{ $enchere->utilisateur->email }}</p>
    <p>Numéro téléphone : {{ $enchere->utilisateur->num_tel }}</p>

    <p><strong>Informations sur la voiture :</strong></p>
    <ul>
        <li>Marque : {{ $voiture->marque->nomMarque }}</li>
        <li>Modèle : {{ $voiture->model->nomModel }}</li>
        <li>Version : {{ $voiture->version->nomVersion }}</li>
        <li>Année de fabrication : {{ $voiture->annee }}</li>
        <li>Prix initial : {{ $voiture->prix_initial }}</li>
    </ul>

    <p>Informations sur l'enchère :</p>
    <ul>
        <li>Prix de l'enchère : {{ $enchere->prix_enchere }}</li>
    </ul>

    <p><strong>Bénéfice :</strong>{{ $enchere->prix_enchere-$voiture->prix_initial  }} </p>
    <p>Merci de votre participation.</p>
</body>
</html>

