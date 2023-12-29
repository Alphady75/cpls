<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailerService {

   private $siteEmail = 'noreplay@contact.com';

	public function __construct(private MailerInterface $mailer){

	}

	public function sendMail($sujet, $message){

		$email = (new TemplatedEmail())
			->from(new Address($this->siteEmail, 'C+'))
			->to($this->siteEmail)
			->subject($sujet)
			->htmlTemplate('mails/_notification.html.twig')
			->context([
				'sujet' => $sujet,
				'message' => $message,
			])
		;

		return $this->mailer->send($email);
	}
}