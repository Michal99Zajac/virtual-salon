<?php

require_once __DIR__.'/../repository/UserRepository.php';

class AppController {
  private $request;
  public $url;

  public function __construct() {
    $this->request = $_SERVER['REQUEST_METHOD'];
    $this->url = "http://$_SERVER[HTTP_HOST]";
  }

  protected function isPost(): bool {
    return $this->request === 'POST';
  }

  protected function isGet(): bool {
    return $this->request === 'GET';
  }

  protected function isSession(): bool {
    return isset($_SESSION['id']);
  }

  public function logout() {
    if (!$this->isPost()) {
      return header("Location: {$this->url}/search");
    }

    $userRepository = new UserRepository();
    $userRepository->logoutUser($_SESSION['id']);

    session_unset();
    session_destroy();

    return header("Location: {$this->url}/search");
  }

  protected function render(string $template = null, array $variables = []) {
    $templatePath = 'public/views/' . $template . '.php';
    $output = 'File not found!';

    if (file_exists($templatePath)) {
      extract($variables);

      ob_start();
      include $templatePath;
      $output = ob_get_clean();
    }

    print $output;
  }
}
