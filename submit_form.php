<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Vérification des champs
    if (empty($name) || empty($email) || empty($message)) {
        die("Tous les champs sont requis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    // Préparation de l'e-mail
    $to = "valentincaille3002@gmail.com";
    $subject = "Nouveau message de $name";
    $emailBody = "Nom : $name\n";
    $emailBody .= "Email : $email\n\n";
    $emailBody .= "Message :\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Message envoyé avec succès !";
    } else {
        echo "Erreur lors de l'envoi du message. Veuillez réessayer.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
