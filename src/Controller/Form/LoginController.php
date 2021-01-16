<?php


namespace App\Controller\Form;


use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
    public function generateForm():FormInterface
    {
        //récupération d'un constructeur de formulaire
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('login', TextType::class);
        $formBuilder->add('password', PasswordType::class);
        $formBuilder->add('submit', SubmitType::class);
        //recupération du formulaire
        $form = $formBuilder->getForm();
        return $form;
    }
     */
    public function loginForm(Request $request):Response
    {
        $form= $this->createForm(LoginFormType::class);
        #$form= $this->generateForm();
        $message = null; //aucun message par défaut
        //prise en charge de la requête
        $form->handleRequest($request);
        //On vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $login = $data['login'];
            $password = $data['password'];
            return $this->redirectToRoute('hello', ['prenom'=>$data['login']]);
        } else if ($form->isSubmitted())
        {
            $message = 'Login et mot de passe mal formé';
        }

        //l'appel à createView génère une version utilisable
        $formView = $form->createView();
        return $this->render('login.html.twig', [
            'form'=>$formView]);
    }

    public function loginPost(Request $request):Response
    {
        $form= $this->createForm(LoginFormType::class);
        #$form = $this->generateForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $login = $data['login'];
            $password = $data['password'];
            $returnMessage = "Bienvenue $login !";
        } else
        {
            $returnMessage = 'Désolé, veuillez réessayer';
        }
        #return new Response($returnMessage);
        return $this->render('login_result.html.twig', ['message'=>$returnMessage]);

    }

}