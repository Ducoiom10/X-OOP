<?php

namespace Ducna\XOop\Commons;

use eftec\bladeone\BladeOne;

class Controller
{
    protected function renderViewClient($view, $data = [])
    {
        try {
            $templatePath = __DIR__ . '/../Views/Client';
            $compiledPath = __DIR__ . '/../Views/Compiles';

            $blade = new BladeOne($templatePath, $compiledPath);

            echo $blade->run($view, $data);
        } catch (\Exception $e) {
            $this->renderError($e->getMessage());
        }
    }

    protected function renderViewAdmin($view, $data = [])
    {
        try {
            $templatePath = __DIR__ . '/../Views/Admin';
            $compiledPath = __DIR__ . '/../Views/Compiles';

            $blade = new BladeOne($templatePath, $compiledPath);

            echo $blade->run($view, $data);
        } catch (\Exception $e) {
            $this->renderError($e->getMessage());
        }
    }

    protected function renderError($errorMessage)
    {
        $templatePath = __DIR__ . '/../Views/Errors';
        $compiledPath = __DIR__ . '/../Views/Compiles';

        $blade = new BladeOne($templatePath, $compiledPath);

        echo $blade->run('error', ['errorMessage' => $errorMessage]);
    }
}
