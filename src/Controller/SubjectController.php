<?php

namespace App\Controller;

use App\Model\AdminManager;
use App\Model\SubjectManager;
use App\Model\CourseManager;

//call the AbstractController islogin function to check if the user is logged in


class SubjectController extends AbstractController
{


    public const TABLE = 'subject';
    public const ID = 'cid';




    public function index(): string
    {
        // call a static function
        AbstractController::islogin();

        $subjectManager = new SubjectManager();
        $subjects = $subjectManager->selectAll('cfull');
        return $this->twig->render('Subject/index.html.twig', ['subjects' => $subjects]);
    }

    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $subjectManager = new SubjectManager();
        $subject = $subjectManager->selectOneById($id);
        return $this->twig->render('Subject/show.html.twig', ['subject' => $subject]);
    }
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $subject = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $subjectManager = new SubjectManager();
            $id = $subjectManager->insert($subject);

            header('Location:/subjects/show?id=' . $id);
            return null;
        }
        $courseManager = new CourseManager();
        $courses = $courseManager->selectAll('cfull');
        return $this->twig->render('Subject/add.html.twig', [
            'courses' => $courses
        ]);
    }

    public function edit(int $id): ?string
    {
        $subjectManager = new SubjectManager();
        $subject = $subjectManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $subject = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $subjectManager->update($subject);

            header('Location: /subjects/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }
        $courseManager = new CourseManager();
        $courses = $courseManager->selectAll('cfull');
        return $this->twig->render('Subject/edit.html.twig', [
            'subject' => $subject, 'courses' => $courses
        ]);
    }


    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $subjectManager = new SubjectManager();
            $subjectManager->delete((int)$id);

            header('Location:/subjects');
        }
    }
}
