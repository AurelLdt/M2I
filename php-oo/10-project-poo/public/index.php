<?php

/**
 * Pour bien nous organiser, toutes les pages "publiques"
 * sont situées dans le dossier public.
 */

// On peut inclure toutes les bibliothèques de Composer
require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../views/header.php';

use App\Contact;
use App\Form;
use App\Validation;

$form = new Form($_POST);
$validation = new Validation($form);
$validation->add('civility')->required()->in(['Mr', 'Mme']);
$validation->add('email')->required()->email();
$validation->add('telephone')->required()->min(10)->number();
$validation->add('message')->required()->min(15);
// Potentiellement, en @todo on pourrait ajouter une règle confirmed()
// $validation->add('password')->required()->min(6)->confirmed();
// Le confirmed pourrait comparer le champ password et password_confirmation

// Sans l'objet, on fait ça
$email = $_POST['email'] ?? null;
// Avec l'objet, on fait ça
$email = $form->get('email');
// ou ça
$email = $form->email;

if ($form->isSubmit() && $validation->isValid()) {
    // Envoyer un email...

    // @todo Faire une classe Mail qui simplifie les choses
    /*(new Mail('Sujet'))->setFrom('')
        ->setTo('')
        ->setBody('')
        ->send();*/

    // Configuration du SMTP qui envoie l'email
    // Si on est chez Bouygues, on peut mettre ça
    // $transport = new Swift_SmtpTransport('smtp.bbox.fr', 25);
    // Si on veut utiliser Gmail, on fait ça
    // $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587))
    //     ->setUsername('toto@gmail.com')
    //     ->setPassword('toto');
    $transport = new Swift_SmtpTransport('localhost', 1025);
    // Sur un "vrai" hébergement, on utilise ce transport
    // $transport = new Swift_SendmailTransport();
    $mailer = new Swift_Mailer($transport);

    // Création de l'email à envoyer: Sujet, expéditeur, destinataire, corps du message
    $email = (new Swift_Message('Demande de contact'))
        ->setFrom('toto@gmail.com')
        ->setTo('toto@gmail.com')
        ->setBody('
            Bonjour Matthieu, voici une demande de contact : <br /> <br />
            - Email: '.$form->email.' <br />
            - Civilité: '.$form->civility.' <br />
            - Téléphone: '.$form->telephone.' <br />
            - Message: '.$form->message.'
        ', 'text/html');

    // Envoi du mail
    // $mailer->send($email);

    // Fais une requête en BDD...
    // On a une table contact avec 5 colonnes: id (INT), civility, email, phone, message (TEXT)
    // use App\Contact;
    $contact = new Contact();
    // $contact->__set('civility', 'Mme');
    $contact->civility = $form->civility;
    $contact->email = $form->email;
    $contact->phone = $form->telephone;
    $contact->message = $form->message;
    $contact->save();

    echo $form->get('civility').' '.$form->get('email').' a envoyé un message: <br />';
    echo $form->message; // $form->message est idem que $form->get('message');
}

?>

<form action="" method="post">
    <div>
        <?php // $validation->add('qcm_1')->required()->in(['B', 'D']); ?>
        <?php // echo $form->select('qcm_1', 'Que fait 1 + 1', ['A' => '1', 'B' => '2', 'C' => '3', 'D' => '4']); ?>
        <?php // echo $validation->error('qcm_1'); ?>
    </div>
    <div>
        <?= $form->select('civility', 'Civilité', ['Mr' => 'Mr', 'Mme' => 'Mme']); ?>
        <?= $validation->error('civility'); ?>
    </div>
    <div>
        <?= $form->input('email', null, 'email'); ?>
        <?= $validation->error('email'); ?>
    </div>
    <div>
        <?= $form->input('telephone', 'Téléphone'); ?>
        <?= $validation->error('telephone'); ?>
    </div>
    <div>
        <?= $form->textarea('message'); ?>
        <?= $validation->error('message'); ?>
    </div>

    <button class="btn btn-primary">Envoyer</button>
</form>

<?php require __DIR__.'/../views/footer.php';
