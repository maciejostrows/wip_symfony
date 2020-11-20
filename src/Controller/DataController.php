<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class DataController extends AbstractController
{
    /**
     * @Route("/save_data", name="save_data")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function saveData(Request $request, MailerInterface $mailer): Response
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        if($request->isMethod('POST')) {
            $user = new Users();
            $user->setName($request->get('name'));
            $user->setSurname($request->get('surname'));
            $user->setEmail($request->get('email'));
            $user->setDescription($request->get('description'));
            $user->setPosition($request->get('position'));
            $user->setDetail1($request->get('detail1'));
            $user->setDetail2($request->get('detail2'));
            if ($request->get('detail3') === "true") {
                $detail3 = 1;
            } else {
                $detail3 = 0;
            }
            $user->setDetail3($detail3);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $html = "<p>Imię: ".$user->getName()."</p>
                    <p>Nazwisko: ".$user->getSurname()."</p>
                    <p>Email: ".$user->getEmail()."</p>
                    <p>Opis: ".$user->getDescription()."</p>
                    <p>Stanowisko: ".$user->getPosition()."</p>
                    <p>Detail1: ".$user->getDetail1()."</p>
                    <p>Detail2: ".$user->getDetail2()."</p>
                    <p>Detail3: ".($user->getDetail3()) ? "Tak" : "Nie"."</p>";

            $email = (new Email())
                ->from('maciej.ostrows@gmail.com')
                ->to($user->getEmail())
                ->subject('Witamy w serwisie')
                ->text('Twoja rejestracja przebiegła prawidłowo.')
                ->html($html);

            $mailer->send($email);

            return new JsonResponse(['code' => 200]);
        } else {
            return new JsonResponse(['error' => 'wrong request type']);
        }
    }

    /**
     * @Route("/get_data", name="get_data")
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function getData(Request $request, UsersRepository $usersRepository): Response
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        if($request->isMethod('GET')) {
            $users = $usersRepository->getUsers();
            return new JsonResponse(['users' => $users]);
        } else {
            return new JsonResponse(['error' => 'wrong request type']);
        }
    }

    /**
     * @Route("/get_user/{id}", name="get_user")
     * @param $id
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function getUserById($id, Request $request, UsersRepository $usersRepository): Response
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        if($request->isMethod('GET')) {
            $user = $usersRepository->getUser($id);
            return new JsonResponse(['user' => $user]);
        } else {
            return new JsonResponse(['error' => 'wrong request type']);
        }
    }

    /**
     * @Route("/edit_user/{id}", name="edit_user")
     * @param $id
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function editUser($id, Request $request, UsersRepository $usersRepository): Response
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        if($request->isMethod('POST')) {
            $user = $usersRepository->findOneById($id);

            $user->setName($request->get('name'));
            $user->setSurname($request->get('surname'));
            $user->setEmail($request->get('email'));
            $user->setDescription($request->get('description'));
            $user->setPosition($request->get('position'));
            $user->setDetail1($request->get('detail1'));
            $user->setDetail2($request->get('detail2'));
            if ($request->get('detail3') === "true") {
                $detail3 = 1;
            } else {
                $detail3 = 0;
            }
            $user->setDetail3($detail3);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return new JsonResponse(['code' => 200]);
        } else {
            return new JsonResponse(['error' => 'wrong request type']);
        }
    }

    /**
     * @Route("/delete_user/{id}", name="delete_user")
     * @param $id
     * @param Request $request
     * @param UsersRepository $usersRepository
     * @return Response
     */

    public function deleteUser($id, Request $request, UsersRepository $usersRepository): Response
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        if($request->isMethod('POST')) {
            $user = $usersRepository->findOneById($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

            return new JsonResponse(['code' => 200]);
        } else {
            return new JsonResponse(['error' => 'wrong request type']);
        }
    }
}
