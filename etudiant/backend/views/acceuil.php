<?php if($data) : ?>
  <?php $a=0; ?>
  <?php foreach($data as $row) :?>
    <?php if($a == 0 && $row->emploi !="") :?>
  <!-- Emploi  -->
  <div class="card my-3">
    <div class="card-body">
      <div class="card-title">
        <img class="rounded-circle" src="img/a.jpg" width="40px" height="40px">
        <span class="h5">Administration</span>
      </div>
      <?php 
        $filename = $row->emploi;

        $ext = explode('.', $filename);
        $finalext = strtolower(end($ext));
        if($finalext === "jpg" || $finalext === "png" || $finalext === "jpeg"):
       ?>
      <img class="card-img" src="../files/postes/<?php echo $row->emploi ?>">

      <?php else: ?>
        <a href="../files/postes/<?php echo $row->emploi ?>" class="btn btn-primary" download>Telecharger</a>
      <?php endif; ?>
    </div>
  </div>
    <?php $a=1; ?>
    <?php endif; ?>
    <div class="card my-3">
      <div class="card-body">
        <div class="card-title">
          <img class="rounded-circle" src="img/a.jpg" width="40px" height="40px">
          <span class="h5">Administration</span>
          <h6 class="float-right text-muted"><?php echo $row->date_inscr; ?></h6>
        </div>
        <p class="card-text">
          <?php echo $row->description; ?>
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
          <a href="../postes/files/<?php echo $row->lien ?>" class="btn btn-primary" download>Telecharger</a>
        <?php endif; ?>
        <span class="text-muted float-right"><?php echo $row->type ?></span>
      </div>
    </div>
<?php endforeach ; ?>

<?php else : ?>
  <h2 class="text-center">No data</h2>
<?php endif ; ?>

