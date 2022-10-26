<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)

return [
    '' => ['HomeController', 'index',],
    'courses' => ['CourseController', 'index',],
    'courses/show' => ['CourseController', 'show', ['id']],
    'courses/edit' => ['CourseController', 'edit', ['id']],
    'courses/add' => ['CourseController', 'add',],
    'courses/delete' => ['CourseController', 'delete',],
    'admin/login' => ['AdminController', 'login',],
    'subjects' => ['SubjectController', 'index',],
    'subjects/show' => ['SubjectController', 'show', ['id']],
    'subjects/edit' => ['SubjectController', 'edit', ['id']],
    'subjects/add' => ['SubjectController', 'add',],
    'subjects/delete' => ['SubjectController', 'delete',],

];
