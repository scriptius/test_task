<h1>Рассчет ЗП</h1>

<?php
echo '<table cellpadding="5" cellspacing="0" border="1">';
echo     '<thead>
              <tr>
                  <td> ID пользователя </td>
                  <td> ФИО </td>
                  <td> Итоговая ЗП </td>
                  <td> Id бонуса </td>
              </tr>
          </thead>';

foreach ($salaryReport as $key => $value) {
    echo "<tr>";
    foreach ($value as $data)
        echo "<td>".$data."</td>";
    echo "</tr>";
}
echo "</table>";
