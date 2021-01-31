<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/students", name="students")
     */
    public function index(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findAll();

        return $this->render('student/index.html.twig', compact('students'));
    }

    /**
     * @Route("/students/add", methods="GET|POST", name="students_add")
     */
    public function add(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($student);
            $this->em->flush();

            $this->addFlash('success', 'L\'étudiant a bien été créé en base de données.');
            return $this->redirectToRoute('students');
        }

        return $this->render('student/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/students/{id}/edit", methods={"GET", "POST"}, name="students_edit")
     */
    public function edit(Request $request, Student $student)
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success', 'L\'étudiant a bien été modifié en base de données.');
            return $this->redirectToRoute('students');
        }

        return $this->render('student/edit.html.twig', [
            'form' => $form->createView(),
            'student' => $student
        ]);
    }

    /**
     * @Route("/students/{id}", methods={"GET"}, name="students_show", requirements={"id":"\d+"})
     */
    public function show(Student $student)
    {
        return $this->render('student/show.html.twig', compact('student'));
    }

    /**
     * @Route("/students/{id}", methods={"DELETE"}, name="students_delete", requirements={"id":"\d+"})
     */
    public function delete(Student $student, Request $request)
    {
        $tokenId = 'delete' . $student->getId();
        $token = $request->get('_token');

        if ($this->isCsrfTokenValid($tokenId, $token)) {
            $this->em->remove($student);
            $this->em->flush();

            $this->addFlash('success', 'L\'étudiant a bien été supprimé en base de données.');
            return $this->redirectToRoute('students');
        }

        $this->addFlash('error', 'Une erreur est survenue lors de la suppression de l\'étudiant.');
        return $this->redirectToRoute('students');
    }
}
