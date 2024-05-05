<?php

namespace App\Controllers;
use App\Http\Response;
use App\Http\Request;

class NotFoundController {
  public function index(Request $request, Response $response) {
    $response::json([
      'error' => true,
      'success' => false,
      'message' => 'Not found'
    ], 404);
    return;
  }
}