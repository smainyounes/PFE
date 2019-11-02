<?php if($data) : ?>

  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Module</th>
        <th scope="col">Date d'ajout</th>
        <th scope="col">Date De Remise</th>
        <th scope="col">Telecharger</th>
      </tr>
    </thead>
    <tbody>

  <?php foreach($data as $row) : ?>
    <tr>
      <th scope="row"><?php echo $row->nom_module; ?></th>
      <td><?php echo $row->date_inscr; ?></td>
      <td><?php echo $row->date_exp; ?></td>
      <td align="center">
        <a href="<?php echo '../files/postes/'.$row->lien ?>" class="btn btn-primary my-1">Telecharger</a>
      </td>
    </tr>
  <?php endforeach; ?>

    </tbody>
  </table>
<?php else : ?>
  <h2 class="text-center">pas de Devoir de Maison</h2>
<?php endif; ?>
