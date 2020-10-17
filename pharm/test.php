<body>
<form class = "records-form" action = "summary.php">
    <div class = "form-head" >Filter</div>
    <div class = "form-body filter">
        <label style ="width: unset;">Show from </label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="from">
        <label style ="width: unset;"> to</label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="to">
        <label style ="width: unset;">Customer</label>
        <select style = "padding:5px; vertical-align:super;" name="customer">
            <option>All</option>
            <?php
            for ($k = 0; $k < sizeof($cust); $k++) {
                extract($cust[$k], EXTR_PREFIX_ALL, 'm');
            ?>
                <option><?= $m_name ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" name="filter" value="Show Products" style = "margin-left: 0; margin-bottom: 0;">
    </form>
    </div>
</body>
 