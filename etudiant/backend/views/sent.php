<?php if($data): ?>
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col">Sent to</th>
        <th scope="col">Suject</th>
        <th scope="col">Message</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row): ?>
        <tr>
          <?php if($row->who_r === "e"): ?>
            <th scope="row"><?php echo $row->nom_e.' '.$row->prenom_e; ?></th>
          <?php elseif($row->who_r === "p"): ?>
            <th scope="row"><?php echo $row->nom_p; ?></th>
          <?php endif; ?>
          <td><?php echo $row->sujet; ?></td>
          <td>
            <?php echo shortenText($row->contenu); ?>
          </td>
          <td align="center">
            <button class="btn btn-outline-primary my-1 afficher" name="<?php echo($row->id_message) ?>">Afficher</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script type="text/javascript">
    $(".afficher").click(function() {
      
      $.ajax({
          type: 'POST',
          url: 'backend/work.php',
          data: { Page: 'message',
                  msgid: $(this).attr('name'),
                  stat: 's'},
          beforeSend:function(){
            // set the loading screen
            $("#content-loading").show();

            // disable scrolling
            $('html, body').css({
                "overflow-y": 'hidden',
                height: '100%'
            });

          },  
       error: function(){
        $("#content-loading").hide();
        $('html, body').css({
            "overflow-y": 'auto',
            height: 'auto'
        });

          alert("error no connection");
       },     
       success:function(data)
       {
        // remove the loading screen
        $("#content-loading").hide();

        // enable scrolling 
        $('html, body').css({
            "overflow-y": 'auto',
            height: 'auto'
        });

        // set the new content
          $("#mofid").html(data);

          // change the page title
          $("title").text("Espace Etudiant | Message");
       }
      });
    });

<?php else: ?>
  <h3 class="text-center">No message sent.</h3>
<?php endif; ?>
