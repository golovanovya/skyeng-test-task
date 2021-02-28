<?php
declare(strict_types=1);

namespace App\Controller;

use SimpleXMLElement;
use App\Decorator\DecoratorManager;

/**
 * @todo
 * Нарушается принципы единственной ответственности,
 * открытости/закрытости и инверсии зависимости
 * опечатка в имени поля $isProdaction
 */
class LessonController
{
    public $isProdaction;
    public $host;
    public $user;
    public $password;
    public $memcacheCache;
    public $nullCache;
    public $kibanaLogger;
    public $fileLogger;

    /**
     * @param int $cat
     * @param string $rt
     * @todo разобраться с входными параметрами
     * $cat обозначен как int, но проверяется с помощью regexp как строка
     * эта строка должна состоять 5 цифр и проверяется на то что число больше 0
     * т.е. странная валидация
     */
    public function action($cat, $rt = null)
    {
        /**
         * @todo непонятная ошибка валидации
         */
        if (!preg_match('/[0-9]{5}/', $cat) || $cat <= 0) {
            echo "error";
            exit;
        }
        if (is_null($rt)) {
            $rt = 'json';
        }
        if ($this->isProdaction) {
            /** @var DecoratorManager $decorator_manager не соответствует формату PSR */
            $decorator_manager = new DecoratorManager($this->user, $this->password, $this->host, $this->kibanaLogger);
            $decorator_manager->setCache($this->memcacheCache);
        } else {
            $decorator_manager = new DecoratorManager($this->user, $this->password, $this->host, $this->fileLogger);
            $decorator_manager->setCache($this->nullCache);
        }
        $data = $decorator_manager->getResponse(["categoryId" => $cat, '']);
        if ($data != []) {
            /**
             * @todo странный параметр для выбора формата ответа
             * обычно принято передавать через заголовки запроса
             * application/json
             * application/xml
             */
            if ($rt == 'xml') {
                $xml = new SimpleXMLElement('<root/>');
                array_walk_recursive($data, [$xml, 'addChild']);
                echo $xml->asXML();
                exit;
            } elseif ($rt == 'json') {
                echo json_encode($data);
                exit;
            }
        }
        /**
         * в случае если не обработается ни одним обработчиком
         * ползователь не узнает почему произошла ошибка
         */
        echo "error";
        exit;
    }
}
