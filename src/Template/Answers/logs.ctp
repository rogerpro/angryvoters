<?php
echo $this->Html->tag('h1', __('Últimas respuestas'));

$tableContents = '';

$rows = [];
foreach ($answers as $answers) {
    $rows[] = [
        h($answers->user->first_name),
        h($answers->display_answer),
        $answers->id
    ];
}
$tableContents .= $this->Html->tableHeaders([
    [
        __('Usuario') => [
            'class' => 'c1',
            'title' => 'hey'
        ]
    ],
    __('Respuesta'),
    __('Id')
]);
$tableContents .= $this->Html->tableCells($rows);

echo $this->Html->tag('table', $tableContents);
