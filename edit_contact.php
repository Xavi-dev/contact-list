<?php 

$title = "Edit contact";
require_once("includes/header.php"); 

   if (isset($_GET['id'])) {
      $idContact = $_GET['id'];
   }

      $query = "SELECT * FROM contacts WHERE id = :id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":id", $idContact, PDO::PARAM_INT);
      $stmt->execute();

      $contact = $stmt->fetch(PDO::FETCH_OBJ);

   if (isset($_POST["editContact"])) {
        
      $name = $_POST["name"];
      $lastName = $_POST["lastname"];
      $prefix = $_POST["prefix"];
      $mobile = $_POST["mobile"];
      $email = $_POST["email"];

   if (empty($name) || empty($lastName) || empty($prefix) || empty($mobile) || empty($email)) {
      $error = "Error. There are empty fields.";
      header('Location: edit_contact.php?error=' . $error);
   }else{           
      $query = "UPDATE contacts set name = :name, lastname = :lastname, prefix = :prefix, mobile = :mobile, email = :email  WHERE id = :id";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":lastname", $lastName, PDO::PARAM_STR);
      $stmt->bindParam(":prefix", $prefix, PDO::PARAM_STR);
      $stmt->bindParam(":mobile", $mobile, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":id", $idContact, PDO::PARAM_INT);

      $resultat = $stmt->execute();
            
      if ($resultat) {
         $message = "Contact edited successfully.";
         header('Location: contacts.php?missatge=' . $message);
         exit();
      }else{
         $error = "Error when editing the contact. There are empty fields or the email already exists.";
         header('Location: edit_contact.php?error=' . $error); 
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
            <div class="col-sm-12">
                <h3 class="font-weight-bold"><img src="img/gtk-edit.svg" alt="" class="me-1 mb-3">Edit contact</h3>

                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name"
                            value="<?php if($contact) echo $contact->name; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last name:</label>
                        <input type="text" class="form-control" name="lastname"
                            value="<?php if($contact) echo $contact->lastname; ?>" required>
                    </div>

                    <div class="row">

                        <div class="col-3 col-sm-2 mb-3">
                            <label for="prefix" class="form-label">Prefix:</label>
                            <input type="text" class="form-control" name="prefix"
                                value="<?php if($contact) echo $contact->prefix; ?>" required>
                        </div>
                        <div class="col-9 col-sm-10 mb-3">
                            <label for="mobile" class="form-label">Mobile:</label>
                            <input type="text" class="form-control" name="mobile"
                                value="<?php if($contact) echo $contact->mobile; ?>" required>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php if($contact) echo $contact->email; ?>" required>
                    </div>

                    <button type="submit" name="editContact" class="mt-3 btn w-100 bg-yellow-color">Edit
                        contact</button>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php") ?>
