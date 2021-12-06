<?php 

$title = "Contact info";
require_once("includes/header.php"); 

   if (isset($_GET['id'])) {
      $idContacte = $_GET['id'];
      }

      $query = "SELECT * FROM contactes WHERE id = :id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);
      $stmt->execute();

      $contacte = $stmt->fetch(PDO::FETCH_OBJ);

?>

<div class="container-lg container-table">

    <div class="row">

        <div class="col-sm-12">
            <h3 class="mb-4"><img src="img/icon-info.svg" alt="" class="me-2">Contact info</h3>
            <p><?php echo "<strong>Name: </strong>" . $contacte->nom; ?></p>
            <p><?php echo "<strong>Last name: </strong>" . $contacte->cognoms; ?></p>

            <p><a href="tel:+<?php echo "+" . $contacte->prefix; ?><?php echo $contacte->telefon; ?>">
                    <img src="img/icon-watsap.svg" alt="" class="icon-form">
                    <?php echo "+" . $contacte->prefix . " "; ?><?php echo $contacte->telefon; ?>
                </a></p>

            <p><a href="mailto:<?php echo $contacte->email; ?>"><img src="img/ICON_Contact-agenda.svg" alt=""
                        class="icon-form me-2"><?php echo $contacte->email; ?></a></p>
        </div>

        <div class="col-sm-6">
            <a href="edit_contact.php?id=<?php echo $contacte->id; ?>"><img src="img/gtk-edit.svg" alt=""
                    class="me-2"></a>
            <a href="delete_contact.php?id=<?php echo $contacte->id; ?>"><img src="img/erase-red.svg" alt=""></a>
        </div>

    </div>
</div>

<?php require_once("includes/footer.php") ?>