<?php
echo $this->Html->tag('h1', __('Últimas preguntas'));
// debug($questions->toArray());
// debug($questions->first());

$tableContents = '';

$rows = [];
foreach ($questions as $question) {
    $rows[] = [
        h($question->title),
        h($question->total_answers)
    ];
}
$tableContents .= $this->Html->tableHeaders([
    __('Question'),
    __('Total Answers'),
    __('Yes'),
    __('No')
]);
$tableContents .= $this->Html->tableCells($rows);

echo $this->Html->tag('table', $tableContents);
