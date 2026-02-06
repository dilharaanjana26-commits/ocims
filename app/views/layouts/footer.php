<?php if (isset($isAdminRoute) && $isAdminRoute): ?>
            </div>
        </main>
    </div>
<?php elseif ((isset($isStudentRoute) && $isStudentRoute) || (isset($isTeacherRoute) && $isTeacherRoute)): ?>
            </div>
        </main>
    </div>
<?php else: ?>
    </div>
<?php endif; ?>
<a class="floating-telegram" href="https://t.me/ceylonlankadigi" target="_blank" rel="noopener" aria-label="Chat on Telegram">
    <i class="fa-brands fa-telegram"></i>
    <span>Chat on Telegram</span>
</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
