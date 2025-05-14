# lab5 Григоровский Дмитрий
## 1. Инструкции по запуску проекта
1. Скачайте проект и разместите файлы в директории веб-сервера:
`git clone https://github.com/ваш-репозиторий.git`
2. Запустите сервер:
   `php -S localhost:8000`
4. Откройте в браузере:
   `http://localhost:8000`
## 2. Описание лабораторной работы   
_Цель:_сПознакомиться с глобальной переменной $_POST и обработкой данных из форм в PHP. Научиться валидировать пользовательские данные, работать с различными типами элементов формы, а также анализировать различия между $_REQUEST и $_POST.
## 3. Краткая документация к проекту 
<table>
    <tr>
        <th>Файл</th>
        <th>Описание</th>
    </tr>
    <tr>
        <td>index.php</td>
        <td>Решение 1 задания</td>
    </tr>
    <tr>
       <td>index2.php</td>
      <td>Решение 2 задания </td>
    </tr>
     <tr>
          <td>index3.php</td>
      <td>Решение 3 задания </td>
    </tr>
   <tr>
          <td>index4.php</td>
      <td>Решение 4 задания </td>
    </tr>
</table>

## 4. Примеры использования проекта с приложением скриншотов или фрагментов кода
1. Работа с глобальной переменной $_POST
   Объясните, что такое глобальные переменные $_POST и $_SERVER["PHP_SELF"].

$_POST - суперглобальный массив, содержащий данные, отправленные медотом POST.

$_SERVER["PHP_SELF"]- возвращает путь к текущему скрипту, используется как action, чтобы отправить форму на ту же страницу

   ```php
   <?php
$name = '';
$email = '';
$review = '';
$comment = '';
$error = '';
$showResult = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $review = $_POST['review'] ?? '';
    $comment = trim($_POST['comment'] ?? '');

    if ($name === '' || $email === '' || $review === '' || $comment === '') {
        $error = 'Пожалуйста, заполните все поля.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Введите корректный email.';
    } else {
        $showResult = true;
    }
}
?>
   ```
Скриншот:
![image](https://github.com/user-attachments/assets/563dc911-27cf-49e9-a0cc-fd8451db7bfd)
![image](https://github.com/user-attachments/assets/0f6d45ef-3ec5-44e7-92e7-3853e40be082)

2. 

