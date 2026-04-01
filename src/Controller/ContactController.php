<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function sendMail(Request $request, MailerInterface $mailer):Response
    {
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $name = $contact->getName();
                    $firstname = $contact->getFirstname();
                    $address = $contact->getEmail();
                    $message = $contact->getMessage();
                    $contact = $form->getData();


                        $email = (new Email())
                        ->from($address)
                        ->to('jose@arcadia.com')
                        ->subject('Demande de contact')
                        ->text($message);

                        $mailer->send($email);

                        return $this->redirectToRoute('app_contact_sent');
                    
            }   
            
            return $this->render('contact/index.html.twig', [
                'form' => $form,
                'contact' => $contact,
            ]);
            
        }

        #[Route('/contact/sent', name: 'app_contact_sent')]
        public function show(): Response
        {
         
            return $this->render('contact/sent.html.twig');
        }

       
}
