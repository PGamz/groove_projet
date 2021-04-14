<?php


namespace app\migrations;


use app\core\Application;

class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "";
        $db->pdo->exec($SQL);
    }
}