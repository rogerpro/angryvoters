<?php
echo $this->Html->tag('h1', __('Últimas preguntas'));
// debug($questions->toArray());
debug($questions->first());

$tableContents = '';

$rows = [];
foreach ($questions as $question) {
    $rows[] = [
        h($question->title)
    ];
}
$tableContents .= $this->Html->tableHeaders([
    __('Question'),
    __('Answers'),
    __('Yes'),
    __('No')
]);
$tableContents .= $this->Html->tableCells($rows);

echo $this->Html->tag('table', $tableContents);
