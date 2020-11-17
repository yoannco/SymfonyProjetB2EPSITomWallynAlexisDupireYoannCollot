<?php

namespace App\Controller;

use App\Entity\ParametreHTTP;
use App\Entity\RequeteHTTP;
use App\Entity\HeaderHTTP;
use App\Form\JsonForm;
use App\Form\HeaderForm;
use App\Form\RequeteType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(): Response
    {
        $repo = $this->getDoctrine()->getRepository(RequeteHTTP::class);
        $user = $this->getUser();
        $userid = $user->getId();
        $requete = $repo->findBy(['iduser' => $userid]);

        return $this->render('accueil/index.html.twig', [
        'requetes' => $requete
        ]);
    }

    /**
     * @Route("/accueil/new", name="accueil_create")
     * @Route("/accueil/{id}/edit", name="accueil_edit")
     */
    public function form(RequeteHTTP $requete = null, Request $request, ObjectManager $manager) {
        $user = $this->getUser();

        if (!$requete) {
            $requete = new RequeteHTTP();
        }

        $form = $this->createForm(RequeteType::class, $requete);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$requete->getId()){
                $requete->setCreatedAt(new \DateTime());
                $requete->setIduser($user);
            }

            $manager->persist($requete);
            $manager->flush();

            return $this->redirectToRoute('accueil'); //43
        }

        return $this->render('accueil/create.html.twig', [
            'formRequete' => $form->createView(),
            'editMode' => $requete->getId() !== null
        ]);
    }

    /**
     * @Route("/accueil/{id}/launch", name="accueil_launch")
     */
    public function lauch($id){
        $repo = $this->getDoctrine()->getRepository(RequeteHTTP::class);
        $repo2 = $this->getDoctrine()->getRepository(ParametreHTTP::class);
        $repo3 = $this->getDoctrine()->getRepository(HeaderHTTP::class);

        $requete = $repo->find($id);
        $param = $repo2->findBy(['idrequete' => $id]);
        $header = $repo3->findBy(['idrequete' => $id]);

        $url = $requete->getUrl();
        $type = $requete->getType();

        $totalparam = count($param);
        $totalHeader = count($header);

        $json = array();
        for ($i=$totalparam-1; $i>-1; $i--){
            $json[$param[$i]->getCle()] = $param[$i]->getValeur();
        }

        $headerResponse = array();
        for ($i=$totalHeader-1; $i>-1; $i--){
            $json[$header[$i]->getCle()] = $header[$i]->getValeur();
        }

        $client=HttpClient::create();

        $response = $client->request($type, $url, [
            'headers' => $headerResponse,
            'json' => $json,
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode==200){
            $content = $response->getContent();
        } else {
            $content = $response->getContent(false);
        }

        return $this->render('accueil/launch.html.twig', [
            'requetes' => $requete,
            'params' => $param,
            'content' => $content,
            'statuscode' => $statusCode,
            'headers' => $header
        ]);
    }


    /**
     * @Route("/accueil/{id}/newjson", name="accueil_createjson")
     * @Route("/accueil/{id}&{idjson}/editjson", name="accueil_editjson")
     */
    public function formJson(RequeteHTTP $id, ParametreHTTP $requete = null, Request $request, ObjectManager $manager) {

        $requete = new ParametreHTTP();

        $form = $this->createForm(JsonForm::class, $requete);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$requete->getIdrequete()){
                $requete->setIdrequete($id);
            }

            $manager->persist($requete);
            $manager->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('accueil/createjson.html.twig', [
            'formRequete' => $form->createView()
        ]);
    }

    /**
     * @Route("/accueil/{id}/newheader", name="accueil_createheader")
     * @Route("/accueil/{id}&{idjson}/editheader", name="accueil_editheader")
     */
    public function formHeader(RequeteHTTP $id, HeaderHTTP $requete = null, Request $request, ObjectManager $manager) {

        $requete = new HeaderHTTP();

        $form = $this->createForm(HeaderForm::class, $requete);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$requete->getIdrequete()){
                $requete->setIdrequete($id);
            }

            $manager->persist($requete);
            $manager->flush();

            return $this->redirectToRoute('accueil');
        }
        return $this->render('accueil/createheader.html.twig', [
            'formHeader' => $form->createView()
        ]);
    }

    /**
     * @Route("/deleterequete/{id}/", name="deleteRequete")
     *
     * @param RequeteHTTP $requeteHTTP
     * @return Response
     */
    public function deleteRequete(RequeteHTTP $requeteHTTP){
        $em = $this->getDoctrine()->getManager();
        $em->remove($requeteHTTP);
        $em->flush();

        return new Response('Supprimé');
        }
    /**
     * @Route("/deletekey/{id}/", name="deleteKey")
     *
     * @param ParametreHTTP $parametreHTTP
     * @return Response
     */
    public function deleteKey(ParametreHTTP $parametreHTTP){
        $em = $this->getDoctrine()->getManager();
        $em->remove($parametreHTTP);
        $em->flush();

        return new Response('Supprimé');
    }

    /**
     * @Route("/deleteheader/{id}/", name="deleteHeader")
     *
     * @param HeaderHTTP $headerHTTP
     * @return Response
     */
    public function delete(HeaderHTTP $headerHTTP){
        $em = $this->getDoctrine()->getManager();
        $em->remove($headerHTTP);
        $em->flush();

        return new Response('Supprimé');
    }
}
