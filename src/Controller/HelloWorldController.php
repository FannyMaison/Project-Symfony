<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**controller HelloWorld, affiche la chaine "Hello $prenom" dans le navigateur
     * @param string $prenom
     * @return Response
     */
    function hello($prenom):Response
    {
        #$returnString = "Hello $prenom";
        return $this->render('hello.html.twig', [
            'prenom' =>$prenom
        ]);
    }

    /**
     * Affiche un formulaire
     * @return Response
     */
    function form():Response
    {
        return new Response("
        <html>
            <body>
            <form method='post'>
            Nom : <input name='name'/>
            <input type='submit'/>
            </form>
            </body>");
    }

    /**
     * @param Request $request
     * @return Response
     */
    function formReceive(Request $request):Response
    {
        $formData = $request->request->get('name');
        return new Response("Merci $formData");
    }

    function list():Response
    {
        $list = ['Bernard', 'Jean', 'Daniel', 'Patrick'];
        return $this->render('list.html.twig', [
            'list'=>$list
        ]);
    }
}