<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Repository\WeatherRepository;
use App\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather')]
    public function city($city ,LocationRepository $locationRepository, WeatherRepository $weatherRepository): Response
    {
        $location = $locationRepository->findOneBy([
            'city' => $city,
        ]);

        $weathers = $weatherRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'weathers' => $weathers,
        ]);
    }
}
