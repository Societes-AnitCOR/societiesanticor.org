<?php


namespace App\Notification;


class TwigTemplateMailer
{
    protected $mailer;
    protected $fromEmail;
    private $fromAlias;

    public function __construct(\Swift_Mailer $mailer, string $fromEmail = 'noreply@email.com', string $fromAlias = '')
    {
        $this->mailer = $mailer;
        $this->fromEmail = $fromEmail;
        $this->fromAlias = $fromAlias;
    }

    /**
     *
     * @param $renderedTemplate
     * @param $fromEmail
     * @param $toEmail
     */
    public function sendEmailMessage($renderedTemplate, $toEmail, $fromEmail = null)
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));
        $message = new \Swift_Message();
        $message
            ->setSubject($subject)
            ->setFrom($fromEmail ?: $this->fromEmail)
            ->setTo($toEmail)
            ->setReplyTo($toEmail) // prevent reply to robot
            ->setBody($body)
            ->setContentType('text/html');
        $this->mailer->send($message);
    }
}
