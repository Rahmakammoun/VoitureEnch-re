<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification d'enchère terminée</title>
</head>
<body>
    <p>Bonjour,</p>
    <p>L'enchère sur la voiture {{ $voiture->matricule }} est maintenant terminée.</p>
    <p>Informations sur la voiture :</p>
    <ul>
        <li>Marque : {{ $voiture->marque->nomMarque }}</li>
        <li>Modèle : {{ $voiture->model->nomModel }}</li>
        <li>Version : {{ $voiture->version->nomVersion }}</li>
        <li>Année de fabrication : {{ $voiture->annee }}</li>
        <li>Prix : {{ $enchere->prix_enchere }}</li>
        <!-- Ajoutez d'autres informations si nécessaire -->
    </ul>
    <p>Informations sur le vendeur :</p>
    <p>Adresse Email : {{ $voiture->proprietaire->email }}</p>
    <p>Numéro de téléphone: {{ $voiture->proprietaire->num_tel }}</p>

    <ul>
        
        
        <!-- Ajoutez d'autres informations si nécessaire -->
    </ul>
    <p>Merci de votre participation.</p>
</body>
</html>
