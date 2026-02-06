<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="d-flex align-items-start justify-content-between mb-4">
    <div>
        <p class="text-uppercase lms-eyebrow">Learning hub</p>
        <h2 class="lms-heading">Content & updates</h2>
        <p class="text-muted mb-0">Catch every mentor post, download tutes, and rewatch live sessions.</p>
    </div>
    <span class="badge badge-category badge-category--indigo">Resources</span>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="lms-card fade-in h-100">
            <div class="lms-card__header">
                <h5 class="mb-0">Teacher posts</h5>
                <span class="badge badge-category badge-category--slate">Updates</span>
            </div>
            <div class="lms-feed">
                <?php foreach ($posts as $post): ?>
                    <div class="lms-feed__item">
                        <div class="fw-semibold"><?= Helpers::e($post['teacher_name']) ?></div>
                        <p class="text-muted mb-0"><?= Helpers::e($post['content']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="lms-card fade-in mb-4">
            <div class="lms-card__header">
                <h5 class="mb-0">Latest tutes</h5>
                <span class="badge badge-category badge-category--mint">Downloads</span>
            </div>
            <div class="lms-list">
                <?php foreach ($tutes as $tute): ?>
                    <div class="lms-list__item">
                        <div>
                            <div class="fw-semibold"><?= Helpers::e($tute['title']) ?></div>
                            <div class="text-muted small"><?= Helpers::e($tute['batch_name']) ?></div>
                        </div>
                        <a class="btn btn-sm btn-outline-primary" href="<?= Helpers::e($tute['file_path']) ?>">Download</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="lms-card fade-in">
            <div class="lms-card__header">
                <h5 class="mb-0">Live classes</h5>
                <span class="badge badge-category">Streaming</span>
            </div>
            <div class="lms-list">
                <?php foreach ($live as $class): ?>
                    <div class="lms-list__item lms-list__item--stacked">
                        <div>
                            <div class="fw-semibold"><?= Helpers::e($class['batch_name']) ?></div>
                            <div class="text-muted small"><?= Helpers::e($class['schedule_date']) ?></div>
                        </div>
                        <div class="lms-embed">
                            <?= $class['youtube_embed_url'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
