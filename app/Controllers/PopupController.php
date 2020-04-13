<?php

namespace App\Controllers;

use Framework\Http\Response;
use Framework\Routing\Controller;

class PopupController extends Controller
{
    /**
     * Displays the index view.
     *
     * @return Response
     */
    public function index() : Response
    {
        return $this->response()
            ->view('index');
    }

    /**
     * Gets the popup content.
     *
     * @return Response
     */
    public function getContent()
    {
        return $this->response()
            ->json([
                'content' => <<<EOT
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tristique magna ante.
                    Nunc gravida, nunc eget posuere fermentum, quam tortor varius nulla, et fermentum ipsum eros quis nisi.
                    Duis viverra consectetur arcu. Etiam pellentesque dui odio, in sagittis quam rhoncus et.
                    Sed nec elit non urna ultrices hendrerit. Maecenas a nisl id augue interdum interdum eu ut leo.
                    Ut id mauris massa.
                    Etiam imperdiet ante vitae libero congue, et commodo nisl hendrerit.
                    Praesent urna ante, facilisis sed mauris eget, consectetur sagittis velit.
                    Vivamus at bibendum orci.
                    Proin consequat, odio quis egestas tempor, velit metus maximus justo, quis sollicitudin erat nisl ac nunc.
                    Maecenas vel mauris sit amet augue imperdiet pharetra eget eu quam.
                    EOT
            ]);
    }
}