<?php
require 'vendor/autoload.php';
use \atk4\ui\Header;
$app = new \atk4\ui\App('Добро пожаловать в игру!');
$app->initLayout('Centered');
$app->add(['Header', 'Инструкция']);
$text = $app->add(['Text']);
$text->addParagraph('Эта игра демонстрирует, как использовать Links, Buttons, Headers, Text в Agile Toolkit.');
$text->addParagraph("Для игры Вам необходимо загадать любое целое число от 1 до 100 включительно. После того, как Вы загадали число, нажмите кнопку 'Начать игру!' ");
$button = $app->layout->add(['Button', "Начать игру!",'iconRight'=>'smile']);
//$button->set(['primary'=>true]);
$button->link(['main','max'=>100,'min'=>0]);
$button->addClass('teal inverted');
$db = New
\atk4\data\Persistence_SQL('mysql:dbname=friends;host=localhost','root','');
class Friends extends \atk4\data\Model {
  public $table = 'user';
  function init() {
    parent::init();
    $this->addField('name');
    $this->addField('surname');
    $this->addField('phone_numbber',['default'=>'+371']);
    $this->addField('nickname');
    $this->addField('password',['type'=>'password']);
    $this->addField('birthday',['type'=>'date']);
    $this->addField('notes', ['type'=>'text']);
  }
}
$form = $app->layout->add('Form');
$form->setModel(new Friend($db));
$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success('Record update');
});
$button = $app->layout->add(['label','Хочу новое обновление']);
