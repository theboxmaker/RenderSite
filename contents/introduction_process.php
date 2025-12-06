<?php
// Safely fetch values
function val($key) {
    return htmlspecialchars($_POST[$key] ?? '');
}

$first = val('first');
$middle = trim(val('middle'));
$last = val('last');
$pronouns = val('pronouns');
$about = val('about');
$image = val('image');
$caption = val('caption');

// Process courses (remove empty fields)
$courses = array_filter($_POST['courses'] ?? [], fn($c) => trim($c) !== "");
$courses = array_map('htmlspecialchars', $courses);

// Build full name
$fullName = $first;
if ($middle !== "") $fullName .= " " . $middle;
$fullName .= " " . $last;

?>

<h2>Introduction</h2>

<figure style="max-width:450px; margin:0 auto;">
    <img src="<?= $image ?>" alt="Profile image" style="width:100%; border-radius:12px;">
    <figcaption style="text-align:center; margin-top:5px;">
        <?= $caption ?>
    </figcaption>
</figure>

<p><strong>Name:</strong> <?= $fullName ?></p>

<?php if ($pronouns): ?>
    <p><strong>Pronouns:</strong> <?= $pronouns ?></p>
<?php endif; ?>

<p><?= nl2br($about) ?></p>

<h3>My Courses</h3>
<ul>
<?php foreach ($courses as $c): ?>
    <li><?= $c ?></li>
<?php endforeach; ?>
</ul>

<p><a href="introduction_form.php">← Go Back</a></p>
