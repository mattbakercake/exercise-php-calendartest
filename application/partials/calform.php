<!-- form view partial -->

<form method="post">
    <fieldset>
        <input type="submit" name="prev" value="&#8592; Prev"/>
        <input type="submit" name="next" value="Next &#8594;"/>
    </fieldset>
    
    <fieldset>
        <label for="month">Month: </label>
        <select id="month" name="month">
           <?php foreach($view->selectMonths() as $option) { echo $option; } ?>
        </select>

        <label for="year">Year: </label>
        <select id="year" name="year">
            <?php foreach($view->selectYears() as $option) { echo $option; }?>
        </select>

        <input type="submit" name="submit" value="Go"/>
    </fieldset>
    
    <input type="hidden" name="currentmonth" value="<?php echo $view->getMonth(); ?>" />
    <input type="hidden" name="currentyear" value="<?php echo $view->getYear(); ?>" />
</form>

