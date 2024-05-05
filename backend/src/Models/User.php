<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class User extends Database
{
  public static function save(array $data)
  {
    $pdo = self::getConnection();
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $data['name'],
      $data['email'],
      $data['password']
    ]);
    return $pdo->lastInsertId() > 0 ? true : false;
  }

  public static function findByEmail(string $email)
  {
    $pdo = self::getConnection();
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function findAllUsers()
  {
    $pdo = self::getConnection();
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function delete(int $id)
  {
    $pdo = self::getConnection();
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0 ? true : false;
  }
}