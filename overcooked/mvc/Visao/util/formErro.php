<?php if ($this->temErro($campo)): ?>
    <p class="help-block alert alert-danger" role="alert "><?= $this->getErro($campo) ?></span>
<?php endif ?>