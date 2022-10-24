<?php

namespace App\Controller;

use App\Model\CourseManager;

class CourseController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        $courseManager = new CourseManager();
        $courses = $courseManager->selectAll('title');

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
}
