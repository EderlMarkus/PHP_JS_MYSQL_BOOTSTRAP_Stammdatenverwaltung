<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include './components/header.html';?>
  </head>
  <body>
  <?php include './components/navbar.html';?>

    <form class="blendIn">
      <div class="form-group">
        <label for="name">Mitarbeitername:</label>

        <input type="text" class="form-control" fieldType = "name" id="name" placeholder="Name" />
      </div>
      <button type="submit" id="submit" class="btn btn-primary">Suchen</button>
    </form>
    <table class="table-responsive table blendIn" id="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Addresse</th>
          <th scope="col">Geburtsdatum</th>
          <th scope="col">Aufnahmedatum</th>
          <th scope="col">Austrittsdatum</th>
          <th scope="col">Gehalt</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    <script src="./scripts/lesen.js"></script>
  </body>
</html>
