<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\CustomerType');

        if ($request->getMethod() == Request::METHOD_POST) {

            $data = $request->request->all();

            try {
                $customer = $this->get('app.model.customer')->create($data);
                $this->addFlash('success', 'Your registration is successful.');
            } catch (\Exception $e) {
                $this->addFlash('failure', 'Your registration was not successful. Error: ' . $e->getMessage());
            }

            return $this->redirectToRoute('homepage');
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
