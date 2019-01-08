<?php
/**
 * Controller in charge to everything user's related
 */

class UsersController extends AbstractController {

    public function index() {
        global $db;

        $users = $db->getUsersList();

        $this->render([
            'title' => 'Authentification',
            'view' => 'users_list',
            'data' =>   [ 'users' => $users ]
        ]);
    }
}