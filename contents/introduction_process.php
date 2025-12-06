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
$image = val('image'); // may be empty
$caption = val('caption');

// Process courses (remove empty fields)
$courses = array_filter($_POST['courses'] ?? [], fn($c) => trim($c) !== "");
$courses = array_map('htmlspecialchars', $courses);

// Build full name
$fullName = $first;
if ($middle !== "") {
    $fullName .= " " . $middle;
}
$fullName .= " " . $last;
?>

<h2>Introduction</h2>

<?php if (!empty($image)): ?>
    <figure style="max-width:450px; margin:0 auto;">
        <img 
            src="<?= $image ?>" 
            alt="<?= $caption !== '' ? $caption : 'Profile Image' ?>" 
            style="width:100%; border-radius:12px;"
        >
        <?php if (!empty($caption)): ?>
            <figcaption style="text-align:center; margin-top:5px;">
                <?= $caption ?>
            </figcaption>
        <?php endif; ?>
    </figure>
<?php else: ?>
    <p><em>No image provided.</em></p>
<?php endif; ?>

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
