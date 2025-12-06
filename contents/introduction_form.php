<?php
// Prefill your intro data here
$defaults = [
    "first" => "Zachary",
    "middle" => "",
    "last" => "Tucker",
    "pronouns" => "he/him",
    "about" => "I am a web development student who enjoys PHP, MySQL, and solving complex problems.",
    "image" => "/images/zack-on-the-course.jpg",
    "caption" => "On the course!",
    "courses" => [
        "WEB250 – Database Driven Websites",
        "WEB210 – Advanced Web Programming",
        "WEB215 – Advanced Markup & Scripting"
    ]
];
?>

<h2>Introduction Form</h2>

<form action="introduction_process.php" method="post" enctype="multipart/form-data" style="max-width:800px; margin:0 auto;">

    <fieldset>
        <legend>Your Information</legend>

        <label>First Name:
            <input type="text" name="first" value="<?= htmlspecialchars($defaults['first']) ?>" required>
        </label>

        <label>Middle Name (optional):
            <input type="text" name="middle" value="<?= htmlspecialchars($defaults['middle']) ?>">
        </label>

        <label>Last Name:
            <input type="text" name="last" value="<?= htmlspecialchars($defaults['last']) ?>" required>
        </label>

        <label>About You:
            <textarea name="about" rows="5" required><?= htmlspecialchars($defaults['about']) ?></textarea>
        </label>
    </fieldset>

    <fieldset>
        <legend>Image</legend>

        <label>Image URL (or leave the default):
            <input type="text" name="image" value="<?= htmlspecialchars($defaults['image']) ?>">
        </label>

        <label>Caption:
            <input type="text" name="caption" value="<?= htmlspecialchars($defaults['caption']) ?>">
        </label>
    </fieldset>

    <fieldset>
        <legend>Your Courses</legend>

        <?php for ($i=0; $i<5; $i++): ?>
            <label>Course <?= $i+1 ?>:
                <input type="text" name="courses[]" 
                       value="<?= isset($defaults['courses'][$i]) ? htmlspecialchars($defaults['courses'][$i]) : '' ?>">
            </label>
        <?php endfor; ?>
        
        <p style="font-size:0.9em; color:#555;">(Leave extra course fields blank if not needed.)</p>
    </fieldset>

    <button type="submit">Generate Introduction</button>
</form>
