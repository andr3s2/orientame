<?php

require 'boostrap.php';
require './model/User.php';

use Intervention\Image\ImageManagerStatic as Image;


class Orientame {

    public function __construct($method) {

        header('Content-Type: application/json');
        $action = $_GET['action'];


        try {
            $response = [];
            switch (strtoupper($method)) {
                case 'POST' :
                    if ($action == 'user') {
                        $response = User::createOrUpdate((object)$_POST);
                    } else if ($action == 'answer') {
                        $response = User::setAnswers($_GET['id'], (object)$_POST);
                    } else if ($action == 'clean') {
                        $response = User::setAnswers($_GET['id'], (object)array('answers' => ''));
                    } else if ($action == 'share') {

                        $user = \Firebase\JWT\JWT::decode($_POST['token'], getenv('APP_KEY'), ['HS256']);

                        $images = array(
                            'interests' => $_POST['interests'],
                            'skills' => $_POST['skills'],
                            'personality' => $_POST['personality'],
                        );

                        Image::configure(array('driver' => 'imagick'));

                        $imgCanvas = Image::canvas(600, 1200);

                        $imgCanvas->text('Resultados', 200, 0, function($font) {
                            $font->file('assets/fonts/eutemia.ttf');
                            $font->color('#000');
                            $font->align('center');
                            $font->valign('top');
                            $font->size(24);
                        });

                        //$imgCanvas->text('Resultados Orientación Vocacional');
                        $imgInterests = Image::make($_POST['interests'])->resize(600, 400);
                        $imgSkills = Image::make($_POST['skills'])->resize(400, 400);
                        $imgPersonality = Image::make($_POST['personality'])->resize(600, 400);

                        $imgCanvas->insert($imgInterests, 'top', 100);
                        $imgCanvas->insert($imgSkills, 'top', 0, 400);
                        $imgCanvas->insert($imgPersonality, 'top', 0, 800);

                        $imgCanvas->save("results/{$user->id}.png");


                        $user = (object)User::setImage($user->id, $images);

                        $response = array(
                            'code' => \Firebase\JWT\JWT::encode(['uid' => $user->id, 'network' => strtolower($_GET['type'])], getenv('APP_KEY'))
                    );

                    }
                    break;
                case 'GET' :

                    if ($action == 'user') {
                        $response = User::find($_GET['id']);
                    }
                    break;
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode((object)array('error' => 'Hubo un error en el request', 'msg' => $e->getMessage()));
            die();
        }


        if (!$response) {
            http_response_code(400);
            echo json_encode((object)array('error' => 'Hubo un error en el request'));
            die();
        }

        echo json_encode($response);

    }


}

$orientame = new Orientame($_SERVER['REQUEST_METHOD']);

