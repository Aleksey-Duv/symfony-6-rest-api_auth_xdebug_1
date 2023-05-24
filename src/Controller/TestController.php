<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
//    private $user;
//    private $manager;
//
//    public function __construct(entityManagerInterface $manager, UserRepository $user)
//    {
//        $this->manager = $manager;
//        $this->user = $user;
//
//    }
    #[Route('/test', name: 'app_test')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }

    #[Route('/api/getAllUser', name: 'get_allures', methods: 'GET')]
    public function getAllUser(entityManagerInterface $manager): JsonResponse
    {
        $users = $manager->getRepository(User::class)->findAll();
//        return  $this->json($users);

       // $users=$this->user->findAll();
//dd($users);
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'password' => $user->getPassword(),
            ];
        }

        $response = new JsonResponse($data);

        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }


}
