<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Firebase\JWT\JWT;

class SignController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function in(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $encoder)
    {
        $parameters = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy(['email'=>$parameters['email'],]);

        if (!$user || !$encoder->isPasswordValid($user, $parameters['password'])) {
            return $this->json([
                'message' => 'Şifre veya Email Hatalı',
            ]);
        }

        $payload = [
            "user" => $user->getUserIdentifier(),
            "exp"  => (new \DateTime())->modify("+30 days")->getTimestamp(),
        ];

        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');

        return $this->json([
            'message' => 'Giriş İşlemi Başarılı',
            'token' => sprintf('Bearer %s', $jwt),
        ]);
    }

    public function up(UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository,ProductRepository $productRepository): Response
    {
        // kendimiz için manuel bir user ekledik
        $user = new User();
        $user->setEmail("murat@murat.com");
        $user->setPassword($passwordHasher->hashPassword($user, "123456"));
        $user->setRoles(['ROLE_USER']);
        $userRepository->add($user,true);

        // Örnek üründe ekledik
        $product = new Product();
        $product->setName("Telefon");
        $product->setPrice(100);
        $productRepository->add($product,true);

        $product = new Product();
        $product->setName("Bilgisayar");
        $product->setPrice(500);
        $productRepository->add($product,true);

        return $this->json([
            'message' => 'Kullanıcı Oluşturma İşlemi Başarılı',
            'email'=>'murat@murat.com',
            'password'=>'123456',

        ]);
    }
}