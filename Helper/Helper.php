<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/02/2018
 * Time: 18:23
 */
namespace Helper;

use Controller\Backend;

class Helper
{

    public function formatDate($dateTime)
    {
        if(is_null($dateTime))
            return null;

        $formatter = new \IntlDateFormatter('fr_FR',\IntlDateFormatter::LONG,
            \IntlDateFormatter::SHORT,
            'Europe/Paris',
            \IntlDateFormatter::GREGORIAN );
        $date = new \DateTime($dateTime);
        $date = $formatter->format($date);
        return str_replace(':', 'h', $date);
    }

    public function sendMail($name, $email, $subject, $content)
    {
        $json = file_get_contents("config.json");
        $json = json_decode($json, true);

        // Create the Transport
        $transport = (new \Swift_SmtpTransport($json['smtp']['host'], $json['smtp']['port']))
            ->setUsername($json['smtp']['username'])
            ->setPassword($json['smtp']['password'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message())


            // Give the message a subject
            ->setSubject($subject)

            // Set the From address with an associative array
            ->setFrom([$email => $name])

            // Set the To addresses with an associative array (setTo/setCc/setBcc)
            ->setTo([$json['smtp']['my_email']])

            // Give it a body
            ->setBody($content);

        // Send the message
        $mailer->send($message);
    }

    public function tokenValidationCSRF($tokenInSession, $tokenInForm)
    {

        if (!empty($tokenInSession) AND !empty($tokenInForm))
        {

            // On vérifie que les deux correspondent
            if ($tokenInSession == $tokenInForm)
                return true;
            else
                return false;

        }
        else
            return false;

    }

    public function sessionHijackingProtection()
    {

        if(isset($_COOKIE['ticket']) && isset($_SESSION['ticket']))
        {

            if($_COOKIE['ticket'] != $_SESSION['ticket'])
            {
                session_destroy();
                header('Location:index.php');
                exit;
            }

        }


        $ticket = bin2hex(random_bytes(32));
        $_SESSION['ticket'] = $ticket;
        setcookie('ticket', $ticket);


    }

}
