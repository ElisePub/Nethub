<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;
use App\Entity\Message;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function home(){
        return $this->render('/index.html.twig', []);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(){
        return $this->render('/connexion.html.twig', []);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(){
        return $this->render('/inscription.html.twig', []);
    }

    /**
     * @Route("/add_user", name="add_user", methods={"POST"})
     */
    public function traiterInscription(Request $request, PersistenceManagerRegistry $doctrine, EntityManagerInterface $entityManager) {
        try {
            //recuperation des informations du formulaire
            $email = $request->request->get('email');
            $nom = $request->request->get('nom');
            $mdp = $request->request->get('password');

            //verifie si l'email existe déjà
            $userRepository = $entityManager->getRepository(Utilisateur::class);
            $existingUser = $userRepository->findOneBy(['email' => $email]);
            if($existingUser){
                $errorMessage = 'email est déjà utilisé.';
                return new RedirectResponse($this->generateUrl('inscription', [
                    'errorMessage' => $errorMessage,
                ]));
            } else {
                //création d'un nouvel utilisateur
                $user = new Utilisateur;
                $user->setNom($nom);
                $user->setEmail($email);
                $user->setMdp($mdp);
                $user->setPic('profilpic.jpg');

                //insertion
                $entityManager->persist($user);
                $entityManager->flush();

                //renvoi vers homepage
                $messages = $doctrine->getRepository(Message::class)->findAll();
                return $this->render('/homeaccount.html.twig', [
                    'messages' => $messages,
                    'utilisateur' => $user,
                ]);
            }      
        } catch (Exception $e){
            $this->logger->error('Une erreur s\'est produite : ' . $e->getMessage());
        }
    }


    /**
     * @Route("/connect_user", name="connect_user", methods={"POST"})
     */
    public function traiterConnection(Request $request, PersistenceManagerRegistry $doctrine, EntityManagerInterface $entityManager)
    {
        $email = $request->request->get('email');
        $mdp = $request->request->get('password');

        $userRepository = $entityManager->getRepository(Utilisateur::class);
        $existingUser = $userRepository->findOneBy(['email' => $email]);
        if($existingUser && $existingUser->getMdp() === $mdp){
            //renvoi vers homepage
            $messages = $doctrine->getRepository(Message::class)->findAll();
            return $this->render('/homeaccount.html.twig', [
                'messages' => $messages,
                'utilisateur' => $existingUser,
            ]);
        } else {
            $errorMessage = 'informations incorrectes.';
            return new RedirectResponse($this->generateUrl('connexion', [
                'errorMessage' => $errorMessage,
            ]));
        }
    
        $existingUser = $userRepository->findOneBy(['email' => $email]);
    }

    /**
     * @Route("/homepage/{user}", name="add_message", methods={"POST"})
     */
    
    public function traiterMessage(Request $request, PersistenceManagerRegistry $doctrine, EntityManagerInterface $entityManager, Utilisateur $user)
    {
        try {
            $titre = $request->request->get('titre');
            $contenu = $request->request->get('message');
            $utilisateur = $doctrine->getRepository(Utilisateur::class)->find($user);
    
            //création d'un nouveau message
            $message = new Message;
            $message->setTitre($titre);
            $message->setContenu($contenu);
            $message->setReponses(0);
            $message->setLUtilisateur($utilisateur);

            //insertion
            $entityManager->persist($message);
            $entityManager->flush();
            
            //renvoi vers homepage
            $messages = $doctrine->getRepository(Message::class)->findAll();
            return $this->render('/homeaccount.html.twig', [
                'messages' => $messages,
                'utilisateur' => $utilisateur,
            ]);
        } catch (Exception $e){
            $this->logger->error('Une erreur s\'est produite : ' . $e->getMessage());
        }
    }
}