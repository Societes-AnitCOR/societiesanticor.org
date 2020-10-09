<?php


namespace App\Notification;


use App\Entity\Admin\User;
use Twig\Environment;

final class NotificationManager
{
    protected $mailer;
    protected $templating;

    public function __construct(
        TwigTemplateMailer $mailer,
        Environment $templating
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function notifyNewAccount(User $user)
    {
        $rendered = $this->templating->render('emails/new_account.html.twig', [
            'user' => $user,
        ]);

        $this->mailer->sendEmailMessage($rendered, $user->getEmail());
    }

    public function notifyForgotPasswordLink(User $user)
    {
        $rendered = $this->templating->render('emails/forgot_password.html.twig', [
            'user' => $user,
        ]);

        $this->mailer->sendEmailMessage($rendered, $user->getEmail());
    }

    public function notifyRegistrationCompanyPage(User $user)
    {
        $rendered = $this->templating->render('emails/registration_company_page.html.twig', [
            'user' => $user,
        ]);

        $this->mailer->sendEmailMessage($rendered, $user->getEmail());
    }

}
