<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = $_POST['age'];
    $course = $_POST['course'];
    $experience = $_POST['experience'];
    $notify = isset($_POST['notify']) ? 'Да' : 'Нет';
    $goal = $_POST['goal'];

}
?>

<form method="POST">
    <p>Возраст: <input type="number" name="age" required></p>

    <p>Курс:
        <select name="course" required>
            <option value="PHP">PHP</option>
            <option value="HTML">HTML</option>
            <option value="JavaScript">JavaScript</option>
        </select>
    </p>

    <p>Опыт:</p>
    <label><input type="radio" name="experience" value="Начинающий" required> Начинающий</label><br>
    <label><input type="radio" name="experience" value="Средний"> Средний</label><br>
    <label><input type="radio" name="experience" value="Продвинутый"> Продвинутый</label><br>

    <p><label><input type="checkbox" name="notify"> Получать уведомления</label></p>

    <p>Цель обучения:<br>
        <textarea name="goal" rows="4" cols="30" required></textarea>
    </p>

    <button type="submit">Отправить</button>

    <?php
    echo "<h3>Результаты:</h3>";
    echo "Возраст: $age<br>";
    echo "Курс: $course<br>";
    echo "Опыт: $experience<br>";
    echo "Получать уведомления: $notify<br>";
    echo "Цель обучения: $goal<br>";
    ?>
</form>