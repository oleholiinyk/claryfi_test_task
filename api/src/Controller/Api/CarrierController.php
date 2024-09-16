<?php

namespace App\Controller\Api;

use App\Factory\CarrierServiceFactory;
use App\Repository\CarrierRepository;
use App\Request\Carriers\CalculateDeliveryCostRequest;
use App\Service\DeliveryCostService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carriers", name="carriers_api")
 */
class CarrierController extends AbstractController
{

  /**
   * @Route("", name="index", methods={"GET"})
   */
  public function index(CarrierRepository $carrierRepository, SerializerInterface $serializer): Response
  {
    $carriers = $carrierRepository->findAll();

    $data = $serializer->serialize($carriers, 'json');

    return new Response($data, 200, ['Content-Type' => 'application/json']);
  }

  /**
   * @Route("/calculate/delivery-cost", name="calculate", methods={"POST"})
   */
  public function calculateDeliveryCost(CalculateDeliveryCostRequest $request, CarrierRepository $carrierRepository): JsonResponse
  {
    $carrier = $carrierRepository->findOneBySlug($request->carrierSlug);

    if (!$carrier) {
      return new JsonResponse(['error' => 'Carrier not found.'], Response::HTTP_NOT_FOUND);
    }

    $carrierService = CarrierServiceFactory::createFromSlug($carrier->getSlug());

    $calculator = new DeliveryCostService($carrierService, $carrier);

    return new JsonResponse($calculator->calculate($request->weight));
  }
}
