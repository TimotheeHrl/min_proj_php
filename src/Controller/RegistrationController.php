<?php

namespace App\Controller;

use App\Model\RegistrationManager;
use App\Model\SessionManager;
use App\Model\SubjectManager;
use App\Model\CourseManager;

class RegistrationController extends AbstractController
{
    public function index(): string
    {
        $registrationManager = new RegistrationManager();
        $registrations = $registrationManager->selectAll('id');

        return $this->twig->render('Registration/index.html.twig', ['registrations' => $registrations]);
    }

    public function add(): ?string
    {
        $session = new SessionManager();
        $sessions = $session->selectAll('session');
        $subject = new SubjectManager();
        $subjects = $subject->selectAll('cfull');
        $course = new CourseManager();
        $courses = $course->selectAll('cfull');
        $registrationManager = new RegistrationManager();
        $cities = $registrationManager->getAllCities();
        $countries = $registrationManager->getAllCountries();
        // get cookie value
        $session_id = $_COOKIE['session_id'];
        $sessionM = new SessionManager();
        $session = $sessionM->selectOneById($session_id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $registration = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $registrationManager = new RegistrationManager();
            $id = $registrationManager->insert($registration);

            header('Location:/registrations/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Registration/add.html.twig', [
            'sessions' => $sessions,
            'subjects' => $subjects,
            'courses' => $courses,
            'cities' => $cities,
            'countries' => $countries,
            'session' => $session,
        ]);
    }

    public function show(int $id): string
    {
        $registrationManager = new RegistrationManager();
        $registration = $registrationManager->selectOneById($id);

        return $this->twig->render('Registration/show.html.twig', ['registration' => $registration]);
    }

    public function edit(int $id): ?string
    {
        $session = new SessionManager();
        $sessions = $session->selectAll('session');
        $subject = new SubjectManager();
        $subjects = $subject->selectAll('subject');
        $course = new CourseManager();
        $courses = $course->selectAll('course');
        $registrationManager = new RegistrationManager();
        $registration = $registrationManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $registration = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $registrationManager = new RegistrationManager();
            $registrationManager->update($registration);

            header('Location:/registrations/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Registration/edit.html.twig', ['registration' => $registration]);
    }

    public function delete(int $id): void
    {
        $registrationManager = new RegistrationManager();
        $registrationManager->delete($id);
        header('Location:/registrations/index');
    }
}
