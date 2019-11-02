<?php if($data) : ?>

  <?php foreach($data as $row): ?>

    <!-- card with download button -->
    <div class="card my-3">
      <div class="card-body">
        <div class="card-title">
          <img class="rounded-circle" src="../files/profile/<?php echo $row->image_p ?>" width="40px" height="40px">
          <span class="h5"><?php echo strtoupper($row->nom_p) ?></span>
          <h6 class="float-right text-muted"><?php echo $row->date_inscr ?></h6>
        </div>
        <p class="card-text">
          <?php echo $row->description ?>
        </p>

        <!-- checking file type -->
        <?php 
          $filename = $row->lien;

          $ext = explode('.', $filename);
          $finalext = strtolower(end($ext));
          if($finalext === "jpg" || $finalext === "png" || $finalext === "jpeg"):
         ?>
        <img class="card-img" src="../files/postes/<?php echo $row->lien ?>">

        <?php else: ?>
          <a href="../files/postes/<?php echo $row->lien ?>" class="btn btn-primary" download>Telecharger</a>
        <?php endif; ?>
        <span class="text-muted float-right"><?php echo $row->type ?></span>
      </div>
    </div>

  <?php endforeach ; ?>

<?php else : ?>
  <h2 class="text-center">Aucun Affichage trouver</h2>
<?php endif ; ?>
