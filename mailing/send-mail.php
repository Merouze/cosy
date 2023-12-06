<?php
require './../vendor/autoload.php';

use \Mailjet\Resources;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


if (isset($_POST['name']) && isset($_POST['email'])) {
// var_dump($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE']);
$mj = new \Mailjet\Client($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE'],true,['version' => 'v3.1']);

$SENDER_EMAIL = 'workshopcrud@proton.me';
$RECIPIENT_EMAIL = 'aurelienmerouze@gmail.com';
// Set the email body
$name = "Nom:". $_POST['name'];
$email =  "Email:". $_POST['email'];
$phone =  "Téléphone:". $_POST['phone'];
$message = "Message:". $_POST['message'];

$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => 'workshopcrud@proton.me',
                'Name' => "MediaFork"
            ],
            'To' => [
                [
                    'Email' => $RECIPIENT_EMAIL,
                    'Name' => "You"
                ]
            ],
            'Subject' => "A new mail from MediaFork!",
            'TextPart' => "Greetings from Mailjet!",
            'HTMLPart' => "<h1>New message</h1><p>$name</p><p>$email</p><p>$phone</p><p>$message</p>"     
                ]
    ]
];
 // Message de confirmation pour l'utilisateur
 $userBody = [
    'Messages' => [
        [
            'From' => [
                'Email' => $SENDER_EMAIL,
                'Name' => "Me"
            ],
            'To' => [
                [
                    'Email' => $_POST['email']
                ]
            ],
            'Subject' => "Confirmation de votre message à MediaFork",
            'TextPart' => "Votre message a bien été envoyé. Nous reviendrons vers vous prochainement.",
            'HTMLPart' => "<h1>Confirmation de message</h1><p>Votre message a bien été reçu. Nous reviendrons vers vous prochainement.</p>"
        ]
    ]
];

// Envoyer le message de confirmation à l'utilisateur
$responseUser = $mj->post(Resources::$Email, ['body' => $userBody]);

// All resources are located in the Resources class
$response = $mj->post(Resources::$Email, ['body' => $body]);
// Read the response
// $response->success() && var_dump($response->getData());
// var_dump($response);
header('Location: ../index.php');
exit;
}
?>
