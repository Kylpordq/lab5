# lab5 Григоровский Дмитрий
## 1. Инструкции по запуску проекта
1. Скачайте проект и разместите файлы в директории веб-сервера:
`git clone https://github.com/ваш-репозиторий.git`
2. Запустите сервер:
   `php -S localhost:8000`
4. Откройте в браузере:
   `http://localhost:8000`
## 2. Описание лабораторной работы   
__Цель:__ Познакомиться с глобальной переменной $_POST и обработкой данных из форм в PHP. Научиться валидировать пользовательские данные, работать с различными типами элементов формы, а также анализировать различия между $_REQUEST и $_POST.
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

2. Получение данных с различных контроллеров

 ```php
 <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = $_POST['age'];
    $course = $_POST['course'];
    $experience = $_POST['experience'];
    $notify = isset($_POST['notify']) ? 'Да' : 'Нет';
    $goal = $_POST['goal'];

}
?>
```
Скриншот:
![image](https://github.com/user-attachments/assets/2406030b-e4a9-4e22-8dd1-d735c88e63a3)

3. Создание, обработка и валидация форм
 Объясните, чем отличаются глобальные переменные $_REQUEST и $_POST.
$_REQUEST - Объединяет $_GET, $_POST B $_COOKIE. Имеет проблемы с безопасностью.
$_POST - массив, содержащий данные из формы, отправленные методом POST.

```php
<?php
$name = $email = $comment = "";
$agree = false;
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['mail'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $agree = isset($_POST['agree']);


    if (strlen($name) < 3) {
        $errors['name'][] = "Имя должно быть не короче 3 символов.";
    }
    if (strlen($name) > 20) {
        $errors['name'][] = "Имя должно быть не длиннее 20 символов.";
    }
    if (preg_match('/\d/', $name)) {
        $errors['name'][] = "Имя не должно содержать цифры.";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'][] = "Неверный формат email.";
    }

    if (empty($comment)) {
        $errors['comment'][] = "Комментарий обязателен.";
    } elseif (strlen($comment) < 10) {
        $errors['comment'][] = "Комментарий должен содержать не менее 10 символов.";
    }


    if (!$agree) {
        $errors['agree'][] = "Необходимо согласиться на обработку данных.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>

 ```
Скриншот:
![image](https://github.com/user-attachments/assets/831f8957-36d1-4347-b717-b19386facdd5)
![image](https://github.com/user-attachments/assets/30a0c4c6-61c5-4561-81f1-b46a67fa2f56)

4. Создание теста
   
  ```php
<?php
$errors = [];
$result = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $answer1 = $_POST['question1'] ?? '';
    $answer2 = $_POST['question2'] ?? [];
    $answer3 = $_POST['question3'] ?? '';


    if ($name === '') {
        $errors[] = "Введите имя.";
    }


    if ($answer1 === '') {
        $errors[] = "Выберите ответ на вопрос 1.";
    }

    if (empty($answer2)) {
        $errors[] = "Выберите хотя бы один вариант в вопросе 2.";
    }

    if ($answer3 === '') {
        $errors[] = "Выберите ответ на вопрос 3.";
    }


    if (empty($errors)) {
        $score = 0;

        if ($answer1 === 'c')
            $score++;
        if (in_array('c', $answer2) && in_array('a', $answer2) && count($answer2) === 2)
            $score++;
        if ($answer3 === 'a')
            $score++;

        $result = [
            'name' => $name,
            'score' => $score,
            'total' => 3
        ];
    }
}
?>

   ```
Скриншот:
![image](https://github.com/user-attachments/assets/ce0cb2fe-5cd1-4e21-a51f-eebacb78fd92)


