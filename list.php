<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список заявок</title>
</head>
<body>
    
    <?php 
    include_once("config.php");
    include_once("db_connect.php");

    $result = array();
  $query = "SELECT   `id`, `first_name`, `second_name`, `middle_name`, `date`,   `name_file` FROM `Form`";
    $res_query = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) {
        $row = mysqli_fetch_assoc($res_query);
        $arr = array(
            'name' => $row['first_name'],
            'second' => $row['second_name'],
            'middle' => $row['middle_name'],
            'date' => $row['date'],
            'id_file' => $row['id'],
            'name_file' => $row['name_file'],
        );
        array_push($result, $arr);
    }
    
    ?>
    <table border="3" bordercolor="black">
        <tr>
         <th>Имя</th>
         <th>Фамилия</th>
         <th>Отчество</th>
         <th>Дата загрузки</th>
         <th>Файл</th>
        </tr>

        <? foreach ($result as $key => $value): ?>        
        <tr>
            <td><?=$value['name']?></td>
            <td><?=$value['second']?></td>
            <td><?=$value['middle']?></td>
            <td><?=$value['date']?></td>
            <td><a href="download.php?id=<?=$value['id_file']?>"><?=$value['name_file']?></a></td>
        </tr>
        <? endforeach; ?>
      </table>
</body>
</html>
