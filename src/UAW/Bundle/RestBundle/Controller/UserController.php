<?php

namespace UAW\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function getUserAction($slug)
    {
        $em = $this->container->get('doctrine')->getManager();

        if ($slug == 'me') {
            $user = $this->getUser();
        } else{
            $user = $em->getRepository('UAWRestBundle:User')->find($slug);
        }

        if (!is_object($user)){
            throw $this->createNotFoundException();
        }

        return $user;
    } // "get_user"      [GET] /user/{slug}

    public function postUserAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->container->get('form.factory')->create(
            $this->container->get('seekube_student.form.profile_informations.type'),
            $user
        );

        if ($request->getMethod() == 'POST') {
            $form->bind($request->request->all());
            // data is an array with "name", "email", and "message" keys
            $user = $form->getData();
        }

        $this->container->get('doctrine')->getManager()->flush();

        return $user;
    }

}
