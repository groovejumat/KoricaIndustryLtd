<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Sending post data to popup window</title>
</head>
<body>
<form action="popup.php" method="post" target="popup" onsubmit="window.open('popup.php', 'popup', 'width=100, height=100');">
    <input type="hidden" name="var" value="<?php echo "좀비"?>">
    <input type="submit">
</form>
</body>
</html>