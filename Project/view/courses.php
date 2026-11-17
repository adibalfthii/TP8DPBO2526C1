<?php include 'view/header.php'; ?>

<div class="row">
    <!-- Form Tambah / Edit Course -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header <?= $editData ? 'bg-warning text-dark' : 'bg-primary text-white' ?>">
                <h5 class="mb-0"><?= $editData ? 'Edit Course' : 'Create Course' ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=courses">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="course_code" class="form-control" placeholder="Contoh: IK204" value="<?= htmlspecialchars($editData['course_code'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" value="<?= htmlspecialchars($editData['course_name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Credits (SKS)</label>
                        <input type="number" name="credits" min="1" max="6" class="form-control" value="<?= $editData['credits'] ?? '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lecturer</label>
                        <select name="lecturer_id" class="form-select" required>
                            <option value="">-- Select Lecturer --</option>
                            <?php foreach ($lecturers as $lec): ?>
                                <option value="<?= $lec['id'] ?>" <?= (isset($editData['lecturer_id']) && $editData['lecturer_id'] == $lec['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($lec['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <?= $editData ? 'Update Course' : 'Submit' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="index.php?page=courses" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Courses -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Courses List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Credits</th>
                            <th>Lecturer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['course_code']) ?></td>
                                <td><?= htmlspecialchars($row['course_name']) ?></td>
                                <td><?= $row['credits'] ?> SKS</td>
                                <td><?= htmlspecialchars($row['lecturer_name']) ?></td>
                                <td>
                                    <a href="index.php?page=courses&action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=courses&action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'view/footer.php'; ?>