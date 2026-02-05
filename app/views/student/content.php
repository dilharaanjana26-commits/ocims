<?php require __DIR__ . '/../layouts/header.php'; ?>
<h2>Content & Updates</h2>
<h4>Teacher Posts</h4>
<ul class="list-group mb-4">
    <?php foreach ($posts as $post): ?>
        <li class="list-group-item">
            <strong><?= Helpers::e($post['teacher_name']) ?>:</strong>
            <?= Helpers::e($post['content']) ?>
        </li>
    <?php endforeach; ?>
</ul>
<h4>Tutes</h4>
<ul class="list-group mb-4">
    <?php foreach ($tutes as $tute): ?>
        <li class="list-group-item">
            <?= Helpers::e($tute['batch_name']) ?> - <?= Helpers::e($tute['title']) ?>
            <a class="btn btn-sm btn-outline-primary" href="<?= Helpers::e($tute['file_path']) ?>">Download</a>
        </li>
    <?php endforeach; ?>
</ul>
<h4>Live Classes</h4>
<ul class="list-group">
    <?php foreach ($live as $class): ?>
        <li class="list-group-item">
            <?= Helpers::e($class['batch_name']) ?> - <?= Helpers::e($class['schedule_date']) ?>
            <div><?= $class['youtube_embed_url'] ?></div>
        </li>
    <?php endforeach; ?>
</ul>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
