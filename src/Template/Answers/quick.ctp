<?php
echo '<table>';
echo $this->Html->tableHeaders([
    __('Title'),
    __('Answer')
]);
$rows = [];
foreach ($questions as $question) {
    $answerValue = '-';
    if (isset($question->answers[0]->answer)) {
        $answerValue = __('NO');
        if ($question->answers[0]->answer) {
            $answerValue = __('YES');
        }
    }
    $postLinkYes = $this->Form->postLink(__('YES'), [
        'action' => 'answer',
        $question->id,
        true
    ]);
    $postLinkNo = $this->Form->postLink(__('NO'), [
        'action' => 'answer',
        $question->id,
        false
    ]);
    $rows[] = [
        $question->title,
        $answerValue
    ];
}
echo $this->Html->tableCells($rows);
echo '</table>';