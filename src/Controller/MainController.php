<?php

namespace App\Controller;

use App\Entity\Passenger;
use App\Entity\Trip;
use App\Form\PassengerType;
use App\Form\TripType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CustomerType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{

    /**
     * @Route("/", name="main")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();

        $formCustomer = $this->createForm(CustomerType::class);
        $formCustomer->handleRequest($request);

        if($formCustomer->isSubmitted() && $formCustomer->isValid()){
            $formDataCustomer = $formCustomer->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $user->setEmail($formDataCustomer->getEmail());
            $user->setName($formDataCustomer->getName());
            $user->setAddress($formDataCustomer->getAddress());
            $user->setCity($formDataCustomer->getCity());
            $user->setCountry($formDataCustomer->getCountry());
            $entityManager->flush();
            return new RedirectResponse('/');
        }

        $passengers = $this->getDoctrine()->getRepository(Passenger::class)->findAll();

        $formPassenger = $this->createForm(PassengerType::class);
        $formPassenger->handleRequest($request);

        if($formPassenger->isSubmitted() && $formPassenger->isValid()){
            $formDataPassenger = $formPassenger->getData();

            if($request->getMethod() == "POST"){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($formDataPassenger);
                $entityManager->flush();
                return new RedirectResponse('/');
            }
        }

        $trips = $this->getDoctrine()->getRepository(Trip::class)->findAll();

        $formTrip = $this->createForm(TripType::class);
        $formTrip->handleRequest($request);

//        $Trip = new Trip();
//        $arrayOfPassengersById = $_POST["trip"]["Passengers"];;
        if($formTrip->isSubmitted() && $formTrip->isValid()){
            $formDataTrip = $formTrip->getData();


            if($request->getMethod() == "POST"){
                $entityManager = $this->getDoctrine()->getManager();
                $trip = new Trip();
                $tripPassengers = implode(", ",$_POST["trip"]["Passengers"]);
                $trip->setPassengers($tripPassengers);
                $trip->setDestinationAirport($formDataTrip->getDestinationAirport());
                $trip->setDepartureAirport($formDataTrip->getDepartureAirport());
                $trip->setArrivalDateTime($formDataTrip->getArrivalDateTime());
                $trip->setDepartureDateTime($formDataTrip->getDepartureDateTime());
                $entityManager->persist($trip);
                $entityManager->flush();
                return new RedirectResponse('/');
            }
        }


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form_customer' => $formCustomer->createView(),
            'form' => $formPassenger->createView(),
            'passengers' => $passengers,
            'user' =>$user,
            'form_trip' => $formTrip->createView(),
            'trips' => $trips
        ]);
    }
    /**
     * @Route("/main/deletePassenger/{id}", name="deletePassenger")
     * @Method({"DELETE"})
     */
    public function deletePassenger(Request $request, $id){
        $passenger = $this->getDoctrine()->getRepository(Passenger::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($passenger);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }
    /**
     * @Route("/main/deleteTrip/{id}", name="deleteTrip")
     * @Method({"DELETE"})
     */
    public function deleteTrip(Request $request, $id){
        $trip = $this->getDoctrine()->getRepository(Trip::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($trip);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }
//    public function saveCustomer($name, $email, $address, $city, $country){
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $customer = new Customer();
//        $customer->setName($name);
//        $customer->setEmail($email);
//        $customer->setAddress($address);
//        $customer->setCity($city);
//        $customer->setCountry($country);
//
//        $entityManager->persist($customer);
//
//        $entityManager->flush();
//        return new Response("Costumer " . $customer->getName() ." was saved with succes!");
//
//    }
}
