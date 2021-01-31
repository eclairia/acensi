<?php

namespace App\Controller;

use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/departments/{id}/students", name="department_students")
     */
    public function getDepartmentRegisteredStudents(int $id, DepartmentRepository $departmentRepository): Response
    {
        $departmentRegisteredStudents = $departmentRepository->getDepartmentRegisteredStudents($id);

        return new JsonResponse($departmentRegisteredStudents);
    }
}
