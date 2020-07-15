<style>
    table { border-collapse:collapse; }
    th, td { border:1px solid gray; }
</style>

<button onclick="add_row()">행 추가하기</button>
<button onclick="delete_row()">행 삭제하기</button>
<hr>
<table>
    <thead>
    <th>profdgsgduct</th>
    <th>model</th>
    </thead>
    <tbody id="my-tbody"></tbody>
</table>

<script>
    function add_row() {
        var my_tbody = document.getElementById('my-tbody');
        // var row = my_tbody.insertRow(0); // 상단에 추가
        var row = my_tbody.insertRow( my_tbody.rows.length ); // 하단에 추가
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = '항목';
        cell2.innerHTML = new Date().toUTCString();
    }

    function delete_row() {
        var my_tbody = document.getElementById('my-tbody');
        if (my_tbody.rows.length < 1) return;
        // my_tbody.deleteRow(0); // 상단부터 삭제
        my_tbody.deleteRow( my_tbody.rows.length-1 ); // 하단부터 삭제
    }
</script>