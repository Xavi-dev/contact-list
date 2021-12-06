<?php 

$title = "Create contact";
require_once("includes/header.php"); 

   if (isset($_POST["crearContacte"])) {
        
      $nom = $_POST["nom"];
      $cognoms = $_POST["cognoms"];
      $prefix = $_POST["prefix"];
      $telefon = $_POST["telefon"];
      $email = $_POST["email"];
      $categoria = $_POST["categoria"];

      if (empty($nom) || empty($cognoms) || empty($prefix) || empty($telefon) || empty($email)) {
         $error = "Error. There are empty fields.";
         header('Location: create_contact.php?error=' . $error);
      }else{           

         $query = "INSERT INTO contactes(nom, cognoms, prefix, telefon, email)VALUES(:nom, :cognoms, :prefix, :telefon, :email)";

         $stmt = $conn->prepare($query);

         $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
         $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
         $stmt->bindParam(":prefix", $prefix, PDO::PARAM_STR);
         $stmt->bindParam(":telefon", $telefon, PDO::PARAM_STR);
         $stmt->bindParam(":email", $email, PDO::PARAM_STR);

         $resultat = $stmt->execute();

         if ($resultat) {
            $missatge = "Contact created successfully.";
            header('Location: contacts.php?missatge=' . $missatge);
         }else{
            $error = "Error when creating the contact. There are empty fields or the email already exists.";
            header('Location: create_contact.php?error=' . $error); 
            exit();
         }
      }
   }

?>

<div class="d-flex">

    <?php require_once("nav_contact_list.php");?>

    <div class="container-lg container-table align-items-center">

        <?php require_once("includes/alert-error.php"); ?>

        <div class="row">
            <h3 class="font-weight-bold"><img src="img/contact.svg" alt="" class="me-1 mb-3">Create a new contact</h3>

            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="nom" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="cognoms" class="form-label">Last name:</label>
                    <input type="text" class="form-control" name="cognoms" required>
                </div>
                <div class="row">
                    <div class="col-3 col-sm-2 mb-3">
                        <label for="prefix" class="form-label">Prefix:</label>
                        <input type="text" class="form-control" name="prefix" placeholder="34" required>
                    </div>
                    <div class="col-9 col-sm-10  mb-3">
                        <label for="telefon" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" name="telefon" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <button type="submit" name="crearContacte" class="mt-3 btn bg-green-color w-100">Create new
                    contact</button>
            </form>

        </div>

    </div>

</div>

<?php require_once("includes/footer.php") ?>