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

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>

<body>
    <h2>Задание 4</h2>
    <form method="POST">
        <label>Имя: <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>"></label><br><br>

        <p>1. Какое животное на флаге молдовы</p>
        <label><input type="radio" name="question1" value="a"> Зебра</label><br>
        <label><input type="radio" name="question1" value="b"> Кабан</label><br>
        <label><input type="radio" name="question1" value="c"> Зубр</label><br><br>

        <p>2. Травоядные животные</p>
        <label><input type="checkbox" name="question2[]" value="a"> Корова</label><br>
        <label><input type="checkbox" name="question2[]" value="b"> Лев</label><br>
        <label><input type="checkbox" name="question2[]" value="c"> Овца</label><br><br>

        <p>3. Гланый герой аниме Наруто? </p>
        <label><input type="radio" name="question3" value="a"> Наруто</label><br>
        <label><input type="radio" name="question3" value="b"> Анатолий</label><br>
        <label><input type="radio" name="question3" value="c"> Григорой</label><br><br>

        <button type="submit">Отправить</button>
    </form>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <h4>Ошибки:</h4>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($result): ?>
        <div style="margin-top: 20px;">
            <h3>Результат:</h3>
            <p>Имя: <strong><?= htmlspecialchars($result['name']) ?></strong></p>
            <p>Правильных ответов: <strong><?= $result['score'] ?> из <?= $result['total'] ?></strong></p>
        </div>
    <?php endif; ?>
</body>

</html>