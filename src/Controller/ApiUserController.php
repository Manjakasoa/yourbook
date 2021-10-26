<?php 

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ApiUserController extends AbstractController {

	/**
	* @Route("/api/users", name="show_all_user")
	*/
	public function showAll(EntityManagerInterface $em,SerializerInterface $serializer) {
		$data = $em->getRepository(User::class)->findAll();
		$response = new Response($serializer->serialize($data,'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
	}
}