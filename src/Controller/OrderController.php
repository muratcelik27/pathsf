<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\ByteString;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function create(Request $request, ValidatorInterface $validator, OrderRepository $orderRepository): JsonResponse
    {
        $parameter = json_decode($request->getContent(),true);

        $user = $this->getUser();
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneBy(['id'=>$parameter['productId']]);

        if (!$product) {
            return $this->json(['message' => 'Ürün Bulunamadı'], 400);
        }

        $order = new Order();
        $order->setUser($user);
        $order->setProduct($product);
        $order->setOrderCode(ByteString::fromRandom(6));
        $order->setAddress($parameter['address']);
        $order->setQuantity($parameter['quantity']);
        $order->setShippingDate(date('Y-m-d H:i:s',strtotime('+5 days')));

        $errors = $validator->validate($order);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $orderRepository->add($order);

        return $this->json(['message' => "Siparişiniz Başarılı Bir Şekilde Oluşturuldu"]);
    }

    public function edit(Request $request, OrderRepository $orderRepository, ValidatorInterface $validator, int $id, int $quantity): JsonResponse
    {
        $order = $orderRepository->findOneBy(["id" => $id]);

        $parameter = json_decode($request->getContent(), true);

        if (date('YmdHi', strtotime($order->getShippingDate())) < date('YmdHi')) {
            $order->setQuantity($parameter['quantity']);
            $order->setAddress($parameter['address']);

            $errors = $validator->validate($order);
            if (count($errors) > 0) {
                return new Response((string)$errors, 400);
            }

        }

        return $this->json(['status' => 1]);
    }

    public function list(OrderRepository $orderRepository): JsonResponse
    {
        $data = $orderRepository->findAll();

        return $this->json($data);
    }

    public function show(OrderRepository $orderRepository, int $id): JsonResponse
    {
        $order = $orderRepository->findOneByIdJoinedToUserAndProduct($id);

        return $this->json($order);
    }
}