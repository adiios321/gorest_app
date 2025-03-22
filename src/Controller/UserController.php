<?php

namespace App\Controller;

use App\DTO\UserDto;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
  #[Route('/', name: 'user_list')]
  public function index(Request $request, UserService $service)
  {
    $query = $request->query->get('q', '');
    $users = $service->getAll($query);

    return $this->render('user/index.html.twig', [
      'users' => $users,
      'query' => $query
    ]);
  }

  #[Route('/user/edit', name: 'user_edit', methods: ['POST'])]
  public function edit(Request $request, UserService $service): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $user = new UserDto(
      $data['id'],
      $data['name'],
      $data['email'],
      $data['gender'] ?? 'male',
      $data['status'] ?? 'active',
    );

    try {
      $updated = $service->updateUser($user);
      return new JsonResponse($updated->toArray());
    } catch (\Exception $e) {
      return new JsonResponse(['error' => $e->getMessage()], 400);
    }
  }
}
