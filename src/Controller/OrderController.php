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

    public function edit(Request $request, OrderRepository $orderRepository, ValidatorInterface $validator, int $id): JsonResponse
    {
        $order = $orderRepository->findOneBy(["id" => $id]);

        $parameter = json_decode($request->getContent(),true);

        if ($order->getShippingDate()->format('YmdHi') < date('YmdHi')) {
            $order->setQuantity($parameter['quantity']);
            $order->setAddress($parameter['address']);

            $errors = $validator->validate($order);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
        }

        return $this->json(['message' => "Siparişiniz Güncellendi"]);
    }

    public function list(OrderRepository $orderRepository): JsonResponse
    {
        $data = $orderRepository->findBy(['user'=>$this->getUser()->getId()]);

        return $this->json($data);
    }

    public function show(OrderRepository $orderRepository, int $id): JsonResponse
    {
        $order = $orderRepository->findOneByIdJoinedToProduct($id,$this->getUser()->getId());

        return $this->json($order);
    }
}