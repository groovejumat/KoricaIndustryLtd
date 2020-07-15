<button id='btn-add-row'>행 추가하기</button>
<button id='btn-delete-row'>행 삭제하기</button>
<hr>

<form action="jqposttest.php" method="post" >
<table id="mytable" border="0" cellspacing="2">
    <tr>
        <th><input type="text" name="array1[]" placeholder="head" style="background-color: #aaaaaa"></th>
        <th><input type="text" name="array2[]" placeholder="head" style="background-color: #aaaaaa"></th>
        <th><input type="text" name="array3[]" placeholder="head" style="background-color: #aaaaaa"></th>
    </tr>
</table>
    <input type="submit" />
</form>

<script src="//code.jquery.com/jquery.min.js"></script>
<script>
    $('#btn-add-row').click(function() {
        var time = new Date().toLocaleTimeString();
        $('#mytable > tbody:last').append('<tr><td><input type="text" name="array1[]"></td><td><input type="text" name="array2[]"></td><td><input type="text" name="array3[]"></td></tr>');
    });
    $('#btn-delete-row').click(function() {
        $('#mytable > tbody:last > tr:last').remove();
    });
</script>


