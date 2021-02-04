<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
 use App\Entity\Building;

class BuildingController extends AbstractController 
{
    private $logger;
    private $isDebug;

     /**
     * @Route("/buildings", name="buildings")
     */
    public function index() {
        return new Response('TestController');
    }
    
   /**
     * @Route("/buildings/new", name="buildings_new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $building = new Building();
        $building->setName('Missing pants')
            ->setAddress('missing-pants-'.rand(0, 1000));

        $entityManager->persist($building);
        $entityManager->flush();

        return new Response(sprintf(
            'Well hallo! The shiny new Building is id #%d, Name: %s',
            $building->getId(),
            $building->getName()
        ));
    }

    /**
     * @Route("/buildings/{username}", name="app_show")
     */
    public function show($id, EntityManagerInterface $entityManager)
    {
        if ($this->isDebug) {
            $this->logger->info('We are in debug mode!');
        }
        $repository = $entityManager->getRepository(Building::class);
        $building = $repository->findOneBy(['id' => $id]);
        dd($building);
    }
}


