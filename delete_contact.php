<?php 

$title = "Delete contact";
require_once("includes/header.php"); 

   if (isset($_GET['id'])) {
      $idContact = $_GET['id'];
   }

   $query = "SELECT * FROM contacts WHERE id = :id";
   $stmt = $conn->prepare($query);

   $stmt->bindParam(":id", $idContact, PDO::PARAM_INT);
   $stmt->execute();

   $contact = $stmt->fetch(PDO::FETCH_OBJ);

   if (isset($_POST["deleteContact"])) {        
       
      $query = "DELETE FROM contacts WHERE id = :id";
      $stmt = $conn->prepare($query);       
      $stmt->bindParam(":id", $idContact, PDO::PARAM_INT);

      $result = $stmt->execute();

   if ($result) {
      $message = "Contact deleted successfully.";
      header('Location: contacts.php?missatge=' . $message);
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
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control form-control-none" name="name"
                        value="<?php if($contact) echo $contact->name; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name:</label>
                    <input type="text" class="form-control form-control-none" name="lastname"
                        value="<?php if($contact) echo $contact->lastname; ?>" readonly>
                </div>

                <div class="row">
                    <div class="col-3 col-sm-2 mb-3">
                        <label for="prefix" class="form-label">Prefix:</label>
                        <input type="text" class="form-control" name="prefix"
                            value="<?php if($contact) echo $contact->prefix; ?>" readonly>
                    </div>
                    <div class="col-9 col-sm-10 mb-3">
                        <label for="mobile" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" name="mobile"
                            value="<?php if($contact) echo $contacte->mobile; ?>" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control form-control-none" name="email"
                        value="<?php if($contact) echo $contact->email; ?>" readonly>
                </div>

                <button type="submit" name="deleteContact" class="mt-3 btn bg-red-color w-100">Delete
                    contact</button>
               
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php") ?>
