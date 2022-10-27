<?php

namespace App\Controller;

use App\Model\AdminManager;
use App\Model\CourseManager;
//call the AbstractController islogin function to check if the user is logged in


class CourseController extends AbstractController
{


    public const TABLE = 'tbl_course';
    public const ID = 'cid';




    public function index(): string
    {
        // call a static function
        AbstractController::islogin();

        $courseManager = new CourseManager();
        $courses = $courseManager->selectAll('cfull');
        return $this->twig->render('Course/index.html.twig', ['courses' => $courses]);
    }

    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $courseManager = new CourseManager();
        $course = $courseManager->selectOneById($id);
        return $this->twig->render('Course/show.html.twig', ['course' => $course]);
    }
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $course = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $courseManager = new CourseManager();
            $id = $courseManager->insert($course);

            header('Location:/courses/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Course/add.html.twig');
    }
    public function edit(int $id): ?string
    {
        $courseManager = new CourseManager();
        $course = $courseManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course = array_map('trim', $_POST);
            $courseManager->update($course);

            header('Location: /courses/show?id=' . $id);

            return null;
        }

        return $this->twig->render('Course/edit.html.twig', [
            'course' => $course,
        ]);
    }


    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $courseManager = new CourseManager();
            $courseManager->delete((int)$id);

            header('Location:/courses');
        }
    }
}
