<?defined('SYSPATH') or exit('Install must be loaded from within index.php!');?>

<?if (!empty(install::$error_msg)):?>
    <br>
    <div class="alert alert-danger"><?=install::$error_msg?></div>
<?endif?>

<?if(!empty(install::$msg)):?>
    <br>
    <div class="alert alert-warning">
        <?=__("We have detected some incompatibilities, installation may not work as expected but you can try.")?> <br>
        <?=install::$msg?>
    </div>
<?endif?>

<div class="jumbotron well">
    <h2>Ups! You need a compatible Hosting</h2>
    <p class="text-danger">Your hosting seems to be not compatible. Check your settings.<p>
</div>