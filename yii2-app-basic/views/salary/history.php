<h1>История начисления бонусов</h1>

<?php
echo '<table cellpadding="5" cellspacing="0" border="1">';
echo     '<thead>
              <tr>
                  <td> ID пользователя </td>
                  <td> Старая ЗП </td>
                  <td> Обновленная ЗП </td>
                  <td> Id бонуса </td>
                  <td> дата </td>
              </tr>
          </thead>';
foreach ($history as $item) {
    echo "<tr>";
    foreach ($item as $data)
        echo "<td>".$data."</td>";
    echo "</tr>";
}
echo "</table>";