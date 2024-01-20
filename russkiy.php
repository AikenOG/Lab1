<!DOCTYPE html>
<html>
<head>
    <title>Задания по Русскому языку</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF8">
</head>
<body>
    <h1>Задания ЕГЭ по Русскому языку</h1>

    <?php
    // Определение вопросов и ответов
    $questions = [
        ["question" => "На какие вопросы отвечает существительное по своим признакам?", "answer" => "Кто? Что?"],
        ["question" => "Что такое глагол?", "answer" => "Действие"],
        ["question" => "Что такое русский словарь ожигова?", "answer" => "Кошмар"],
        ["question" => "Какое слово является синонимом к слову 'Прекрасный' ?", "answer" => "Превосходный"],
        ["question" => "Какое слово является антонимом к слову 'Холодный' ?", "answer" => "Горячий"]
    ];

    $responses = $_POST['answers'] ?? [];
    $validationErrors = [];
    $correctness = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $questionIndex = key($_POST['answers']);
        $response = trim($responses[$questionIndex]);
        if ($response === '') {
            $validationErrors[$questionIndex] = 'Ответ не может быть пустым';
        } else {
            $correctness[$questionIndex] = strtolower($response) === strtolower($questions[$questionIndex]['answer']);
        }
    }
    ?>

    <?php foreach ($questions as $index => $q): ?>
        <div class="task <?= isset($correctness[$index]) ? ($correctness[$index] ? 'correct' : 'incorrect') : '' ?>">
            <div class="task-title">Задание <?= $index + 1 ?></div>
            <p class="task-text"><?= $q['question'] ?></p>
            <form class="response-form" method="post">
                <input type="text" name="answers[<?= $index ?>]" value="<?= htmlspecialchars($responses[$index] ?? '') ?>" placeholder="Введите ваш ответ">
                <button type="submit">ОК</button>
                <div class="error-message">
                    <?php if (isset($validationErrors[$index])): ?>
                        <span class="error"><?= $validationErrors[$index] ?></span>
                    <?php elseif (isset($correctness[$index]) && !$correctness[$index]): ?>
                        <span class="error">Ошибка!</span>
                    <?php endif; ?>
                </div>
            </form>

        </div>
    <?php endforeach; ?>

    <footer>
        <div class="footer-content">
            <img src="img/logo.jpg" alt="Логотип" class="footer-logo" onclick="location.href='index.html'">
        </div>
    </footer>
</body>
</html>