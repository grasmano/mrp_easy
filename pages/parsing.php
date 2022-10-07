<?php

$parsingResult = [];
$showParsingFunctionResult = false;

if (isset($_POST['run_parse_function'])) {
    $string = "[TAG_NAME:some_desc]some_data[/TAG_NAME]";
    $parsingResult = ParseTags::parse($string);
    $showParsingFunctionResult = true;
}

?>

<div>
    <h5>1. Parse tags</h5>
    <div class="col-4 mt-3 mb-5">
        <div class="row">
            <div class=" col-md-12">
                <form id="logout_form" name="logout_form" method="post">
                    <input type="submit" class="col-12 btn btn-primary mt-2" name="run_parse_function"
                           value="Run string parsing function">
                    <input type="submit" class="col-12 btn btn-primary mt-2" name="run_tests" value="Run tests">
                </form>
            </div>
            <?php if ($showParsingFunctionResult == true) { ?>
                <div class="mt-5">
                    <div class="font-weight-bold">String:</div>
                    <span><?php echo $string; ?></span>
                    <div class="font-weight-bold">Parsing result:</div>
                    <span>
                    <?php
                    echo '<pre>';
                    print_r($parsingResult);
                    echo '</pre>';
                    ?>
                </span>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
if (isset($_POST['run_tests'])) {
    include './tests/ParsingTests.php';
    $parsingTests = new ParsingTests();
    $classMethods = get_class_methods('ParsingTests');
    array_splice($classMethods, 4);

    try {
        foreach ($classMethods as $key => $classMethod) {
            echo $key + 1 . ". Run test $classMethod. ";
            $parsingTests->$classMethod();
            echo "Result OK <br/>";
        }
    } catch (Exception $e) {
        echo "Result Failed: {$e->getMessage()} <br/>";
    }
}
?>