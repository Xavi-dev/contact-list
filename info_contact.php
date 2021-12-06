<?php 

$title = "Contact info";
require_once("includes/header.php"); 

   if (isset($_GET['id'])) {
      $idContact = $_GET['id'];
      }

      $query = "SELECT * FROM contacts WHERE id = :id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":id", $idContact, PDO::PARAM_INT);
      $stmt->execute();

      $contact = $stmt->fetch(PDO::FETCH_OBJ);

?>

<div class="container-lg container-table">

    <div class="row">

        <div class="col-sm-12">
            <h3 class="mb-4"><img src="img/icon-info.svg" alt="" class="me-2">Contact info</h3>
            <p><?php echo "<strong>Name: </strong>" . $contact->nom; ?></p>
            <p><?php echo "<strong>Last name: </strong>" . $contact->cognoms; ?></p>

            <p><a href="tel:+<?php echo "+" . $contact->prefix; ?><?php echo $contact->telefon; ?>">
                    <img src="img/icon-watsap.svg" alt="" class="icon-form">
                    <?php echo "+" . $contact->prefix . " "; ?><?php echo $contact->telefon; ?>
                </a></p>

            <p><a href="mailto:<?php echo $contact->email; ?>"><img src="img/ICON_Contact-agenda.svg" alt=""
                        class="icon-form me-2"><?php echo $contact->email; ?></a></p>
        </div>

        <div class="col-sm-6">
            <a href="edit_contact.php?id=<?php echo $contact->id; ?>"><img src="img/gtk-edit.svg" alt=""
                    class="me-2"></a>
            <a href="delete_contact.php?id=<?php echo $contact->id; ?>"><img src="img/erase-red.svg" alt=""></a>
        </div>

    </div>
</div>

<?php require_once("includes/footer.php") ?>
