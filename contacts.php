<?php 

$title = "Contacts";
require_once("includes/header.php");

   $query = "SELECT * FROM contacts";
   $stmt = $conn->query($query);
   $contacts = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="d-flex">

    <?php require_once("nav_contact_list.php");?>

    <div class="container-lg container-table align-items-center">

      <?php require_once("includes/alert-ok.php"); ?>

      <div class="row">
         <div class="col-md-7 col-sm-12">
               <h2><a href="create_contact.php"><img src="img/new-contact.svg" class="me-1 pb-1" alt="">Create new
                     contact</a></h2>
         </div>

         <div class="col-md-1 pe-md-0 mt-2">
               <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                  <button type="submit" class="button-search"><img src="img/edit-find.svg" class="icon-search mt-1"
                           alt=""></button>
         </div>
         <div class="col-md-4 col-sm-12 col-search mt-2">
               <input type="text" class="input-search form-control" id="myInput" placeholder="Search contact...">
         </div>
         </form>
      </div>

      <div class="row mt-2">
         <div class="col-sm-12">
               <table class="table table-striped">
                  <thead>
                     <tr>
                           <th></th>
                           <th>Name</th>
                           <th>Last name</th>
                           <th class="pc-table-title">Mobile</th>
                           <th class="pc-table-title">Email</th>
                     </tr>
                  </thead>

                  <tbody id="myTable">

                     <?php foreach($contacts as $i) : ?>

                     <tr class="tr-table">
                           <td>
                              <a href="info_contact.php?id=<?php echo $i->id; ?>"><img src="img/icon-info.svg" alt=""
                                       class="icon-form only-mobile"></a>
                              <a href="edit_contact.php?id=<?php echo $i->id; ?>"><img src="img/gtk-edit.svg" alt=""
                                       class="icon-form no-mobile"></a>
                              <a href="delete_contact.php?id=<?php echo $i->id; ?>"><img src="img/erase-red.svg"
                                       alt="" class="icon-form no-mobile"></a>
                           </td>
                           <td><?php echo $i->name; ?></td>
                           <td><?php echo $i->lastname; ?></td>
                           <td class="pc-table">
                              <a href="tel:+<?php echo "+" . $i->prefix; ?>
                  <?php echo $i->mobile; ?>"><img src="img/icon-watsap.svg" alt=""
                                       class="icon-form"><?php echo "+" . $i->prefix. " " . $i->mobile; ?></a>
                           </td>
                           <td class="pc-table">
                              <a href="mailto:<?php echo $i->email; ?>"><img src="img/ICON_Contact-agenda.svg" alt=""
                                       class="icon-mail"><?php echo $i->email; ?></a>
                           </td>
                     </tr>

                     <?php endforeach; ?>

                  </tbody>
               </table>
         </div>
      </div>

      <?php require_once("includes/footer.php") ?>

      <!-- Jquery search contacts -->

      <script>
      $(document).ready(function() {
         $("#myInput").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
         });
      });
      </script>
