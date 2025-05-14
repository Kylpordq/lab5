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

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>my shop</title>
</head>

<body>
    <h2>#write-comment</h2>
    <form method="POST">
        <label>Name:
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        </label><br>
        <?php if (!empty($errors['name']))
            foreach ($errors['name'] as $e)
                echo "<p style='color:red;'>$e</p>"; ?>

        <label>Mail:
            <input type="email" name="mail" value="<?= htmlspecialchars($email) ?>">
        </label><br>
        <?php if (!empty($errors['mail']))
            foreach ($errors['mail'] as $e)
                echo "<p style='color:red;'>$e</p>"; ?>

        <label>Comment:<br>
            <textarea name="comment"><?= htmlspecialchars($comment) ?></textarea>
        </label><br>
        <?php if (!empty($errors['comment']))
            foreach ($errors['comment'] as $e)
                echo "<p style='color:red;'>$e</p>"; ?>

        <label>
            <input type="checkbox" name="agree" <?= $agree ? 'checked' : '' ?>>
            Do you agree with data procesing ?
        </label><br>
        <?php if (!empty($errors['agree']))
            foreach ($errors['agree'] as $e)
                echo "<p style='color:red;'>$e</p>"; ?>

        <button type="submit">Send</button>
    </form>

    <?php if ($success): ?>
        <p style="color:green;">Thank you! Data sent successfully.</p>
    <?php endif; ?>
</body>

</html>