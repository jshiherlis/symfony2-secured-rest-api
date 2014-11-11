<?php

namespace UAW\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UAW\Bundle\RestBundle\Entity\Item;

class ItemController extends Controller
{
    public function getItemsAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $items = $em->getRepository('UAWRestBundle:Item')->findAll();

        return $items;
    } // "get_items"     [GET] /items

    public function getItemAction($id)
    {
        $em = $this->container->get('doctrine')->getManager();

        $item = $em->getRepository('UAWRestBundle:Item')->find($id);

        if (!is_object($item)){
            throw $this->createNotFoundException();
        }

        return $item;
    } // "get_item"      [GET] /items/{id}

    public function postItemAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager();

        $item = new Item();
        $user = $em->getRepository('UAWRestBundle:User')->find(intval($request->request->get('user')));
        $item->setTitle($request->request->get('title'));
        $item->setUser($user);

        $em->persist($item);
        $em->flush();

        return $item;
    } // "post_item"      [POST] /items

    public function removeItemAction($id)
    {} // "remove_item"   [GET] /items/{id}/remove

}
