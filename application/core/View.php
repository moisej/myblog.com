<?php

namespace liw\application\core;

class View
{
    function __construct()
    {
    }

    /**
     * Метод для генерації сторінки (контенту)
     * @param $content_view загальний шаблон
     * @param $template_view шаблон, який генерується
     * @param null $data завантаженні з контроллера дані, які потрібно вивести в шаблоні
     */
    function generate($content_view, $template_view, $data = null)
    {
        include 'application/views/'.$template_view;
    }
}



