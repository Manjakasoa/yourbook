<?php 

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ApiUserController extends AbstractController {

	/**
	* @Route("/api/users", name="show_all_user",methods={"GET"})
	*/
	public function showAll(EntityManagerInterface $em,SerializerInterface $serializer) {
		$data = $em->getRepository(User::class)->findAll();
		$response = new Response($serializer->serialize($data,'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
	}

	/**
	* @Route("/api/users", name="add_user",methods={"POST"})
	*/
	public function add() {
		return new JsonResponse([
			'succes'	=> true
		]);
	}

	/**
	* @Route("/api/users/{id}", name="show_user",methods={"GET"})
	*/
	public function show(User $user,SerializerInterface $serializer) {
		$response = new Response($serializer->serialize($user,'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
	}

	/**
	* @Route("/api/users/{id}", name="edit_user",methods={"PUT"})
	*/
	public function edit(EntityManagerInterface $em, User $user,Request $request) {
		$data = json_decode($request->getContent());
		$user->setFirstName($data->firstName)
			 ->setLastName($data->lastName);
		$em->persist($user);
		$em->flush();
		return new JsonResponse([
			'succes' => true
		]);
	}

	/**
	* @Route("/api/users/{id}", name="delete_user",methods={"DELETE"})
	*/
	public function delete(User $user,EntityManagerInterface $em) {
		$em->remove($user);
		$em->flush();
		return new JsonResponse([
			'succes' => true
		]);
	}
}