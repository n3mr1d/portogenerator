<?php
// menampilkan login form
function loginform(){
  print_start('login','login');  
  echo<<<HTML
  <div class="kontainer-login">
  <div class="form-kontainer">
  HTML;
  shownotification();
  echo<<<HH
      
          <h3 class="login-admin">Login Admin</h3>
          <form action="" method="POST">
            <input type="hidden" name="login">
            <div class="form-group">
              <label for="username">Username:</label> 
              <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
          </form>
        </div>
      </div>
  HH;
    endhtml();
}
// validate login passwordd
function validate($username, $password) {
    global $db, $error;

    try {
        $cekuser = "SELECT * FROM admins WHERE username = :user";
        $stmt = $db->prepare($cekuser);
        $stmt->bindParam(':user', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['success'] = "Berhasil masuk!";
            $_SESSION['user_id'] = $user['id'];
            showManage();
          } else {
            $_SESSION['error'] = "Username atau password salah!";
            loginform();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();

    }
}

// regitser 
function regis(){
    print_start('register','login');
    echo<<<HTML
      <div class="kontainer-regiter">
        <div class="kontainer-reg">
        <h3 class="regitser-admin">regitser Admin</h3>
          <form action="" method="POST">
            <div class="form-group">
            <input type="hidden" name="register">
            <label for="username">Username:</label> 
            </div>
            <div class="form-group">
              <input type="text" name="username" id="username">
            <label  for="password">Password:</label>
            <input type="password" name="password"  id="password">
              </div>
              <button type="submit" class="btn-login" > register </button>
          </form>
      
         </div>
        </div>
    HTML;
    endhtml();
}
// form register apabila admin gak ada sama sekali
function isAdminsTableEmpty() {
    global $db;
    try {
        $query = "SELECT COUNT(*) as total FROM admins";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total'] == 0;

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
// function untuk menambahkan admin apabila database kkosong
function registeradmin($username,$password){
    global $db;
    // insert to dattabase

    $user = strtolower($username);
    $passwordhash= password_hash($password,PASSWORD_DEFAULT);
    try{
    $register = "INSERT INTO admins(username,password) values(:user,:pass)";
    $stmt =$db->prepare($register);
    $stmt->bindParam(':user',$user);
    $stmt->bindParam(':pass',$passwordhash);
    if($stmt->execute()){
      $_SESSION['error'] = "Kamu Berhasil melakukan register";
      showhome();
    }
    }catch(Exception $e){
        echo'Error: ' . $e->getMessage();
    }
}
// fungsi untuk menambahkan sebuah proyek baru
function showaddprojectform() {

    
    print_start("addproject","showform");
    echo<<<HTML
      <div class="kontainer-form">
        <div class="form-header">
            <h2>Add New Project</h2>
            <p>Fill in the details below to add a new project to your portfolio</p>
        </div>
HTML;
    shownotification();
    echo<<<HTML
        <div class="kontainer-text">
            <form action="" method="POST" enctype="multipart/form-data" id="projectForm">
                <input type="hidden" name="inputproject">
                <div class="form-group">
                    <label for="title">Title Project <span class="required">*</span></label>
                    <input type="text" id="title" name="title" required placeholder="Enter project title">
                </div>
                
                <div class="form-group">
                    <label for="deskrip">Description <span class="required">*</span></label>
                    <textarea id="deskrip" name="deskrip" rows="5" required placeholder="Explain about your project here"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="github">Github Repository <span class="required">*</span></label>
                        <input type="text" id="github" name="github" required placeholder="https://github.com/username/repo">
                    </div>
                    
                    <div class="form-group half">
                        <label for="demo">Demo Link</label>
                        <input type="text" id="demo" name="demo" placeholder="https://your-demo-link.com">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="progres">Project Status</label>
                    <select name="statuspo" id="progres">
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="project_tags">Project Tags</label>
                    <div class="tags-container">
                        <div class="tag-category">
                            <label>Languages</label>
                            <input type="text" id="language_tags" name="language_tags" placeholder="PHP, JavaScript, Python..." class="tag-input blue-tag">
                        </div>
                        <div class="tag-category">
                            <label>Frameworks</label>
                            <input type="text" id="framework_tags" name="framework_tags" placeholder="Laravel, React, Vue..." class="tag-input yellow-tag">
                        </div>
                        <div class="tag-category">
                            <label>Databases</label>
                            <input type="text" id="database_tags" name="database_tags" placeholder="MySQL, MongoDB, PostgreSQL..." class="tag-input red-tag">
                        </div>
                    </div>
                    <div class="tags-preview" id="tagsPreview"></div>
                </div>
                
                <div class="form-group">
                    <label for="project_images">Project Images <span class="required">*</span></label>
                    <div class="file-upload-container">
                        <input type="file" id="project_images" name="imgup" accept="image/*" required>
                        <div class="upload-button">
                            <i class="fas fa-cloud-upload-alt"></i> Choose Files
                        </div>
                    </div>
                    <div class="image-preview" id="imagePreview"></div>
                </div>
                
                <div class="form-actions">
                    <button type="reset" class="btn-secondary">Reset Form</button>
                    <button type="submit" name="submit_project" class="btn-primary">Submit Project</button>
                </div>
            </form>
        </div>
     </div>
HTML;
    jsallow('showproject');
    endhtml();
}

// Function to handle project submission
function handleProjectSubmission() {
    global $db;
    
    try {
        // Start transaction
        $db->beginTransaction();
        
        // Insert project data
        $stmt = $db->prepare("INSERT INTO project (title, deskrip, github, demo, statuspo) VALUES (:title, :deskrip, :github, :demo, :statuspo)");
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':deskrip', $_POST['deskrip']);
        $stmt->bindParam(':github', $_POST['github']);
        $stmt->bindParam(':demo', $_POST['demo']);
        $stmt->bindParam(':statuspo', $_POST['statuspo']);
        $stmt->execute();
        
        $projectId = $db->lastInsertId();
    
        // Process language tags
        if (!empty($_POST['language_tags'])) {
            $tag = $_POST['language_tags'];
            $color = '#3498db'; 
            
            $tagStmt = $db->prepare("INSERT INTO tag (tag, color, project_id) VALUES (:tag, :color, :project_id)");
            $tagStmt->bindParam(':tag', $tag);
            $tagStmt->bindParam(':color', $color);
            $tagStmt->bindParam(':project_id', $projectId);
            $tagStmt->execute();
        }
        
        // Process framework tags
        if (!empty($_POST['framework_tags'])) {
            $tag = $_POST['framework_tags'];
            $color = '#f39c12'; 
            
            $tagStmt = $db->prepare("INSERT INTO tag (tag, color, project_id) VALUES (:tag, :color, :project_id)");
            $tagStmt->bindParam(':tag', $tag);
            $tagStmt->bindParam(':color', $color);
            $tagStmt->bindParam(':project_id', $projectId);
            $tagStmt->execute();
        }
        
        // Process database tags
        if (!empty($_POST['database_tags'])) {
            $tag = $_POST['database_tags'];
            $color = '#e74c3c';
            
            $tagStmt = $db->prepare("INSERT INTO tag (tag, color, project_id) VALUES (:tag, :color, :project_id)");
            $tagStmt->bindParam(':tag', $tag);
            $tagStmt->bindParam(':color', $color);
            $tagStmt->bindParam(':project_id', $projectId);
            $tagStmt->execute();
        }

        // Process uploaded images
        $uploadDir =__DIR__ . '/uploads/';
      

        $fileName = time() . '_' . basename($_FILES['imgup']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['imgup']['tmp_name'], $targetFile)) {


            $relativePath = '/upload/' . $fileName;
            $imageStmt = $db->prepare("INSERT INTO image (project_id, path_image) VALUES (:project_id, :path_image)");
            $imageStmt->bindParam(':project_id', $projectId);
            $imageStmt->bindParam(':path_image', $relativePath);
            $imageStmt->execute();
        }
        
        $db->commit();
        $_SESSION['error'] = "Berhasil Memambahan project kedalam database";

        exit;
    } catch (Exception $e) {
        // Rollback transaction on error
        $db->rollBack();
         $_SESSION['error'] = "Error: " . $e->getMessage() ;
    }
}
// function untukk melakkuan editing data pada project feature
function editingpage($id){
  global $db;

  // Ambil data project
  $sql = "SELECT * FROM project WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_OBJ); 

  if (!$data) {
    echo "Data tidak ditemukan.";
    return;
  }

  // Ambil tag yang terkait
  $tagSql = "SELECT tag FROM tag WHERE project_id = :id";
  $tagStmt = $db->prepare($tagSql);
  $tagStmt->bindParam(':id', $id, PDO::PARAM_INT);
  $tagStmt->execute();
  $tagRows = $tagStmt->fetchAll(PDO::FETCH_OBJ);

  // Gabungkan semua tag jadi satu string
  $tags = array_map(function($row) {
    return $row->tag;
  }, $tagRows);
  $tagsString = htmlspecialchars(implode(", ", $tags)); 

  print_start("editing", "editing");
$selectedDraft = $data->statuspo === 'complated' ? 'selected' : '';
$selectedPublished = $data->statuspo === 'ongoing' ? 'selected' : '';

  echo <<<HTML
  <div class="kontainer-form">
    <h2 class="title-form">Edit Project</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="{$data->id}">
        <input type="hidden" name="action" value="update">

    <div class="groupform">
        <label>Judul</label>
        <input type="text" name="title" value="{$data->title}" required>
      </div>

      <div class="groupform">
        <label>Deskripsi</label>
        <textarea name="deskrip" required>{$data->deskrip}</textarea>
      </div>

      <div class="groupform">
        <label>GitHub Link</label>
        <input type="url" name="github" value="{$data->github}">
      </div>

      <div class="groupform">
        <label>Demo Link</label>
        <input type="url" name="demo" value="{$data->demo}">
      </div>

      <div class="groupform">
        <label>Status</label>
        <select name="statuspo">
          <option value="complated" $selectedPublished>complated</option>
          <option value="ongoing" $selectedDraft>ongoing</option>
        </select>
      </div>

      <div class="groupform">
        <label for="tag">Tags (pisahkan dengan koma)</label>
        <input type="text" name="tag" value="{$tagsString}">
      </div>

      <div class="groupform">
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
  HTML;
}

//function update project 
function update($id){
  global $db;
  $post = $_POST;
  $title = $post['title'];
  $deskrip= $post['deskrip'];
  $github = $post['github'];
  $demo = $post['demo'];
  $statuspo = $post['statuspo'];
  $tag = $post['tag'];
  $resault = array_map('trim',explode(',',$tag));


try{
$db->beginTransaction();
    //hapus dulu forign key nya
    $tagchange = "DELETE FROM tag WHERE project_id = :id";
    $stmt2 = $db->prepare($tagchange);
    $stmt2->bindParam(':id',$id);
    $stmt2->execute();
    $tagadd = "INSERT INTO tag(project_id, tag) value(:pro_id, :tag)";
    $stmttag = $db->prepare($tagadd);
    foreach($resault as $tag){
      $stmttag->bindParam(':pro_id',$id);
      $stmttag->bindParam(':tag',$tag);
      $stmttag->execute();
    }
  $data = "UPDATE project SET title = :title, deskrip = :deskrip, github = :github, demo = :demo, statuspo = :statuspo WHERE id = :id";
  $stmt = $db->prepare($data);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':deskrip', $deskrip);
  $stmt->bindParam(':github', $github);
  $stmt->bindParam(':demo', $demo);
  $stmt->bindParam(':statuspo', $statuspo);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $db->commit();
  $_SESSION['error'] = "Data Berhasil di update"; 
  }catch(Exception $e){
    $db->rollBack();
    echo "gagal memperbarui data dengan error " . $e->getMessage();
  }
}
// function untukk menghapus table
function del(int $id){
  global $db;
  try {
    $db->beginTransaction();
$deltag= "DELETE FROM tag WHERE project_id = :id";
$deldata = "DELETE FROM project WHERE id = :id";
  $stmt = $db->prepare($deltag);
  $stmt2 = $db->prepare($deldata);
    $stmt->bindParam(':id',$id);
    $stmt2->bindParam(':id',$id);
    $stmt->execute();
    $stmt2->execute();
    $db->commit();
    $_SESSION['error'] = "Berhasil Menghapus data $id";
  }catch(PDOException $e){
    $db->rollBack();
    echo "gagal menghapus ada kesalah $e";
  }

}
// function form untuk menambahkan crypto coin
function showsettings() {
  echo <<<HTML
  <section>
    <div class="kontainer-form">
      <h1 class="title-crypto">Add Crypto Currency</h1>
      <form action="" method="POST">
        <input type="hidden" name="action" value="addcry">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
          <label for="icon">Icon URL:</label>
          <input type="text" id="icon" name="icon" required>
        </div>
        <div class="form-group">
          <button type="submit" class="submit-btn">Add Currency</button>
        </div>
      </form>
    </div>
  </section>
  HTML;
}
// function untuk menambahkan skill section
function uploadskil(int $percentage, string $name, string $namesvg){
global $db;
try {
  $db->beginTransaction();
$svgContent = file_get_contents($_FILES['svg_file']['tmp_name']); 
$sql = "INSERT INTO skill(svg_name,skill,svg_content,percentage) VALUES(:svgname,:name,:svgcontent,:percentage)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':svgname',$namesvg);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':svgcontent',$svgContent);
$stmt->bindParam(':percentage',$percentage);
$stmt->execute();
$db->commit();
}catch(Exception $e){
  $db->rollBack();
echo"Fatal Error" . $e->getMessage();
}
}