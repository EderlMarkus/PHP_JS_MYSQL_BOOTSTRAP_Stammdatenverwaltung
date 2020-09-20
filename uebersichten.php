<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include './components/header.html';?>
  </head>
  <body>
  <?php include './components/navbar.html';?>
    <div class="container m-2 blendIn">
      <div class="fixed bottom">
        <div class="row">
          <div class="col-sm">
            <button id="getHistorie" class="m-2 btn btn-primary">
              Historie
            </button>
          </div>
          <div class="col-sm">
            <button id="getMitarbeiterSalary" class="m-2 btn btn-primary">
              Durchschnittsgehälter
            </button>
          </div>
        </div>
      </div>
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
            <th scope="col" class="extra"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <script src="./scripts/uebersichten.js?234"></script>
  </body>
</html>
