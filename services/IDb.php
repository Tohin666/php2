<?php
namespace app\services;

interface IDb
{
    public function executeQueryOne(string $sql, array $params = []);
    public function executeQueryAll(string $sql, array $params = []);
}