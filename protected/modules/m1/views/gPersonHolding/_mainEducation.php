<h3>Education</h3>
<?php echo $this->renderPartial('/gPerson/_tabEducation', ["model" => $model]); ?>

<h3>Non Formal Education</h3>
<?php
echo $this->renderPartial('/gPerson/_tabEducationNf', ["model" => $model]);
