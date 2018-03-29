<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 28/03/2018
 * Time: 15:30
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Competence;
use AppBundle\Entity\Stagiaire;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AppController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('app/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/competence", name="ajout_competence")
     */
    public function ajoutCompetenceAction(Request $request)
    {
        $competence = new Competence();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $competence);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('type')
            ->add('isInfo')
            ->add('valider', SubmitType::class);
        // on récupérer l'objet form
        $form = $formBuilder->getForm();

        // handle request qui appelle automatiquement les seeter de l'objet article
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // On enregistre notre objet $article dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($competence);
                $em->flush();
                $this->addFlash('success', "Competence ajoutee au formulaire.");

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('app/competence.html.twig', ['formCompetence' => $form->createView()]);
    }

    /**
     * @Route("/stagiaire", name="ajout_competence")
     */
    public function ajoutStagiaireAction(Request $request)
    {
        $stagiaire = new Stagiaire();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $stagiaire);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('name')
            ->add('firstname')
            ->add('birthday')
            ->add('email')
            ->add('phone')
            ->add('pcode')
            ->add('competences',EntityType::class,array('class'=>'AppBundle:Competence','multiple' => true))
            ->add('valider', SubmitType::class);
        // on récupérer l'objet form
        $form = $formBuilder->getForm();

        // handle request qui appelle automatiquement les seeter de l'objet article
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // On enregistre notre objet $article dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($stagiaire);
                $em->flush();
                $this->addFlash('success', "Stagiaire ajoute au formulaire.");

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('app/stagiaire.html.twig', ['formStagiaire' => $form->createView()]);
    }

}