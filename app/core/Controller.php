<?php
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect($path)
    {
        header('Location: ' . $path);
        exit;
    }

    protected function requireRole($role)
    {
        if (!Auth::check() || Auth::role() !== $role) {
            Flash::error('Access denied.');
            $this->redirect('/public/index.php?route=login');
        }
    }
}
