<h1>Create an account</h1>
<?php $form = app\core\form\Form::begin('', "post")?>
<div class="row">
  <div class="col"><?php echo $form->field($model ,'firstname')  ?></div>
  <div class="col"><?php echo $form->field($model ,'lastname') ?></div>
</div>
<?php echo $form->field($model ,'email')?>
<?php echo $form->field($model ,'password')->passwordField()?>
<?php echo $form->field($model ,'confirmPassword')->passwordField()?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>
<!-- <form action="" method="post">
    <div class="row">
        <div class="col">
         <div class="form-group">
    <label >FirstName</label>
    <input type="text"  name="firstname" class="form-control">
         </div>
        </div>
        <div class="col">
         <div class="form-group">
    <label >LastName</label>
    <input type="text"  name="lastname" class="form-control">
          </div>
        </div>
    </div>
  <div class="form-group">
    <label >Email address</label>
    <input type="text"  name="email" class="form-control">
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password"  name="password" class="form-control">
  </div>
  <div class="form-group">
    <label >Confirm Password</label>
    <input type="password"  name="confirmPassword" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->