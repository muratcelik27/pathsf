<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SignController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function in(?User $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = "fake_token_11245541"; // somehow create an API token for $user

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }

    public function up(UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository): Response
    {
        // kendimiz için manuel bir user ekledik
        $user = new User();
        $user->setEmail("murat@murat.com");
        $user->setPassword($passwordHasher->hashPassword($user, "123456"));
        $user->setRoles(['ROLE_USER']);
        $userRepository->add($user,true);

        return $this->json(['status' => 1]);
    }
}