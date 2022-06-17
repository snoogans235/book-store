<?php
require_once('Classes/Controller.php');
require_once('Classes/Model.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
//handle form submission
if ( isset($_POST) ){
    $Controller = new Controller();
    $results = $Controller->SearchData($_POST['field'], $_POST['value']);
}
?>
<form name="search" method="post" style="width: 800px;display: flex;margin: 0 auto;flex-direction: column;align-items: flex-start;">
    <div style="display:flex;flex-direction:column;margin-bottom:10px;">
        <label for="field">Field:</label>
        <input type="text" name="field" id="field" value="<?=$_POST['field']?>"/>
    </div>

    <div style="display:flex;flex-direction:column;margin-bottom:10px;">
        <label for="value">Query:<sup>*</sup></label>
        <input type="text" name="value" id="value" value="<?=$_POST['value']?>" />
    </div>

    <button type="submit">Search</button>
</form>

<?php if ( isset($_POST) ) {?>
<ul>
    <?php foreach($results as $r){ ?>
    <li><?=$r['identifier']?></li>
    <?php } ?>
</ul>
<?php } ?>
</body>
</html>

