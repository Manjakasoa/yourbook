<?php 

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ApiUserController extends AbstractController {

	/**
	* @Route("/api/users", name="show_all_user")
	*/
	public function showAll(EntityManagerInterface $em) {
		$data = $em->getRepository(User::class)->findAll();
		return new JsonResponse($data);
	}
}