<?php

namespace UAW\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function getUserAction($slug)
    {
        if ($slug == 'me') {
            $user = $this->getUser();
        } else{
            $user = null;
        }

        if (!is_object($user)){
            throw $this->createNotFoundException();
        }

        return $user;
    } // "get_user"      [GET] /user/{slug}

    public function postUserAction(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if (empty($username) !== false && empty($password) !== false) {
            $userManager = $this->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->setEnabled(true)
                ->setPlainPassword($password)
                ->setUsername($username)
                ->setEmail($username);

            $em = $this->container->get('doctrine')->getManager();

            $em->persist($user);
            $em->flush();

            return $user;
        }

        return new JsonResponse([
            'message' => 'POST data incomplete'
        ], 500);
    }// "post_user"      [POST] /user
}
