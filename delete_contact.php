<?php 

$title = "Delete contact";
require_once("includes/header.php"); 

   if (isset($_GET['id'])) {
      $idContacte = $_GET['id'];
   }

   $query = "SELECT * FROM contactes WHERE id = :id";
   $stmt = $conn->prepare($query);

   $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);
   $stmt->execute();

   $contacte = $stmt->fetch(PDO::FETCH_OBJ);

   if (isset($_POST["eliminarContacte"])) {        
       
      $query = "DELETE FROM contactes WHERE id = :id";
      $stmt = $conn->prepare($query);       
      $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);

      $resultat = $stmt->execute();

   if ($resultat) {
      $missatge = "Contact deleted successfully.";
      header('Location: contacts.php?missatge=' . $missatge);
      exit();
   }else{
      $error = "Error, contact could not be deleted.";
      header('Location: delete_contact.php?error=' . $error); 
      exit();
   }
}

?>

<div class="agenda-main-container d-flex">

    <?php require_once("nav_contact_list.php"); ?>

    <div class="container-lg container-table align-items-center">

        <?php require_once("includes/alert-error.php"); ?>

        <div class="row">
            <h3><img src="img/erase-red.svg" alt="" class="me-1 mb-3">Delete contact</h3>

            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Name:</label>
                    <input type="text" class="form-control form-control-none" name="nom"
                        value="<?php if($contacte) echo $contacte->nom; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="cognoms" class="form-label">Last name:</label>
                    <input type="text" class="form-control form-control-none" name="cognoms"
                        value="<?php if($contacte) echo $contacte->cognoms; ?>" readonly>
                </div>

                <div class="row">
                    <div class="col-3 col-sm-2 mb-3">
                        <label for="prefix" class="form-label">Prefix:</label>
                        <input type="text" class="form-control" name="prefix"
                            value="<?php if($contacte) echo $contacte->prefix; ?>" readonly>
                    </div>
                    <div class="col-9 col-sm-10 mb-3">
                        <label for="telefon" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" name="telefon"
                            value="<?php if($contacte) echo $contacte->telefon; ?>" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control form-control-none" name="email"
                        value="<?php if($contacte) echo $contacte->email; ?>" readonly>
                </div>

                <button type="submit" name="eliminarContacte" class="mt-3 btn bg-red-color w-100">Delete
                    contact</button>
            </form>
        </div>
    </div>

</div>

<?php require_once("includes/footer.php") ?>