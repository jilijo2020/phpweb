<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>学生列表</title>
  </head>
  <body>
    <table>
      <tr><th>ID编号</th><th>姓名</th><th>性别</th></tr>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['gender']?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </body>
</html>
