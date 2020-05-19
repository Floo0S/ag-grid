<?php
$pageTitle = "Set Filter - Excel Mode";
$pageDescription = "Enterprise feature of ag-Grid supporting Angular, React, Javascript and more. One such feature is Set Filter. Set Filter works like Excel, providing checkboxes to select values from a set. Version 20 is available for download now, take it for a free two month trial.";
$pageKeywords = "ag-Grid JavaScript Data Grid Excel Set Filtering";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<h1 class="heading-enterprise">Set Filter - Excel Mode</h1>

<p class="lead">
    The Set Filter is a more powerful version of Excel's AutoFilter, allowing users to easily build more complex sets
    for filtering in less time. However, sometimes you may want to provide your users with an Excel-like experience.
    For this you can use Excel Mode.
</p>

<?= createSnippet(<<<SNIPPET
filterParams: {
    excelMode: 'windows' // can be 'windows' or 'mac'
    ...
}
SNIPPET
) ?>

<p>
    There are differences in how Excel's AutoFilter behaves depending on whether you are using the Windows or Mac
    version. ag-Grid therefore allows you to choose which behaviour you would like to use, by setting
    <code>excelMode</code> to <code>'windows'</code> or <code>'mac'</code> respectively.
</p>

<p>
    The example below demonstrates the differences between the different modes:
</p>

<ul class="content">
    <li>
        The <b>ag-Grid</b> column demonstrates the default behaviour of the Set Filter in ag-grid.
    </li>
    <li>
        The <b>Excel (Windows)</b> column demonstrates the behaviour of the Set Filter in Windows Excel Mode.
    </li>
    <li>
        The <b>Excel (Mac)</b> column demonstrates the behaviour of the Set Filter in Mac Excel Mode.
    </li>
</ul>

<?= grid_example('Excel Mode', 'excel-mode', 'generated', ['enterprise' => true, 'modules' => ['clientside', 'setfilter', 'menu']]) ?>

<h2>Differences Between Modes</h2>

<p>
    A more detailed breakdown of the differences in behaviour between the different modes can be found in the table
    below. For ag-Grid, this shows the default behaviour, but obviously the behaviour of ag-Grid can be
    adjusted to your needs.
</p>

<?php
    function printBehaviour($value) {
        $isPresent = false;
        $additionalInfo = null;

        if (is_string($value)) {
            $isPresent = true;
            $additionalInfo = $value;
        } else if (is_array($value)) {
            $isPresent = $value[0];
            $additionalInfo = $value[1];
        } else {
            $isPresent = $value;
        }

        if (is_null($isPresent)) {
            echo "<td>N/A</td>";
        }
        else {
            $icon = $isPresent ? 'check' : 'times';
            $colour = $isPresent ? 'green' : 'red';
            $text = is_null($additionalInfo) ? '' : " ($additionalInfo)";

            echo "<td><i class=\"fas fa-$icon\" style='color: $colour;'></i>$text</td>";
        }
    }

    function printBehaviourListRows() {
        $behaviours = json_decode(file_get_contents('excelMode.json'))->behaviours;

        foreach ($behaviours as $behaviour) {
            echo '<tr class="item-row">';
            echo "<td>$behaviour->behaviour</td>";
            printBehaviour($behaviour->agGrid);
            printBehaviour($behaviour->windowsExcel);
            printBehaviour($behaviour->macExcel);
            echo '</tr>';
        }
    }
?>

<table class="row-model-table reference">
    <tr class="first-row">
        <th>Behaviour</th>
        <th>ag-Grid</th>
        <th>Excel (Windows)</th>
        <th>Excel (Mac)</th>
    </tr>
    <?php printBehaviourListRows(); ?>
</table>

<?php include '../documentation-main/documentation_footer.php';?>
