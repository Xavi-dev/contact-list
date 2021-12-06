<?php 

$title = "Create contact";
require_once("includes/header.php"); 

   if (isset($_POST["createContact"])) {
        
      $name = $_POST["name"];
      $lastName = $_POST["lastname"];
      $prefix = $_POST["prefix"];
      $mobile = $_POST["mobile"];
      $email = $_POST["email"];
      $category = $_POST["category"];

      if (empty($name) || empty($lastName) || empty($prefix) || empty($mobile) || empty($email)) {
         $error = "Error. There are empty fields.";
         header('Location: create_contact.php?error=' . $error);
      }else{           

         $query = "INSERT INTO contacts(name, lastname, prefix, mobile, email)VALUES(:name, :lastname, :prefix, :mobile, :email)";

         $stmt = $conn->prepare($query);

         $stmt->bindParam(":name", $name, PDO::PARAM_STR);
         $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
         $stmt->bindParam(":prefix", $prefix, PDO::PARAM_STR);
         $stmt->bindParam(":mobile", $mobile, PDO::PARAM_STR);
         $stmt->bindParam(":email", $email, PDO::PARAM_STR);

         $result = $stmt->execute();

         if ($result) {
            $message = "Contact created successfully.";
            header('Location: contacts.php?missatge=' . $message);
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
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name:</label>
                    <input type="text" class="form-control" name="lastname" required>
                </div>
                <div class="row">
                    <div class="col-3 col-sm-2 mb-3">
                        <label for="prefix" class="form-label">Prefix:</label>
                        <input type="text" class="form-control" name="prefix" placeholder="34" required>
                    </div>
                    <div class="col-9 col-sm-10  mb-3">
                        <label for="mobile" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" name="mobile" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <button type="submit" name="createContact" class="mt-3 btn bg-green-color w-100">Create new
                    contact</button>
            </form>

        </div>
    </div>
</div>

<?php require_once("includes/footer.php") ?>
