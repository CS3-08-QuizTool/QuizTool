<?php

require_once(__DIR__ . '/config.php');

$quiz = new MyApp\Quiz();

try {
  $choiceSize = $quiz->getCurrentChoiceSize(); 
  $correctAnswer = $quiz->HostCheckAnswer();
} catch (Exception $e) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
  echo $e->getMessage();
  exit;
}
$quiz->add_current_num();
//json形式で返す
header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
  'choice_size' => $choiceSize,
  'correct_answer' => $correctAnswer
]);