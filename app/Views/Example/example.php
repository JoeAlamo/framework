<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Example</title>
</head>
<body>
    <h1>Example header</h1>
    <p>Lorem ipsum</p>
    <?php
        foreach ($routeParameters as $k => $v) {
            echo "<p>";
            echo htmlentities($k, ENT_QUOTES | ENT_XHTML, 'UTF-8');
            echo "=>";
            echo htmlentities($v, ENT_QUOTES | ENT_XHTML, 'UTF-8');
            echo "</p>";
        }
    ?>
</body>
</html>